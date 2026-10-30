<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if (session('success'))
                <x-alert type="success">{{ session('success') }}</x-alert>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
