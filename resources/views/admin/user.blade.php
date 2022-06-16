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
                    <div class="user_data text-gray-700">
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
                                <div class="px-4 py-2 capitalize">{{ $user->first_name }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.phone') }}</div>
                                <div class="px-4 py-2">{{ $user->phone }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div
                                    class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.secondname') }}</div>
                                <div class="px-4 py-2 capitalize">{{ $user->second_name }}</div>
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
                                <div class="px-4 py-2 capitalize">{{ $user->last_name }}</div>
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
                    <div class="flex items-center justify-end space-x-2">
                        <button
                            class="edit_profile bg-amber-500 hover:bg-amber-700 text-white font-semibold hover:text-white h-8 px-4 m-2 hover: rounded">
                            {{ trans('view-profilepage-profile-button.edit') }}
                        </button>
                        <button
                            class="hidden bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white h-8 px-4 m-2 border border-blue-500 hover:border-transparent rounded focus:text-red-500">
                            {{ trans('view-profilepage-profile-button.save') }}
                        </button>
                    </div>

                    <div class="user_input sticky top-0 p-4 w-full hidden">
                        <div class="text-gray-700">
                            <div class="grid md:grid-cols-2 text-sm">
                                <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold m-2">{{ trans('view-profilepage-profile.login') }}</div>
                                    <input type="text" id="login" name="login"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           value="{{ $user->login }}">
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold m-2">{{ trans('view-profilepage-profile.sex') }}</div>
                                    <div class="flex-row">
                                        <div class="flex items-center mb-3 last:mb-0">
                                            @if($user->sex == 'male')
                                                <input
                                                    id="gendermale"
                                                    name="gender"
                                                    type="radio"
                                                    class="w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer"
                                                    value="male"
                                                    checked
                                                />
                                            @else
                                                <input
                                                    id="gendermale"
                                                    name="gender"
                                                    type="radio"
                                                    class="w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer"
                                                    value="male"
                                                />
                                            @endif
                                            <label class="ml-2 text-sm" for="male">{{ trans('base-phrases.sex-male') }}</label>
                                        </div>
                                        <div class="flex items-center mb-3 last:mb-0">
                                            @if($user->sex == 'female')
                                                <input
                                                    id="genderfemale"
                                                    name="gender"
                                                    type="radio"
                                                    class="w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer"
                                                    value="female"
                                                    checked
                                                />
                                            @else
                                                <input
                                                    id="genderfemale"
                                                    name="gender"
                                                    type="radio"
                                                    class="w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer"
                                                    value="female"
                                                />
                                            @endif
                                            <label class="ml-2 text-sm" for="female">{{ trans('base-phrases.sex-female') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 m-2">
                                    <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.firstname') }}</div>
                                    <input type="text" id="first_name"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           value="{{ $user->first_name }}">
                                </div>
                                <div class="grid grid-cols-2 m-2">
                                    <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.phone') }}</div>
                                    <input type="text" id="phone"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           value="{{ $user->phone }}">
                                </div>
                                <div class="grid grid-cols-2 m-2">
                                    <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.secondname') }}</div>
                                    <input type="text" id="second_name"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           value="{{ $user->second_name }}">
                                </div>
                                <div class="grid grid-cols-2 m-2">
                                    <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.email') }}</div>
                                    <input type="email" id="email"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           value="{{ $user->email }}">
                                </div>
                                <div class="grid grid-cols-2 m-2">
                                    <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.lastname') }}</div>
                                    <input type="text" id="last_name"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           value="{{ $user->last_name }}">
                                </div>
                                <div class="grid grid-cols-2 m-2">
                                    <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.birthdate') }}</div>
                                    <input type="date" id="birthday"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           value="{{ $user->birthdate }}">
                                </div>
                                <div class="grid grid-cols-2 m-2">
                                    <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.registered') }}</div>
                                    <div class="px-4 py-2">{{ $user->created_at }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end space-x-2">
                            <button
                                class="cancel_edit bg-amber-500 hover:bg-amber-700 text-white font-semibold hover:text-white h-8 px-4 m-2 hover: rounded">
                                {{ trans('view-profilepage-profile-button.cancel') }}
                            </button>
                            <button
                                class="save_edit bg-green-600 hover:bg-green-800 text-white font-semibold hover:text-white h-8 px-4 m-2 hover: rounded">
                                {{ trans('view-profilepage-profile-button.save') }}
                            </button>
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
                        @if(\App\Helpers\RoleHelper::has_permission(\App\Models\Permission::ADD_ROLE_TO_USER, Auth::user()->id))
                            <button type="click" id="add_user_role"
                                    class="add_user_role bg-green-600 text-white font-semibold h-8 px-4 m-2 rounded hover:bg-green-500">
                                {{ trans('admin-user-page-user-roles.role-action-assign') }}
                            </button>
                        @endif
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
                                @if (\App\Helpers\RoleHelper::has_permission(\App\Models\Permission::REMOVE_ROLE_FROM_USER, Auth::user()->id))
                                    <th class="w-1/3 text-center py-3 px-4 uppercase font-semibold text-sm">{{ trans('admin-user-page-user-roles.role-action') }}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="text-gray-700">
                            @foreach(RoleHelper::get_user_roles($user->id)->sortBy('id') as $role)
                                <tr>
                                    <input type="hidden" class="role_id_{{ $role->id }}" name="role_id"
                                           value="{{ $role->id }}">
                                    <td class="w-1/3 text-center py-3 px-4">{{ $role->name }}</td>
                                    <td class="w-1/3 text-center py-3 px-4">{{ $role->description }}</td>
                                    @if (\App\Helpers\RoleHelper::has_permission(\App\Models\Permission::REMOVE_ROLE_FROM_USER, Auth::user()->id))
                                        <td class="w-1/3 text-center py-3 px-4">
                                            <button type="click" id="remove_user_role_{{$role->id}}"
                                                    class="remove_user_role bg-red-600 text-white font-semibold h-8 px-4 m-2 rounded hover:bg-red-500">
                                                {{ trans('admin-user-page-user-roles.role-action-remove') }}
                                            </button>
                                        </td>
                                    @endif
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
                    </div>
                    <hr>
                    @if(\App\Helpers\RoleHelper::has_permission(\App\Models\Permission::BLOCK_USER, Auth::user()->id)
                            && (\App\Helpers\RoleHelper::has_permission(\App\Models\Permission::UNBLOCK_USER, Auth::user()->id)))
                        <div>
                            @if(!$user->isBlocked())
                                <button class="block_user hover:text-red-500" name="block" value="block" type="button">
                                    <i
                                        class="fa fa-ban text-red-500 mr-3"
                                        aria-hidden="true"></i>{{ trans('admin-user-page-admin-actions.block-user') }}
                                </button>
                            @else
                                <button class="unblock_user hover:text-green-500" name="unblock" value="unblock"
                                        type="button"><i
                                        class="fa fa-heart text-green-500 mr-3"
                                        aria-hidden="true"></i>{{ trans('admin-user-page-admin-actions.unblock-user') }}
                                </button>
                            @endif
                        </div>
                    @endif
                    @if(\App\Helpers\RoleHelper::has_permission(\App\Models\Permission::DELETE_USER, Auth::user()->id))
                        <div>
                            <button class="delete_user hover:text-red-500" name="delete" value="delete" type="button">
                                <i class="fa fa-trash text-red-500 mr-3"
                                   aria-hidden="true"></i>{{ trans('admin-user-page-admin-actions.delete-user') }}
                            </button>
                        </div>
                    @endif
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

    jQuery(function ($) {
        $(document).mouseup(function (e) {
            let chosserole = $(".choose_role");
            if (!chosserole.is(e.target)) {
                chosserole.slideUp(300);
            }
        });
    });

    var gender = '';

    if ($('#gendermale').is(':checked')) {
        gender = $('#gendermale').val();
    } else if ($('#genderfemale').is(':checked')) {
        gender = $('#genderfemale').val();
    }

    function profileData() {
        $('.profile').addClass('bg-gray-200');
        $('.trash').removeClass('bg-gray-200');
        $('.user_data').removeClass('hidden');
        $('.user_albums').addClass('hidden');
        $('.user_albums').addClass('hidden');
        $('.user_photos').addClass('hidden');
        $('.user_trashed_albums').addClass('hidden');
        $('.user_trashed_photos').addClass('hidden');
        $('.album_and_photos').removeClass('bg-gray-200');

        sessionStorage.setItem('lastUri', 'profile_data')
    }

    $('.edit_profile').on('click', function () {
        $('.edit_profile').addClass('hidden');
        $('.user_data').addClass('hidden');
        $('.user_input').removeClass('hidden');
    });

    $('.cancel_edit').on('click', function () {
        $('.edit_profile').removeClass('hidden');
        $('.user_data').removeClass('hidden');
        $('.user_input').addClass('hidden');
    });

    $('#gendermale').on('change', function () {
        gender = $(this).val();
    });

    $('#genderfemale').on('change', function () {
        gender = $(this).val();
    });

    $('.save_edit').on('click', function () {
        let login = document.getElementById("login").value;
        let firstName = document.getElementById("first_name").value;
        let secondName = document.getElementById("second_name").value;
        let lastName = document.getElementById("last_name").value;
        let phone = document.getElementById("phone").value;
        let email = document.getElementById("email").value;
        let birthdate = document.getElementById("birthday").value;
        let userId = document.getElementById("user_id").value;
        let url = "{{ route('editUser', ['user' => $user]) }}";

        $.post(url, {
            _token: '{{ csrf_token() }}',
            userId: userId,
            login: login,
            firstName: firstName,
            secondName: secondName,
            lastName: lastName,
            phone: phone,
            email: email,
            birthdate: birthdate,
            gender: gender
        })
            .success(function (response) {
                $('.edit_profile').removeClass('hidden');
                $('.user_data').removeClass('hidden');
                $('.save_edit').addClass('hidden');
                $('.cancel_edit').addClass('hidden');
                $('.user_input').addClass('hidden');
                if (!alert(response.msg)) {
                    window.location.reload();
                }
            })
    });
</script>



