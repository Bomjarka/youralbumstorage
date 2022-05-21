<header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
    <div class="w-1/2"></div>
    <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
        <button @click="isOpen = !isOpen"
                class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-[#3d68ff] hover:border-[#3956d0] focus:border-green-500 focus:outline-none">
            <i class="fa fa-user"></i>
        </button>
        <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
        <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
            <a href="{{ route('main') }}" target="_blank" class="block px-4 py-2 account-link hover:text-blue-600 opacity-100">{{ trans('admin-dropdown-menu.back-to-app') }}</a>
            <a href="{{ route('adminUser' ,['user' => Auth::user()]) }}" class="block px-4 py-2 account-link hover:text-blue-600 opacity-100">{{ trans('admin-dropdown-menu.profile') }}</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="block px-4 py-2 account-link hover:text-blue-600"
                   onclick="event.preventDefault();
                                        this.closest('form').submit();">{{ trans('view-navigation.logout') }}</a>
            </form>
        </div>
    </div>
</header>
