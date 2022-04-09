<div class="py-12">
    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
        @foreach($photos as $photo)
            <!-- Column -->
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                    <!-- Article -->
                    <article class="overflow-hidden rounded-lg shadow-lg">

                        <a href="#">
                            <img alt="Placeholder" class="block h-auto w-full" src="https://picsum.photos/600/400/?random">
                        </a>

                        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                            <h1 class="text-lg">
                                <a class="no-underline hover:underline text-black" href="#">
                                    {{ $photo->name }}
                                </a>
                            </h1>
                            <p class="text-grey-darker text-sm">
                                {{ $photo->created_at->format('d M Y') }}
                            </p>
                        </header>

                        <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                            <a class="flex items-center no-underline hover:underline text-black" href="#">
                                <p class="ml-2 text-sm">
                                    {{ $photo->description }}
                                </p>
                            </a>
                            <x-photos.delete-photo :action="route('deletePhoto', $photo)" :photo="$photo"></x-photos.delete-photo>
                        </footer>
                    </article>
                    <!-- END Article -->
                </div>
                <!-- END Column -->
            @endforeach
        </div>
    </div>
</div>




