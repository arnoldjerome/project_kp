<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\Product;
use App\Models\Payment;
use App\Models\CustomRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


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
            'totalOrders',
            'totalRevenue',
            'ordersByStatus',
            'customRequests',
            'topCustomers'
        ));
    }



    public function exportPdf()
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

        $pdf = Pdf::loadView('report.pdf', compact(
            'totalOrders',
            'totalRevenue',
            'ordersByStatus',
            'customRequests',
            'topCustomers'
        ));

        return $pdf->download('laporan-ringkasan.pdf');
    }

    public function download()
    {
        $month = now()->format('F Y'); // contoh: "July 2025"
        $monthlyOrders = Order::with(['user', 'items.product'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();

        $stockSummary = Product::withCount('orderItems as total_sold')
            ->get()
            ->map(function ($product) {
                $remaining = $product->stock - $product->total_sold;
                return [
                    'name' => $product->name,
                    'initial_stock' => $product->stock,
                    'sold' => $product->total_sold,
                    'remaining' => $remaining,
                    'status' => $remaining <= 5 ? 'Hampir Habis' : 'Aman',
                ];
            });

        $topProducts = Product::withCount('orderItems')->orderByDesc('order_items_count')->take(5)->get();

        $customRequests = CustomRequest::with('user')->latest()->limit(5)->get();

        $pdf = Pdf::loadView('report.detailed_pdf', compact(
            'month',
            'monthlyOrders',
            'stockSummary',
            'topProducts',
            'customRequests'
        ));

        return $pdf->download('laporan-rinci-BCS.pdf');
    }
}
