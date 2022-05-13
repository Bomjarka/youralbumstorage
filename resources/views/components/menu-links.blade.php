<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-nav-link :href="route('albums')" :active="request()->routeIs('albums')">
        {{ __('Albums') }}
    </x-nav-link>
    <x-nav-link :href="route('photos')" :active="request()->routeIs('photos')">
        {{ __('Photos') }}
    </x-nav-link>
    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
        {{ __('About') }}
    </x-nav-link>
</div>
