<?php

namespace App\Http\Controllers;

use App\Models\CustomRequest;
use Illuminate\Http\Request;

class CustomRequestController extends Controller
{
    public function create(Request $request)
    {
        // Menambahkan permintaan custom furniture
        $customRequest = CustomRequest::create([
            'user_id' => $request->user_id,
            'request_detail' => $request->request_detail,
            'file_url' => $request->file_url,
            'status' => 'pending',
        ]);

        return response()->json($customRequest);
    }

    public function updateStatus($id, Request $request)
    {
        $customRequest = CustomRequest::findOrFail($id);
        $customRequest->status = $request->status;
        $customRequest->save();

        return response()->json($customRequest);
    }
}