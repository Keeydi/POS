<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
            <button onclick="openCreateModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition">
                Add Product
            </button>
        </div>
    </x-slot>

    <div class="py-6 px-6 overflow-y-auto h-full">
        <div class="max-w-7xl mx-auto">

            <!-- Filters -->
            <div class="bg-white shadow rounded-lg p-4 mb-6">
                <form method="GET" action="{{ route('products.index') }}" class="flex gap-4">
                    <div class="flex-1">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="category_id" id="category" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                        <select name="department_id" id="department" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">All Departments</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition">
                            Filter
                        </button>
                        @if(request('category_id') || request('department_id'))
                            <a href="{{ route('products.index') }}" class="ml-2 text-gray-600 hover:text-gray-800">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Products Table -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cost</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commission</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->sku }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->category->name ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->department->name ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₱{{ number_format($product->price, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $product->cost ? '₱' . number_format($product->cost, 2) : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($product->is_commissionable)
                                            @if($product->commission_type === 'fixed')
                                                ₱{{ number_format($product->commission_value, 2) }}
                                            @elseif($product->commission_type === 'percentage')
                                                {{ number_format($product->commission_value, 2) }}%
                                            @else
                                                Tiered
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $product->active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button onclick="openEditModal({{ $product->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">
                                        No products found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Create/Edit Product Modal -->
    <div id="productModal" class="fixed inset-0 hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4" style="background: rgba(0, 0, 0, 0.1); backdrop-filter: blur(2px);">
        <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto transform transition-all">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-4 rounded-t-xl flex justify-between items-center z-10">
                <h3 class="text-xl font-semibold" id="modalTitle">Add Product</h3>
                <button onclick="closeModal()" class="text-white hover:text-gray-200 transition-colors p-1 rounded-lg hover:bg-white/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6">
                <form id="productForm" method="POST">
                    @csrf
                    <div id="methodField"></div>

                    <!-- Form Fields Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                            <select name="category_id" id="category_id" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-700 mb-2">SKU *</label>
                            <input type="text" name="sku" id="sku" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                            <input type="text" name="name" id="name" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price *</label>
                            <input type="number" name="price" id="price" step="0.01" min="0" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="cost" class="block text-sm font-medium text-gray-700 mb-2">Cost</label>
                            <input type="number" name="cost" id="cost" step="0.01" min="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="department_id" class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                            <select name="department_id" id="department_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">No Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Checkboxes and Commission Fields -->
                    <div class="space-y-4 mb-6">
                        <div class="flex items-center space-x-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_commissionable" id="is_commissionable" value="1" class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-2 text-sm font-medium text-gray-700">Is Commissionable</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="taxable" id="taxable" value="1" class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-2 text-sm font-medium text-gray-700">Taxable</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="active" id="active" value="1" checked class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-2 text-sm font-medium text-gray-700">Active</span>
                            </label>
                        </div>

                        <div id="commissionFields" style="display: none;" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="commission_type" class="block text-sm font-medium text-gray-700 mb-2">Commission Type</label>
                                <select name="commission_type" id="commission_type" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="fixed">Fixed</option>
                                    <option value="percentage">Percentage</option>
                                    <option value="tiered">Tiered</option>
                                </select>
                            </div>
                            <div>
                                <label for="commission_value" class="block text-sm font-medium text-gray-700 mb-2">Commission Value</label>
                                <input type="number" name="commission_value" id="commission_value" step="0.01" min="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                        <button type="button" onclick="closeModal()" class="px-6 py-2.5 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition font-medium">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium shadow-md hover:shadow-lg">
                            Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Set up event listener once on page load
        document.addEventListener('DOMContentLoaded', function() {
            const isCommissionable = document.getElementById('is_commissionable');
            if (isCommissionable) {
                isCommissionable.addEventListener('change', toggleCommissionFields);
            }

            // Close modal when clicking outside (on backdrop)
            const modal = document.getElementById('productModal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === this || e.target.classList.contains('backdrop')) {
                        closeModal();
                    }
                });
            }
        });

        function openCreateModal() {
            document.getElementById('modalTitle').textContent = 'Add Product';
            document.getElementById('productForm').action = '{{ route("products.store") }}';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('productForm').reset();
            toggleCommissionFields();
            document.getElementById('productModal').classList.remove('hidden');
        }

        function openEditModal(productId) {
            // Fetch product data and populate form
            fetch(`/products/${productId}`)
                .then(response => response.json())
                .then(product => {
                    document.getElementById('modalTitle').textContent = 'Edit Product';
                    document.getElementById('productForm').action = `/products/${productId}`;
                    document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
                    
                    document.getElementById('category_id').value = product.category_id || '';
                    document.getElementById('sku').value = product.sku || '';
                    document.getElementById('name').value = product.name || '';
                    document.getElementById('price').value = product.price || '';
                    document.getElementById('cost').value = product.cost || '';
                    document.getElementById('department_id').value = product.department_id || '';
                    document.getElementById('is_commissionable').checked = product.is_commissionable || false;
                    document.getElementById('commission_type').value = product.commission_type || 'fixed';
                    document.getElementById('commission_value').value = product.commission_value || '';
                    document.getElementById('taxable').checked = product.taxable || false;
                    document.getElementById('active').checked = product.active !== undefined ? product.active : true;
                    
                    toggleCommissionFields();
                    document.getElementById('productModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (window.showToast) {
                        window.showToast('Failed to load product data', 'error');
                    } else {
                        alert('Failed to load product data');
                    }
                });
        }

        function closeModal() {
            document.getElementById('productModal').classList.add('hidden');
        }

        function toggleCommissionFields() {
            const isCommissionable = document.getElementById('is_commissionable');
            const commissionFields = document.getElementById('commissionFields');
            
            if (isCommissionable && commissionFields) {
                if (isCommissionable.checked) {
                    commissionFields.style.display = 'grid';
                } else {
                    commissionFields.style.display = 'none';
                }
            }
        }
    </script>
</x-app-layout>
