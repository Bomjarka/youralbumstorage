<!-- Profile Section -->
<div class="user_data sticky top-0 p-4 w-full">
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
                <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.firstname') }}</div>
                <div class="px-4 py-2">{{ $user->first_name }}</div>
            </div>
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.phone') }}</div>
                <div class="px-4 py-2">{{ $user->phone }}</div>
            </div>
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.secondname') }}</div>
                <div class="px-4 py-2">{{ $user->second_name }}</div>
            </div>
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.email') }}</div>
                <div class="px-4 py-2">{{ $user->email }}</div>
            </div>
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.lastname') }}</div>
                <div class="px-4 py-2">{{ $user->last_name }}</div>
            </div>
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.birthdate') }}</div>
                <div class="px-4 py-2">{{ $user->birthdate }}</div>
            </div>
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">{{ trans('view-profilepage-profile.registered') }}</div>
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
                        <input
                            id="gender"
                            name="gender"
                            type="radio"
                            class="w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer"
                            value="male"
                        /><label class="ml-2 text-sm" for="male">{{ trans('base-phrases.sex-male') }}</label>
                    </div>
                    <div class="flex items-center mb-3 last:mb-0">
                        <input
                            id="gender"
                            name="gender"
                            type="radio"
                            class="w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer"
                            value="female"
                        /><label class="ml-2 text-sm" for="female">{{ trans('base-phrases.sex-female') }}</label>
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
            class="edit_profile bg-amber-500 hover:bg-amber-700 text-white font-semibold hover:text-white h-8 px-4 m-2 hover: rounded">
            {{ trans('view-profilepage-profile-button.edit') }}
        </button>
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
<!-- End profile Section -->
