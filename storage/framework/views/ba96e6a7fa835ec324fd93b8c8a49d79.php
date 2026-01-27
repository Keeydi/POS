<div>
    <!-- Search and Category Filter -->
    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Search products..." 
               class="w-full px-4 py-2 border rounded-lg mb-2">
        
        <div class="flex flex-wrap gap-2">
            <button wire:click="selectCategory(null)" 
                    class="px-3 py-1 rounded <?php echo e(!$selectedCategory ? 'bg-blue-500 text-white' : 'bg-gray-200'); ?>">
                All
            </button>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button wire:click="selectCategory(<?php echo e($category->id); ?>)" 
                        class="px-3 py-1 rounded <?php echo e($selectedCategory == $category->id ? 'bg-blue-500 text-white' : 'bg-gray-200'); ?>">
                    <?php echo e($category->name); ?>

                </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-3 gap-3">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $filteredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button wire:click="selectProduct(<?php echo e($product->id); ?>)" 
                    class="p-3 bg-white border rounded-lg hover:bg-blue-50 hover:border-blue-300 transition text-left">
                <div class="font-medium text-sm"><?php echo e($product->name); ?></div>
                <div class="text-xs text-gray-500"><?php echo e($product->sku); ?></div>
                <div class="text-sm font-semibold text-blue-600 mt-1">₱<?php echo e(number_format($product->price, 2)); ?></div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->is_commissionable): ?>
                    <div class="text-xs text-green-600 mt-1">Commissionable</div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php /**PATH E:\CoreDev\Projects\POS\resources\views/livewire/product-grid.blade.php ENDPATH**/ ?>