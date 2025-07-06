<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan semua order
    public function index()
    {
        $orders = Order::with(['items', 'payment', 'invoice'])->get();
        return response()->json($orders);
    }

    // Menampilkan detail order berdasarkan ID
    public function show($id)
    {
        $order = Order::with(['items', 'payment', 'invoice'])->findOrFail($id);
        return response()->json($order);
    }

    // Membuat order baru
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
            'status' => 'pending',
        ]);

        // Menambahkan item ke order
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Menambahkan pembayaran
        Payment::create([
            'order_id' => $order->id,
            'reference' => 'INV-' . uniqid(),
            'method' => $request->method,
            'amount' => $order->total_price,
            'status' => 'pending',
        ]);

        // Menambahkan invoice
        Invoice::create([
            'order_id' => $order->id,
            'invoice_code' => 'INV-' . uniqid(),
            'amount' => $order->total_price,
            'generated_at' => now(),
        ]);

        return response()->json($order, 201);
    }

    // Mengupdate status order
    public function updateStatus($id, Request $request)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return response()->json($order);
    }

    // Menghapus order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }

    public function showPendingOrders()
    {
        $orders = Order::where('status', 'pending')->with(['user', 'items.product'])->get();
        return view('orders.index', compact('orders'));
    }

    public function markAsPaid($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'paid';
        $order->save();

        return response()->json(['success' => true]);
    }
}
