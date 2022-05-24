<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('/images/logo.png') }}">
    <title>{{ config('app.name', 'Laravel') . '|' . $title }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<div class="pb-2 bg-gray-100">
    @include('layouts.navigation')

    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
    <!-- Page Content -->
    <main>
        @if (session('status') == 'verification-link-sent')
            <div class="container my-12 mx-auto px-4 md:px-12">
                <x-notifications.approving
                    :value="trans('verify-email-message.success-message')">
                </x-notifications.approving>
            </div>
        @endif
        @if(Auth::user())
            @if (!Auth::user()->isVerified())
                <div class="container my-12 mx-auto px-4 md:px-12">
                    <x-notifications.warning
                        :value="trans('warning-blade.subject')">{{ trans('warning-blade.message') }}</x-notifications.warning>
                </div>
            @else
                {{ $slot }}
            @endif
        @else
            {{ $slot }}
        @endif
    </main>
</div>
</body>
<footer class="flex flex-col justify-center w-full bg-white text-center p-4">
    <x-feedback-block></x-feedback-block>
    <x-translate-block></x-translate-block>
    <div class="pt-3">
        <a target="_blank" href="https://vk.com/xamas27" class="underline">Developed by Alexander Chirkin 2022 ©</a>.
    </div>
</footer>

</html>
