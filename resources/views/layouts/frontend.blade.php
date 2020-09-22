<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @hasSection('title')
        <title>@yield('title') | {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @livewireStyles
</head>
<body x-data="{cartMenuOpen: false}" @menu-open="cartMenuOpen = true">

    <x-menu />

    <div class="container mx-auto pt-4 sm:px-6 lg:px-8">
        @yield('content')
    </div>

    <div class="h-full w-128 fixed top-0 right-0 transform shadow-2xl bg-white"
         x-show="cartMenuOpen"
         @click.away="cartMenuOpen = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform"
         x-transition:enter-end="opacity-100 transform"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform"
         x-transition:leave-end="opacity-0 transform"
    >

        @livewire('cart')
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    @livewireScripts
</body>
</html>
