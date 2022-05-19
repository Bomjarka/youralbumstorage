<form method="GET" action="{{ route('profile') }}">
    <x-dropdown-link :href="route('profile')"
                     onclick="event.preventDefault();
                                                this.closest('form').submit();
                                                sessionStorage.clear()">
        {{ trans('view-navigation.profile') }}
    </x-dropdown-link>
</form>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <x-dropdown-link :href="route('logout')"
                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
        {{ trans('view-navigation.logout') }}
    </x-dropdown-link>
</form>
