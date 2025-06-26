<?php

namespace App\Http\Controllers;

use App\Models\CustomRequest;
use Illuminate\Http\Request;

class CustomRequestController extends Controller
{

    public function index()
    {
        $requests = CustomRequest::all();
        return view('customrequests.index', compact('requests'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'request_detail' => 'required|string',
            'file_url' => 'required|string',
        ]);

        $customRequest = CustomRequest::create([
            'user_id' => $validated['user_id'],
            'request_detail' => $validated['request_detail'],
            'file_url' => $validated['file_url'],
            'status' => 'pending',
        ]);

        return response()->json($customRequest, 201);
    }

    public function updateStatus($id, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved',
        ]);

        $customRequest = CustomRequest::findOrFail($id);
        $customRequest->status = $validated['status'];
        $customRequest->save();

        return response()->json($customRequest, 200); // 200 = OK
    }
    public function storeFromChat(Request $request)
    {
        $validated = $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Simpan file ke folder public/assets/images/sketsa/
        $filename = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('assets/images/sketsa'), $filename);

        $customRequest = CustomRequest::create([
            'chat_id' => $validated['chat_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_url' => 'assets/images/sketsa/' . $filename,
            'status' => 'pending'
        ]);

        return response()->json(['success' => true, 'data' => $customRequest], 201);
    }
}
