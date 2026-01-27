<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Point of Sale
        </h2>
    </x-slot>

    <div class="h-full overflow-y-auto bg-white">
        <div class="h-full p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-6">Select Area & Table</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 h-full">
                @foreach($areas as $area)
                    <div class="flex flex-col">
                        <h4 class="font-semibold text-gray-700 mb-4 text-base">{{ $area->name }}</h4>
                        <div class="grid grid-cols-5 gap-3 flex-1 content-start">
                            @foreach($area->tables as $table)
                                <a href="{{ route('pos.table', $table) }}" 
                                   class="p-3 text-center rounded-lg border-2 transition-all transform hover:scale-105
                                   {{ $table->status === 'occupied' ? 'bg-red-100 border-red-400 hover:bg-red-200' : 'bg-green-100 border-green-400 hover:bg-green-200' }}">
                                    <div class="text-sm font-semibold text-gray-900">{{ $table->name }}</div>
                                    <div class="text-xs text-gray-600 mt-1">{{ $table->status }}</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
