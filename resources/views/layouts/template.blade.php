<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/app.css')}}" />
    @include('shared.icons')
    <title>@yield('title', 'The Vinyl Shop')</title>

</head>
<body>
@include('shared.navigation')
<main class="container my-3">
    @yield('main', 'Page under construction ...')
</main>
@include('shared.footer')
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
