<div class="pt-2 pb-3 space-y-1">
    <x-responsive-nav-link :href="route('albums')" :active="request()->routeIs('albums')">
        {{ __('Albums') }}
    </x-responsive-nav-link>
</div>
<div class="pt-2 pb-3 space-y-1">
    <x-responsive-nav-link :href="route('photos')" :active="request()->routeIs('photos')">
        {{ __('Photos') }}
    </x-responsive-nav-link>
</div>
<div class="pt-2 pb-3 space-y-1">
    <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
        {{ __('About') }}
    </x-responsive-nav-link>
</div>
