<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payout;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function sales(Request $request)
    {
        $date = $request->get('date', now()->format('Y-m-d'));

        $orders = Order::whereDate('created_at', $date)
            ->whereIn('status', ['paid', 'closed'])
            ->with(['area', 'table', 'user'])
            ->get();

        $summary = [
            'total_orders' => $orders->count(),
            'total_sales' => $orders->sum('total'),
            'total_discounts' => $orders->sum('discount_amount'),
            'total_tax' => $orders->sum('tax'),
            'total_service_charge' => $orders->sum('service_charge'),
        ];

        return view('reports.sales', compact('orders', 'summary', 'date'));
    }

    public function payroll(Request $request)
    {
        $date = $request->get('date', now()->format('Y-m-d'));

        $payouts = Payout::where('payout_date', $date)
            ->where('status', 'finalized')
            ->with(['staff', 'approvedBy'])
            ->get();

        return view('reports.payroll', compact('payouts', 'date'));
    }
}
