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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
            integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

</head>
<body class="bg-gray-100 font-sans antialiased flex">
<!-- Page Heading -->
<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl" >
    <div class="p-6">
        <a href="{{ route('admin') }}" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
            Admin Tools
        </a>
        <button
            class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
            <i class="fas fa-plus mr-3"></i> New Report
        </button>
    </div>
    <div class="links">
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route('adminDashboard') }}"
               class="flex items-center text-white py-4 pl-6 nav-item active-nav-link">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('adminBlank') }}"
               class="flex items-center text-white hover:opacity-100 py-4 pl-6 nav-item active-nav-link">
                <i class="fas fa-sticky-note mr-3"></i>
                Blank Page
            </a>
            <a href="{{ route('adminTable') }}"
               class="flex items-center text-white hover:opacity-100 py-4 pl-6 nav-item active-nav-link">
                <i class="fas fa-table mr-3"></i>
                Tables
            </a>
            <a href="{{ route('adminForms') }}"
               class="flex items-center text-white hover:opacity-100 py-4 pl-6 nav-item active-nav-link">
                <i class="fas fa-align-left mr-3"></i>
                Forms
            </a>
            <a href="{{ route('adminCalendar') }}"
               class="flex items-center text-white hover:opacity-100 py-4 pl-6 nav-item active-nav-link">
                <i class="fas fa-calendar mr-3"></i>
                Calendar
            </a>
        </nav>
    </div>
</aside>

<div class="relative w-full flex flex-col h-screen overflow-y-hidden">
    <!-- Desktop Header -->
    <x-admin.admin-desktop-menu></x-admin.admin-desktop-menu>
    <!-- Mobile Header & Nav -->
    <x-admin.admin-mobile-menu></x-admin.admin-mobile-menu>
    <main>
        {{ $slot }}
    </main>
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
