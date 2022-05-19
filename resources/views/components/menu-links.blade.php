<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-nav-link :href="route('albums')" :active="request()->routeIs('albums')">
        {{ trans('view-navigation.albums') }}
    </x-nav-link>
    <x-nav-link :href="route('photos')" :active="request()->routeIs('photos')">
        {{ trans('view-navigation.photos') }}
    </x-nav-link>
    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
        {{ trans('view-navigation.about') }}
    </x-nav-link>
</div>
