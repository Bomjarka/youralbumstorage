<div class="pt-2 pb-3 space-y-1">
    <x-responsive-nav-link :href="route('albums')" :active="request()->routeIs('albums')">
        {{ trans('view-navigation.albums') }}
    </x-responsive-nav-link>
</div>
<div class="pt-2 pb-3 space-y-1">
    <x-responsive-nav-link :href="route('photos')" :active="request()->routeIs('photos')">
        {{ trans('view-navigation.photos') }}
    </x-responsive-nav-link>
</div>
<div class="pt-2 pb-3 space-y-1">
    <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
        {{ trans('view-navigation.about') }}
    </x-responsive-nav-link>
</div>
