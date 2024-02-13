<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env('APP_NAME')}}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="h-[100vh] w-full lg:flex flex-col gap-5 justify-center items-center bg-slate-100">
            <h1 class="text-6xl font-bold tracking-wider uppercase">l'autoscuola</h1>
            <a href="{{ route('login') }}" class="bg-black border border-black px-10 py-3 text-white text-sm font-bold tracking-[0.75px] rounded-md uppercase hover:bg-white hover:text-slate-500">Accedi</a>
        </div>
    </body>
</html>
