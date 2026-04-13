

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Checkout</h1>

        <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
            <!-- Left Column: Shipping Address & Order Items -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Shipping Address (Mockup for now) -->
                <div class="bg-white shadow sm:rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Alamat Pengiriman
                    </h2>
                    <div class="border-t border-gray-100 pt-4">
                        <p class="font-bold text-gray-800"><?php echo e(auth()->user()->name); ?></p>
                        <p class="text-gray-600">(+62) 812-3456-7890</p>
                        <p class="text-gray-600">Jalan Contoh No. 123, Kecamatan Contoh, Kota Contoh, Jawa Barat, 12345</p>
                        <button class="text-sm text-orange-600 font-medium mt-2 hover:text-orange-500">Ubah</button>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Produk Dipesan</h2>
                    </div>
                    <ul role="list" class="divide-y divide-gray-200">
                        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="p-6 flex items-center">
                            <div class="flex-shrink-0 w-20 h-20 border border-gray-200 rounded-md overflow-hidden bg-gray-100">
                                <?php if(isset($details['image']) && $details['image']): ?>
                                    <img src="<?php echo e(asset('storage/' . $details['image'])); ?>" alt="<?php echo e($details['name']); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No Img</div>
                                <?php endif; ?>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-base font-medium text-gray-900"><?php echo e($details['name']); ?></h3>
                                <p class="text-sm text-gray-500">Variasi: -</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Rp <?php echo e(number_format($details['price'], 0, ',', '.')); ?></p>
                                <p class="text-sm text-gray-500">x <?php echo e($details['quantity']); ?></p>
                                <p class="text-base font-bold text-gray-900 mt-1">Rp <?php echo e(number_format($details['price'] * $details['quantity'], 0, ',', '.')); ?></p>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="lg:col-span-4 mt-8 lg:mt-0">
                <div class="bg-white shadow sm:rounded-lg p-6 sticky top-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6">Rincian Pembayaran</h2>
                    
                    <dl class="space-y-4 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <dt>Subtotal untuk Produk</dt>
                            <dd class="font-medium text-gray-900">Rp <?php echo e(number_format($total, 0, ',', '.')); ?></dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Total Ongkos Kirim</dt>
                            <dd class="font-medium text-gray-900">Rp 15.000</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Biaya Layanan</dt>
                            <dd class="font-medium text-gray-900">Rp 1.000</dd>
                        </div>
                        
                        <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                            <dt class="text-base font-bold text-gray-900">Total Pembayaran</dt>
                            <dd class="text-xl font-extrabold text-orange-600">Rp <?php echo e(number_format($total + 16000, 0, ',', '.')); ?></dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <form action="<?php echo e(route('checkout.process')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="w-full bg-orange-600 border border-transparent rounded-xl shadow-lg py-4 px-4 text-base font-bold text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition">
                                Buat Pesanan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Project\Project-UKK\resources\views/checkout/index.blade.php ENDPATH**/ ?>