<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{User, Category, Product, Order, OrderItem, Payment, Invoice, Chat, Message, CustomRequest};

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $customer = User::where('role', 'customer')->first();
        $admin = User::where('role', 'admin')->first();
        $category = Category::where('name', 'Indoor')->first();

        $product = Product::create([
            'name' => 'Lemari Kayu Premium',
            'description' => 'Lemari jati 3 pintu dengan desain modern minimalis.',
            'price' => 4500000,
            'stock' => 5,
            'category_id' => $category->id,
        ]);

        $order = Order::create([
            'user_id' => $customer->id,
            'total_price' => $product->price,
            'status' => 'paid',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        Payment::create([
            'order_id' => $order->id,
            'reference' => 'INV-2025001',
            'method' => 'QRIS',
            'amount' => $product->price,
            'status' => 'paid',
            'paid_at' => now(),
            'callback_response' => json_encode(['status' => 'PAID']),
        ]);

        Invoice::create([
            'order_id' => $order->id,
            'invoice_code' => 'INV-2025001',
            'amount' => $product->price,
            'generated_at' => now(),
        ]);

        $chat = Chat::create([
            'user_id' => $customer->id,
            'admin_id' => $admin->id,
            'started_at' => now(),
            'ended_at' => now()->addMinutes(10),
        ]);

        Message::create([
            'chat_id' => $chat->id,
            'sender' => 'user',
            'message' => 'Halo, apakah saya bisa pesan lemari custom?',
            'timestamp' => now(),
        ]);

        Message::create([
            'chat_id' => $chat->id,
            'sender' => 'admin',
            'message' => 'Tentu, silakan kirim spesifikasi Anda.',
            'timestamp' => now()->addMinutes(1),
        ]);

        CustomRequest::create([
            'user_id' => $customer->id,
            'request_detail' => 'Saya ingin lemari dengan tinggi 2 meter dan warna coklat tua.',
            'file_url' => 'https://example.com/contoh-gambar.png',
            'status' => 'pending',
        ]);
    }
}