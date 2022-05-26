<x-admin-layout>
    <x-slot name="title">
        {{ trans('admin-permissions.title') }}
    </x-slot>
    @if (session('status'))
        @if (session('status') == 'permission-updated')
            <x-notifications.approving
                :value="trans('admin-permissions.permission-updated')"></x-notifications.approving>
        @endif
        @if (session('status') == 'nothing-updated')
            <x-notifications.error
                :icon="'fa fa-exclamation-triangle mr-3'"
                :value="trans('admin-roles.nothing-update')"></x-notifications.error>
        @endif
    @endif
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col" x-data="{ modelOpen: false }">
        <main class="w-full flex-grow p-6">
            <h1 class="text-3xl text-black pb-6">{{ trans('admin-permissions.all-permissions') }}</h1>
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
