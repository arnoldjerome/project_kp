<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function startChat(Request $request)
    {
        // Mulai sesi chat baru antara user dan admin
        $chat = Chat::create([
            'user_id' => $request->user_id,
            'admin_id' => $request->admin_id,
            'started_at' => now(),
        ]);

        return response()->json($chat);
    }

    public function sendMessage($chat_id, Request $request)
    {
        // Kirim pesan baru dalam chat
        $message = Message::create([
            'chat_id' => $chat_id,
            'sender' => $request->sender,
            'message' => $request->message,
            'timestamp' => now(),
        ]);

        return response()->json($message);
    }

    public function endChat($id)
    {
        // Akhiri chat
        $chat = Chat::findOrFail($id);
        $chat->ended_at = now();
        $chat->save();

        return response()->json($chat);
    }
}