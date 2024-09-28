<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon site Laravel')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Inclure la barre de navigation -->
    @include('layouts.navbar')

    <div class="parallax-header">
    </div>

    <!-- Contenu principal -->
    <div class="container mx-auto mt-8">
        @yield('content')
    </div>
    @include('layouts.footer')
   @vite('resources/js/app.js')
</body>
</html>