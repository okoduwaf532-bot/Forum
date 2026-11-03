<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Forum Gang')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased" @if (request()->routeIs('users.*')) data-vanta-effect="halo" @elseif (request()->routeIs('dashboard', 'home', 'threads.*', 'thread.*', 'topic.*')) data-vanta-effect="birds" @endif>
        <div class="vanta-page min-h-screen">
            @if (request()->routeIs('users.*'))
                <div id="vanta-background" class="vanta-background" aria-hidden="true"></div>
            @elseif (request()->routeIs('dashboard', 'home', 'threads.*', 'thread.*', 'topic.*'))
                <div id="vanta-background" class="vanta-background" aria-hidden="true"></div>
            @endif
            @include('layouts.navigation')

            @if (session('success'))
                <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
                    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <main class="relative z-10">
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
    </body>
</html>
