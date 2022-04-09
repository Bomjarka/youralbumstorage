<!-- Authentication -->
<form method="GET" action="{{ route('profile') }}">
    <x-responsive-nav-link :href="route('profile')"
                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
        {{ __('Profile') }}
    </x-responsive-nav-link>
</form>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <x-responsive-nav-link :href="route('logout')"
                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
        {{ __('Log Out') }}
    </x-responsive-nav-link>
</form>
