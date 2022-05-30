<div class="pt-5 lg:py-0 lg:grid place-content-center">
    <div class="text-center mb-14">
        <h1 class="text-gray-900 text-4xl font-semibold">{{ trans('feedback-section.title') }}</h1>
        <p class="text-lg text-gray-700 mt-4 px-2">{{ trans('feedback-section.title-question') }}</p>
    </div>
    <div class="lg:flex items-center justify-center lg:gap-10">
        <div
            class="bg-white rounded-lg pt-16 pb-10 px-10 border-t-8 border-green-400 my-5 lg:my-0 shadow-lg max-w-xs mx-auto lg:mx-0 flex-grow">
            <div>
                <h2 class="font-semibold text-2xl text-gray-900">{{ trans('feedback-section.help-support-title') }}</h2>
                <p class="text-gray-400 mt-2.5 text-lg">{{ trans('feedback-section.help-support') }}</p>

                <div x-data="{ modelOpen: false }">
                    <button @click="modelOpen =!modelOpen" class="text-black bg-gradient-to-tr from-green-200 via-green-300 to-blue-500 pt-1 pb-1.5 w-full shadow-sm rounded-full inline tracking-wider capitalize mt-24 transition duration-500
                 hover:bg-gradient-to-br from-green-200 via-green-300 to-blue-500 hover:scale-125">
                        {{ trans('feedback-section.contact-us-button') }}
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
                                @if (Auth::user())
                                    <div class="">
                                        <p class="text-xl flex items-center">
                                            <i class="fa fa-comment mr-3"></i> {{ trans('feedback-form.title') }}
                                        </p>
                                        <div class="leading-loose">
                                            <form method="post" action="{{ route('feedback') }}" class="">
                                                @csrf
                                                @method('post')
                                                <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                                <div class="mt-2">
                                                    <label class="block"
                                                           for="message">{{ trans('feedback-form.message-label') }}:</label>
                                                    <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded"
                                                              id="message" name="message" rows="6" required=""
                                                              placeholder="{{ trans('feedback-form.message-placeholder') }}..."
                                                              aria-label="Email"></textarea>
                                                </div>
                                                <div class="mt-6">
                                                    <button
                                                        class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded
                                                    hover:bg-gray-600"
                                                        type="submit">
                                                        {{ trans('feedback-form.submit-button') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <div class="">
                                        <p class="text-xl pb-6 flex items-center">
                                            <i class="fa fa-comment mr-3"></i> {{ trans('feedback-form.title') }}
                                        </p>
                                        <div class="leading-loose">
                                            <form method="post" action="{{ route('feedback') }}" class="p-10">
                                                @csrf
                                                @method('post')
                                                <div class="">
                                                    <label class="block text-sm text-gray-600"
                                                           for="name">{{ trans('feedback-form.name-label') }}</label>
                                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
                                                           id="name" name="name" type="text" required=""
                                                           placeholder="{{ trans('feedback-form.name-label') }}"
                                                           aria-label="Name">
                                                </div>
                                                <div class="mt-2">
                                                    <label class="block text-sm text-gray-600"
                                                           for="email">{{ trans('feedback-form.email-label') }}</label>
                                                    <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded"
                                                           id="email" name="email" type="email" required=""
                                                           placeholder="{{ trans('feedback-form.email-label') }}"
                                                           aria-label="Email">
                                                </div>
                                                <div class="mt-2">
                                                    <label class=" block text-sm text-gray-600"
                                                           for="message">{{ trans('feedback-form.message-label') }}</label>
                                                    <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded"
                                                              id="message" name="message" rows="6" required=""
                                                              placeholder="{{ trans('feedback-form.message-placeholder') }}..."
                                                              aria-label="message"></textarea>
                                                </div>
                                                <div class="mt-6">
                                                    <button
                                                        class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded
                                                    hover:bg-gray-600"
                                                        type="submit">
                                                        {{ trans('feedback-form.submit-button') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
