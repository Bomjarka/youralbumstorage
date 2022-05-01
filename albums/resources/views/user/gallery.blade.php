<link
    href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
    rel="stylesheet"
/>
<!--  Swiper's CSS -->
<link
    rel="stylesheet"
    href="https://unpkg.com/swiper/swiper-bundle.min.css"
/>
<x-app-layout>
    <x-slot name="title">
        Photos
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Gallery') }}
        </h2>
    </x-slot>
    <div class="swiper mySwiper bg-gray-200">
        <div class="swiper-wrapper">
            @foreach(Auth::user()->photos as $photo)
                <div class="swiper-slide flex flex-col items-center justify-center">
                    <img
                        class="max-w-lg rounded"
                        src="{{ url('storage/' . $photo->photo_path) }}"
                        alt="image"
                    />
                    <p>{{ $photo->name }}</p>
                    <p>{{ $photo->description }}</p>
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next text-black hover:text-blue-400"></div>
        <div class="swiper-button-prev text-black hover:text-blue-400"></div>
    </div>
</x-app-layout>

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
