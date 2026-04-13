

<?php $__env->startSection('content'); ?>
<div class="space-y-8 pb-10">
    <!-- Header -->
    <div class="flex flex-wrap items-start gap-3 justify-between">
        <div>
            <h2 class="text-xl sm:text-2xl font-extrabold text-[#1A1C1E]">Inventory Management</h2>
            <p class="text-sm text-gray-400 mt-1 font-medium italic">Manage your stock and pricing here.</p>
        </div>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="flex items-center gap-2 px-4 sm:px-6 py-2.5 sm:py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-xl transition shadow-lg shadow-orange-100 text-sm flex-shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span class="hidden sm:inline">Add New Product</span>
            <span class="sm:hidden">Add Product</span>
        </a>
    </div>

    <?php if(session('success')): ?>
    <div class="bg-orange-50 border border-orange-100 text-orange-600 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="font-bold"><?php echo e(session('success')); ?></span>
    </div>
    <?php endif; ?>

    <!-- Table Section -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-[#F8F9FA]">
                        <th class="px-4 sm:px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400">Product Details</th>
                        <th class="px-4 sm:px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400">Category</th>
                        <th class="px-4 sm:px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-right">Price</th>
                        <th class="px-4 sm:px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-center">Stock Level</th>
                        <th class="px-4 sm:px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-[#F8F9FA] transition group">
                        <td class="px-4 sm:px-8 py-4 sm:py-5">
                            <div class="flex items-center gap-3 sm:gap-4">
                                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl overflow-hidden flex-shrink-0 border border-gray-100">
                                    <?php if($product->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="w-full h-full object-cover" alt="<?php echo e($product->name); ?>">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="min-w-0">
                                    <h5 class="text-sm font-extrabold text-[#1A1C1E] truncate"><?php echo e($product->name); ?></h5>
                                    <p class="text-[10px] text-gray-400 font-medium truncate">Slug: <?php echo e($product->slug); ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 sm:px-8 py-4 sm:py-5">
                            <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest bg-orange-50 text-orange-600 whitespace-nowrap">
                                <?php echo e($product->category->name ?? 'Uncategorized'); ?>

                            </span>
                        </td>
                        <td class="px-4 sm:px-8 py-4 sm:py-5 text-right font-extrabold text-[#1A1C1E] whitespace-nowrap">
                            Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                        </td>
                        <td class="px-4 sm:px-8 py-4 sm:py-5 text-center">
                            <div class="inline-block px-3 py-1 rounded-full <?php echo e($product->stock < 10 ? 'bg-red-50 text-red-500' : 'bg-orange-50 text-orange-500'); ?> text-[10px] font-extrabold uppercase tracking-widest whitespace-nowrap">
                                <?php echo e($product->stock); ?> Units
                            </div>
                        </td>
                        <td class="px-4 sm:px-8 py-4 sm:py-5">
                            <div class="flex justify-end items-center gap-2">
                                <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="p-2 bg-orange-50 text-orange-600 hover:bg-orange-600 hover:text-white rounded-xl transition shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="<?php echo e(route('admin.products.destroy', $product->id)); ?>" method="POST" onsubmit="return confirm('Delete this product?')" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="p-2 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="p-4 sm:p-8 bg-[#F8F9FA] border-t border-gray-100 flex flex-col sm:flex-row items-start sm:items-center gap-3 justify-between">
            <div class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                Showing <?php echo e($products->firstItem()); ?> to <?php echo e($products->lastItem()); ?> of <?php echo e($products->total()); ?> entries
            </div>
            <div>
                <?php echo e($products->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Project-UKK\resources\views/admin/products/index.blade.php ENDPATH**/ ?>