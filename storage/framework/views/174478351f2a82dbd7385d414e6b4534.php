

<?php $__env->startSection('content'); ?>
<div class="space-y-8 pb-10">
    <!-- Header -->
    <div class="flex flex-wrap items-start gap-3 justify-between">
        <div>
            <h2 class="text-xl sm:text-2xl font-extrabold text-[#1A1C1E]">Customer Management</h2>
            <p class="text-sm text-gray-400 mt-1 font-medium italic">View and manage your registered customers.</p>
        </div>
    </div>

    <!-- Customers Table -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-[#F8F9FA]">
                        <th class="px-4 sm:px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400">Customer Name</th>
                        <th class="px-4 sm:px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400">Email Address</th>
                        <th class="px-4 sm:px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-center">Joined Date</th>
                        <th class="px-4 sm:px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-[#F8F9FA] transition group">
                        <td class="px-4 sm:px-8 py-4 sm:py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-orange-50 flex items-center justify-center text-orange-600 font-extrabold text-sm flex-shrink-0">
                                    <?php echo e(substr($customer->name, 0, 1)); ?>

                                </div>
                                <h5 class="text-sm font-extrabold text-[#1A1C1E] whitespace-nowrap"><?php echo e($customer->name); ?></h5>
                            </div>
                        </td>
                        <td class="px-4 sm:px-8 py-4 sm:py-5">
                            <span class="text-sm text-gray-500 font-medium"><?php echo e($customer->email); ?></span>
                        </td>
                        <td class="px-4 sm:px-8 py-4 sm:py-5 text-center text-[10px] font-extrabold text-gray-400 uppercase tracking-widest whitespace-nowrap">
                            <?php echo e($customer->created_at->format('M d, Y')); ?>

                        </td>
                        <td class="px-4 sm:px-8 py-4 sm:py-5 text-center">
                            <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest bg-orange-50 text-orange-600">
                                Active Customer
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="px-8 py-12 text-center text-gray-400 font-bold uppercase tracking-widest text-xs">
                            No customers found.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if($customers->hasPages()): ?>
        <div class="p-8 bg-[#F8F9FA] border-t border-gray-100">
            <?php echo e($customers->links()); ?>

        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Project\Project-UKK\resources\views\admin\customers.blade.php ENDPATH**/ ?>