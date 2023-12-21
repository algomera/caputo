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
        @stack('styles')
        @livewireStyles
    </head>
    <body class="font-sans antialiased">

        <div class="hidden fixed h-full w-full md:flex lg:hidden justify-center items-center bg-black/20">
            <div class="bg-slate-400 flex flex-col items-center justify-center px-10 py-6 rounded-md">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h2 class="text-white text-2xl font-medium uppercase!">Passare alla visualizzazione orizzontale</h2>
            </div>
        </div>

        <div class="min-h-screen bg-color-efefef md:hidden lg:block">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                @role('admin')
                    <div class="pt-24">
                        <livewire:admin.navbar />
                    </div>

                    <div class="grow min-h-[calc(100vh-96px)] pl-72 2xl:pl-80">
                        {{ $slot }}
                    </div>
                @else
                    <div class="min-h-[calc(100vh-96px)] w-screen pt-24">
                        {{$slot}}
                    </div>
                @endrole
            </main>
        </div>
        @stack('scripts')
        @livewireScriptConfig
        @livewire('wire-elements-modal')
    </body>
</html>
