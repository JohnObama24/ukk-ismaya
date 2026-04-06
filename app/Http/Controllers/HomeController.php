<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $categories = \App\Models\Category::all();
        // Shopee-style: Get many products for the "Daily Discover" grid with pagination
        $products = \App\Models\Product::latest()->paginate(30);

        return view('home', compact('categories', 'products'));
    }
}
