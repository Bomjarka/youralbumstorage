<!-- Profile Section -->
<div class="user_data sticky top-0 p-4 w-full">
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
    <div class="flex items-center justify-end space-x-2">
        <button
            class="edit_profile bg-amber-500 hover:bg-amber-700 text-white font-semibold hover:text-white h-8 px-4 m-2 hover: rounded">
            Edit
        </button>
        <button
            class="invisible bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white h-8 px-4 m-2 border border-blue-500 hover:border-transparent rounded focus:text-red-500">
            Save
        </button>
    </div>
</div>
<div class="user_input sticky top-0 p-4 w-full hidden">
    <div class="text-gray-700">
        <div class="grid md:grid-cols-2 text-sm">
            <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold m-2">Login</div>
                <input type="text" id="login" name="login"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ $user->login }}">
            </div>
            <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold m-2">Gender</div>
                <div class="flex-row">
                    <div class="flex items-center mb-3 last:mb-0">
                        <input
                            id="gender"
                            name="gender"
                            type="radio"
                            class="w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer"
                            value="male"
                        /><label class="ml-2 text-sm" for="male">Male</label>
                    </div>
                    <div class="flex items-center mb-3 last:mb-0">
                        <input
                            id="gender"
                            name="gender"
                            type="radio"
                            class="w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer"
                            value="female"
                        /><label class="ml-2 text-sm" for="female">Female</label>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 m-2">
                <div class="px-4 py-2 font-semibold">First Name</div>
                <input type="text" id="first_name"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ $user->first_name }}">
            </div>
            <div class="grid grid-cols-2 m-2">
                <div class="px-4 py-2 font-semibold">Phone</div>
                <input type="text" id="phone"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ $user->phone }}">
            </div>
            <div class="grid grid-cols-2 m-2">
                <div class="px-4 py-2 font-semibold">Second Name</div>
                <input type="text" id="second_name"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ $user->second_name }}">
            </div>
            <div class="grid grid-cols-2 m-2">
                <div class="px-4 py-2 font-semibold">Email</div>
                <input type="email" id="email"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ $user->email }}">
            </div>
            <div class="grid grid-cols-2 m-2">
                <div class="px-4 py-2 font-semibold">Last Name</div>
                <input type="text" id="last_name"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ $user->last_name }}">
            </div>
            <div class="grid grid-cols-2 m-2">
                <div class="px-4 py-2 font-semibold">Birthday</div>
                <input type="date" id="birthday"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ $user->birthdate }}">
            </div>
            <div class="grid grid-cols-2 m-2">
                <div class="px-4 py-2 font-semibold">Registered</div>
                <div class="px-4 py-2">{{ $user->created_at }}</div>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-end space-x-2">
        <button
            class="edit_profile bg-amber-500 hover:bg-amber-700 text-white font-semibold hover:text-white h-8 px-4 m-2 hover: rounded">
            Edit
        </button>
        <button
            class="cancel_edit bg-amber-500 hover:bg-amber-700 text-white font-semibold hover:text-white h-8 px-4 m-2 hover: rounded">
            cancel
        </button>
        <button
            class="save_edit bg-green-600 hover:bg-green-800 text-white font-semibold hover:text-white h-8 px-4 m-2 hover: rounded">
            save
        </button>
    </div>
</div>
<!-- End profile Section -->
