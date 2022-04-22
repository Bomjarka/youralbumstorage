<x-admin-layout>
    <x-slot name="title">
        {{ $user->fullName() }}
    </x-slot>
    <div class="w-full p-4  border-t flex flex-col">
        <h1 class="text-3xl text-black pb-6">{{ $user->fullName() }}</h1>
        <div class="w-full mt-6">
            @if (Auth::user()->hasVerifiedEmail() == false)
                <x-warning :message="'This user is not verified!'"></x-warning>
            @endif
            @if($user->isBlocked())
                <x-error :message="'This user is blocked'"></x-error>
            @endif
        </div>
        <div class="w-full mt-6">
            @if(RoleHelper::has_role('admin', $user->id))
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

        <div class="flex flex-wrap">
            <div class="w-full lg:w-4/5 my-6 pr-0 lg:pr-2">
                <!-- Start About Section -->
                <div class="bg-white border border-blue-500 p-3 mt-3 shadow-sm rounded-sm">
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
                <div class="hidden sm:block bg-white border border-blue-500 p-3  mt-3 shadow-sm rounded-sm">
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
                <div class="hidden sm:block bg-white border border-blue-500 p-3  mt-3 shadow-sm rounded-sm">
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
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Album Name</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Photo Name</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Photo Description</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Created</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-700">
                            @foreach($user->photos as $photo)
                                <tr>
                                    <td class="text-left py-3 px-4">{{ $photo->id }}</td>
                                    <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                                                                       href="#">{{ $photo->album->first()->name ?? 'Not in album' }}</a>
                                    </td>
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
                <!-- End photos Section -->
            </div>
            <div class="w-full lg:w-1/5 my-6 pr-0 lg:pr-2">
                <!-- Start Actions Section -->
                <div class="bg-white border border-blue-500 p-3  mt-3 shadow-sm rounded-sm">
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                        <span class="text-blue-500">
                            <i class="fa fa-tasks mr-3"></i>
                        </span>
                        Actions
                    </div>
                    <div>
                        @if(!$user->isBlocked())
                            <button class="block_user" name="block" value="block" type="button"><i
                                    class="fa fa-ban text-red-500 mr-3" aria-hidden="true"></i>Block user
                            </button>
                        @else
                            <button class="unblock_user" name="unblock" value="unblock" type="button"><i
                                    class="fa fa-heart text-green-500 mr-3" aria-hidden="true"></i>Unblock user
                            </button>
                        @endif
                    </div>
                    <div>
                        @if(RoleHelper::has_role('admin', $user->id) == false)
                            <button class="make_admin" name="make_admin" value="make_admin" type="button"><i
                                    class="fa fa-user-plus text-green-500 mr-3" aria-hidden="true"></i>Make admin
                            </button>
                        @else
                            <button class="disable_admin" name="disable_admin" value="disable_admin" type="button"><i
                                    class="fa fa-user-times text-red-500 mr-3" aria-hidden="true"></i>Dismiss Admin
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
    $('.block_user').on('click', function () {
        let url = "{{ route('blockUser', ['user' => $user->id]) }}";
        $.post(url, {
            _token: '{{ csrf_token() }}'
        })
            .success(function (response) {
                console.log(response.msg);
                if (!alert(response.msg)) {
                    window.location.reload();
                }
            })
    });
    $('.unblock_user').on('click', function () {
        let url = "{{ route('unblockUser', ['user' => $user]) }}";
        $.post(url, {
            _token: '{{ csrf_token() }}'
        })
            .success(function (response) {
                console.log(response.msg);
                if (!alert(response.msg)) {
                    window.location.reload();
                }
            })
    });


    $('.make_admin').on('click', function () {
        let url = "{{ route('makeAdmin', ['user' => $user->id]) }}";
        $.post(url, {
            _token: '{{ csrf_token() }}'
        })
            .success(function (response) {
                console.log(response.msg);
                if (!alert(response.msg)) {
                    window.location.reload();
                }
            })
    });

    $('.disable_admin').on('click', function () {
        let url = "{{ route('disableAdmin', ['user' => $user]) }}";
        $.post(url, {
            _token: '{{ csrf_token() }}'
        })
            .success(function (response) {
                console.log(response.msg);
                if (!alert(response.msg)) {
                    window.location.reload();
                }
            })
    });
</script>



