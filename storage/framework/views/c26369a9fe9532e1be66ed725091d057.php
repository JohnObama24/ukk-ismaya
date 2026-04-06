

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
            <!-- Sidebar -->
            <aside class="py-6 px-2 sm:px-6 lg:py-0 lg:px-0 lg:col-span-3">
                <nav class="space-y-1">
                    <a href="<?php echo e(route('profile.index')); ?>" class="text-gray-900 group rounded-md px-3 py-2 flex items-center text-sm font-medium hover:bg-gray-50 hover:text-gray-900">
                        <!-- Icon -->
                        <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span class="truncate">My Profile</span>
                    </a>

                    <?php if(auth()->user()->role === 'admin'): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-orange-700 bg-orange-50 group rounded-md px-3 py-2 flex items-center text-sm font-bold border border-orange-200">
                        <svg class="text-orange-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                        <span class="truncate">Dashboard Admin</span>
                    </a>
                    <?php endif; ?>

                    <?php if(auth()->user()->role === 'user'): ?>
                    <a href="<?php echo e(route('orders.index')); ?>" class="text-gray-900 group rounded-md px-3 py-2 flex items-center text-sm font-medium hover:bg-gray-50 hover:text-gray-900">
                        <!-- Icon -->
                        <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span class="truncate">Order History</span>
                    </a>

                    <a href="<?php echo e(route('wishlist.index')); ?>" class="bg-orange-50 text-orange-700 hover:bg-white group rounded-md px-3 py-2 flex items-center text-sm font-medium border-l-4 border-orange-600 shadow-sm">
                         <svg class="text-orange-500 group-hover:text-orange-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
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

            <!-- Main Content -->
            <div class="sm:px-6 lg:px-0 lg:col-span-9">
                <div class="md:flex md:items-center md:justify-between mb-6">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">Daftar Keinginan</h2>
                        <p class="mt-1 text-sm text-gray-500">Products you've saved for later.</p>
                    </div>
                </div>

                <?php if(session('success')): ?>
                <div class="bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                </div>
                <?php endif; ?>

                <?php $__empty_1 = true; $__currentLoopData = $wishlistItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white shadow rounded-lg mb-4 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-20 w-20 bg-gray-200 rounded-md overflow-hidden flex items-center justify-center">
                                <span class="text-xs text-text-gray-500 px-1 text-center"><?php echo e($item->product->name); ?></span>
                            </div>
                            <div class="ml-6 flex-1">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-medium text-gray-900">
                                        <a href="<?php echo e(route('products.show', $item->product->id)); ?>" class="hover:text-blue-600 transition">
                                            <?php echo e($item->product->name); ?>

                                        </a>
                                    </h3>
                                    <p class="text-lg font-extrabold text-orange-600">Rp <?php echo e(number_format($item->product->price, 0, ',', '.')); ?></p>
                                </div>
                                <p class="mt-1 text-sm text-gray-500 truncate max-w-md"><?php echo e($item->product->description); ?></p>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex space-x-4">
                                        <a href="<?php echo e(route('cart.add', $item->product->id)); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-bold rounded-xl shadow-sm text-white bg-orange-600 hover:bg-orange-700 transition">
                                            Masukkan ke Keranjang
                                        </a>
                                        <a href="<?php echo e(route('wishlist.remove', $item->product->id)); ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                            Remove
                                        </a>
                                    </div>
                                    <div class="text-sm">
                                        <?php if($item->product->stock > 0): ?>
                                        <span class="text-orange-600 font-medium">In Stock</span>
                                        <?php else: ?>
                                        <span class="text-red-600 font-medium">Out of Stock</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="bg-white shadow rounded-lg p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Your wishlist is empty</h3>
                    <p class="mt-1 text-sm text-gray-500">Explore our products and save your favorites!</p>
                    <div class="mt-6">
                        <a href="<?php echo e(route('products.index')); ?>" class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-sm font-bold rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition">
                            Cari KhilafStore
                        </a>
                    </div>
                </div>
                <?php endif; ?>

                <div class="mt-6">
                    <?php echo e($wishlistItems->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Projek-UKK\resources\views/wishlist/index.blade.php ENDPATH**/ ?>