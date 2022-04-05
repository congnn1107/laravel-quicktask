<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    @section('scripts')
        @include('layouts.scripts')
    @show

    <!--Styles-->
    @section('styles')
        @include('layouts.styles')
    @show
</head>

<body>
    <div id="app">
        @section('navbar')
            @include('layouts.navbar')
        @show

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
