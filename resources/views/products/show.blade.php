@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
            <!-- Image Gallery -->
            <div class="flex flex-col-reverse">
                <div class="w-full aspect-square bg-gray-50 rounded-lg overflow-hidden border border-gray-200">
                     @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain p-4">
                     @else
                         <div class="w-full h-full bg-gray-200 flex items-center justify-center text-2xl text-gray-500 font-bold">
                            {{ $product->name }} Image
                        </div>
                     @endif
                </div>
                <div class="mt-4 flex items-center justify-center">
                    <a href="{{ route('wishlist.add', $product->id) }}" class="flex items-center gap-2 text-gray-500 hover:text-red-500 transition group">
                        <svg class="w-6 h-6 group-hover:fill-red-500 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span class="text-sm font-medium">Favorit Saya (Wishlist)</span>
                    </a>
                </div>
            </div>

            <!-- Product Info -->
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $product->name }}</h1>

                <div class="mt-3">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-3xl text-orange-600 font-extrabold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <div class="mt-6">
                    <h3 class="sr-only">Description</h3>
                    <div class="text-base text-gray-700 space-y-6">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <div class="flex items-center mb-6">
                        <span class="text-gray-700 mr-4">Kuantitas</span>
                        <div class="flex items-center border border-gray-300 rounded-sm">
                            <button type="button" onclick="decrementQuantity()" class="px-3 py-1 text-gray-600 hover:bg-gray-100 border-r border-gray-300">-</button>
                            <input type="text" id="quantity_display" value="1" class="w-12 text-center border-none focus:ring-0 text-gray-900" readonly>
                            <button type="button" onclick="incrementQuantity()" class="px-3 py-1 text-gray-600 hover:bg-gray-100 border-l border-gray-300">+</button>
                        </div>
                        <span class="ml-4 text-sm text-gray-500">Tersedia {{ $product->stock ?? 50 }} buah</span>
                    </div>

                    @if(!auth()->check() || auth()->user()->role !== 'admin')
                    <div class="flex flex-row gap-4 mt-8">
                        <form action="{{ route('cart.add', $product->id) }}" method="GET" id="addToCartForm" class="flex-1">
                            @csrf
                            <input type="hidden" name="quantity" id="cart_quantity" value="1">
                            <button type="submit" class="w-full bg-red-50 border border-red-500 rounded-sm py-4 px-4 flex items-center justify-center text-base font-medium text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
                                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Masukkan Keranjang
                            </button>
                        </form>

                        <form action="{{ route('buy_now', $product->id) }}" method="POST" id="buyNowForm" class="flex-1">
                            @csrf
                            <input type="hidden" name="quantity" id="buy_quantity" value="1">
                            <button type="submit" class="w-full bg-red-500 border border-transparent rounded-sm py-4 px-4 flex items-center justify-center text-base font-medium text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
                                Beli Sekarang
                            </button>
                        </form>

                        
                    </div>
                    @else
                    <div class="mt-10 p-4 bg-orange-50 border border-orange-200 rounded-xl">
                        <p class="text-sm font-bold text-orange-800 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Anda masuk sebagai Admin. Fitur belanja dinonaktifkan untuk fokus ke pengelolaan toko.
                        </p>
                        <div class="mt-4 flex space-x-3">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-flex items-center px-4 py-2 bg-orange-600 border border-transparent rounded-lg font-bold text-white hover:bg-orange-700 transition shadow-sm text-sm">
                                Ubah Produk Ini
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg font-bold text-gray-700 bg-white hover:bg-gray-50 transition shadow-sm text-sm">
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                    @endif

                <section aria-labelledby="details-heading" class="mt-12">
                     <h2 id="details-heading" class="sr-only">Additional Details</h2>
                     <div class="border-t divide-y divide-gray-200">
                         <!-- Rating Section -->
                     <div class="py-6">
                        <div class="md:flex md:items-center md:justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900">
                                Penilaian Produk ({{ $ratings->count() }})
                            </h3>
                            <div class="flex items-center gap-2 mt-2 md:mt-0">
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($product->average_rating))
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-sm font-medium text-gray-500">{{ number_format($product->average_rating, 1) }} dari 5</span>
                            </div>
                        </div>

                        <!-- Rating Form (Only for verified buyers with completed orders) -->
                        @if($canRate)
                        <div class="bg-gray-50 p-6 rounded-xl mb-8 border border-gray-100">
                             <form action="{{ route('products.ratings.store', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h4 class="text-sm font-bold text-gray-900 mb-4 uppercase tracking-wide">Beri Penilaian</h4>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                    <div class="flex gap-4">
                                        @foreach([5,4,3,2,1] as $r)
                                        <label class="flex items-center cursor-pointer">
                                            <input type="radio" name="rating" value="{{ $r }}" class="mr-1 accent-orange-600" required>
                                            <span class="text-sm text-gray-600">{{ $r }} Bintang</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Komentar (Opsional)</label>
                                    <textarea name="comment" id="comment" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" placeholder="Bagaimana kualitas produk ini?"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto (Opsional)</label>
                                    <input type="file" name="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                                </div>
                                <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded-lg font-bold text-sm hover:bg-orange-700 transition">Kirim Penilaian</button>
                             </form>
                        </div>
                        @endif

                        <!-- Ratings List -->
                        <div class="space-y-6">
                            @forelse($ratings as $rating)
                            <div class="flex gap-4 border-b border-gray-100 pb-6 last:border-0 last:pb-0">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold">
                                        {{ substr($rating->user->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <h4 class="text-sm font-bold text-gray-900">{{ $rating->user->name }}</h4>
                                        <span class="text-xs text-gray-400">{{ $rating->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="flex text-yellow-400 mb-2">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-3 h-3 {{ $i < $rating->rating ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                    </div>
                                    <p class="text-sm text-gray-600 leading-relaxed mb-2">{{ $rating->comment }}</p>
                                    @if($rating->image)
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/' . $rating->image) }}" target="_blank" class="block w-24 h-24 rounded-lg overflow-hidden border border-gray-200 hover:border-orange-500 transition">
                                                <img src="{{ asset('storage/' . $rating->image) }}" alt="Rating Image" class="w-full h-full object-cover">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-xl">
                                Belum ada penilaian untuk produk ini.
                            </div>
                            @endforelse
                        </div>
                     </div>
                     </div>
                </section>
            </div>
        </div>
        
        <!-- Related Products -->
        <section aria-labelledby="related-heading" class="mt-16 sm:mt-24">
            <h2 id="related-heading" class="text-lg font-bold text-gray-900">Produk Serupa yang Kamu Suka</h2>

            <div class="mt-6 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-2">
                @foreach($relatedProducts as $related)
                <div class="group relative flex flex-col bg-white hover:shadow-lg transition shadow-sm border border-transparent hover:border-orange-500 duration-200">
                    <!-- Product Image -->
                    <a href="{{ route('products.show', $related->slug) }}" class="relative aspect-square bg-white block">
                        <div class="absolute inset-0 flex items-center justify-center">
                             @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-contain p-4">
                             @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-xs font-bold text-center px-1">
                                    {{ $related->name }}
                                </div>
                             @endif
                        </div>
                    </a>

                    <!-- Product Info -->
                    <div class="p-2 flex flex-col flex-1">
                        <h3 class="text-xs text-gray-900 mb-1 leading-tight line-clamp-2 min-h-[2.5em]">
                            <a href="{{ route('products.show', $related->slug) }}">
                                {{ $related->name }}
                            </a>
                        </h3>
                        
                        <div class="mt-auto">
                            <span class="text-[9px] border border-orange-500 text-orange-500 px-0.5 mb-1 inline-block">Grosir</span>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-sm font-semibold text-orange-600">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="text-[10px] text-gray-500">10RB+ Terjual</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>
<script>
    function incrementQuantity() {
        var qtyInput = document.getElementById('quantity_display');
        var currentQty = parseInt(qtyInput.value);
        var newQty = currentQty + 1;
        
        qtyInput.value = newQty;
        updateHiddenInputs(newQty);
    }

    function decrementQuantity() {
        var qtyInput = document.getElementById('quantity_display');
        var currentQty = parseInt(qtyInput.value);
        if (currentQty > 1) {
            var newQty = currentQty - 1;
            qtyInput.value = newQty;
            updateHiddenInputs(newQty);
        }
    }

    function updateHiddenInputs(qty) {
        document.getElementById('cart_quantity').value = qty;
        document.getElementById('buy_quantity').value = qty;
    }
</script>
@endsection
