<x-admin-layout>
    <x-slot name="title">
        {{ trans('admin-menu.roles') }}
    </x-slot>
    <!-- Warning if AJAX wrong -->
    {{--    @if (session('status') == 'nothing-updated')--}}
    {{--    <div class="warning hidden" role="alert">--}}
    {{--        <div class="bg-orange-500 text-white font-bold rounded-t px-4 py-2 mt-3">--}}
    {{--            <i class="fa fa-exclamation-triangle mr-3"></i>{{ trans('warning-blade.title') }}--}}
    {{--        </div>--}}
    {{--        <div--}}
    {{--            class="warning-text flex flex-col border border-t-0 border-orange-400 rounded-b bg-orange-100 px-4 py-3 text-orange-700 font-bold">--}}
    {{--            <p></p>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    @endif--}}
    <!-- End of arning if AJAX wrong -->
    <!-- Approve msg if role created -->

    <!-- End of approve msg if role created -->
    <!-- Approve msg if role updated -->
    @if (session('status'))
        @if (session('status') == 'role-created')
            <x-approving
                :value="trans('admin-roles.role-created')"></x-approving>
        @endif
        @if (session('status') == 'role-updated')
            <x-approving
                :value="trans('admin-roles.role-updated')"></x-approving>

        @endif
        @if (session('status') == 'nothing-updated')
            <x-error :value="trans('admin-roles.nothing-update')"></x-error>
        @endif
    @endif
    {{--    <div class="edit_success hidden" role="alert">--}}
    {{--        <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2 mt-3">--}}
    {{--            <i class="fa fa-check mr-3"></i>{{ trans('approving-blade.title') }}--}}
    {{--        </div>--}}
    {{--        <div--}}
    {{--            class="flex flex-col border border-t-0 border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 font-bold">--}}
    {{--            <p>{{ trans('admin-roles.role-updated') }}</p>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <!-- End of approve msg if role updated -->
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col" x-data="{ modelOpen: false }">
        <main class="w-full flex-grow p-6">
            <h1 class="text-3xl text-black pb-6">{{ trans('admin-menu.roles') }}</h1>
            <button @click="modelOpen =!modelOpen"
                    class="flex items-center justify-center px-3 py-2 space-x-2 bg-green-600 text-white font-semibold h-8 px-4 m-2 rounded hover:bg-green-500">
                <i class="fa fa-plus w-5 h-5"></i>
                <span>{{ trans('admin-roles.new-role-button') }}</span>
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
                            <h1 class="text-xl font-medium text-gray-800 ">{{ trans('admin-roles.new-role-title') }}</h1>
                            <button @click="modelOpen = false"
                                    class="text-gray-600 focus:outline-none hover:text-gray-700">
                                <i class="fa fa-times w-6 h-6"></i>
                            </button>
                        </div>
                        <form class="mt-5" method="post" action="{{ route('addRole') }}">
                            @csrf
                            @method('post')
                            <div>
                                <label for="role_name"
                                       class="block text-sm text-gray-700 capitalize dark:text-gray-200">{{ trans('admin-roles.new-role-name') }}
                                </label>
                                <input required placeholder="{{ trans('admin-roles.new-role-name') }}" type="text"
                                       name="role_name"
                                       class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                            </div>
                            <div class="mt-4">
                                <label for="role_description"
                                       class="block text-sm text-gray-700 capitalize dark:text-gray-200">{{ trans('admin-roles.new-role-description-label') }}
                                </label>
                                <input placeholder="{{ trans('admin-roles.new-role-description-placeholder') }}"
                                       type="text"
                                       name="role_description"
                                       class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                            </div>
                            <div class="flex justify-end mt-6">
                                <button type="submit"
                                        class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform rounded-md bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800">
                                    {{ trans('admin-roles.save-role') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End add Role modal -->
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
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ trans('admin-user-page-user-roles.role-action') }}</th>
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
        let url = "{{ route('editRole') }}";
        {{--$.post(url, {--}}
        {{--    _token: '{{ csrf_token() }}',--}}
        {{--    roleId: roleId,--}}
        {{--    newRoleDescription: newRoleDescription--}}
        {{--})--}}
        {{--    .success(function (response) {--}}
        {{--        console.log(response.msg);--}}
        {{--        // if (response.msg != 'Role updated!') {--}}
        {{--        //     $('.warning').slideDown(300);--}}
        {{--        //     $(".warning").delay(1000).slideUp(300);--}}
        {{--        //     $('.warning-text p').text(response.msg);--}}
        {{--        // } else {--}}
        {{--        //     $('.save_role').removeClass('hidden');--}}
        {{--        //     $('.save_role').addClass('cursor-not-allowed opacity-50');--}}
        {{--        //     $('.edit_success').slideDown(300);--}}
        {{--        //     $(".edit_success").delay(1000).slideUp(300, function () {--}}
        {{--                window.location.reload();--}}
        {{--        //     });--}}
        {{--        // }--}}
        {{--    });--}}
    });
</script>
