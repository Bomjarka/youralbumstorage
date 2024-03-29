<x-app-layout>
    <x-slot name="title">
        Albums
    </x-slot>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ trans('view-albumpage.title') }}
            </h2>
            <x-download-photos></x-download-photos>
        </div>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <x-notifications.error
                    :icon="'fa fa-lock mr-3'"
                    :value="$error">
                </x-notifications.error>
            @endforeach
        @endif
    </x-slot>
    <div class="container my-12 mx-auto px-4 md:px-12">
        <x-notifications.approving
            :value="trans('download-photos-notification.message')">
        </x-notifications.approving>
    </div>
    <x-albums.albums-grid :albums="$albums"></x-albums.albums-grid>
</x-app-layout>

