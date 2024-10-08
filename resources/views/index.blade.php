<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="shortcut icon" href="{{asset('media/icon.png')}}" alt="icône">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/style1.css')}}" media="screen and ( min-width:750px )">
    <link rel="stylesheet" href="{{asset('css/style2.css')}}" media="screen and ( max-width:750px )">
</head>
<body>

    <div class="show_menu" id="show_menu">
        <div></div>
        <div></div>
        <div></div>
    </div>
        <a class="hide_menu" id="hide_menu" href="{{$_SERVER['REQUEST_URI']}}">
        X
        </a>
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