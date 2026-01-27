<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Payment;
use App\Models\BusinessSetting;
use App\Services\OrderService;
use App\Services\PrintService;
use App\Services\AuditService;
use Illuminate\Support\Facades\DB;

class OrderManager extends Component
{
    public $order;
    public $table;
    public $products = [];
    public $staff = [];
    public $selectedProduct = null;
    public $quantity = 1;
    public $selectedStaff = null;
    public $modifiers = '';
    public $instructions = '';
    public $paymentMethod = 'Cash';
    public $paymentAmount = 0;
    public $showPaymentModal = false;

    protected $listeners = ['productSelected', 'sendToDepartments', 'processPayment'];

    public function mount(Order $order = null, $table = null)
    {
        if ($order) {
            $this->order = $order->load(['items.product', 'items.staff', 'payments']);
        }
        $this->table = $table;
    }

    public function productSelected($productId, $staffId = null)
    {
        $this->selectedProduct = Product::find($productId);
        $this->selectedStaff = $staffId;
        $this->quantity = 1;
        
        // Auto-add if product is not commissionable, otherwise wait for staff selection
        if ($this->selectedProduct && !$this->selectedProduct->is_commissionable) {
            $this->addItem();
        }
    }

    public function addItem()
    {
        if (!$this->order) {
            $this->createOrder();
        }

        if (!$this->selectedProduct) {
            return;
        }

        $orderService = app(OrderService::class);

        $itemData = [
            'product_id' => $this->selectedProduct->id,
            'quantity' => $this->quantity,
            'staff_id' => $this->selectedProduct->is_commissionable ? $this->selectedStaff : null,
            'modifiers' => $this->modifiers,
            'special_instructions' => $this->instructions,
        ];

        $orderService->addItem($this->order, $itemData);

        $this->order->refresh();
        $this->reset(['selectedProduct', 'selectedStaff', 'quantity', 'modifiers', 'instructions']);
    }

    protected function createOrder()
    {
        $orderService = app(OrderService::class);
        $this->order = $orderService->createOrder([
            'area_id' => $this->table->area_id,
            'table_id' => $this->table->id,
        ]);

        // Update table status
        $this->table->update(['status' => 'occupied']);
    }

    public function removeItem($itemId)
    {
        $item = OrderItem::find($itemId);
        if ($item && $this->order->status === 'draft') {
            $item->delete();
            app(OrderService::class)->recalculateOrder($this->order);
            $this->order->refresh();
        }
    }

    public function sendToDepartments()
    {
        if (!$this->order || $this->order->items->isEmpty()) {
            return;
        }

        $orderService = app(OrderService::class);
        $printService = app(PrintService::class);

        $orderService->sendToDepartments($this->order);

        // Print to departments
        $departments = $this->order->items->pluck('product.department.code')->unique()->filter();
        foreach ($departments as $deptCode) {
            $printService->printOrderToDepartment($this->order, $deptCode);
        }

        $this->order->refresh();
        $this->dispatch('orderSent');
    }

    public function openPaymentModal()
    {
        $this->paymentAmount = $this->order->balance;
        $this->showPaymentModal = true;
    }

    public function processPayment()
    {
        if ($this->paymentAmount <= 0 || $this->paymentAmount > $this->order->balance) {
            return;
        }

        DB::transaction(function () {
            Payment::create([
                'order_id' => $this->order->id,
                'payment_method' => $this->paymentMethod,
                'amount' => $this->paymentAmount,
                'user_id' => auth()->id(),
            ]);

            $this->order->paid_amount += $this->paymentAmount;
            $this->order->balance = $this->order->total - $this->order->paid_amount;

            if ($this->order->balance <= 0) {
                $this->order->status = 'paid';
                $this->order->paid_at = now();
                app(OrderService::class)->closeOrder($this->order);
            }

            $this->order->save();
        });

        AuditService::log('payment_recorded', 'Order', $this->order->id, 
            "Payment of {$this->paymentAmount} recorded for order {$this->order->order_no}");

        $this->order->refresh();
        $this->showPaymentModal = false;
        $this->dispatch('paymentProcessed');
    }

    public function render()
    {
        $settings = BusinessSetting::getSettings();
        return view('livewire.order-manager', compact('settings'));
    }
}
