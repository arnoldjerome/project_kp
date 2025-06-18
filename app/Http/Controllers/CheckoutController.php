<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $user = Auth::user();

        // Simpan order
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $request->price * $request->quantity,
            'status' => 'pending',
        ]);

        // Simpan item order
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        // Simpan pembayaran dengan status "pending"
        $payment = Payment::create([
            'order_id' => $order->id,
            'reference' => 'INV-' . uniqid(),
            'method' => 'bca_qris',
            'amount' => $order->total_price,
            'status' => 'pending',
        ]);

        // Arahkan ke halaman payment (bisa kirim data QR dari BCA API nanti)
        return redirect()->route('payment.page', ['order_id' => $order->id]);
    }
}
