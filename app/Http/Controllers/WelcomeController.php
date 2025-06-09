<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WelcomeController extends Controller
{
    public function index()
    {
        $indoorProducts = Product::where('category_id', 1)
            ->orderBy('created_at', 'desc')
            ->take(7)
            ->get();

        $outdoorProducts = Product::where('category_id', 2)
            ->orderBy('created_at', 'desc')
            ->take(7)
            ->get();

        return view('welcome', compact('indoorProducts', 'outdoorProducts'));
    }

}



