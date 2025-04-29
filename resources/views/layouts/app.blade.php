<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Smart Growth') }}</title>
        <link rel="stylesheet" href="{{asset('assets/css/formateur/sidebar.css')}}">
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/listCour.css') }}"> --}}
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        {{-- Icons --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
       <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
       
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=notifications" />
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=chat" /> --}}
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex">
            
            <!-- Main Content -->
            <div id="main-content" class="flex-1">
                @include('layouts.sidebare')
                {{-- @include('layouts.navigation') --}}
                <!-- Page Heading -->
                @isset($header)
                <header class="">
                    {{-- <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"> --}}
                        {{ $header }}
                        {{-- @yield('header') --}}
                    {{-- </div> --}}
                </header>
                @endisset
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                    {{-- @yield('content') --}}
                </main>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1/resumable.js"></script>

</html>
