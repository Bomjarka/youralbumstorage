<link
    href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
    rel="stylesheet"
/>
<!--  Swiper's CSS -->
<link
    rel="stylesheet"
    href="https://unpkg.com/swiper/swiper-bundle.min.css"
/>
<div class="mt-6" x-data="{ open: false }">
    <button @click="open = true">
        <i class="fa fa-eye hover:text-green-600"></i>
    </button>
    <!-- Dialog (full screen) -->
    <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full"
         x-show="open" x-cloak>
        <!-- A basic modal dialog with title, body and one button to close -->
        <div
            class="flex items-end justify-center pt-4 px-4 pb-20 text-center sm:block sm:p-0 ">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                 aria-hidden="true"></div>
            <div @click.away="open = false" class="flex-row items-center justify-center">
                <div
                    class="inline-block align-bottom rounded-lg text-left  transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="">
                        <div class="flex items-center">
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    @foreach($photos as $photo)
                                        <div class="swiper-slide">
                                            <img
                                                class=" rounded"
                                                src="{{ url('storage/' . $photo->photo_path) }}"
                                                alt="image"
                                            />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next hover:text-white"></div>
                <div class="swiper-button-prev hover:text-white"></div>
            </div>
        </div>
    </div>
</div>
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>

    var swiper = new Swiper('.mySwiper', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        keyboard: {
            enabled: true,
        },
    });
</script>
