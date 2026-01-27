<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Table;
use App\Models\Area;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->format('Y-m-d');
        
        $stats = [
            'today_orders' => Order::whereDate('created_at', $today)->count(),
            'today_sales' => Order::whereDate('created_at', $today)
                ->whereIn('status', ['paid', 'closed'])
                ->sum('total'),
            'open_tables' => Table::where('status', 'occupied')->count(),
            'pending_orders' => Order::whereIn('status', ['draft', 'sent_to_departments', 'in_progress'])->count(),
        ];

        $areas = Area::with(['tables' => function ($query) {
            $query->where('active', true);
        }])->where('active', true)->get();

        return view('dashboard', compact('stats', 'areas'));
    }
}
