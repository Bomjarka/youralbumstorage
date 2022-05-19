<x-app-layout>
    <x-slot name="title">
        {{ 'Album ' . $album->name }}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $album->name }}
            @if ($album->photos->count() == 0)
                - This album is empty
            @endif
        </h2>
    </x-slot>
    <x-photos.photos-grid :photos="$photos" :album="$album"></x-photos.photos-grid>
</x-app-layout>
