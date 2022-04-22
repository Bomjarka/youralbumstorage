<!-- Albums Section -->
<div class="user_trashed_albums hidden bg-white p-3 mt-3 shadow-sm rounded-sm">
    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                    <span class="text-red-500">
                            <i class="fa fa-book mr-3"></i>
                        </span>
        Deleted Albums
    </div>
    @if ($user->trashedAlbums->count() == 0)
        No deleted albums
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
                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Deleted</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Action</th>

            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach($user->trashedAlbums as $album)
                <tr>
                    <td class="text-left py-3 px-4">{{ $album->id }}</td>
                    <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                                                       href="#">{{ $album->name }}</a></td>
                    <td class="text-left py-3 px-4">{{ $album->description }}</td>
                    <td class="text-left py-3 px">{{ $album->created_at->toDateString() }}</td>
                    <td class="text-left py-3 px">{{ $album->deleted_at->toDateString() }}</td>
                    <td class="text-left py-3 px">
                        <button
                            class="restore_album bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white h-8 px-4 m-2 border border-green-500 hover:border-transparent rounded"
                            value="{{ $album->id }}">
                            restore
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif
</div>
<!-- End albums Section -->
<!-- Photo Section -->
<div class="user_trashed_photos hidden bg-white p-3 mt-3 shadow-sm rounded-sm">
    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                    <span class="text-red-500">
                            <i class="fa fa-camera mr-3"></i>
                        </span>
        Deleted Photos
    </div>
    @if ($user->trashedPhotos->count() == 0)
        No deleted photos
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
                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Deleted</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Action</th>

            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach($user->trashedPhotos as $photo)
                <tr>
                    <td class="text-left py-3 px-4">{{ $photo->id }}</td>
                    <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                                                       href="#">{{ $photo->name }}</a></td>
                    <td class="text-left py-3 px-4">{{ $photo->description }}</td>
                    <td class="text-left py-3 px">{{ $photo->created_at->toDateString() }}</td>
                    <td class="text-left py-3 px">{{ $photo->deleted_at->toDateString() }}</td>
                    <td class="text-left py-3 px">
                        <button
                            class="restore_photo bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white h-8 px-4 m-2 border border-green-500 hover:border-transparent rounded"
                            value="{{ $photo->id }}">
                            restore
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif
</div>
<!-- End photo Section -->
