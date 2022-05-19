<x-app-layout>
    <x-slot name="title">
        Albums
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('view-albumpage.title') }}
        </h2>
    </x-slot>
    <x-albums.albums-grid :albums="$albums"></x-albums.albums-grid>
</x-app-layout>
