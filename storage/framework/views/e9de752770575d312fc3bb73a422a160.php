<div class="h-full flex flex-col">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order): ?>
        <!-- Order Items -->
        <div class="flex-1 overflow-y-auto p-4">
            <div class="mb-4">
                <h3 class="font-semibold">Order #<?php echo e($order->order_no); ?></h3>
                <p class="text-sm text-gray-500"><?php echo e($order->created_at->format('M d, Y h:i A')); ?></p>
            </div>

            <div class="space-y-2 mb-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->items->where('is_voided', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                        <div class="flex-1">
                            <div class="font-medium"><?php echo e($item->product->name); ?></div>
                            <div class="text-sm text-gray-500">
                                <?php echo e($item->quantity); ?>x @ ₱<?php echo e(number_format($item->unit_price, 2)); ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->staff): ?>
                                    | Staff: <?php echo e($item->staff->full_name); ?>

                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->special_instructions): ?>
                                <div class="text-xs text-gray-400"><?php echo e($item->special_instructions); ?></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="text-right">
                            <div class="font-semibold">₱<?php echo e(number_format($item->subtotal, 2)); ?></div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->status === 'draft'): ?>
                                <button wire:click="removeItem(<?php echo e($item->id); ?>)" 
                                        class="text-xs text-red-600 hover:text-red-800">Remove</button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Totals -->
            <div class="border-t pt-4 space-y-2">
                <div class="flex justify-between">
                    <span>Subtotal:</span>
                    <span>₱<?php echo e(number_format($order->subtotal, 2)); ?></span>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->discount_amount > 0): ?>
                    <div class="flex justify-between text-red-600">
                        <span>Discount:</span>
                        <span>-₱<?php echo e(number_format($order->discount_amount, 2)); ?></span>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->service_charge > 0): ?>
                    <div class="flex justify-between">
                        <span>Service Charge:</span>
                        <span>₱<?php echo e(number_format($order->service_charge, 2)); ?></span>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->tax > 0): ?>
                    <div class="flex justify-between">
                        <span>Tax:</span>
                        <span>₱<?php echo e(number_format($order->tax, 2)); ?></span>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="flex justify-between font-bold text-lg border-t pt-2">
                    <span>Total:</span>
                    <span>₱<?php echo e(number_format($order->total, 2)); ?></span>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->paid_amount > 0): ?>
                    <div class="flex justify-between">
                        <span>Paid:</span>
                        <span>₱<?php echo e(number_format($order->paid_amount, 2)); ?></span>
                    </div>
                    <div class="flex justify-between font-semibold">
                        <span>Balance:</span>
                        <span>₱<?php echo e(number_format($order->balance, 2)); ?></span>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <!-- Actions -->
        <div class="border-t p-4 bg-gray-50">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->status === 'draft'): ?>
                <button wire:click="sendToDepartments" 
                        class="w-full bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 mb-2">
                    Send to Departments
                </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->status === 'billed' || $order->status === 'paid'): ?>
                <button wire:click="openPaymentModal" 
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                    Process Payment
                </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php else: ?>
        <div class="flex items-center justify-center h-full text-gray-500">
            Select a product to start an order
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Payment Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showPaymentModal): ?>
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-96">
                <h3 class="text-lg font-semibold mb-4">Process Payment</h3>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Payment Method</label>
                    <select wire:model="paymentMethod" class="w-full border rounded px-3 py-2">
                        <option value="Cash">Cash</option>
                        <option value="Card">Card</option>
                        <option value="GCash">GCash</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Amount</label>
                    <input type="number" wire:model="paymentAmount" step="0.01" 
                           class="w-full border rounded px-3 py-2">
                </div>

                <div class="flex gap-2">
                    <button wire:click="processPayment" 
                            class="flex-1 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                        Process
                    </button>
                    <button wire:click="$set('showPaymentModal', false)" 
                            class="flex-1 bg-gray-300 text-gray-700 py-2 px-4 rounded hover:bg-gray-400">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH E:\CoreDev\Projects\POS\resources\views/livewire/order-manager.blade.php ENDPATH**/ ?>