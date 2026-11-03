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
    <body class="font-sans text-gray-900 antialiased" @if (request()->routeIs('login', 'register')) data-vanta-effect="waves" @endif>
        <div class="vanta-page min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            @if (request()->routeIs('login', 'register'))
                <div id="vanta-background" class="vanta-background" aria-hidden="true"></div>
            @endif
            <div>
                <a href="/" class="relative z-10 flex items-center gap-2 text-xl font-bold text-slate-900">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600 text-lg font-black text-white">F</span>
                    <span>Forum <span class="text-blue-600">Gang</span></span>
                </a>
            </div>

            <div class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-7 bg-white/95 backdrop-blur-md shadow-xl overflow-hidden rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
