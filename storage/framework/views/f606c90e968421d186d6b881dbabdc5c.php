

<?php $__env->startSection('content'); ?>
<div class="bg-gray-100 min-h-screen pb-24">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-8 h-8 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Keranjang Belanja
        </h1>

        <?php if(session('success')): ?>
        <div class="bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?php echo e(session('success')); ?></span>
        </div>
        <?php endif; ?>

        <?php if(count($cart) > 0): ?>
        <!-- Cart Header -->
        <div class="hidden md:grid grid-cols-12 gap-4 bg-white p-4 shadow-sm rounded-lg mb-4 text-gray-500 text-sm font-medium items-center">
            <div class="col-span-6 flex items-center">
                <input type="checkbox" class="h-4 w-4 text-orange-500 border-gray-300 rounded mr-4" checked disabled>
                <span>Produk</span>
            </div>
            <div class="col-span-2 text-center">Harga Satuan</div>
            <div class="col-span-2 text-center">Kuantitas</div>
            <div class="col-span-1 text-center">Total Harga</div>
            <div class="col-span-1 text-center">Aksi</div>
        </div>

        <!-- Cart Items -->
        <div class="space-y-4">
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white p-4 shadow-sm rounded-lg grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                <!-- Product Info -->
                <div class="col-span-12 md:col-span-6 flex items-center">
                    <input type="checkbox" class="h-4 w-4 text-orange-500 border-gray-300 rounded mr-4 hidden md:block" checked disabled>
                    <div class="flex-shrink-0 w-20 h-20 border border-gray-200 rounded-md overflow-hidden bg-gray-100">
                         <?php if(isset($details['image']) && $details['image']): ?>
                            <img src="<?php echo e(asset('storage/' . $details['image'])); ?>" alt="<?php echo e($details['name']); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No Img</div>
                        <?php endif; ?>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-base font-medium text-gray-900">
                            <a href="#"><?php echo e($details['name']); ?></a>
                        </h3>
                        <p class="text-xs text-gray-500 mt-1">Variasi: -</p>
                        <div class="md:hidden mt-2 font-bold text-orange-500">Rp <?php echo e(number_format($details['price'], 0, ',', '.')); ?></div>
                    </div>
                </div>

                <!-- Unit Price (Desktop) -->
                <div class="hidden md:block col-span-2 text-center text-gray-600">
                    Rp <?php echo e(number_format($details['price'], 0, ',', '.')); ?>

                </div>

                <!-- Quantity -->
                <div class="col-span-12 md:col-span-2 flex justify-center items-center">
                    <div class="flex items-center border border-gray-300 rounded-sm">
                        <button disabled class="px-3 py-1 text-gray-600 hover:bg-gray-100 cursor-not-allowed">-</button>
                        <input type="text" value="<?php echo e($details['quantity']); ?>" class="w-12 text-center border-none focus:ring-0 text-sm p-1" readonly>
                        <button disabled class="px-3 py-1 text-gray-600 hover:bg-gray-100 cursor-not-allowed">+</button>
                    </div>
                </div>

                <!-- Total Price -->
                <div class="hidden md:block col-span-1 text-center font-bold text-orange-500">
                    Rp <?php echo e(number_format($details['price'] * $details['quantity'], 0, ',', '.')); ?>

                </div>

                <!-- Actions -->
                <div class="col-span-12 md:col-span-1 text-center flex md:block justify-end">
                    <a href="<?php echo e(route('cart.remove', $id)); ?>" class="text-gray-500 hover:text-red-500 text-sm font-medium">Hapus</a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Voucher Section (Mockup) -->
        <div class="bg-white p-4 shadow-sm rounded-lg mt-4 flex justify-between items-center border-t-4 border-t-gray-100">
            <div class="flex items-center text-orange-500 font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                Voucher Toko
            </div>
            <button class="text-blue-600 text-sm hover:underline">Gunakan/masukkan kode</button>
        </div>

        <!-- Bottom Bar (Sticky) -->
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-6 w-full sm:w-auto justify-between sm:justify-start">
                    <div class="flex items-center">
                        <input type="checkbox" class="h-4 w-4 text-orange-500 border-gray-300 rounded mr-2" checked disabled>
                        <span class="text-gray-600 text-sm">Pilih Semua (<?php echo e(count($cart)); ?>)</span>
                    </div>
                    <button class="text-gray-500 hover:text-red-500 text-sm hidden sm:block">Hapus</button>
                </div>

                <div class="flex items-center gap-4 w-full sm:w-auto justify-between sm:justify-end">
                    <div class="flex items-center gap-2">
                        <span class="text-gray-600 text-sm">Total (<?php echo e(count($cart)); ?> produk):</span>
                        <span class="text-xl font-bold text-orange-500">Rp <?php echo e(number_format($total, 0, ',', '.')); ?></span>
                    </div>
                    <a href="<?php echo e(route('checkout.index')); ?>" class="bg-orange-500 text-white font-bold py-3 px-10 rounded-sm hover:bg-orange-600 transition shadow-lg">
                        Checkout
                    </a>
                </div>
            </div>
        </div>

        <?php else: ?>
        <div class="text-center py-24 bg-white shadow sm:rounded-lg">
            <svg class="mx-auto h-24 w-24 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Keranjang Anda Kosong</h3>
            <p class="mt-2 text-gray-500">Sepertinya Anda belum menambahkan produk apapun.</p>
            <div class="mt-8">
                <a href="<?php echo e(route('products.index')); ?>" class="inline-flex items-center px-8 py-3 border border-transparent shadow-sm text-base font-bold rounded-md text-white bg-orange-500 hover:bg-orange-600 transition">
                    Belanja Sekarang
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Projek-UKK\resources\views/cart/index.blade.php ENDPATH**/ ?>