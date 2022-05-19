<x-app-layout>
    <x-slot name="title">
        {{ trans('view-navigation.albums') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('view-albumpage.title') }}
        </h2>
    </x-slot>
    <x-guest.albums-grid></x-guest.albums-grid>
</x-app-layout>
