<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-login bg-cover bg-center bg-no-repeat relative">
            <div class="absolute top-0 left-0 h-full w-full bg-black/40 z-10"></div>
            <div class="z-20 w-full sm:max-w-md mt-6 px-16 py-14 bg-white/70 shadow-md overflow-hidden sm:rounded-sm">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
