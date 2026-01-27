<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Staff
            </h2>
            <button onclick="openCreateModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition">
                Add Staff
            </button>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-6 px-6 overflow-y-auto h-full">
        <div class="max-w-7xl mx-auto">

            <!-- Staff Table -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Staff Code</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nickname</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Default Allowance</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo e($member->staff_code); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($member->full_name); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($member->nickname ?? '-'); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($member->staff_type); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₱<?php echo e(number_format($member->default_allowance, 2)); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($member->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                            <?php echo e($member->active ? 'Active' : 'Inactive'); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button onclick="openEditModal(<?php echo e($member->id); ?>)" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                        No staff found.
                                    </td>
                                </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    <?php echo e($staff->links()); ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Create/Edit Staff Modal -->
    <div id="staffModal" class="fixed inset-0 hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4" style="background: rgba(0, 0, 0, 0.1); backdrop-filter: blur(2px);">
        <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto transform transition-all">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-4 rounded-t-xl flex justify-between items-center z-10">
                <h3 class="text-xl font-semibold" id="modalTitle">Add Staff</h3>
                <button onclick="closeModal()" class="text-white hover:text-gray-200 transition-colors p-1 rounded-lg hover:bg-white/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6">
                <form id="staffForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <div id="methodField"></div>
                    
                    <!-- Form Fields Grid -->
                    <div class="space-y-4 mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="staff_code" class="block text-sm font-medium text-gray-700 mb-2">Staff Code *</label>
                                <input type="text" name="staff_code" id="staff_code" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="staff_type" class="block text-sm font-medium text-gray-700 mb-2">Staff Type *</label>
                                <select name="staff_type" id="staff_type" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Select Type</option>
                                    <option value="Model">Model</option>
                                    <option value="Host">Host</option>
                                    <option value="Waitress">Waitress</option>
                                    <option value="Bartender">Bartender</option>
                                    <option value="Kitchen">Kitchen</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                            <input type="text" name="full_name" id="full_name" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="nickname" class="block text-sm font-medium text-gray-700 mb-2">Nickname</label>
                            <input type="text" name="nickname" id="nickname" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="default_allowance" class="block text-sm font-medium text-gray-700 mb-2">Default Allowance *</label>
                            <input type="number" name="default_allowance" id="default_allowance" step="0.01" min="0" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="active" id="active" value="1" checked class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-2 text-sm font-medium text-gray-700">Active</span>
                            </label>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                        <button type="button" onclick="closeModal()" class="px-6 py-2.5 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition font-medium">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium shadow-md hover:shadow-lg">
                            Save Staff
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openCreateModal() {
            document.getElementById('modalTitle').textContent = 'Add Staff';
            document.getElementById('staffForm').action = '<?php echo e(route("staff.store")); ?>';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('staffForm').reset();
            document.getElementById('staffModal').classList.remove('hidden');
        }

        function openEditModal(staffId) {
            // Fetch staff data and populate form
            fetch(`/staff/${staffId}`)
                .then(response => response.json())
                .then(staff => {
                    document.getElementById('modalTitle').textContent = 'Edit Staff';
                    document.getElementById('staffForm').action = `/staff/${staffId}`;
                    document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
                    
                    document.getElementById('staff_code').value = staff.staff_code || '';
                    document.getElementById('full_name').value = staff.full_name || '';
                    document.getElementById('nickname').value = staff.nickname || '';
                    document.getElementById('staff_type').value = staff.staff_type || '';
                    document.getElementById('default_allowance').value = staff.default_allowance || '';
                    document.getElementById('active').checked = staff.active !== undefined ? staff.active : true;
                    
                    document.getElementById('staffModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (window.showToast) {
                        window.showToast('Failed to load staff data', 'error');
                    } else {
                        alert('Failed to load staff data');
                    }
                });
        }

        function closeModal() {
            document.getElementById('staffModal').classList.add('hidden');
        }

        // Close modal when clicking outside (on backdrop)
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('staffModal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeModal();
                    }
                });
            }
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php /**PATH E:\CoreDev\Projects\POS\resources\views/staff/index.blade.php ENDPATH**/ ?>