<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            @media screen and (min-width: 1200px){
                #main{
                    margin: auto;
                    max-width: 1200px;
                }
            }
        </style>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- LIVEWIRE -->
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <script src="//unpkg.com/alpinejs" defer></script>

    </head>
    <body class="font-sans antialiased">

        <div id="main">
            <x-headers.guest_header />

            <div class="min-h-screen bg-gray-100">
                <!-- {{--
                @include('layouts.navigation')
                --}} -->
                <!-- Page Heading -->
                <!-- {{--
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            --}} -->
                <!-- Page Content -->

                    {{ $slot }}

            </div>

        </div><!-- end of id=main -->

        {{-- LIVEWIRE --}}
        @livewireScripts

    </body>
</html>
