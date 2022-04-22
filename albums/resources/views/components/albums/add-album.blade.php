<div class="flex items-center justify-center my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
    <div x-data="{ modelOpen: false }">
        <button @click="modelOpen =!modelOpen"
                class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide hover:scale-150 transition duration-500 m-2 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 shadow-lg">
            <i class="fa fa-plus w-5 h-5"></i>
            <span>Add album</span>
        </button>
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
                        <h1 class="text-xl font-medium text-gray-800 ">Add new album</h1>

                        <button @click="modelOpen = false"
                                class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <i class="fa fa-times w-6 h-6"></i>
                        </button>
                    </div>

                    <p class="mt-2 text-sm text-gray-500 ">
                        Add album to your storage
                    </p>

                    <form class="mt-5" method="post" action="{{ route('createAlbum') }}">
                        @csrf
                        @method('post')
                        <div>
                            <input type="hidden"type="text" name="user_id" value="{{ Auth::user()->id }}"
                                   class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>
                        <div>
                            <label for="album_name"
                                   class="block text-sm text-gray-700 capitalize dark:text-gray-200">Album
                                name</label>
                            <input placeholder="Album name" type="text" name="album_name"
                                   class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>
                        <div class="mt-4">
                            <label for="album_description"
                                   class="block text-sm text-gray-700 capitalize dark:text-gray-200">Album
                                Description</label>
                            <input placeholder="This album of some photos" type="text"
                                   name="album_description"
                                   class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>
                        <div class="flex justify-end mt-6">
                            <button type="submit"
                                    class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform rounded-md bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800">
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
