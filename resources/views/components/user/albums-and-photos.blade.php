<x-notifications.approving
    :value="__('Check your email, we sent link for downloading archive')">
</x-notifications.approving>
<!-- Albums Section -->
<div class="user_albums hidden bg-white p-3 mt-3 shadow-sm rounded-sm">
    <div>
        <div class="grid md:grid-cols-2 text-sm">
            <div class="grid grid-cols-2">
                <div
                    class="px-4 py-2 font-semibold">{{ trans('view-profilepage-albums-and-photos.total-albums') }}</div>
                <div class="px-4 py-2">{{ $user->albums->count() }}</div>
            </div>
            <div class="grid grid-cols-2">
                <div
                    class="px-4 py-2 font-semibold">{{ trans('view-profilepage-albums-and-photos.total-photos') }}</div>
                <div class="px-4 py-2">{{ $user->photos->count() }}</div>
            </div>
        </div>
        @if ($user->photos->count() != 0)
            <div class="flex items-center justify-end">
                <button type="click"
                        class="download_photos bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                    <i class="fa fa-download mr-3" aria-hidden="true"></i>
                    <span>{{ trans('view-profilepage-albums-and-photos.download-photos') }}</span>
                </button>
            </div>
        @endif
        <div class="flex items-center mt-3 space-x-2 font-semibold text-gray-900 leading-8">
                    <span class="text-green-500">
                            <i class="fa fa-book mr-3"></i>
                        </span>
            {{ trans('view-profilepage-albums-and-photos.albums') }}
        </div>
        @if ($user->albums->count() == 0)
            {{ trans('view-profilepage-albums-and-photos.no-albums') }}
        @else
            <table class="w-full bg-white mt-3">
                <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">ID</th>
                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">{{ trans('view-albumpage.album-name') }}</th>
                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">{{ trans('view-albumpage.album-description') }}</th>
                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">{{ trans('base-phrases.created') }}</th>

                </tr>
                </thead>
                <tbody class="text-gray-700">
                @foreach($user->albums as $album)
                    <tr>
                        <td class="text-center py-3 px-4">{{ $album->id }}</td>
                        <td class="text-center py-3 px-4"><a class="hover:text-blue-500"
                                                             href="{{ route('userAlbum', $album) }}">{{ $album->name }}</a>
                        </td>
                        <td class="text-center py-3 px-4">{{ $album->description ?? '-'}}</td>
                        <td class="text-center py-3 px">{{ $album->created_at->toDateString() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @endif
    </div>
    <!-- End albums Section -->
    <!-- Photo Section -->
    <div class="user_photos hidden bg-white p-3 mt-3 shadow-sm rounded-sm">
        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                    <span class="text-green-500">
                            <i class="fa fa-camera mr-3"></i>
                        </span>
            {{ trans('view-profilepage-albums-and-photos.photos') }}
        </div>
        @if ($user->photos->count() == 0)
            {{ trans('view-profilepage-albums-and-photos.no-photos') }}
        @else
            <table class="w-full bg-white mt-3">
                <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">ID</th>
                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">{{ trans('view-photospage.photo-name') }}</th>
                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">{{ trans('view-photospage.photo-description') }}</th>
                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">{{ trans('base-phrases.created') }}</th>

                </tr>
                </thead>
                <tbody class="text-gray-700">
                @foreach($user->photos as $photo)
                    <tr>
                        <td class="text-center py-3 px-4">{{ $photo->id }}</td>
                        <td class="text-center py-3 px-4"><a class="hover:text-blue-500"
                                                             href="#">{{ $photo->name }}</a></td>
                        <td class="text-center py-3 px-4">{{ $photo->description }}</td>
                        <td class="text-center py-3 px">{{ $photo->created_at->toDateString() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @endif
    </div>
    <!-- End photo Section -->
</div>

<script>
    $('.download_photos').on('click', function () {
        let url = "{{ route('downloadAllPhotos') }}";
        $.post(url, {
            _token: '{{ csrf_token() }}',
            userId: {{ Auth::user()->id }}
        })
            .success(function (response) {
                $('.success').slideDown(300);
                $(".success").delay(3000).slideUp(300);
            });
    });
</script>
