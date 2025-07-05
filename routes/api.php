<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CustomRequestController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API routes
Route::get('/admin/chats', [ChatController::class, 'getChatsForAdmin']);
Route::get('/admin/chats/{chat}', [ChatController::class, 'getChatMessages']);
Route::post('/admin/chats/{chat}/messages', [ChatController::class, 'sendMessageFromAdmin']);
Route::post('/admin/chats/{chat}/clear', [ChatController::class, 'clearAllMessages']);
Route::post('/customrequests', [CustomRequestController::class, 'create'])->name('customrequests.create');
Route::post('/admin/chats/start', [ChatController::class, 'startChat']);
Route::post('/admin/custom-request', [CustomRequestController::class, 'storeFromChat']);
Route::post('/user/chats/{chat}/messages', [ChatController::class, 'sendMessageFromUser']);
Route::post('/admin/messages/{id}/hide', [ChatController::class, 'hideMessage']);
