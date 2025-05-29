<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Smart Growth') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <!-- Auth Card -->
            <div class="w-full sm:max-w-md px-6 py-8 bg-white auth-card rounded-xl">
                {{ $slot }}
            </div>

            <!-- Footer Links -->
            <div class="mt-8 text-center text-sm text-gray-600">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="hover:text-gray-900 underline">Connexion</a>
                @endif

                @if (Route::has('register'))
                    <span class="mx-2">•</span>
                    <a href="{{ route('register') }}" class="hover:text-gray-900 underline">Inscription</a>
                @endif
            </div>
        </div>
    </body>
</html>