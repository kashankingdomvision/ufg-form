<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">

        {{-- fav icon --}}
        <link rel="icon" href="{{ asset('img/fav-icon.png') }}"  sizes="16x16">

        {{-- title start --}}
        <title>{{ config('app.name', 'Laravel') }} | @yield('title') </title>
        {{-- title end --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"></script>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link href="{{ asset('css/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
        <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet">
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/swi204cs.js') }}" defer></script>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    </head>
<body class="hold-transition sidebar-mini layout-fixed">
    @guest
        <div class="container">
            @yield('content')
        </div>
    @endguest

    @auth
        @include('includes.sidebar')
        <div class="wrapper">
            @include('includes.navbar')
            @yield('content')
        </div>
    @endauth

@auth
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 150,   //set editable area's height
                placeholder: 'Enter Text Here..',
                codemirror: { // codemirror options
                    theme: 'monokai'
                }
            });
        });

        
        function calltextEditorSummerNote(val = null) {
            $('.summernote:last').summernote('destroy');
            $('.note-editor:last').remove();
            $('.summernote').summernote({
                    height: 150,   //set editable area's height
                    placeholder: 'Enter Text Here..',
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    }
                }, 'code', val);
            }
    </script>
@endauth

<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>

    function callLaravelFileManger() {
        console.log('run function');
        var route_prefix = `${window.location.origin}/ufg-form/public/laravel-filemanager`;
        $('.fileManger').filemanager('image', {prefix: route_prefix});
    }

    callLaravelFileManger();
</script>

@stack('scripts')

<script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>

@stack('js')

</body>
</html>
