<x-admin-layout>
    <x-slot name="title">
        {{ trans('admin-permissions.title') }}
    </x-slot>
    @if (session('status'))
        @if (session('status') == 'permission-created')
            <x-notifications.approving
                :value="trans('admin-permissions.permission-created')"></x-notifications.approving>
        @endif
        @if (session('status') == 'permission-updated')
            <x-notifications.approving
                :value="trans('admin-permissions.permission-updated')"></x-notifications.approving>
        @endif
        @if (session('status') == 'nothing-updated')
            <x-notifications.error
                :icon="'fa fa-exclamation-triangle mr-3'"
                :value="trans('admin-roles.nothing-update')"></x-notifications.error>
        @endif
        @if (session('status') == 'permission-exists')
            <x-notifications.error
                :icon="'fa fa-exclamation-triangle mr-3'"
                :value="trans('admin-permissions.permission-exists')"></x-notifications.error>
        @endif
    @endif
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col" x-data="{ modelOpen: false }">
        <main class="w-full flex-grow p-6">
            <h1 class="text-3xl text-black pb-6">{{ trans('admin-permissions.all-permissions') }}</h1>
            @if (\App\Helpers\RoleHelper::has_permission(\App\Models\Permission::CREATE_ROLE, Auth::user()->id))
                <button @click="modelOpen =!modelOpen"
                        class="flex items-center justify-center px-3 py-2 space-x-2 bg-green-600 text-white font-semibold h-8 px-4 m-2 rounded hover:bg-green-500">
                    <i class="fa fa-plus w-5 h-5"></i>
                    <span>{{ trans('admin-permissions.create-permission-button') }}</span>
                </button>
                <!-- Add Role modal -->
                <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto"
                     aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div
                        class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                        <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                             x-transition:enter="transition ease-out duration-300 transform"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-200 transform"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
                             aria-hidden="true"
                        ></div>

                        <div x-cloak x-show="modelOpen"
                             x-transition:enter="transition ease-out duration-300 transform"
                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave="transition ease-in duration-200 transform"
                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                        >
                            <div class="flex items-center justify-between space-x-4">
                                <h1 class="text-xl font-medium text-gray-800 ">{{ trans('admin-permissions.new-permission-title') }}</h1>
                                <button @click="modelOpen = false"
                                        class="text-gray-600 focus:outline-none hover:text-gray-700">
                                    <i class="fa fa-times w-6 h-6"></i>
                                </button>
                            </div>
                            <form class="mt-5" method="post" action="{{ route('createPermission') }}">
                                @csrf
                                @method('post')
                                <div>
                                    <label for="permission_name"
                                           class="block text-sm text-gray-700 capitalize dark:text-gray-200">{{ trans('admin-permissions.permission-name') }}
                                    </label>
                                    <input required placeholder="{{ trans('admin-permissions.permission-name') }}"
                                           type="text"
                                           name="permission_name"
                                           class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                </div>
                                <div class="mt-4">
                                    <label for="permission_description"
                                           class="block text-sm text-gray-700 capitalize dark:text-gray-200">{{ trans('admin-permissions.permission-description') }}
                                    </label>
                                    <input placeholder="{{ trans('admin-permissions.permission-name') }}"
                                           type="text"
                                           name="permission_description"
                                           class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                </div>
                                <div class="flex justify-end mt-6">
                                    <button type="submit"
                                            class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform rounded-md bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800">
                                        {{ trans('admin-permissions.save-permission') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            <!-- End add Role modal -->
            <div class="w-full mt-6">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> {{ trans('admin-permissions.all-permissions') }}
                </p>
                <div class="bg-white overflow-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ trans('admin-permissions.permission-name') }}</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ trans('admin-permissions.permission-description') }}</th>
                            @if (\App\Helpers\RoleHelper::has_permission(\App\Models\Permission::EDIT_ROLE, Auth::user()->id))
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ trans('admin-user-page-user-roles.role-action') }}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody class="text-gray-700">
                        @foreach($permissions as $permission)
                            <tr>
                                <td class="text-left py-3 px-4"><input type="hidden" class="permission_id"
                                                                       name="permission_id"
                                                                       value="{{ $permission->id }}">{{ $permission->id }}
                                </td>
                                <td class="text-left py-3 px-4">{{ $permission->name }}</td>
                                <td class="text-left py-3 px-4"><input
                                        id={{$permission->id}}  class="permission_description"
                                        name="permission_description"
                                        value="{{ $permission->description }}"></td>
                                @if (\App\Helpers\RoleHelper::has_permission(\App\Models\Permission::EDIT_ROLE, Auth::user()->id))
                                    <td class="text-left py-3 px-4">
                                        <form method="post" action="{{ route('editPermission') }}">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" id="pd_input_{{$permission->id}}"
                                                   name="newPermissionDescription"
                                                   value="">
                                            <input type="hidden" id="pid_input_{{$permission->id}}" name="permissionId"
                                                   value={{$permission->id}}>
                                            <button type="click" id="save_permission_{{$permission->id}}"
                                                    class="save_permission disabled bg-green-600 text-white font-semibold h-8 px-4 m-2 rounded  cursor-not-allowed opacity-50">
                                                {{ trans('admin-permissions.permission-action') }}
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-admin-layout>

<script>
    let permissionId = null;
    let newPermissionDescription = null;
    $('.permission_description').on('input', function () {
        let id = $(this).attr('id');
        permissionId = id;
        newPermissionDescription = $(this).val();
        $('#pd_input_' + id).val(newPermissionDescription);
        $('#save_permission_' + id).addClass('hover:bg-green-500');
        $('#save_permission_' + id).removeClass('cursor-not-allowed opacity-50 disabled');
        $('.save_permission').not($('#save_permission_' + id)).addClass('hidden');
    });

    $('.save_permission').on('click', function () {
        if ($(this).hasClass('disabled')) {
            return false;
        }
    });
</script>
