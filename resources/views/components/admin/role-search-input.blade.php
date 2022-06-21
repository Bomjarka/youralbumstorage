<div class="mt-4">
    <div class="mt-4 space-y-5">
        <select
            class="select-role appearance-none block text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
            <option disabled selected>{{ trans('admin-user-page-user-roles.role-action-choose') }}</option>
            @foreach(RoleHelper::get_all_roles() as $role)
                @if (RoleHelper::has_role($role->name, $user->id))
                    @continue
                @endif
                <option name="role_id" value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
</div>

