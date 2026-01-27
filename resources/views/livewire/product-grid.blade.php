<div>
    <!-- Search and Category Filter -->
    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Search products..." 
               class="w-full px-4 py-2 border rounded-lg mb-2">
        
        <div class="flex flex-wrap gap-2">
            <button wire:click="selectCategory(null)" 
                    class="px-3 py-1 rounded {{ !$selectedCategory ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                All
            </button>
            @foreach($categories as $category)
                <button wire:click="selectCategory({{ $category->id }})" 
                        class="px-3 py-1 rounded {{ $selectedCategory == $category->id ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-3 gap-3">
        @foreach($filteredProducts as $product)
            <button wire:click="selectProduct({{ $product->id }})" 
                    class="p-3 bg-white border rounded-lg hover:bg-blue-50 hover:border-blue-300 transition text-left">
                <div class="font-medium text-sm">{{ $product->name }}</div>
                <div class="text-xs text-gray-500">{{ $product->sku }}</div>
                <div class="text-sm font-semibold text-blue-600 mt-1">₱{{ number_format($product->price, 2) }}</div>
                @if($product->is_commissionable)
                    <div class="text-xs text-green-600 mt-1">Commissionable</div>
                @endif
            </button>
        @endforeach
    </div>
</div>
