<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Admin|' . $title }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="bg-gray-100 font-sans antialiased flex">
<!-- Page Heading -->
<aside class="bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <x-admin.admin-desktop-menu></x-admin.admin-desktop-menu>
</aside>

<div class="w-full flex flex-col h-screen overflow-y-auto">
    <!-- Desktop Header -->
    <x-admin.admin-desktop-nav></x-admin.admin-desktop-nav>
    <!-- Mobile Header & Nav -->
    <x-admin.admin-mobile-menu></x-admin.admin-mobile-menu>
    <main class="hidden md:block w-full flex-grow p-6">
        {{ $slot }}
    </main>
    <h1 class="block w-full bg-white text-center p-4 font-bold md:hidden">{{ trans('admin-common.ability-message') }}</h1>
    <footer class="w-full bg-white text-center p-4">
       <a target="_blank" href="https://vk.com/xamas27" class="underline">Developed by Alexander Chirkin 2022 ©</a>
    </footer>
</div>
</body>
</html>

<script>
    url = $(location).attr('href');
    $('.links a').removeClass('active-nav-link');
    $(".links a").each(function () {
        let linkURL = $(this).attr('href');
        if (url == linkURL) {
            $(this).addClass('active-nav-link');
        }
    });
</script>
