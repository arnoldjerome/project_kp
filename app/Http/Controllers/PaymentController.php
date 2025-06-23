<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        // Proses pembayaran dan simpan ke tabel payment
        $order = Order::findOrFail($request->order_id);

        $payment = Payment::create([
            'order_id' => $order->id,
            'reference' => 'INV-' . uniqid(),
            'method' => $request->method,
            'amount' => $order->total_price,
            'status' => 'unpaid',
        ]);

        return response()->json($payment);
    }

    public function updateStatus($id, Request $request)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = $request->status;
        $payment->paid_at = now();
        $payment->save();

        $order = $payment->order;

        if ($request->status === 'paid') {
            // Jika pembayaran berhasil dikonfirmasi
            foreach ($order->items as $item) {
                $product = $item->product;
                $product->decrement('stock', $item->quantity);
            }

            $order->status = 'paid';
        } elseif ($request->status === 'pending') {
            // Jika baru klik "Saya Sudah Bayar"
            $order->status = 'pending';
        }

        $order->save();

        return redirect()->route('payment.page', ['order_id' => $order->id])
            ->with('success', 'Pembayaran anda akan segera dikonfirmasi.');
    }
}
