<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CustomRequestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckoutController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chat', function () {
    return view('chat.index');
});

Route::get('/services', function () {
    return view('services.index');
});

Route::get('/blog', function () {
    return view('blog.index');
});

Route::get('/checkout', function () {
    return view('checkout.index');
});

Route::get('/invoice', function () {
    $user = Auth::user();
    $orders = \App\Models\Order::with(['items.product', 'payment'])
        ->where('user_id', $user->id)
        ->whereHas('payment') // hanya yang sudah ada pembayaran
        ->get();

    return view('invoice.index', compact('orders'));
})->middleware('auth')->name('invoice.index');


Route::get('/payment', function () {
    return view('payment.index');
});

Route::get('/thankyou', function () {
    return view('thankyou.index');
});

Route::get('/productint', [ProductController::class, 'showIndoor']);
Route::get('/productext', [ProductController::class, 'showOutdoor']);


Route::get('/', [WelcomeController::class, 'index']);


Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.process');

Route::get('/register', function () {
    return view('register.index');
});

Route::get('/detailproduct/{id}', [ProductController::class, 'show'])->name('product.detail');



Route::post('/register', [UserController::class, 'store'])->name('register.process');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/customrequests', [CustomRequestController::class, 'index'])->name('customrequests.index');
Route::post('/customrequests/{id}/approve', [CustomRequestController::class, 'updateStatus'])->name('customrequests.approve');

Route::post('/checkout', [CheckoutController::class, 'process'])->middleware('auth')->name('checkout.process');
Route::get('/payment/{order_id}', function ($order_id) {
    $order = \App\Models\Order::with(['items', 'payment'])->findOrFail($order_id);
    return view('payment.index', compact('order'));
})->name('payment.page');

Route::put('/payment/confirm/{id}', [PaymentController::class, 'updateStatus'])->name('payment.confirm');


