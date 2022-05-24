<x-app-layout>
    <x-slot name="title">
        {{ 'Album ' . $album->name }}
    </x-slot>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $album->name }}
                @if ($album->photos->count() == 0)
                    - {{ trans('view-albumpage-button.empty') }}
                @endif
            </h2>
            <x-download-photos></x-download-photos>
        </div>
    </x-slot>
    <x-photos.photos-grid :photos="$photos" :album="$album"></x-photos.photos-grid>
</x-app-layout>
