<x-app-layout>
    <x-slot name="title">
        Photos
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Guest Photos Page') }}
        </h2>
    </x-slot>

    <x-guest.photos-grid></x-guest.photos-grid>
</x-app-layout>
