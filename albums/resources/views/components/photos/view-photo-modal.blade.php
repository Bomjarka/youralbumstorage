<div x-data="{ modelOpen: false }">
    <button @click="modelOpen =!modelOpen"
            class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide hover:scale-150 transition duration-500 m-2 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 shadow-lg">
        <i class="fa fa-eye w-5 h-5"></i>
        <span>Add photo</span>
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
                 class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                 aria-hidden="true"
            ></div>

            <div x-cloak x-show="modelOpen"
                 class="inline-block w-full max-w-2xl p-8 m-20 transition-all transform bg-gray-50 rounded-lg ">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach($photos as $photo)
                            <div class="flex items-center justify-center swiper-slide">
                                <img
                                    class="object-cover"
                                    src="{{ url('storage/' . $photo->photo_path) }}"
                                    alt="image"
                                />
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
</div>

