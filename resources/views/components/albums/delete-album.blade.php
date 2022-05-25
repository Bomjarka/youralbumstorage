<div class="mt-6" x-data="{ open: false }">
    <button @click="open = true">
        <i class="fa fa-trash hover:text-red-600"></i>
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
                            <i class="fa fa-exclamation-triangle text-red-500 fa-2x" aria-hidden="true"></i>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900"
                                    id="modal-title">
                                    {{ trans('delete-photo-form.title') }}
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        {{ trans('delete-photo-form.message', ['period' => config('filesystems.lifetime')]) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <form class="deleteAlbumForm"
                              x-on:submit="$dispatch('deleting')"
                              method="post"
                              action="{{ route('deleteAlbum', [$album->id]) }}"
                        >
                            @csrf
                            @method('post')
                            <button type="submit"
                                    class="deleteModalButton w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                {{ trans('delete-photo-form.delete-button') }}
                            </button>
                            <input class="delete_photos" type="hidden" name="delete_photos">
                        </form>
                        <button @click="open = false"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ trans('delete-photo-form.cancel-button') }}
                        </button>
                        @if($album->photos->count() != 0)
                            <label for="delete_photos_checkbox" class="inline-flex items-center">
                                <input type="checkbox"
                                       class="delete_photos_checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                       name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ trans('delete-photo-form.checkbox') }}</span>
                            </label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(".delete_photos_checkbox").on('change', function () {
        $('.delete_photos').val($(".delete_photos_checkbox").is(':checked'))
    });
</script>
