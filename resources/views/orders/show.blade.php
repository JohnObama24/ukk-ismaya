@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('orders.index') }}" class="inline-flex items-center text-sm font-bold text-orange-600 hover:text-orange-500 transition">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Riwayat Pesanan
            </a>
        </div>

        <!-- Order Header -->
        <div class="bg-white shadow sm:rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Pesanan #{{ $order->order_number }}</h1>
                        <p class="mt-1 text-sm text-gray-500">Dipesan pada {{ $order->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div class="flex space-x-3">
                        @if($order->status == 'delivered')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-orange-100 text-orange-800">
                            Selesai
                        </span>
                        @elseif($order->status == 'shipped')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-orange-100 text-orange-800">
                            Dikirim
                        </span>
                        @elseif($order->status == 'cancelled')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-800">
                            Dibatalkan
                        </span>
                        @elseif($order->status == 'processing')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-purple-100 text-purple-800">
                            Diproses
                        </span>
                        @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-yellow-100 text-yellow-800">
                            Menunggu
                        </span>
                        @endif
                        <a href="{{ route('orders.invoice', $order->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            Invoice
                        </a>
                    </div>
                </div>
            </div>

            <!-- Progress Stepper -->
            <div class="px-6 py-8 border-b border-gray-100 bg-white">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t-2 border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-between">
                        <!-- Step 1: Menunggu -->
                        <div class="flex flex-col items-center">
                            <div class="relative flex h-10 w-10 items-center justify-center rounded-full {{ in_array($order->status, ['pending', 'processing', 'shipped', 'delivered']) ? 'bg-orange-600 text-white' : 'bg-gray-200 text-gray-400' }} ring-4 ring-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <span class="mt-2 text-[10px] font-bold uppercase tracking-wider {{ in_array($order->status, ['pending', 'processing', 'shipped', 'delivered']) ? 'text-orange-600' : 'text-gray-500' }}">Diterima</span>
                        </div>

                        <!-- Step 2: Diproses -->
                        <div class="flex flex-col items-center">
                            <div class="relative flex h-10 w-10 items-center justify-center rounded-full {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'bg-orange-600 text-white' : 'bg-gray-200 text-gray-400' }} ring-4 ring-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <span class="mt-2 text-[10px] font-bold uppercase tracking-wider {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'text-orange-600' : 'text-gray-500' }}">Diproses</span>
                        </div>

                        <!-- Step 3: Dikirim -->
                        <div class="flex flex-col items-center">
                            <div class="relative flex h-10 w-10 items-center justify-center rounded-full {{ in_array($order->status, ['shipped', 'delivered']) ? 'bg-orange-600 text-white' : 'bg-gray-200 text-gray-400' }} ring-4 ring-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <span class="mt-2 text-[10px] font-bold uppercase tracking-wider {{ in_array($order->status, ['shipped', 'delivered']) ? 'text-orange-600' : 'text-gray-500' }}">Dikirim</span>
                        </div>

                        <!-- Step 4: Selesai -->
                        <div class="flex flex-col items-center">
                            <div class="relative flex h-10 w-10 items-center justify-center rounded-full {{ $order->status == 'delivered' ? 'bg-orange-600 text-white' : 'bg-gray-200 text-gray-400' }} ring-4 ring-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="mt-2 text-[10px] font-bold uppercase tracking-wider {{ $order->status == 'delivered' ? 'text-orange-600' : 'text-gray-500' }}">Selesai</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="px-6 py-5">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Daftar Produk</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                    <div class="flex items-center py-4 border-b border-gray-100 last:border-0">
                        <div class="flex-shrink-0 w-20 h-20 bg-gray-200 rounded-lg overflow-hidden flex items-center justify-center">
                            <span class="text-xs text-gray-500 text-center px-1">{{ $item->product ? $item->product->name : 'Product' }}</span>
                        </div>
                        <div class="ml-6 flex-1">
                            <h3 class="text-base font-medium text-gray-900">
                                {{ $item->product ? $item->product->name : 'Product Unavailable' }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-base font-bold text-gray-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-500">Rp {{ number_format($item->price, 0, ',', '.') }} per item</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-gray-50 px-6 py-5">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold text-gray-900">Total Pembayaran</span>
                    <span class="text-2xl font-extrabold text-orange-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
