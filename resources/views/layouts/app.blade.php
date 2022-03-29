<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
        <meta id="current_route_name" name="current_route_name" content="{{ \Route::currentRouteName() }}">
        <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
        <link rel="icon" href="{{ asset('images/logos/fav-icon.png') }}"  sizes="32x32">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
        <style>
            .iti__flag {background-image: url("{{ asset('images/intl-tel-input/flags.png')}}") ;}
            @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
                .iti__flag {background-image: url("{{ asset('images/intl-tel-input/flags@2x.png')}}") !important;}
            }
        </style>

    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        @guest
            <div class="container">
                @yield('content')
            </div>
        @endguest

        @auth
        <div class="wrapper">
            @include('includes.navbar')
            @include('includes.sidebar')
                @yield('content')
            </div>
        @endauth
        
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <script src="{{ asset('js/app.js') }}" ></script>
        @stack('js')
    </body>
</html>
