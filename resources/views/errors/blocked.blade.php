<x-blocked-layout>
    <div class="min-h-screen flex flex-col justify-center sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
            </a>
        </div>
        <div class="w-full bg-red-500 sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div role="alert">
                <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2 mt-3">
                    <i class="fa fa-lock mr-3"></i> {{ trans('alert-blade.title') }}
                </div>
                    <p class="text-white">{{ trans('userblocked-blade.message') }}
                        <a href="mailto::{{ config('mail.from.address', 'YourAlbumStorage') }}" class="hover:underline">{{ trans('userblocked-blade.action') }}</a></p>
                </div>
            </div>
            <div class="flex justify-center pt-3">
                <x-translate-block></x-translate-block>
            </div>
        </div>
    </div>
</x-blocked-layout>
