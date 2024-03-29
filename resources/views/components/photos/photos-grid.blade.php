<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<div class="py-12 overflow-hidden">
    <div class="photo-grid container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            @foreach($photos as $photo)
                <!-- Column -->
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3 transition duration-500">
                    <!-- Article -->
                    <article id="{{ $photo->id }}"
                             class="article-div overflow-hidden rounded-lg shadow-lg hover:border-2 border-blue-600">
                        <input class="photo-path-{{ $photo->id }}" type="hidden" name="photo-path"
                               value="{{ $photo->photo_path }}">
                        <img alt="Placeholder" class="block h-auto w-full"
                             src="{{ url('storage/' . $photo->photo_preview_path) }}">
                        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                            <h1 class="text-lg">
                                <a class="no-underline hover:underline text-black" href="{{ route('gallery') }}">
                                    {{ $photo->name }}
                                </a>
                            </h1>
                            <p class="text-grey-darker text-sm">
                                {{ $photo->created_at->format('d M Y') }}
                            </p>
                        </header>
                        <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                            <a class="no-underline hover:underline text-black" href="#">
                                <p class="ml-2 text-sm">
                                    {{ $photo->description }}
                                </p>
                            </a>
                            <div class="space-x-2 hidden sm:flex">
                                <x-photos.edit-photo :photo="$photo"></x-photos.edit-photo>
                                <x-photos.delete-photo :photo="$photo"></x-photos.delete-photo>
                                <x-photos.gallery :photos="$photos" :photo="$photo"></x-photos.gallery>
                            </div>
                        </footer>
                    </article>
                    <!-- END Article -->
                </div>
                <!-- END Column -->
                @if($loop->last)
                    @if(Route::is('userAlbum'))
                        <x-photos.add-photo :photo="$photo" :album="$album" :fromAlbums="true"></x-photos.add-photo>
                    @else
                        <x-photos.add-photo :photo="$photo" :fromAlbums="false"></x-photos.add-photo>
                    @endif
                @endif
            @endforeach
            @if($photos->isEmpty())
                @if(Route::is('userAlbum'))
                    <x-photos.add-photo :album="$album" :fromAlbums="true"></x-photos.add-photo>
                @else
                    <x-photos.add-photo :fromAlbums="false"></x-photos.add-photo>
                @endif
            @endif
        </div>

    </div>
</div>

<script>
    $(window).load(function () {
        $('.article-div').on('click', function () {
            let id = $(this).attr('id');
            let path = 'storage/' + $('.photo-path-' + id).val();
        });

        $(document).on('mouseenter', '.article-div', function () {
            // const form_id = $(this).attr('form');
            // $('.article-div').removeClass('scale-100');
            // $(this).addClass('');
            // $('.new-album-button').addClass('scale-75');
            // $("#maindiv").addClass('scale-85');
        });
        $(document).on('mouseleave', '.article-div', function () {
            // $('.article-div').not(this).removeClass('scale-75');
            // $('.article-div').not(this).addClass('scale-100');
            // $('.this').removeClass('scale-75');
            // $('.new-album-button').removeClass('scale-75');
            // $('.article-div').addClass('scale-100');
        });
    });
</script>




