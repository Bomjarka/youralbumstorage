<div class="py-12">
    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
        @foreach($albums as $album)
            <!-- Column -->
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                    <!-- Article -->
                    <article class="overflow-hidden rounded-lg shadow-lg">

                        <a href="{{ route('userAlbum', [$album]) }}">
                            <img alt="Placeholder" class="block h-auto w-full" src="https://picsum.photos/600/400/?random">
                        </a>

                        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                            <h1 class="text-lg">
                                <a class="no-underline hover:underline text-black" href="{{ route('userAlbum', [$album]) }}">
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
                            <x-albums.delete-album :action="route('deleteAlbum', $album)" :album="$album"></x-albums.delete-album>
                        </footer>

                    </article>
                    <!-- END Article -->
                </div>
                <!-- END Column -->
            @endforeach
        </div>
    </div>
</div>

