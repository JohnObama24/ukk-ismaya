<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Order::with('items.product')
            ->where('user_id', auth()->id());

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(5);
        
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = \App\Models\Order::with('items.product')
            ->where('user_id', auth()->id())
            ->findOrFail($id);
        
        return view('orders.show', compact('order'));
    }

    public function invoice($id)
    {
        $order = \App\Models\Order::with('items.product')
            ->where('user_id', auth()->id())
            ->findOrFail($id);
        
        return view('orders.invoice', compact('order'));
    }

    public function markAsCompleted($id)
    {
        $order = \App\Models\Order::where('user_id', auth()->id())->findOrFail($id);

        if ($order->status == 'delivered') { // Assumes 'delivered' means shipped/arrived but not yet 'completed' by user
            $order->update(['status' => 'completed']);
            return back()->with('success', 'Pesanan diterima! Anda sekarang dapat memberikan penilaian.');
        }

        return back()->with('error', 'Pesanan tidak dapat diselesaikan saat ini.');
    }
}
