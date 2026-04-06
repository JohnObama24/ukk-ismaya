

<?php $__env->startSection('content'); ?>
<div class="space-y-8 pb-10">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-extrabold text-[#1A1C1E]">System Settings</h2>
            <p class="text-sm text-gray-400 mt-1 font-medium italic">Configure your application preferences.</p>
        </div>
    </div>

    <!-- Settings Placeholder -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-12 flex flex-col items-center justify-center text-center space-y-4">
        <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center text-blue-500">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-extrabold text-[#1A1C1E]">Settings Module</h3>
            <p class="text-sm text-gray-400 max-w-sm">Manage your store information, payment methods, and user permissions here in the future.</p>
        </div>
        <div class="flex gap-4">
            <a href="<?php echo e(route('profile.index')); ?>" class="px-6 py-3 bg-orange-500 text-white font-bold rounded-xl hover:bg-orange-600 transition shadow-lg shadow-orange-200">
                Go to My Profile
            </a>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="px-6 py-3 bg-white text-gray-500 border border-gray-100 font-bold rounded-xl hover:bg-gray-50 transition">
                Home
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Projek-UKK\resources\views/admin/settings.blade.php ENDPATH**/ ?>