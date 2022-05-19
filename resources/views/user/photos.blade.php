<x-app-layout>
    <x-slot name="title">
        Photos
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('view-photospage.title') }}
        </h2>
    </x-slot>
    <x-photos.photos-grid :photos="$photos" :album="null"></x-photos.photos-grid>
</x-app-layout>
