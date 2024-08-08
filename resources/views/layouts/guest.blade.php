<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'NewLuck') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('fontawesome-web/css/all.min.css')}}" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <script src="https://js.paystack.co/v1/inline.js"></script>
    </head>
    <body class="font-sans text-gray-900 antialiased dark:bg-gray-900  bg-gray-100 min-h-screen">
        <div class=" flex flex-col sm:justify-center items-center pt-6 sm:pt-0 mx-10 my-20">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg mx-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
