<x-admin-layout>
    <x-slot name="title">
        {{ $user->fullName() }}
    </x-slot>
    <div class="w-full p-4  border-t flex flex-col">
        <h1 class="text-3xl text-black pb-6">{{ $user->fullName() }}</h1>
        <div class="w-full mt-6">
            @if (!$user->isVerified())
                <x-notifications.warning
                    :value="trans('admin-user-page-verify-warning.subject')">
                </x-notifications.warning>
            @endif
            @if($user->isBlocked())
                <x-notifications.error
                    :icon="'fa fa-lock mr-3'"
                    :value="trans('admin-user-page-blocked-alert.subject')">
                </x-notifications.error>
            @endif
        </div>
        <div class="w-full mt-6">
            @if(RoleHelper::has_role('admin', $user->id))
                <div>
                    <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2">
                        <i class="fa-solid fa-user-gear mr-3"></i>{{ trans('info-blade.title') }}
                    </div>
                    <div class="border border-t-0 border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700">
                        <p>{{ trans('admin-user-page-user-admin-info.subject') }}</p>
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
                        {{ trans('admin-user-page-user-data.about') }}
                    </div>
                    <div class="text-gray-700">
                        <div class="grid md:grid-cols-2 text-sm">
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.login') }}</div>
                                <div class="px-4 py-2">{{ $user->login }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.sex') }}</div>
                                <div class="px-4 py-2">{{ $user->sex }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div
                                    class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.firstname') }}</div>
                                <div class="px-4 py-2">{{ $user->first_name }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.phone') }}</div>
                                <div class="px-4 py-2">{{ $user->phone }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div
                                    class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.secondname') }}</div>
                                <div class="px-4 py-2">{{ $user->second_name }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.email') }}</div>
                                <div class="px-4 py-2">
                                    <a class="text-blue-800" href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                </div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div
                                    class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.lastname') }}</div>
                                <div class="px-4 py-2">{{ $user->last_name }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div
                                    class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.birthdate') }}</div>
                                <div class="px-4 py-2">{{ $user->birthdate }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div
                                    class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.registered') }}</div>
                                <div class="px-4 py-2">{{ $user->created_at }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of about section -->
                <!--Notifications for admin after actions-->
                @if(session('status'))
                    @if(session('status') == 'role-assigned')
                        <x-notifications.approving
                            :value="trans('admin-roles.role-assigned')">
                        </x-notifications.approving>
                    @endif
                    @if(session('status') == 'role-disabled')
                        <x-notifications.approving
                            :value="trans('admin-roles.role-disabled')">
                        </x-notifications.approving>
                    @endif
                    @if (session('status') == 'role-already-assigned')
                        <x-notifications.error
                            :icon="'fa fa-exclamation-triangle mr-3'"
                            :value="trans('admin-roles.role-already-assigned')"></x-notifications.error>
                    @endif
                    @if (session('status') == 'role-assign-error')
                        <x-notifications.error
                            :icon="'fa fa-exclamation-triangle mr-3'"
                            :value="trans('admin-roles.role-already-assigned')"></x-notifications.error>
                    @endif
                @endif
                <div class="error-alert hidden" role="alert">
                    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2 mt-3">
                        <i class="'fa fa-exclamation-triangle mr-3'"></i> {{ trans('alert-blade.title') }}
                    </div>
                    <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                        <p></p>
                    </div>
                </div>
                <!--End of admin notifications section-->
                <!-- User Roles Section -->
                <div class="hidden sm:block bg-white border border-blue-500 p-3  mt-3 shadow-sm rounded-sm">
                    <div class="flex items-center justify-between space-x-2 font-semibold text-gray-900 leading-8">
                        <div>
                            <span class="text-blue-500">
                            <i class="fa fa-book mr-3"></i>
                            </span>
                            {{ trans('admin-user-page-user-roles.title') }}
                        </div>
                        <button type="click" id="add_user_role"
                                class="add_user_role bg-green-600 text-white font-semibold h-8 px-4 m-2 rounded hover:bg-green-500">
                            {{ trans('admin-user-page-user-roles.role-action-assign') }}
                        </button>
                    </div>
                    <div class="choose_role flex items-center justify-end hidden">
                        <x-admin.role-search-input :user="$user"></x-admin.role-search-input>
                    </div>
                    @if (RoleHelper::get_user_roles($user->id)->count() == 0)
                        {{ trans('admin-user-page-user-roles.no-roles') }}
                    @else
                        <table class="min-w-full bg-white mt-3">
                            <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="w-1/3 text-center py-3 px-4 uppercase font-semibold text-sm">{{ trans('admin-user-page-user-roles.role-name') }}</th>
                                <th class="w-1/3 text-center py-3 px-4 uppercase font-semibold text-sm">{{ trans('admin-user-page-user-roles.role-description') }}</th>
                                <th class="w-1/3 text-center py-3 px-4 uppercase font-semibold text-sm">{{ trans('admin-user-page-user-roles.role-action') }}</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-700">
                            @foreach(RoleHelper::get_user_roles($user->id)->sortBy('id') as $role)
                                <tr>
                                    <input type="hidden" class="role_id_{{ $role->id }}" name="role_id"
                                           value="{{ $role->id }}">
                                    <td class="w-1/3 text-center py-3 px-4">{{ $role->name }}</td>
                                    <td class="w-1/3 text-center py-3 px-4">{{ $role->description }}</td>
                                    <td class="w-1/3 text-center py-3 px-4">
                                        <button type="click" id="remove_user_role_{{$role->id}}"
                                                class="remove_user_role bg-red-600 text-white font-semibold h-8 px-4 m-2 rounded hover:bg-red-500">
                                            {{ trans('admin-user-page-user-roles.role-action-remove') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <!-- End user roles Section -->
                <!-- Albums Section -->
                <div class="hidden sm:block bg-white border border-blue-500 p-3  mt-3 shadow-sm rounded-sm">
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                    <span class="text-blue-500">
                            <i class="fa fa-book mr-3"></i>
                        </span>
                        {{ trans('view-profilepage-albums-and-photos.albums') }}
                    </div>
                    @if ($user->albums->count() == 0)
                        {{ trans('view-profilepage-albums-and-photos.no-albums') }}
                    @else
                        <table class="min-w-full bg-white mt-3">
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
                                                                         href="#">{{ $album->name }}</a></td>
                                    <td class="text-center py-3 px-4">{{ $album->description ?? '-' }}</td>
                                    <td class="text-center py-3 px-4">{{ $album->created_at->toDateString() }}</td>
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
                        {{ trans('view-profilepage-albums-and-photos.photos') }}
                    </div>
                    @if ($user->photos->count() == 0)
                        {{ trans('view-profilepage-albums-and-photos.no-photos') }}
                    @else
                        <table class="min-w-full bg-white mt-3">
                            <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="text-center py-3 px-4 uppercase font-semibold text-sm">ID</th>
                                <th class="text-center py-3 px-4 uppercase font-semibold text-sm">{{ trans('view-albumpage.album-name') }}</th>
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
                                                                         href="#">{{ $photo->album->first()->name ?? trans('admin-user-page-user-albums.not-in-album') }}</a>
                                    </td>
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
                <!-- End photos Section -->
            </div>
            <!-- Right aside section -->
            <div class="w-full lg:w-1/5 my-6 pr-0 lg:pr-2">
                <!-- Start Actions Section -->
                <div class="bg-white border border-blue-500 p-3 mt-3 shadow-sm rounded-sm">
                    <div class="flex items-center space-x-2 font-semibold  text-lg text-gray-900 leading-8">
                        <span class="text-blue-500">
                            <i class="fa fa-tasks mr-3"></i>
                        </span>
                        {{ trans('admin-user-page-admin-actions.title') }}
                    </div><hr>
                    <div>
                        @if(!$user->isBlocked())
                            <button class="block_user hover:text-red-500" name="block" value="block" type="button"><i
                                    class="fa fa-ban text-red-500 mr-3"
                                    aria-hidden="true"></i>{{ trans('admin-user-page-admin-actions.block-user') }}
                            </button>
                        @else
                            <button class="unblock_user hover:text-green-500" name="unblock" value="unblock" type="button"><i
                                    class="fa fa-heart text-green-500 mr-3"
                                    aria-hidden="true"></i>{{ trans('admin-user-page-admin-actions.unblock-user') }}
                            </button>
                        @endif
                    </div>
                    <div>
                        <button class="delete_user hover:text-red-500" name="delete" value="delete" type="button">
                            <i class="fa fa-trash text-red-500 mr-3" aria-hidden="true"></i>{{ trans('admin-user-page-admin-actions.delete-user') }}
                        </button>
                    </div>
                </div>
            </div>
            <!-- End right aside section -->
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
                if (!alert(response.msg)) {
                    window.location.reload();
                }
            });
    });

    $('.unblock_user').on('click', function () {
        let url = "{{ route('unblockUser', ['user' => $user]) }}";
        $.post(url, {
            _token: '{{ csrf_token() }}'
        })
            .success(function (response) {
                if (!alert(response.msg)) {
                    window.location.reload();
                }
            });
    });

    $('.remove_user_role').on('click', function () {
        let url = "{{ route('removeUserRole', ['user' => $user]) }}";
        let roleId = $(this).attr('id').split('_')[3];
        $.post(url, {
            _token: '{{ csrf_token() }}',
            roleId: roleId
        })
        window.location.reload();

    });

    $('.add_user_role').on('click', function () {
            console.log();
        if (!$('.choose_role').is(':visible')) {
            $('.choose_role').delay(100).slideDown(300);
        } else {
            $('.choose_role').delay(100).slideUp(300);
        }
        $('.select-role').on('change', function () {
            let url = "{{ route('addUserRole', ['user' => $user]) }}";
            let roleId = $(this).val();
            $.post(url, {
                _token: '{{ csrf_token() }}',
                roleId: roleId
            }).fail(function (response) {
                let errmsg = JSON.parse(response.responseText).message;
                let errFile = JSON.parse(response.responseText).file + JSON.parse(response.responseText).line;

                $('.error-alert p').text('{{ trans('base-phrases.admin-error-message') }}.' + ' Error message: ' + errmsg);
                $('.error-alert').slideDown(300);
                $(".error-alert").delay(3000).slideUp(300);
            });
            window.location.reload();
        });
    });

    $('.delete_user').on('click', function () {
        let url = "{{ route('deleteUser', ['user' => $user->id]) }}";
        if (confirm('{{ trans('admin-user-page-admin-actions.delete-acceptance') }}')) {
            $.post(url, {
                _token: '{{ csrf_token() }}'
            })
                .success(function (response) {
                    if (!alert(response.status)) {
                        window.location = response.redirect;
                    }
                });
        }
    });

    jQuery(function($){
        $(document).mouseup( function(e){
            let chosserole = $( ".choose_role" );
            if ( !chosserole.is(e.target)) {
                chosserole.slideUp(300);
            }
        });
    });
</script>



