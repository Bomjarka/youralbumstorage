<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<div class="py-12">
    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            <!-- Column -->
            <div
                class="article-div ol my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3 transition duration-500">
                <!-- Article -->
                <article class="overflow-hidden rounded-lg shadow-lg">
                    <a href="#">
                        <img alt="Placeholder" class="block h-auto w-full"
                             src="{{asset('/images/empty_photo.png')}}">

                    </a>
                    <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                        <h1 class="text-lg">
                            <a class="no-underline hover:underline text-black"
                               href="#">
                                Example Photo name
                            </a>
                        </h1>
                        <p class="text-grey-darker text-sm">
                            {{ Carbon\Carbon::today()->subDays(rand(0, 365))->toDateString() }}
                        </p>
                    </header>

                    <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                        <a class="flex items-center no-underline hover:underline text-black" href="#">
                            <p class="ml-2 text-sm">
                                Example photo description
                            </p>
                        </a>
                        <div class="space-x-2 hidden sm:flex">
                            <button>
                                <i class="fa fa-pencil hover:text-green-600"></i>
                            </button>
                            <button>
                                <i class="fa fa-trash hover:text-red-600"></i>
                            </button>
                        </div>
                    </footer>
                </article>
                <!-- END Article -->
            </div>
            <!-- END Column -->
            <div class="flex items-center justify-center my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                <div x-data="{ modelOpen: false }">
                    <button @click="modelOpen =!modelOpen"
                            class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide hover:scale-150 transition duration-500 m-2 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 shadow-lg">
                        <i class="fa fa-plus w-5 h-5"></i>
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
                                    <h1 class="text-xl font-medium text-gray-800 ">Registration</h1>

                                    <button @click="modelOpen = false"
                                            class="text-gray-600 focus:outline-none hover:text-gray-700">
                                        <i class="fa fa-times w-6 h-6"></i>
                                    </button>
                                </div>
                                <p class="mt-2 text-sm text-gray-500 ">
                                    Complete registration to start using our service
                                </p>
                                <x-registration-form></x-registration-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

