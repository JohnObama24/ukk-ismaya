@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 font-sans">Temukan merchendise Favoritmu</h1>

        <div class="mt-6 lg:grid lg:grid-cols-4 lg:gap-x-8">
            <!-- Sidebar / Filters -->
            <div class="hidden lg:block space-y-4">
                <h3 class="text-lg font-medium text-gray-900">Categories</h3>
                <ul class="space-y-3 pb-6 border-b border-gray-200 text-sm font-medium text-gray-900">
                    <li>
                        <a href="{{ route('products.index') }}" class="@if(!request('category')) text-orange-600 @else text-gray-500 @endif hover:text-orange-600">
                            Semua Kategori
                        </a>
                    </li>
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="@if(request('category') == $category->slug) text-orange-600 @else text-gray-500 @endif hover:text-orange-600">
                            {{ $category->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Product Grid -->
            <div class="mt-6 lg:mt-0 lg:col-span-3">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-2">
                    @foreach($products as $product)
                    <div class="group relative flex flex-col bg-white hover:shadow-lg transition shadow-sm border border-transparent hover:border-orange-500 duration-200">
                        <!-- Product Image -->
                        <a href="{{ route('products.show', $product->slug) }}" class="relative aspect-square bg-white block">
                            <div class="absolute inset-0 flex items-center justify-center">
                                 <!-- ... image placeholder ... -->
                                 <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain text-xs text-gray-400">
                            </div>
                            <!-- Badge -->
                            @if($loop->index == 0)
                            <div class="absolute top-0 left-0 bg-yellow-400 text-white text-[10px] font-bold px-1 py-0.5 pointer-events-none">Popular</div>
                            @elseif($loop->index == 1)
                            <div class="absolute top-0 left-0 bg-red-600 text-white text-[10px] font-bold px-1 py-0.5 pointer-events-none">Mall</div>
                            @endif
                        </a>

                        <!-- Admin Edit Button (Moved Outside Link) -->
                        @if(auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="absolute top-0 right-0 p-2 bg-orange-600 text-white rounded-bl-lg hover:bg-orange-700 transition z-20 shadow-sm" title="Edit Produk">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </a>
                        @endif
                        <!-- Product Info -->
                        <div class="p-2 flex flex-col flex-1">
                            <h3 class="text-xs text-gray-900 mb-1 leading-tight line-clamp-2 min-h-[2.5em]">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <div class="mt-auto">
                                <span class="text-[9px] border border-orange-500 text-orange-500 px-0.5 mb-1 inline-block">Grosir</span>
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-semibold text-orange-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <div class="text-[10px] text-gray-500">10RB+ Terjual</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
