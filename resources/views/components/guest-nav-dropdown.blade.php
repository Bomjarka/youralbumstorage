<!-- Authentication -->
<form method="GET" action="{{ route('login') }}">
    <x-dropdown-link :href="route('login')"
                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
        {{ trans('view-navigation.login') }}
    </x-dropdown-link>
</form>
<form method="GET" action="{{ route('register') }}">
    <x-dropdown-link :href="route('register')"
                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
        {{ trans('view-navigation.register') }}
    </x-dropdown-link>
</form>
