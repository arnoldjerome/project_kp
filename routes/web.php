<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/contactus', function () {
    return view('contactus.index');
});

Route::get('/invoice', function () {
    return view('invoice.index');
});

Route::get('/payment', function () {
    return view('payment.index');
});

Route::get('/thankyou', function () {
    return view('thankyou.index');
});

Route::get('/productint', function () {
    return view('productint.index');
});
Route::get('/productext', function () {
    return view('productext.index');
});

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.process');

Route::get('/register', function () {
    return view('register.index');
});

Route::get('/detailproduct', function () {
    return view('detailproduct.index');
});

Route::post('/register', [UserController::class, 'store'])->name('register.process');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');