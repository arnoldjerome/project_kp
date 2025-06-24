<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\CustomRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Payment::where('status', 'paid')->sum('amount');

        $ordersByStatus = Order::select('status')
            ->selectRaw('count(*) as count')
            ->groupBy('status')
            ->get();

        $customRequests = CustomRequest::latest()->limit(5)->get();

        $topCustomers = User::select('id', 'name')
            ->withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->limit(5)
            ->get();

        return view('report.index', compact(
            'totalOrders', 'totalRevenue', 'ordersByStatus', 'customRequests', 'topCustomers'
        ));
    }
}
