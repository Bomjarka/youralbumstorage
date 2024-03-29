<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600"></x-application-logo>
                    </a>
                </div>
                <!-- Navigation Links -->
                <x-menu-links></x-menu-links>
            </div>
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            @if (Auth::user())
                                <div class="capitalize">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</div>
                            @else
                                <div>{{ trans('view-navigation.guest') }}</div>
                            @endif

                            <div class="ml-1">
                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        @if (Auth::user())
                            <x-auth-nav-dropdown></x-auth-nav-dropdown>
                        @else
                            <x-guest-nav-dropdown></x-guest-nav-dropdown>
                        @endif
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <x-responsive-links></x-responsive-links>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @if (Auth::user())
                    <div class="font-medium text-base text-gray-800 capitalize">{{ Auth::user()->first_name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @else
                    <div>{{ trans('view-navigation.guest') }}</div>
                @endif
            </div>

            <div class="mt-3 space-y-1">
                @if (Auth::user())
                    <x-auth-nav-burger></x-auth-nav-burger>
                @else
                    <x-guest-nav-burger></x-guest-nav-burger>
                @endif
            </div>
        </div>
    </div>
</nav>
