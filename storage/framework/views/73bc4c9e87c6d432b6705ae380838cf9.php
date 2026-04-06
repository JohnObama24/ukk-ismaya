

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    <div class="relative rounded-3xl overflow-hidden shadow-2xl h-[500px]">
        <!-- Hero Background Image -->
        <img src="<?php echo e(asset('images/header.jpeg')); ?>" alt="KhilafStore Best Seller" class="absolute inset-0 w-full h-full object-cover">
        
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent flex items-center">
            <div class="max-w-xl px-12">
                <div class="inline-block bg-orange-600 text-white text-[10px] font-bold px-2 py-1 rounded mb-4 tracking-widest uppercase">
                    KhilafStore EXCLUSIVE
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold text-white leading-tight mb-6">
                    Brand new <br>
                    <span class="text-orange-400">Persona 5:</span> <br>
                    action figure
                </h1>
                <p class="text-lg text-gray-200 mb-8 max-md">
                    Discover the world's most biggest merch store
                </p>
                <div class="flex gap-4">
                    <a href="<?php echo e(route('products.index')); ?>" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-4 px-8 rounded-xl transition shadow-lg">
                        Shop Now
                    </a>
                    <a href="#" class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border border-white/30 font-bold py-4 px-8 rounded-xl transition">
                        View Lookbook
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Category Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Shop by Category</h2>
        </div>
        <a href="<?php echo e(route('products.index')); ?>" class="text-sm font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1 group">
            View All 
            <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4 4H3"></path></svg>
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
        <?php
            $catIcons = [
                'Action Figure' => 'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18',
                'Book'          => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                'Keychain'      => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z',
                'Acrylic Figure'=> 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
            ];
            // Get actual categories or use defaults if empty
            $displayCats = $categories->count() > 0 ? $categories->take(5) : collect();
        ?>

        <?php $__currentLoopData = $displayCats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('products.index', ['category' => $category->slug])); ?>" class="group flex flex-col items-center bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition border border-gray-100">
            <div class="w-16 h-16 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($catIcons[$category->name] ?? 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 11v10l8 4'); ?>"></path>
                </svg>
            </div>
            <span class="text-sm font-bold text-gray-900"><?php echo e($category->name); ?></span>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <?php if($displayCats->count() < 5): ?>
            <!-- Fillers if empty -->
            <div class="flex flex-col items-center bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                    <span class="font-bold text-xl">%</span>
                </div>
                <span class="text-sm font-bold text-gray-900">Deals</span>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Recommendations / Daily Discover Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 mb-24">
    <div class="flex items-center justify-between mb-8 border-b-4 border-orange-500 pb-2">
        <h2 class="text-xl font-extrabold text-orange-600 tracking-tight uppercase">Rekomendasi</h2>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="group relative flex flex-col bg-white hover:shadow-lg transition shadow-sm border border-transparent hover:border-orange-500 duration-200">
            <!-- Product Image -->
            <a href="<?php echo e(route('products.show', $product->slug)); ?>" class="relative aspect-square bg-white block">
                <div class="absolute inset-0 flex items-center justify-center p-2">
                     <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-contain">
                </div>
                <!-- Badge -->
                <?php if($loop->index % 10 == 0): ?>
                <div class="absolute top-0 left-0 bg-orange-500 text-white text-[9px] font-bold px-1 py-0.5 pointer-events-none">Terlaris</div>
                <?php elseif($loop->index % 10 == 1): ?>
                <div class="absolute top-0 left-0 bg-blue-600 text-white text-[9px] font-bold px-1 py-0.5 pointer-events-none">Mall</div>
                <?php endif; ?>
                
                <!-- Discount Tag (Dynamic) -->
                <?php if($product->discount > 0): ?>
                <div class="absolute top-0 right-0 bg-orange-50 text-orange-600 text-[9px] font-bold px-1 py-0.5 pointer-events-none">
                    -<?php echo e($product->discount); ?>%
                </div>
                <?php endif; ?>
            </a>
            
            <!-- Product Info -->
            <div class="p-2 flex flex-col flex-1 bg-white">
                <h3 class="text-xs text-gray-800 mb-1 leading-tight line-clamp-2 min-h-[2.5em]">
                    <a href="<?php echo e(route('products.show', $product->slug)); ?>">
                        <?php echo e($product->name); ?>

                    </a>
                </h3>
                
                <div class="mt-auto">
                    <!-- Theme-style Tags -->
                    <div class="flex items-center gap-1 mb-1">
                        <?php if($product->discount > 0): ?>
                            <span class="text-[8px] border border-orange-500 text-orange-500 px-0.5">Diskon</span>
                        <?php endif; ?>
                        <span class="text-[8px] border border-orange-500 text-orange-500 px-0.5">Grosir</span>
                    </div>

                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <div class="text-sm font-semibold text-orange-600">
                                <span class="text-[10px]">Rp</span><?php echo e(number_format($product->discounted_price, 0, ',', '.')); ?>

                            </div>
                            <div class="text-[9px] text-gray-500">10RB+ Terjual</div>
                        </div>
                        <?php if($product->discount > 0): ?>
                            <div class="text-[9px] text-gray-400 line-through">
                                Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Green Pattern Pagination -->
    <div class="mt-16 flex justify-center">
        <div class="flex items-center gap-2">
            <?php if($products->onFirstPage()): ?>
                <span class="p-2 text-gray-300 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </span>
            <?php else: ?>
                <a href="<?php echo e($products->previousPageUrl()); ?>" class="p-2 text-gray-500 hover:text-orange-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
            <?php endif; ?>

            <?php $__currentLoopData = $products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($url); ?>" class="w-10 h-10 flex items-center justify-center rounded-xl text-sm font-bold transition <?php echo e($page == $products->currentPage() ? 'bg-orange-600 text-white shadow-lg shadow-orange-200' : 'text-gray-500 hover:bg-orange-50 hover:text-orange-600'); ?>">
                    <?php echo e($page); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($products->hasMorePages()): ?>
                <a href="<?php echo e($products->nextPageUrl()); ?>" class="p-2 text-gray-500 hover:text-orange-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            <?php else: ?>
                <span class="p-2 text-gray-300 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Newsletter Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
    <div class="bg-orange-600 rounded-[2.5rem] overflow-hidden relative p-12 lg:p-20 shadow-xl">
        <div class="grid lg:grid-cols-2 items-center gap-12 relative z-10">
            <div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-6 leading-tight">
                    Mari Bergabung dengan <br>KhilafStore Club
                </h2>
                <p class="text-orange-100 text-lg">
                    Dapatkan info promo terbaru dan eksklusif langsung di email kamu.
                </p>
            </div>
            <div>
                <form class="flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Masukkan alamat email" class="flex-1 px-8 py-5 rounded-2xl focus:outline-none focus:ring-4 focus:ring-orange-400 text-gray-900 text-lg">
                    <button type="submit" class="bg-white text-orange-600 font-extrabold py-5 px-10 rounded-2xl hover:bg-gray-100 transition shadow-lg whitespace-nowrap">
                        Subscribe Now
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Decorative subtle pattern overlay -->
        <div class="absolute top-0 right-0 w-1/2 h-full bg-orange-500 opacity-20 skew-x-[-30deg] translate-x-20"></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Projek-UKK\resources\views/home.blade.php ENDPATH**/ ?>