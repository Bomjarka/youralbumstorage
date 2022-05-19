<x-app-layout>
    <x-slot name="title">
        {{ trans('view-navigation.photos') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('view-photospage.title') }}
        </h2>
    </x-slot>
    <x-guest.photos-grid></x-guest.photos-grid>
</x-app-layout>
