<!-- Authentication -->
<form method="GET" action="{{ route('login') }}">
    <x-dropdown-link :href="route('login')"
                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
        {{ __('Log In') }}
    </x-dropdown-link>
</form>
<form method="GET" action="{{ route('register') }}">
    <x-dropdown-link :href="route('register')"
                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
        {{ __('Register') }}
    </x-dropdown-link>
</form>
