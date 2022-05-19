<div class="pt-4 pb-1 border-t border-gray-200">
    <div class="px-4">
        @if (Auth::user())
            <div class="font-medium text-base text-gray-800">{{ Auth::user()->first_name }}</div>
            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
        @else
            <div>{{ trans('view-navigation.guest') }}</div>
        @endif
    </div>
    <div class="mt-3 space-y-1">
        @if (Auth::user())
            <x-auth-nav-burger></x-auth-nav-burger>
        @else
            <x-guest-nav-burger></x-guest-nav-burger>
        @endif
    </div>
</div>
