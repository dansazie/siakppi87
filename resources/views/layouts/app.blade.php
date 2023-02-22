<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ (!empty(setting('site_title')) ? setting('site_title') : 'SIASIK') }}</title>

    <link href=" {{ mix('css/app.css') }}" rel="stylesheet">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('theme/fontawesome6/css/all.css')}}" >

    <link rel="icon" href="{{ (!empty(setting('logo')) ? asset('storage/'.setting('logo')) : '') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
    <!-- Template CSS -->

    <link rel="stylesheet" href="{{asset('theme/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/components.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/siasik.css')}}">



    @livewireStyles

    @stack('styles')

</head>
<body class="{{ ((setting('mode_sidebar')==1) ? 'sidebar-mini' : '') }}">
@include('sweetalert::alert')
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('layouts.partials.navbar')

            @include('layouts.partials.sidebar')

            <!-- Main Content -->
            <div class="main-content">

            {{ $slot }}


            </div>
        @include('layouts.partials.footer')
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <!-- General JS Scripts -->

    <script src="{{asset('theme/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('theme/js/moment.min.js')}}"></script>
    <script src="{{asset('theme/js/stisla.js')}}"></script>

    <!-- JS Libraies -->
    <script src="{{asset('theme/js/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>




    <!-- Page Specific JS File -->
    <script src="{{asset('theme/js/page/components-table.js')}}"></script>


    <!-- Template JS File -->
    <script src="{{asset('theme/js/scripts.js')}}"></script>
    <script src="{{asset('theme/js/custom.js')}}"></script>


    @livewireScripts


    @stack('scripts')



</body>
</html>
