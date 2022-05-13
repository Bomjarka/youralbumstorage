<!-- Authentication -->
<form method="GET" action="{{ route('login') }}">
    <x-responsive-nav-link :href="route('login')"
                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
        {{ __('Log In') }}
    </x-responsive-nav-link>
</form>
<form method="GET" action="{{ route('register') }}">
    <x-responsive-nav-link :href="route('register')"
                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
        {{ __('Register') }}
    </x-responsive-nav-link>
</form>
