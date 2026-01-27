<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">{{ $table->area->name }} - {{ $table->name }}</h2>
            <a href="{{ route('pos.index') }}" class="text-blue-600 hover:text-blue-800">Back to Tables</a>
        </div>
    </x-slot>

    <div class="h-full flex overflow-hidden">
        <!-- Product Grid -->
        <div class="w-1/2 border-r bg-gray-50 overflow-y-auto p-4">
            @livewire('product-grid', ['categories' => $categories, 'products' => $products])
        </div>

        <!-- Order Panel -->
        <div class="w-1/2 bg-white overflow-y-auto">
            @livewire('order-manager', ['order' => $activeOrder, 'table' => $table])
        </div>
    </div>
</x-app-layout>
