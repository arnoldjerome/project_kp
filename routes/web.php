<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CustomRequestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReportController;

// Landing & Pages
Route::get('/', [WelcomeController::class, 'index']);
Route::get('/chat', fn() => view('chat.index'));
Route::get('/services', fn() => view('services.index'));
Route::get('/blog', fn() => view('blog.index'));
Route::get('/register', fn() => view('register.index'));

// Product Pages
Route::get('/productint', [ProductController::class, 'showIndoor']);
Route::get('/productext', [ProductController::class, 'showOutdoor']);
Route::get('/detailproduct/{id}', [ProductController::class, 'show'])->name('product.detail');

// Auth
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.process');
Route::post('/register', [UserController::class, 'store'])->name('register.process');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Checkout Flow
Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])
    ->middleware('auth')
    ->name('checkout');

Route::post('/checkout', [CheckoutController::class, 'process'])
    ->middleware('auth')
    ->name('checkout.process');

// Payment Page (after redirect)
Route::get('/payment/{order_id}', function ($order_id) {
    $order = \App\Models\Order::with(['items', 'payment'])->findOrFail($order_id);
    return view('payment.index', compact('order'));
})->name('payment.page');

Route::get('/payment', fn() => view('payment.index'));
Route::put('/payment/confirm/{id}', [PaymentController::class, 'updateStatus'])->name('payment.confirm');

// Invoice
Route::get('/invoice', function () {
    $user = Auth::user();
    $orders = \App\Models\Order::with(['items.product', 'payment'])
        ->where('user_id', $user->id)
        ->whereHas('payment', function ($query) {
            $query->where('status', ['pending','paid']);
        })
        ->get();
    return view('invoice.index', compact('orders'));
})->middleware('auth')->name('invoice.index');

// Admin Custom Request
Route::get('/customrequests', [CustomRequestController::class, 'index'])->name('customrequests.index');
Route::post('/customrequests/{id}/approve', [CustomRequestController::class, 'updateStatus'])->name('customrequests.approve');


Route::middleware(['auth'])->put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

Route::post('/products', [ProductController::class, 'store'])->middleware('auth')->name('products.store');

Route::get('/report', [ReportController::class, 'index'])
->middleware(['auth'])
->name('report.index');



Route::get('/report/pdf', [ReportController::class, 'exportPdf'])
    ->middleware(['auth'])
    ->name('report.pdf');

Route::get('/report/download', [ReportController::class, 'download'])->name('report.download');
