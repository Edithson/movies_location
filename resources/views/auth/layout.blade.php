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
@include('layouts.navigation')
    <section class="content">
        @component('components.notification')@endcomponent
        @yield('content')
    </section>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery-3.6.0.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>