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
            'status' => 'pending',
        ]);

        return response()->json($payment);
    }

    public function updateStatus($id, Request $request)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = $request->status;
        $payment->paid_at = now();
        $payment->save();

        return response()->json($payment);
    }
}