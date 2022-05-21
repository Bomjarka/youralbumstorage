<x-app-layout>
    <x-slot name="title">
        Albums
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('view-albumpage.title') }}
        </h2>
        <x-download-photos></x-download-photos>
    </x-slot>
    <div class="container my-12 mx-auto px-4 md:px-12">
        <x-notifications.approving
            :value="__('Check your email, we sent link for downloading archive')">
        </x-notifications.approving>
    </div>
    <x-albums.albums-grid :albums="$albums"></x-albums.albums-grid>
</x-app-layout>

