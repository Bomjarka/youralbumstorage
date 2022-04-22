<!-- Albums Section -->
<div class="user_albums hidden bg-white p-3 mt-3 shadow-sm rounded-sm">
    <div>
        <div class="grid md:grid-cols-2 text-sm">
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">Total albums:</div>
                <div class="px-4 py-2">{{ $user->albums->count() }}</div>
            </div>
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">Total photos:</div>
                <div class="px-4 py-2">{{ $user->photos->count() }}</div>
            </div>
        </div>
        <div class="flex items-center mt-3 space-x-2 font-semibold text-gray-900 leading-8">
                    <span class="text-green-500">
                            <i class="fa fa-book mr-3"></i>
                        </span>
            Albums
        </div>
        @if ($user->albums->count() == 0)
            No albums
        @else
            <table class="w-full bg-white mt-3">
                <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Album Name</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Album
                        Description
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Created</th>

                </tr>
                </thead>
                <tbody class="text-gray-700">
                @foreach($user->albums as $album)
                    <tr>
                        <td class="text-left py-3 px-4">{{ $album->id }}</td>
                        <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                                                           href="{{ route('userAlbum', $album) }}">{{ $album->name }}</a></td>
                        <td class="text-left py-3 px-4">{{ $album->description }}</td>
                        <td class="text-left py-3 px">{{ $album->created_at->toDateString() }}</td>
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
            Photos
        </div>
        @if ($user->photos->count() == 0)
            No photos
        @else
            <table class="w-full bg-white mt-3">
                <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Photo Name</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Photo
                        Description
                    </th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Created</th>

                </tr>
                </thead>
                <tbody class="text-gray-700">
                @foreach($user->photos as $photo)
                    <tr>
                        <td class="text-left py-3 px-4">{{ $photo->id }}</td>
                        <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                                                           href="#">{{ $photo->name }}</a></td>
                        <td class="text-left py-3 px-4">{{ $photo->description }}</td>
                        <td class="text-left py-3 px">{{ $photo->created_at->toDateString() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @endif
    </div>
    <!-- End photo Section -->
</div>
