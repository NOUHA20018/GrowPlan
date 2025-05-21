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
        
        {{-- <style>
            .logo-container {
                transition: transform 0.3s ease;
            }
            .logo-container:hover {
                transform: scale(1.05);
            }
            .auth-card {
                transition: all 0.3s ease;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            }
            .auth-card:hover {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
        </style> --}}
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            {{-- <!-- Logo Container with enhanced styling -->
            <div class="logo-container mb-8">
                <a href="{{ url('/') }}">
                    <img 
                        src="{{ asset('assets/img/logo.png') }}" 
                        alt="{{ config('app.name', 'Smart Growth') }} Logo"
                        class="h-16 w-auto sm:h-20 object-contain"
                        onerror="this.onerror=null;this.src='{{ asset('assets/img/logo-default.png') }}'"
                    >
                </a>
            </div> --}}

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