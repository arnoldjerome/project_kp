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
}
