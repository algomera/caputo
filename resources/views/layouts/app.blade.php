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
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <main class="flex">
                <nav class="h-[calc(100vh-96px)] w-80 bg-white py-6 shadow-md">
                    <div class="pl-4">
                        <h2 class="uppercase font-semibold text-xs mb-5">profilo</h2>
                        <div class="pl-4 space-y-5">
                            <a href="" class="font-medium text-color-2c2c2c capitalize flex items-center gap-2">
                                <x-icons name="" />
                                profilo
                            </a>
                            <a href="" class="font-medium text-color-2c2c2c capitalize flex items-center gap-2">
                                <x-icons name="" />
                                filiali autoscuole
                            </a>
                            <a href="" class="font-medium text-color-2c2c2c capitalize flex items-center gap-2">
                                <x-icons name="" />
                                creazioni corsi
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- Page Content -->
                <div class="w-full p-10">
                    {{ $slot }}
                </div>
            </main>
        </div>
        @stack('scripts')
        @livewireScriptConfig
        {{-- @livewire('wire-elements-modal') --}}
    </body>
</html>
