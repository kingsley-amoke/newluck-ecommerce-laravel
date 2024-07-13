<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'NewLuck') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('fontawesome-web/css/all.min.css')}}" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link href="{{asset('css/app.css')}}" rel="stylesheet">

        <script src="{{asset('js/app.js')}}" ></script>

    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <header class="w-full border border-b-slate-300 border-x-0 border-t-0">
            @include('layout.shared.navigation')
        </header>
        <div>

            @yield('content')
        </div>
        <footer class="w-full">
            <x-footer/>
        </footer>
    </body>
    </html>