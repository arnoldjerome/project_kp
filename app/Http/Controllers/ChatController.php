<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function startChat(Request $request)
    {
        $chat = Chat::where('user_id', $request->user_id)->first();
        if ($chat) return response()->json($chat);

        $chat = Chat::create([
            'user_id' => $request->user_id,
            'admin_id' => 1, // default admin
            'started_at' => now(),
        ]);
        return response()->json($chat);
    }


    public function endChat($id)
    {
        // Akhiri chat
        $chat = Chat::findOrFail($id);
        $chat->ended_at = now();
        $chat->save();

        return response()->json($chat);
    }
    // ChatController.php
    public function getChatsForAdmin()
    {
        // Mengambil list chat dengan user, latest message dan unread count jika ada
        $chats = Chat::with(['user', 'messages' => function ($q) {
            $q->latest()->limit(1);
        }])->get();

        // Tambah field preview message dan last_timestamp
        $data = $chats->map(function ($chat) {
            $latestMessage = $chat->messages->first();
            return [
                'chat_id' => $chat->id,
                'user_id' => $chat->user_id,
                'user_name' => $chat->user->name,
                'user_avatar' => '/public/assets/images/bcs.png',
                'latest_message' => $latestMessage ? $latestMessage->message : '',
                'last_timestamp' => $latestMessage ? $latestMessage->created_at->format('m/d/Y H:i') : '',
            ];
        });

        return response()->json($data);
    }

    public function getChatMessages(Chat $chat)
    {
        $messages = $chat->messages()->orderBy('created_at')->get();

        return response()->json($messages);
    }

    public function sendMessageFromAdmin(Request $request, Chat $chat)
    {
        $text = $request->input('message');

        // Jika admin kirim [custom_request_button], ubah jadi tombol
        $message = $chat->messages()->create([
            'sender' => 'admin',
            'message' => $text, // tetap kirim teks untuk disimpan, frontend akan olah
            'timestamp' => now(),
        ]);

        return response()->json($message);
    }
    public function sendMessageFromUser(Request $request, Chat $chat)
    {
        $message = $chat->messages()->create([
            'sender' => 'user',
            'message' => $request->message,
            'timestamp' => now(),
        ]);

        return response()->json($message);
    }
}
