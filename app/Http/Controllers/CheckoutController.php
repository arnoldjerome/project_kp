<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);
        $quantity = (int) $request->quantity;

        // Validasi lagi sebelum buat order
        if ($quantity > $product->stock) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }

        // Simpan order
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $product->price * $quantity,
            'status' => 'pending',
        ]);

        // Simpan item order
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price,
        ]);

        // Kurangi stok produk
        $product->decrement('stock', $quantity);

        // Simpan pembayaran
        $payment = Payment::create([
            'order_id' => $order->id,
            'reference' => 'INV-' . uniqid(),
            'method' => 'bca_qris',
            'amount' => $order->total_price,
            'status' => 'pending',
        ]);

        return redirect()->route('payment.page', ['order_id' => $order->id]);

    }

    public function showCheckoutForm(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = (int) $request->quantity;

        if ($quantity < 1) {
            return redirect()->back()->with('error', 'Jumlah tidak boleh kurang dari 1.');
        }

        if ($quantity > $product->stock) {
            return redirect()->back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        return view('checkout.index', compact('product', 'quantity'));
    }


}
