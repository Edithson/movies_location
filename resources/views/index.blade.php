<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/style1.css')}}">
</head>
<body>
    @component('components.notification')@endcomponent
    @include('layouts.navigation')
    @yield('content')
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>