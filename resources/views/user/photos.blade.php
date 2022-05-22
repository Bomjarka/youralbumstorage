<x-app-layout>
    <x-slot name="title">
        Photos
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('view-photospage.title') }}
        </h2>
        <x-download-photos></x-download-photos>
    </x-slot>
    <div class="container my-12 mx-auto px-4 md:px-12">
        <x-notifications.approving
            :value="trans('download-photos-notification.message')">
        </x-notifications.approving>
    </div>
    <x-photos.photos-grid :photos="$photos" :album="null"></x-photos.photos-grid>
</x-app-layout>
