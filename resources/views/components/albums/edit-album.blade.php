<div class="mt-6" x-data="{ open: false }">
    <button @click="open = true">
        <i class="fa fa-pencil hover:text-green-600"></i>
    </button>
    <!-- Dialog (full screen) -->
    <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full"
         x-show="open" x-cloak>

        <!-- A basic modal dialog with title, body and one button to close -->
        <div
            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0 ">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                 aria-hidden="true"></div>
            <div @click.away="open = false">
                                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                                      aria-hidden="true">​</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <i class="fa fa-pencil text-green-500 fa-2x" aria-hidden="true"></i>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900"
                                    id="modal-title">
                                    Edit photo {{ $album->name }}
                                </h3>

                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 mb-3">
                                        You can change photo name or description. Press save when finish.
                                    </p>

                                    <form class="deleteAlbumForm"
                                          x-on:submit="$dispatch('deleting')"
                                          method="post"
                                          action="{{ route('editAlbum', [$album->id]) }}">
                                        @csrf
                                        @method('post')
                                        <x-label for="album_name" :value="__('Album Name')"/>
                                        <x-input id="album_name" class="block mt-1 w-full" type="text" name="album_name"
                                                 value="{{ $album->name }}"
                                                 required autofocus class="mb-3"/>
                                        <x-label for="album_description" :value="__('Album Description')"/>
                                        <x-input id="album_description" class="block mt-1 mb-3 w-full" type="text"
                                                 name="album_description" value="{{ $album->description }}"
                                                 required autofocus/>
                                        <input class="album_id" type="hidden"
                                               name="album_id" value={{ $album->id }}>

                                        <div class="flex justify-end space-x-2 mt-3">
                                            <button @click="open = false"
                                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                                Cancel
                                            </button>
                                            <button type="submit"
                                                    class="editModalButton w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 s sm:w-auto sm:text-sm">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
