

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
            <!-- Sidebar -->
            <aside class="py-6 px-2 sm:px-6 lg:py-0 lg:px-0 lg:col-span-3">
                <nav class="space-y-1">
                    <a href="<?php echo e(route('profile.index')); ?>" class="text-gray-900 group rounded-md px-3 py-2 flex items-center text-sm font-medium hover:bg-gray-50 border border-gray-200 shadow-sm">
                        <!-- Icon -->
                        <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span class="truncate">Profil Saya</span>
                    </a>

                    <?php if(auth()->user()->role === 'admin'): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-orange-700 bg-orange-50 group rounded-md px-3 py-2 flex items-center text-sm font-bold border border-orange-200">
                        <svg class="text-orange-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                        <span class="truncate">Dashboard Admin</span>
                    </a>
                    <?php endif; ?>

                    <a href="<?php echo e(route('orders.index')); ?>" class="bg-orange-50 text-orange-700 hover:bg-white group rounded-md px-3 py-2 flex items-center text-sm font-medium border-l-4 border-orange-600 shadow-sm transition">
                        <!-- Icon -->
                        <svg class="text-orange-500 group-hover:text-orange-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span class="truncate">Riwayat Pesanan</span>
                    </a>

                    <?php if(auth()->user()->role === 'user'): ?>
                    <a href="<?php echo e(route('wishlist.index')); ?>" class="text-gray-900 hover:bg-gray-50 hover:text-gray-900 group rounded-md px-3 py-2 flex items-center text-sm font-medium">
                         <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        <span class="truncate">Wishlist</span>
                    </a>
                    <?php endif; ?>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="w-full">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full text-gray-900 hover:bg-gray-50 hover:text-gray-900 group rounded-md px-3 py-2 flex items-center text-sm font-medium">
                            <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span class="truncate">Logout</span>
                        </button>
                    </form>
                </nav>
            </aside>

            <!-- Content -->
            <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">Riwayat Pesanan</h2>
                         <p class="mt-1 text-sm text-gray-500">Pantau status pesanan terbaru kamu di KhilafStore.</p>
                    </div>
                </div>
                
                <div class="border-b border-gray-200">
                  <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <a href="<?php echo e(route('orders.index')); ?>" class="<?php echo e(!request('status') ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?> whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                      Semua Pesanan
                    </a>
                    <a href="<?php echo e(route('orders.index', ['status' => 'pending'])); ?>" class="<?php echo e(request('status') == 'pending' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?> whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                      Sedang Berjalan
                    </a>
                    <a href="<?php echo e(route('orders.index', ['status' => 'delivered'])); ?>" class="<?php echo e(request('status') == 'delivered' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?> whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                      Selesai
                    </a>
                    <a href="<?php echo e(route('orders.index', ['status' => 'cancelled'])); ?>" class="<?php echo e(request('status') == 'cancelled' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?> whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Dibatalkan
                    </a>
                  </nav>
                </div>


                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center bg-gray-50 border-b border-gray-200">
                        <div>
                             <h3 class="text-lg leading-6 font-bold text-gray-900">
                                Pesanan #<?php echo e($order->order_number); ?>

                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Dipesan pada <?php echo e($order->created_at->format('d M, Y')); ?>

                            </p>
                        </div>
                         <div class="flex space-x-3">
                             <?php if($order->status == 'delivered'): ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-800">
                                Selesai
                            </span>
                            <?php elseif($order->status == 'shipped'): ?>
                             <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-800">
                                Dikirim
                            </span>
                            <?php elseif($order->status == 'processing'): ?>
                             <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-800">
                                Diproses
                            </span>
                             <?php else: ?>
                              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                                Menunggu
                            </span>
                             <?php endif; ?>
                             
                             <a href="<?php echo e(route('orders.show', $order->id)); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-xs font-bold rounded-xl shadow-sm text-white bg-orange-600 hover:bg-orange-700 transition">
                                Lihat Detail
                            </a>
                             <a href="<?php echo e(route('orders.invoice', $order->id)); ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-xs font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition">
                                Invoice
                            </a>
                            
                            <?php if($order->status == 'delivered'): ?>
                            <form action="<?php echo e(route('orders.complete', $order->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin pesanan sudah diterima? Status akan menjadi Selesai.')">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-xs font-bold rounded-xl shadow-sm text-white bg-orange-600 hover:bg-orange-700 transition">
                                    Pesanan Diterima
                                </button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                             <div class="text-2xl font-extrabold text-orange-600 mr-2">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></div>
                             <div class="text-sm text-gray-500">(<?php echo e($order->items->count()); ?> item)</div>
                        </div>

                        <div class="mt-6 flex space-x-4 overflow-x-auto">
                            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex-shrink-0 h-16 w-16 bg-gray-200 rounded-md overflow-hidden border border-gray-200 flex items-center justify-center">
                                 <span class="text-xs text-gray-500"><?php echo e($item->product ? $item->product->name : 'Product'); ?></span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                 <div class="bg-white shadow sm:rounded-lg p-6 text-center">
                    <p class="text-gray-500">No orders found.</p>
                 </div>
                <?php endif; ?>

                <div class="mt-6">
                    <?php echo e($orders->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Projek-UKK\resources\views/orders/index.blade.php ENDPATH**/ ?>