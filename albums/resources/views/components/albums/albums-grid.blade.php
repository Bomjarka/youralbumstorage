<div class="py-12">
    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            @if(!$albums->isEmpty())
                @foreach($albums as $album)
                    <!-- Column -->
                    <div
                        class="article-div ol my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3 transition duration-500">
                        <!-- Article -->
                        <article class="overflow-hidden rounded-lg shadow-lg">
                            <a href="{{ route('userAlbum', [$album]) }}">
                                @if(!$album->photos->isEmpty())
                                    <img alt="Placeholder" class="block h-auto w-full"
                                         src="{{ url('storage/' . $album->photos->first()->photo_preview_path) }}">
                                @else
                                    <img alt="Placeholder" class="block h-auto w-full"
                                         src="{{asset('/images/empty_album.jpg')}}">
                                @endif
                            </a>
                            <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                                <h1 class="text-lg">
                                    <a class="no-underline hover:underline text-black"
                                       href="{{ route('userAlbum', [$album]) }}">
                                        {{ $album->name }}
                                    </a>
                                </h1>
                                <p class="text-grey-darker text-sm">
                                    {{ $album->created_at->format('d M Y') }}
                                </p>
                            </header>

                            <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                                <a class="flex items-center no-underline hover:underline text-black" href="#">
                                    <p class="ml-2 text-sm">
                                        {{ $album->description }}
                                    </p>
                                </a>
                                <div class="space-x-2 hidden sm:flex">
                                    <x-albums.edit-album :album="$album"></x-albums.edit-album>
                                    <x-albums.delete-album :album="$album"></x-albums.delete-album>
                                </div>
                            </footer>
                        </article>
                        <!-- END Article -->
                    </div>
                    <!-- END Column -->
                    @if($loop->last)
                        <x-albums.add-album></x-albums.add-album>
                    @endif
                @endforeach
            @else
                <x-albums.add-album></x-albums.add-album>
            @endif
        </div>
        <div class="container px-1 my-12 mx-auto px-4 md:px-12">
            {{ $albums->links() }}
        </div>
    </div>
</div>

<script>
    // $(window).load(function () {
    //     $(document).on('mouseenter', '.article-div', function () {
    //         $('.article-div').removeClass('scale-100');
    //         $('.article-div').not(this).addClass('scale-75');
    //         $(this).addClass('hover:scale-125');
    //         $('.new-album-button').addClass('scale-75');
    //     });
    //     $(document).on('mouseleave', '.article-div', function () {
    //         $('.article-div').removeClass('scale-75');
    //         $('.new-album-button').removeClass('scale-75');
    //         $('.article-div').addClass('scale-100');
    //     });
    // });
</script>

