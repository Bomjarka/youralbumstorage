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
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <i class="fa fa-pencil text-green-500 fa-2x" aria-hidden="true"></i>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900"
                                    id="modal-title">
                                    {{ trans('edit-photo-form.title') . ', ' . $photo->name }}
                                </h3>

                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 mb-3">
                                        {{ trans('edit-photo-form.description') }}
                                    </p>

                                    <form class="deleteAlbumForm"
                                          x-on:submit="$dispatch('deleting')"
                                          method="post"
                                          action="{{ route('editPhoto', [$photo->id]) }}">
                                        @csrf
                                        @method('post')
                                        <x-label for="photo_name" :value="trans('view-photospage.photo-name')"/>
                                        <x-input id="photo_name" class="block mt-1 w-full" type="text" name="photo_name"
                                                 value="{{ $photo->name }}"
                                                 required autofocus class="mb-3"/>
                                        <x-label for="photo_description" :value="trans('view-photospage.photo-description')"/>
                                        <input placeholder="This photo of a something somewhere" type="text"
                                               name="photo_description" value="{{ $photo->description }}"
                                               class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                        <input class="album_id" type="hidden"
                                               name="album_id" value={{ $album->id ?? null }}>

                                        @if(!Auth::user()->albums->isEmpty())
                                            @if($photo->album->first())
                                                <x-select-album-for-move-photo
                                                    :photo="$photo"></x-select-album-for-move-photo>
                                            @else
                                                <x-select-album-for-photo></x-select-album-for-photo>
                                            @endif
                                        @endif
                                        <div class="flex justify-end space-x-2 mt-3">
                                            <button @click="open = false"
                                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                                {{ trans('edit-photo-form.cancel-button') }}
                                            </button>
                                            <button type="submit"
                                                    class="editModalButton w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 s sm:w-auto sm:text-sm">
                                                {{ trans('edit-photo-form.save-button') }}
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
