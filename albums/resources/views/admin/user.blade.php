<x-admin-layout>
    <x-slot name="title">
        {{ $user->fullName() }}
    </x-slot>
    <div class="w-full p-4  border-t flex flex-col">
        <h1 class="text-3xl text-black pb-6">{{ $user->fullName() }}</h1>
        <div class="w-full mt-6">
            @if($user->isBlocked())
                <div role="alert">
                    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                        <i class="fa fa-lock mr-3"></i>Danger
                    </div>
                    <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                        <p>This user is blocked</p>
                    </div>
                </div>
            @endif
        </div>
        <div class="w-full mt-6">
            @if(\App\Helpers\RoleHelper::has_role('admin', $user->id))
                <div>
                    <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2">
                        <i class="fa-solid fa-user-gear mr-3"></i>Info
                    </div>
                    <div class="border border-t-0 border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700">
                        <p>This user is admin</p>
                    </div>
                </div>
            @endif
        </div>
        <!-- Start About Section -->
        <div class="bg-white border border-blue-500 p-3  mt-3 shadow-sm rounded-sm">
            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                        <span class="text-blue-500">
                            <i class="fa fa-user mr-3"></i>
                        </span>
                About
            </div>
            <div class="text-gray-700">
                <div class="grid md:grid-cols-2 text-sm">
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Login</div>
                        <div class="px-4 py-2">{{ $user->login }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Gender</div>
                        <div class="px-4 py-2">{{ $user->sex }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">First Name</div>
                        <div class="px-4 py-2">{{ $user->first_name }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Phone</div>
                        <div class="px-4 py-2">{{ $user->phone }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Second Name</div>
                        <div class="px-4 py-2">{{ $user->second_name }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Email</div>
                        <div class="px-4 py-2">
                            <a class="text-blue-800" href="mailto:jane@example.com">{{ $user->email }}</a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Last Name</div>
                        <div class="px-4 py-2">{{ $user->last_name }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Birthday</div>
                        <div class="px-4 py-2">{{ $user->birthdate }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-semibold">Registered</div>
                        <div class="px-4 py-2">{{ $user->created_at }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of about section -->
        <!-- Albums Section -->
        <div class="bg-white border border-blue-500 p-3  mt-3 shadow-sm rounded-sm">
            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                    <span class="text-blue-500">
                            <i class="fa fa-book mr-3"></i>
                        </span>
                Albums
            </div>
            @if ($user->albums->count() == 0)
                No albums
            @else
                <table class="min-w-full bg-white mt-3">
                    <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Album Name</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Album
                            Description
                        </th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Created</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700">
                    @foreach($user->albums as $album)
                        <tr>
                            <td class="w-1/3 text-left py-3 px-4">{{ $album->id }}</td>
                            <td class="w-1/3 text-left py-3 px-4"><a class="hover:text-blue-500"
                                                                     href="#">{{ $album->name }}</a></td>
                            <td class="text-left py-3 px-4">{{ $album->description }}</td>
                            <td class="text-left py-3 px">{{ $album->created_at->toDateString() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @endif
        </div>
        <!-- End albums Section -->
        <!-- Photos Section -->
        <div class="bg-white border border-blue-500 p-3  mt-3 shadow-sm rounded-sm">
            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                    <span class="text-blue-500">
                            <i class="fa fa-camera mr-3"></i>
                        </span>
                Photos
            </div>
            @if ($user->photos->count() == 0)
                No photos
            @else
                <table class="min-w-full bg-white mt-3">
                    <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Album Name</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Photo Name</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Photo Description</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Created</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700">
                    @foreach($user->photos as $photo)
                        <tr>
                            <td class="w-1/3 text-left py-3 px-4">{{ $photo->id }}</td>
                            <td class="w-1/3 text-left py-3 px-4"><a class="hover:text-blue-500"
                                                                     href="#">{{ $photo->album->first()->name ?? 'Not in album' }}</a>
                            </td>
                            <td class="w-1/3 text-left py-3 px-4"><a class="hover:text-blue-500"
                                                                     href="#">{{ $photo->name }}</a></td>
                            <td class="text-left py-3 px-4">{{ $photo->description }}</td>
                            <td class="text-left py-3 px">{{ $photo->created_at->toDateString() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <!-- End photos Section -->
    </div>
</x-admin-layout>




