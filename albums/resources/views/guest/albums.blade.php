<x-app-layout>
    <x-slot name="title">
        Albums
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Guest Albums Page') }}
        </h2>
    </x-slot>
    <x-guest.albums-grid></x-guest.albums-grid>
</x-app-layout>
