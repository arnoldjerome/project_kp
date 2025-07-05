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
        if ($chat)
            return response()->json($chat);

        $chat = Chat::create([
            'user_id' => $request->user_id,
            'admin_id' => 1,
            'started_at' => now(),
        ]);

        return response()->json($chat);
    }

    public function endChat($id)
    {
        $chat = Chat::findOrFail($id);
        $chat->ended_at = now();
        $chat->save();

        return response()->json($chat);
    }

    public function getChatsForAdmin()
    {
        $chats = Chat::with([
            'user',
            'messages' => function ($q) {
                $q->latest()->limit(1);
            }
        ])->get();

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
        // Cek apakah user sedang login dan merupakan admin
        if (auth()->check() && auth()->user()->is_admin) {
            // Admin hanya melihat pesan yang tidak disembunyikan dari tampilan admin
            $messages = $chat->messages()
                ->where('is_hidden_by_admin_view', false)
                ->orderBy('created_at')
                ->get();
        } else {
            // User melihat semua pesan tanpa filter
            $messages = $chat->messages()
                ->orderBy('created_at')
                ->get();
        }

        return response()->json($messages);
    }



    public function sendMessageFromAdmin(Request $request, Chat $chat)
    {
        $text = $request->input('message');

        $message = $chat->messages()->create([
            'sender' => 'admin',
            'message' => $text,
            'timestamp' => now(),
            'is_hidden_by_admin' => false,
            'is_hidden_by_admin_view' => false,
        ]);

        return response()->json($message);
    }

    public function sendMessageFromUser(Request $request, Chat $chat)
    {
        $message = $chat->messages()->create([
            'sender' => 'user',
            'message' => $request->message,
            'timestamp' => now(),
            'is_hidden_by_admin' => false,
            'is_hidden_by_admin_view' => false,
        ]);

        return response()->json($message);
    }

    public function hideMessage($id)
    {
        $message = Message::findOrFail($id);
        $message->is_hidden_by_admin = true;
        $message->is_hidden_by_admin_view = true;
        $message->save();

        return response()->json(['status' => 'success']);
    }

    public function clearAllMessages(Chat $chat)
    {
        // Sembunyikan semua pesan hanya dari tampilan admin (bukan hapus)
        $chat->messages()->update(['is_hidden_by_admin_view' => true]);

        return response()->json(['status' => 'cleared']);
    }

    public function clearAdminMessages(Chat $chat)
    {
        // Tandai semua pesan dari admin sebagai hidden permanen
        $chat->messages()
            ->where('sender', 'admin')
            ->update([
                'is_hidden_by_admin' => true,
                'is_hidden_by_admin_view' => true,
            ]);

        return response()->json(['status' => 'cleared']);
    }
}
