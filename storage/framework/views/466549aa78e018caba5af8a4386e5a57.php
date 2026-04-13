

<?php $__env->startSection('content'); ?>
<div class="space-y-8 pb-10">
    <!-- Header -->
    <div class="flex flex-wrap items-start gap-3 justify-between">
        <div>
            <h2 class="text-xl sm:text-2xl font-extrabold text-[#1A1C1E]">Sales Analytics</h2>
            <p class="text-sm text-gray-400 mt-1 font-medium italic">Comprehensive performance metrics for your business.</p>
        </div>
        <button onclick="window.print()" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-100 rounded-xl text-gray-600 font-bold hover:bg-gray-50 transition shadow-sm text-sm flex-shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            Print Report
        </button>
    </div>

    <!-- Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-extrabold uppercase tracking-widest text-gray-400 mb-1">Lifetime Revenue</p>
            <h3 class="text-2xl font-extrabold text-[#1A1C1E]">Rp <?php echo e(number_format($lifetimeRevenue, 0, ',', '.')); ?></h3>
            <div class="mt-2 flex items-center gap-1 text-orange-500 font-bold text-xs">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
                <span>Total Accumulation</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-extrabold uppercase tracking-widest text-gray-400 mb-1">Avg. Order Value</p>
            <h3 class="text-2xl font-extrabold text-[#1A1C1E]">Rp <?php echo e(number_format($averageOrderValue, 0, ',', '.')); ?></h3>
            <p class="mt-2 text-gray-400 font-medium text-xs italic">Per successful checkout</p>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-extrabold uppercase tracking-widest text-gray-400 mb-1">Best Month</p>
            <?php
                $maxRevenue = max($monthlyTrends);
                $bestMonthIndex = array_search($maxRevenue, $monthlyTrends);
                $bestMonth = $monthLabels[$bestMonthIndex] ?? 'N/A';
            ?>
            <h3 class="text-2xl font-extrabold text-[#1A1C1E]"><?php echo e($bestMonth); ?></h3>
            <p class="mt-2 text-orange-600 font-bold text-xs uppercase tracking-widest">Peak Performance</p>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-extrabold uppercase tracking-widest text-gray-400 mb-1">Top Category</p>
            <?php
                $topCategory = $categoryStats->sortByDesc('revenue')->first();
            ?>
            <h3 class="text-2xl font-extrabold text-[#1A1C1E]"><?php echo e($topCategory->name ?? 'None'); ?></h3>
            <p class="mt-2 text-blue-500 font-bold text-xs uppercase tracking-widest">Market Leader</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Revenue Trend Chart -->
        <div class="lg:col-span-2 bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h4 class="font-extrabold text-[#1A1C1E]">Revenue Trends</h4>
                    <p class="text-xs text-gray-400 font-medium italic">Monthly sales performance over the last 6 months.</p>
                </div>
            </div>
            <div id="revenueTrendChart" class="min-h-[300px]"></div>
        </div>

        <!-- Category Distribution Chart -->
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <h4 class="font-extrabold text-[#1A1C1E] mb-8">Category Share</h4>
            <div id="categoryShareChart" class="min-h-[300px]"></div>
            <div class="mt-6 space-y-3">
                <?php $__currentLoopData = $categoryStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center justify-between text-xs">
                    <span class="text-gray-500 font-bold uppercase tracking-widest"><?php echo e($stat->name); ?></span>
                    <span class="text-[#1A1C1E] font-extrabold">Rp <?php echo e(number_format($stat->revenue, 0, ',', '.')); ?></span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- Top Products -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-gray-50">
            <h4 class="font-extrabold text-[#1A1C1E]">Top Performing</h4>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1 italic">Based on total units sold.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-[#F8F9FA]">
                        <th class="px-4 sm:px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400">Products Info</th>
                        <th class="px-4 sm:px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-center">Units Sold</th>
                        <th class="px-4 sm:px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-right">Revenue</th>
                        <th class="px-4 sm:px-8 py-4 text-[10px] font-extrabold uppercase tracking-widest text-gray-400 text-center">Stock Level</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="group hover:bg-[#F8F9FA] transition">
                        <td class="px-4 sm:px-8 py-4 sm:py-5">
                            <div class="flex items-center gap-3 sm:gap-4">
                                <?php if($product->image): ?>
                                <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="w-10 h-10 rounded-xl object-cover flex-shrink-0" alt="">
                                <?php else: ?>
                                <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-gray-300 flex-shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <?php endif; ?>
                                <div>
                                    <p class="text-sm font-extrabold text-[#1A1C1E]"><?php echo e($product->name); ?></p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest"><?php echo e($product->category->name ?? 'Uncategorized'); ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 sm:px-8 py-4 sm:py-5 text-center font-extrabold text-[#1A1C1E]">
                            <?php echo e($product->total_sold); ?>

                        </td>
                        <td class="px-4 sm:px-8 py-4 sm:py-5 text-right font-extrabold text-orange-600 whitespace-nowrap">
                            Rp <?php echo e(number_format($product->total_sold * $product->price, 0, ',', '.')); ?>

                        </td>
                        <td class="px-4 sm:px-8 py-4 sm:py-5 text-center">
                            <?php if($product->stock < 10): ?>
                                <span class="px-3 py-1 bg-red-50 text-red-500 rounded-lg text-[10px] font-extrabold uppercase tracking-widest border border-red-100 whitespace-nowrap">Critical: <?php echo e($product->stock); ?></span>
                            <?php else: ?>
                                <span class="px-3 py-1 bg-orange-50 text-orange-500 rounded-lg text-[10px] font-extrabold uppercase tracking-widest border border-orange-100 whitespace-nowrap">Ok: <?php echo e($product->stock); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Revenue Trend Chart
        const revenueTrendOptions = {
            series: [{
                name: 'Revenue',
                data: <?php echo json_encode($monthlyTrends); ?>

            }],
            chart: {
                height: 350,
                type: 'area',
                toolbar: { show: false },
                sparkline: { enabled: false },
                fontFamily: 'Plus Jakarta Sans, sans-serif'
            },
            colors: ['#10b981'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [20, 100, 100, 100]
                }
            },
            xaxis: {
                categories: <?php echo json_encode($monthLabels); ?>,
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { colors: '#94a3b8', fontWeight: 600 } }
            },
            yaxis: {
                labels: { 
                    formatter: function(val) { return 'Rp ' + val.toLocaleString(); },
                    style: { colors: '#94a3b8', fontWeight: 600 }
                }
            },
            grid: {
                borderColor: '#f8fafc',
                strokeDashArray: 4,
                xaxis: { lines: { show: true } }
            }
        };

        const revenueTrendChart = new ApexCharts(document.querySelector("#revenueTrendChart"), revenueTrendOptions);
        revenueTrendChart.render();

        // Category Share Chart
        const categoryShareOptions = {
            series: <?php echo json_encode($categoryStats->pluck('revenue')); ?>,
            chart: {
                type: 'donut',
                height: 350,
                fontFamily: 'Plus Jakarta Sans, sans-serif'
            },
            labels: <?php echo json_encode($categoryStats->pluck('name')); ?>,
            colors: ['#10b981', '#14b8a6', '#3b82f6', '#6366f1', '#f59e0b'],
            legend: { position: 'bottom', fontWeight: 600 },
            stroke: { show: false },
            dataLabels: { enabled: false },
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'TOTAL',
                                color: '#94a3b8',
                                fontWeight: 800,
                                formatter: function(w) {
                                    return 'Rp ' + w.globals.seriesTotals.reduce((a, b) => a + b, 0).toLocaleString();
                                }
                            }
                        }
                    }
                }
            }
        };

        const categoryShareChart = new ApexCharts(document.querySelector("#categoryShareChart"), categoryShareOptions);
        categoryShareChart.render();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Project\Project-UKK\resources\views\admin\reports.blade.php ENDPATH**/ ?>