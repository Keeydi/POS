<aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 flex flex-col">
    <!-- Logo/Brand -->
    <div class="flex items-center h-16 px-6 border-b border-gray-200">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-900">
            Rabbit Alley POS
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        @php
            $currentRoute = request()->route()->getName();
        @endphp
        
        <a href="{{ route('dashboard') }}" class="relative flex items-center px-4 py-3 text-sm font-medium rounded-lg transition duration-150 ease-in-out {{ $currentRoute === 'dashboard' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
            @if($currentRoute === 'dashboard')
                <span class="absolute left-0 top-0 bottom-0 w-1 bg-indigo-600 rounded-r"></span>
            @endif
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        <a href="{{ route('pos.index') }}" class="relative flex items-center px-4 py-3 text-sm font-medium rounded-lg transition duration-150 ease-in-out {{ str_starts_with($currentRoute, 'pos.') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
            @if(str_starts_with($currentRoute, 'pos.'))
                <span class="absolute left-0 top-0 bottom-0 w-1 bg-indigo-600 rounded-r"></span>
            @endif
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            POS
        </a>

        @can('manage_products')
        <a href="{{ route('products.index') }}" class="relative flex items-center px-4 py-3 text-sm font-medium rounded-lg transition duration-150 ease-in-out {{ str_starts_with($currentRoute, 'products.') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
            @if(str_starts_with($currentRoute, 'products.'))
                <span class="absolute left-0 top-0 bottom-0 w-1 bg-indigo-600 rounded-r"></span>
            @endif
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            Products
        </a>
        @endcan

        @can('manage_staff')
        <a href="{{ route('staff.index') }}" class="relative flex items-center px-4 py-3 text-sm font-medium rounded-lg transition duration-150 ease-in-out {{ str_starts_with($currentRoute, 'staff.') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
            @if(str_starts_with($currentRoute, 'staff.'))
                <span class="absolute left-0 top-0 bottom-0 w-1 bg-indigo-600 rounded-r"></span>
            @endif
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Staff
        </a>
        @endcan

        @can('view_reports')
        <a href="{{ route('reports.index') }}" class="relative flex items-center px-4 py-3 text-sm font-medium rounded-lg transition duration-150 ease-in-out {{ str_starts_with($currentRoute, 'reports.') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
            @if(str_starts_with($currentRoute, 'reports.'))
                <span class="absolute left-0 top-0 bottom-0 w-1 bg-indigo-600 rounded-r"></span>
            @endif
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            Reports
        </a>
        @endcan
    </nav>

    <!-- User Info & Logout -->
    <div class="border-t border-gray-200 p-4">
        <div class="flex items-center mb-3">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                    <span class="text-indigo-600 font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
            </div>
            <div class="ml-3 flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->roles->first()->name ?? 'No Role' }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-150 ease-in-out">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>
