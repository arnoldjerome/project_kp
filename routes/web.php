<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/shop', function () {
    return view('shop.index');
});

Route::get('/aboutus', function () {
    return view('aboutus.index');
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

Route::get('/cart', function () {
    return view('cart.index');
});

Route::get('/checkout', function () {
    return view('checkout.index');
});

Route::get('/thankyou', function () {
    return view('thankyou.index');
});

Route::get('/login', function () {
    return view('login.index');
});

Route::get('/register', function () {
    return view('register.index');
});