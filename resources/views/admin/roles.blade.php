<x-admin-layout>
    <x-slot name="title">
        {{ trans('admin-menu.roles') }}
    </x-slot>
    @if (session('status'))
        @if (session('status') == 'role-updated')
            <x-notifications.approving
                :value="trans('admin-roles.role-updated')"></x-notifications.approving>
        @endif
        @if (session('status') == 'nothing-updated')
            <x-notifications.error
                :icon="'fa fa-exclamation-triangle mr-3'"
                :value="trans('admin-roles.nothing-update')"></x-notifications.error>
        @endif
    @endif
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col" x-data="{ modelOpen: false }">
        <main class="w-full flex-grow p-6">
            <h1 class="text-3xl text-black pb-6">{{ trans('admin-menu.roles') }}</h1>
            <div class="w-full mt-6">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> {{ trans('admin-roles.allroles') }}
                </p>
                <div class="bg-white overflow-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ trans('admin-user-page-user-roles.role-name') }}</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ trans('admin-user-page-user-roles.role-description') }}</th>
                            @if (\App\Helpers\RoleHelper::has_permission(\App\Models\Permission::EDIT_ROLE, Auth::user()->id))
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ trans('admin-user-page-user-roles.role-action') }}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody class="text-gray-700">
                        @foreach($roles as $role)
                            <tr>
                                <td class="text-left py-3 px-4"><input type="hidden" class="role_id" name="role_id"
                                                                       value="{{ $role->id }}">{{ $role->id }}</td>
                                <td class="text-left py-3 px-4">{{ $role->name }}</td>
                                <td class="text-left py-3 px-4"><input id={{$role->id}}  class="role_description"
                                                                       name="role_description"
                                                                       value="{{ $role->description }}"></td>
                                @if (\App\Helpers\RoleHelper::has_permission(\App\Models\Permission::EDIT_ROLE, Auth::user()->id))
                                    <td class="text-left py-3 px-4">
                                        <form method="post" action="{{ route('editRole') }}">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" id="rd_input_{{$role->id}}" name="newRoleDescription"
                                                   value="">
                                            <input type="hidden" id="rid_input_{{$role->id}}" name="roleId"
                                                   value={{$role->id}}>
                                            <button type="click" id="save_role_{{$role->id}}"
                                                    class="save_role disabled bg-green-600 text-white font-semibold h-8 px-4 m-2 rounded  cursor-not-allowed opacity-50">
                                                {{ trans('admin-roles.update-role') }}
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
    let roleId = null;
    let newRoleDescription = null;
    $('.role_description').on('input', function () {
        let id = $(this).attr('id');
        roleId = id;
        newRoleDescription = $(this).val();
        $('#rd_input_' + id).val(newRoleDescription);
        $('#save_role_' + id).addClass('hover:bg-green-500');
        $('#save_role_' + id).removeClass('cursor-not-allowed opacity-50 disabled');
        $('.save_role').not($('#save_role_' + id)).addClass('hidden');
    });

    $('.save_role').on('click', function () {
        if ($(this).hasClass('disabled')) {
            return false;
        }
    });
</script>
