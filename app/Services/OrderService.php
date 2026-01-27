<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createOrder(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $order = Order::create([
                'area_id' => $data['area_id'],
                'table_id' => $data['table_id'],
                'user_id' => auth()->id(),
                'status' => 'draft',
            ]);

            AuditService::log('create_order', 'Order', $order->id, "Order {$order->order_no} created");

            return $order;
        });
    }

    public function addItem(Order $order, array $itemData): OrderItem
    {
        $product = Product::findOrFail($itemData['product_id']);

        $orderItem = $order->items()->create([
            'product_id' => $product->id,
            'staff_id' => $itemData['staff_id'] ?? null,
            'quantity' => $itemData['quantity'],
            'unit_price' => $product->price,
            'subtotal' => $product->price * $itemData['quantity'],
            'modifiers' => $itemData['modifiers'] ?? null,
            'special_instructions' => $itemData['special_instructions'] ?? null,
            'department_status' => 'pending',
        ]);

        $this->recalculateOrder($order);

        AuditService::log('edit_order', 'OrderItem', $orderItem->id, "Item added to order {$order->order_no}");

        return $orderItem;
    }

    public function sendToDepartments(Order $order): void
    {
        DB::transaction(function () use ($order) {
            $order->update([
                'status' => 'sent_to_departments',
                'sent_at' => now(),
            ]);

            $order->items()->update(['department_status' => 'in_progress']);

            AuditService::log('send_to_printer', 'Order', $order->id, "Order {$order->order_no} sent to departments");
        });
    }

    public function recalculateOrder(Order $order): void
    {
        $settings = BusinessSetting::getSettings();

        $subtotal = $order->items()
            ->where('is_voided', false)
            ->sum(DB::raw('(quantity * unit_price) - discount_amount'));

        $discountAmount = $order->discounts()
            ->where('status', 'approved')
            ->sum('amount');

        $serviceCharge = 0;
        if ($settings->service_charge_mode === 'percent' && $settings->service_charge_rate > 0) {
            $serviceCharge = ($subtotal - $discountAmount) * ($settings->service_charge_rate / 100);
        } elseif ($settings->service_charge_mode === 'fixed') {
            $serviceCharge = $settings->service_charge_fixed;
        }

        $taxableAmount = $subtotal - $discountAmount + $serviceCharge;
        $tax = $taxableAmount * ($settings->tax_rate / 100);
        $total = $taxableAmount + $tax;

        $order->update([
            'subtotal' => $subtotal,
            'discount_amount' => $discountAmount,
            'service_charge' => $serviceCharge,
            'tax' => $tax,
            'total' => $total,
            'balance' => $total - $order->paid_amount,
        ]);
    }

    public function markAsBilled(Order $order): void
    {
        $order->update([
            'status' => 'billed',
            'billed_at' => now(),
        ]);

        AuditService::log('edit_order', 'Order', $order->id, "Order {$order->order_no} marked as billed");
    }

    public function closeOrder(Order $order): void
    {
        $order->update([
            'status' => 'closed',
            'closed_at' => now(),
        ]);

        $order->table()->update(['status' => 'available']);

        AuditService::log('end_of_day_close', 'Order', $order->id, "Order {$order->order_no} closed");
    }
}
