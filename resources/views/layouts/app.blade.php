<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
        <link rel="icon" href="{{ asset('images/logos/fav-icon.png') }}"  sizes="32x32">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
    
        <script src="{{ asset('js/app.js') }}" ></script>
        @stack('js')
    </body>
</html>
