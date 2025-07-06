<?php

namespace App\Http\Controllers;

use App\Models\CustomRequest;
use App\Models\Chat;
use Illuminate\Http\Request;

class CustomRequestController extends Controller
{

    public function index()
    {
        $requests = CustomRequest::with('user')->get();
        return view('customrequests.index', compact('requests'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'user_id' => 'required|exists:users,id',
            'price' => 'required|numeric',
        ]);

        $customRequest = CustomRequest::create([
            'user_id' => $validated['user_id'],
            'request_detail' => $validated['request_detail'],
            'file_url' => $validated['file_url'],
            'status' => 'pending',
            'price' => $validated['price'],
        ]);

        return response()->json($customRequest, 201);
    }

    public function updateStatus($id, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,done',
        ]);

        $customRequest = CustomRequest::findOrFail($id);
        $customRequest->status = $validated['status'];
        $customRequest->save();

        // Cari chat user
        $chat = Chat::where('user_id', $customRequest->user_id)->first();
        if ($chat) {
            $messageText = null;

            // Ambil data detail untuk pesan
            $detail = $customRequest->request_detail;
            $harga = $customRequest->price ? 'Rp' . number_format($customRequest->price, 0, ',', '.') : 'Belum ditentukan';

            // Ekstraksi nama dari judul (kalau kamu pakai format **Nama**: Deskripsi)
            preg_match('/\*\*(.*?)\*\*/', $detail, $match);
            $nama = $match[1] ?? 'Custom Product';
            $deskripsi = preg_replace('/\*\*(.*?)\*\*:\s*/', '', $detail); // hapus bagian nama dari deskripsi

            if ($validated['status'] === 'approved') {
                $messageText = "Pesanan Anda,\nNama: $nama\nHarga: $harga\nDeskripsi: $deskripsi\nSEDANG DIPROSES, MOHON MENUNGGU.";
            } elseif ($validated['status'] === 'done') {
                $messageText = "Pesanan Anda,\nNama: $nama\nHarga: $harga\nDeskripsi: $deskripsi\nSUDAH SELESAI. Terima kasih telah menunggu.";
            }

            if ($messageText) {
                \App\Models\Message::create([
                    'chat_id' => $chat->id,
                    'sender' => 'admin',
                    'message' => $messageText
                ]);
            }
        }

        return response()->json($customRequest);
    }

    public function storeFromChat(Request $request)
    {
        $validated = $request->validate([
            'chat_id' => 'required|exists:chats,id', // Boleh dipakai untuk relasi pesan, tapi bukan untuk tabel ini
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'user_id' => 'required|exists:users,id',
            'price' => 'required|numeric',
        ]);

        $filename = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('assets/images/sketsa'), $filename);

        $customRequest = CustomRequest::create([
            'user_id' => $validated['user_id'],
            'request_detail' => '**' . $validated['title'] . '**: ' . $validated['description'], // gabungkan
            'file_url' => 'assets/images/sketsa/' . $filename,
            'status' => 'pending',
            'price' => $validated['price']
        ]);

        return response()->json(['success' => true, 'data' => $customRequest], 201);
    }
}
