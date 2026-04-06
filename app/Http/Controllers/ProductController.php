<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Product::query();

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->paginate(12);
        $categories = \App\Models\Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = \App\Models\Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = \App\Models\Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        $ratings = $product->ratings()->with('user')->latest()->get();
        
        $hasPurchased = false;
        $canRate = false;

        if (auth()->check()) {
            $user = auth()->user();
            $hasPurchased = $user->hasPurchased($product);
            $alreadyRated = $product->ratings()->where('user_id', $user->id)->exists();
            $canRate = $hasPurchased && !$alreadyRated;
        }

        return view('products.show', compact('product', 'relatedProducts', 'ratings', 'canRate'));
    }

    public function storeRating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500', // Made comment optional per request
            'image' => 'nullable|image|max:2048',
        ]);

        $product = \App\Models\Product::findOrFail($id);
        $user = auth()->user();

        if (!$user->hasPurchased($product)) {
            return back()->with('error', 'You must complete an order for this product to rate it.');
        }

        if ($product->ratings()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'You have already rated this product.');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ratings', 'public');
        }

        \App\Models\Rating::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Rating submitted successfully!');
    }
}
