<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon site Laravel')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex flex-col min-h-screen min-w-min">

    <!-- Inclure la barre de navigation -->
    @include('layouts.navbar')

    <div class="parallax-header bg-cover bg-center h-64 sm:h-80 md:h-96">
    </div>

    <!-- Contenu principal -->
    <div class="container mx-auto mt-8">
        @yield('content')
    </div>
    @include('layouts.footer')
   @vite('resources/js/app.js')
</body>
</html>