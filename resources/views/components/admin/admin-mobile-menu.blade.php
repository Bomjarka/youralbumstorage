<header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin') }}" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
        <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
            <i x-show="!isOpen" class="fas fa-bars"></i>
            <i x-show="isOpen" class="fas fa-times"></i>
        </button>
    </div>
    <!-- Dropdown Nav -->
    <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
        <a href="{{ route('main') }}"
           class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-table mr-3"></i>
            {{ trans('admin-dropdown-menu.back-to-app') }}
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            @method('post')
            <a href="{{ route('logout') }}"
               class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item"
               onclick="event.preventDefault();
                                        this.closest('form').submit();">
                <i class="fas fa-sign-out-alt mr-3"></i>
                {{ trans('view-navigation.logout') }}
            </a>
        </form>
    </nav>
</header>
