<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Table;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Staff;
use App\Services\OrderService;
use App\Services\PrintService;
use App\Services\AuditService;

class POSController extends Controller
{
    protected $orderService;
    protected $printService;

    public function __construct(OrderService $orderService, PrintService $printService)
    {
        $this->orderService = $orderService;
        $this->printService = $printService;
    }

    public function index()
    {
        $areas = Area::with(['tables' => function ($query) {
            $query->where('active', true)->orderBy('sort_order');
        }])->where('active', true)->orderBy('sort_order')->get();

        return view('pos.index', compact('areas'));
    }

    public function table(Table $table)
    {
        $table->load('area');
        
        $categories = Category::where('active', true)->orderBy('sort_order')->get();
        $products = Product::with(['category', 'department'])
            ->where('active', true)
            ->get();

        $staff = Staff::where('active', true)
            ->whereIn('staff_type', ['Model', 'Host', 'Waitress'])
            ->get();

        $activeOrder = Order::where('table_id', $table->id)
            ->whereIn('status', ['draft', 'sent_to_departments', 'in_progress', 'ready', 'billed'])
            ->with(['items.product', 'items.staff', 'payments'])
            ->first();

        return view('pos.table', compact('table', 'categories', 'products', 'staff', 'activeOrder'));
    }
}
