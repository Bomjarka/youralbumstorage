<div class="flex items-center justify-center my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
    <div x-data="{ modelOpen: false }">
        <button @click="modelOpen =!modelOpen"
                class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide hover:scale-150 transition duration-500 m-2 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 shadow-lg">
            <i class="fa fa-plus w-5 h-5"></i>
            <span>{{ trans('view-photospage-button.add-photo') }}</span>
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
                        <h1 class="text-xl font-medium text-gray-800 ">{{ trans('add-photo-form.title') }}</h1>

                        <button @click="modelOpen = false"
                                class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <i class="fa fa-times w-6 h-6"></i>
                        </button>
                    </div>
                    <p class="mt-2 text-sm text-gray-500 ">
                        {{ trans('add-photo-form.title-description') }}
                    </p>
                    <form class="mt-5" method="post" action="{{ route('createPhoto') }}" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div>
                            <input type="hidden" name="user_id"
                                   value="{{Auth::user()->id}}"
                                   class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>
                        <div>
                            <label for="photo_name"
                                   class="block text-sm text-gray-700 capitalize dark:text-gray-200">
                                {{ trans('view-photospage.photo-name') }}
                            </label>
                            <input required placeholder="{{ trans('view-photospage.photo-name') }}" type="text"
                                   name="photo_name"
                                   class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>
                        <div class="mt-4">
                            <label for="photo_description"
                                   class="block text-sm text-gray-700 capitalize dark:text-gray-200">
                                {{ trans('view-photospage.photo-description') }}
                            </label>
                            <input placeholder="{{ trans('view-photospage.photo-description') }}" type="text"
                                   name="photo_description"
                                   class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        </div>
                        <div class="files_div mt-2 text-sm text-gray-700 dark:text-gray-200">
                            <span>{{ trans('add-photo-form.attachment-label') }}</span>
                            <div class="flex justify-between items-center">
                                <span class="input_filename hidden font-bold"></span>
                                <button type="button" class="remove_uploaded_image hidden">
                                    <li class="remove_file fa fa-times text-red-500"></li>
                                </button>
                            </div>
                            <div class="max-w-md mx-auto rounded-lg overflow-hidden md:max-w-xl">
                                <div class="md:flex">
                                    <div class="w-full p-3">
                                        <div
                                            class="input_area flex justify-center items-center border-dotted h-48 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100">
                                            <div class="input_box absolute">
                                                <div class="flex flex-col items-center"><i
                                                        class="fa fa-folder-open fa-4x text-blue-700"></i>
                                                    <span
                                                        class="block text-gray-400 font-normal">{{ trans('add-photo-form.attachment-text') }}</span>
                                                </div>
                                            </div>
                                            <input id="user_photo" accept="image/*" type="file" required
                                                   class="user_photo h-full w-full opacity-0" name="user_photo">
                                            <img id="img_preview" class="img_preview hidden" src="#">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end items-center text-gray-400 font-bold">
                                <span>{{ trans('add-photo-form.accepted-files') }}: jpg/jpeg/png</span>
                            </div>
                        </div>
                        <input class="album_id" type="hidden"
                               name="album_id" value={{ $album->id ?? null }}>
                        @if(!$fromAlbums)
                            <x-select-album-for-photo></x-select-album-for-photo>
                        @endif
                        <div class="add-photo-div flex justify-end mt-6">
                            <button type="submit"
                                    class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform rounded-md bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800">
                                {{ trans('add-photo-form.button') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let hiddenField = true;
    $('.photo-to-album').on('click', function () {
        if (hiddenField == false) {
            $('.form-select').addClass('hidden');
            hiddenField = true;
        } else {
            $('.form-select').removeClass('hidden');
            hiddenField = false
        }
        $('.form-select').change(function () {
            var value = $(this).val();
            $('.album_id').val(value);
        });
    });
    let imgInput = document.getElementById('user_photo');
    imgInput.addEventListener('change', function (e) {
        if (e.target.files) {
            let imageFile = e.target.files[0];
            let extension = imageFile.name.substring(imageFile.name.lastIndexOf('.') + 1);
            if (!['png', 'jpeg', 'jpg'].includes(extension)) {
                $('.files_div').addClass('border-2 border-red-500 rounded');
                $('.input_area').addClass('border-red-500');
                $('.input_filename').addClass('text-red-500');
                $('.add-photo-div').addClass('hidden');
                alert('Wrong file type!')
            }

            var reader = new FileReader();
            reader.onload = function (e) {
                var img = document.createElement("img");
                img.onload = function (event) {
                    // Dynamically create a canvas element
                    var canvas = document.createElement("canvas");

                    // var canvas = document.getElementById("canvas");
                    var ctx = canvas.getContext("2d");

                    // Actual resizing
                    ctx.drawImage(img, 0, 0, 300, 200);

                    // Show resized image in preview element
                    document.getElementById("img_preview").src = canvas.toDataURL(imageFile.type);
                }
                img.src = e.target.result;
            }
            reader.readAsDataURL(imageFile);
        }

        let filename = $('.user_photo').val().split('\\').pop();
        $('.input_box').addClass('hidden');
        $('.user_photo').addClass('hidden');
        $('.img_preview').removeClass('hidden');
        $('.remove_uploaded_image').removeClass('hidden');
        $('.input_filename').removeClass('hidden');
        $('.input_filename').text('Attached file name: ' + filename);
    });

    $('.remove_uploaded_image').on('click', function () {
        $(this).addClass('hidden');
        $('.input_box').removeClass('hidden');
        $('.user_photo').removeClass('hidden');
        $('.img_preview').addClass('hidden');
        $('.input_filename').addClass('hidden');

        $('.files_div').removeClass('border-2 border-red-500 rounded')
        $('.input_area').removeClass('border-red-500');
        $('.input_filename').removeClass('text-red-500')
        $('.add-photo-div').removeClass('hidden');
    });
</script>
