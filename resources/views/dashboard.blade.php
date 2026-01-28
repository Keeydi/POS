<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="h-full flex flex-col overflow-hidden">
        <div class="flex-1 flex flex-col p-4 md:p-6 overflow-y-auto">
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 md:h-10 md:w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm md:text-base font-medium text-gray-500 truncate">Today's Orders</dt>
                                    <dd class="text-2xl md:text-3xl font-bold text-gray-900 mt-1">{{ $stats['today_orders'] }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 md:h-10 md:w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm md:text-base font-medium text-gray-500 truncate">Today's Sales</dt>
                                    <dd class="text-2xl md:text-3xl font-bold text-gray-900 mt-1">₱{{ number_format($stats['today_sales'], 2) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 md:h-10 md:w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm md:text-base font-medium text-gray-500 truncate">Open Tables</dt>
                                    <dd class="text-2xl md:text-3xl font-bold text-gray-900 mt-1">{{ $stats['open_tables'] }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 md:h-10 md:w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm md:text-base font-medium text-gray-500 truncate">Pending Orders</dt>
                                    <dd class="text-2xl md:text-3xl font-bold text-gray-900 mt-1">{{ $stats['pending_orders'] }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Areas and Tables -->
            <div class="bg-white shadow-lg rounded-lg flex-1 flex flex-col min-h-0">
                <div class="p-6 md:p-8 flex-1 flex flex-col min-h-0">
                    <h3 class="text-xl md:text-2xl font-semibold text-gray-900 mb-6">Areas & Tables</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 flex-1 min-h-0">
                        @foreach($areas as $area)
                            <div class="flex flex-col min-h-0">
                                <h4 class="text-lg md:text-xl font-semibold text-gray-700 mb-4">{{ $area->name }}</h4>
                                <div class="grid grid-cols-5 gap-3 md:gap-4 flex-1 content-start">
                                    @foreach($area->tables as $table)
                                        <a href="{{ route('pos.table', $table) }}" 
                                           class="p-3 md:p-4 text-center rounded-lg border-2 transition-all duration-200 transform hover:scale-105
                                           {{ $table->status === 'occupied' ? 'bg-red-100 border-red-400 hover:bg-red-200' : 'bg-green-100 border-green-400 hover:bg-green-200' }}">
                                            <div class="text-sm md:text-base font-semibold">{{ $table->name }}</div>
                                            <div class="text-xs md:text-sm text-gray-600 mt-1 capitalize">{{ $table->status }}</div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
