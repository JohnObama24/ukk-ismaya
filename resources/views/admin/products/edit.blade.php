@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 pb-10">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-extrabold text-[#1A1C1E]">Edit product: {{ $product->name }}</h2>
            <p class="text-sm text-gray-400 mt-1 font-medium italic">Update the details of this item.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-2 px-4 py-2 text-gray-500 hover:text-orange-600 font-bold transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to List
        </a>
    </div>

    <!-- Form Section -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="space-y-2">
                    <label for="name" class="text-xs font-extrabold text-gray-400 uppercase tracking-widest pl-1">product Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="block w-full px-4 py-3 rounded-xl border-gray-300 bg-[#F8F9FA] focus:ring-2 focus:ring-orange-500 focus:bg-white transition" placeholder="e.g. Spicy Cassava Chips">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Category -->
                <div class="space-y-2">
                    <label for="category_id" class="text-xs font-extrabold text-gray-400 uppercase tracking-widest pl-1">Category</label>
                    <select name="category_id" id="category_id" required class="block w-full px-4 py-3 rounded-xl border-gray-300 bg-[#F8F9FA] focus:ring-2 focus:ring-orange-500 focus:bg-white transition">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Price -->
                <div class="space-y-2">
                    <label for="price" class="text-xs font-extrabold text-gray-400 uppercase tracking-widest pl-1">Price (Rp)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 font-bold">Rp</span>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 bg-[#F8F9FA] focus:ring-2 focus:ring-orange-500 focus:bg-white transition" placeholder="0">
                    </div>
                    @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Stock -->
                <div class="space-y-2">
                    <label for="stock" class="text-xs font-extrabold text-gray-400 uppercase tracking-widest pl-1">Stock Amount</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required class="block w-full px-4 py-3 rounded-xl border-gray-300 bg-[#F8F9FA] focus:ring-2 focus:ring-orange-500 focus:bg-white transition" placeholder="0">
                    @error('stock')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Discount -->
                <div class="space-y-2">
                    <label for="discount" class="text-xs font-extrabold text-gray-400 uppercase tracking-widest pl-1">Discount (%)</label>
                    <div class="relative">
                        <input type="number" name="discount" id="discount" value="{{ old('discount', $product->discount) }}" min="0" max="100" class="block w-full pr-10 pl-4 py-3 rounded-xl border-gray-300 bg-[#F8F9FA] focus:ring-2 focus:ring-orange-500 focus:bg-white transition" placeholder="0">
                        <span class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400 font-bold">%</span>
                    </div>
                    @error('discount')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label for="description" class="text-xs font-extrabold text-gray-400 uppercase tracking-widest pl-1">Description</label>
                <textarea name="description" id="description" rows="4" required class="block w-full px-4 py-3 rounded-xl border-gray-300 bg-[#F8F9FA] focus:ring-2 focus:ring-orange-500 focus:bg-white transition" placeholder="Tell us more about this snack...">{{ old('description', $product->description) }}</textarea>
                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Image Upload -->
            <div class="space-y-2">
                <label class="text-xs font-extrabold text-gray-400 uppercase tracking-widest pl-1">Snack Image</label>
                <div class="flex items-center gap-6">
                    @if($product->image)
                        <div class="w-24 h-24 rounded-2xl overflow-hidden border border-gray-100 flex-shrink-0">
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover" alt="{{ $product->name }}">
                        </div>
                    @endif
                    <div class="flex-grow">
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-100 border-dashed rounded-2xl bg-[#F8F9FA] hover:bg-white transition hover:border-orange-200 group">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-300 group-hover:text-orange-400 transition" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="image" class="relative cursor-pointer bg-transparent rounded-md font-extrabold text-orange-600 hover:text-orange-500">
                                        <span>Upload a new file</span>
                                        <input id="image" name="image" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-400">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                    </div>
                </div>
                @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-orange-600 hover:bg-orange-700 text-white font-extrabold py-4 rounded-2xl transition shadow-lg shadow-orange-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Update & Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
