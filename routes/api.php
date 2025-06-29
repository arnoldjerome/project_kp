<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CustomRequestController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// SEMENTARA: Tanpa auth untuk cek koneksi API
Route::get('/admin/chats', [ChatController::class, 'getChatsForAdmin']);
Route::get('/admin/chats/{chat}', [ChatController::class, 'getChatMessages']);
Route::post('/admin/chats/{chat}/messages', [ChatController::class, 'sendMessageFromAdmin']);
Route::post('/customrequests', [CustomRequestController::class, 'create'])->name('customrequests.create');
Route::post('/admin/chats/start', [ChatController::class, 'startChat']);
Route::post('/admin/custom-request', [CustomRequestController::class, 'storeFromChat']);
Route::post('/user/chats/{chat}/messages', [ChatController::class, 'sendMessageFromUser']);

;
