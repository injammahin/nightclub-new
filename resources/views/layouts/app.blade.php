<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description"
        content="@yield('meta_description', 'Al\'s Night Club is a Caribbean and international nightlife destination in Margate.')">

    <title>@yield('title', 'Al\'s Night Club')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/fav.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/fav.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/fav.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body>
    <div class="noise"></div>
    <div class="cursor-light"></div>

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    @stack('scripts')
</body>

</html>