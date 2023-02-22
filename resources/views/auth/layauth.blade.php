<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; {{ (!empty(setting('site_title')) ? setting('site_title') : 'SIASIK') }}</title>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

<!-- General CSS Files -->
<link rel="stylesheet" href="{{asset('theme/bootstrap/bootstrap.min.css')}}" >
<link rel="stylesheet" href="{{asset('theme/fontawesome/css/all.css')}}" >

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('theme/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/components.css')}}">
</head>

<body>
  <div id="app">
    
  @yield('content')

  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('theme/js/jquery-3.3.1.min.js')}}" ></script>
  <script src="{{asset('theme/js/popper.min.js')}}"></script>
  <script src="{{asset('theme/js/bootstrap.min.js')}}" ></script>
  <script src="{{asset('theme/js/jquery.nicescroll.min.js')}}"></script>
  <script src="{{asset('theme/js/moment.min.js')}}"></script>
  <script src="{{asset('theme/js/stisla.js')}}"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="{{asset('theme/js/scripts.js')}}"></script>
  <script src="{{asset('theme/js/custom.js')}}"></script>

  <!-- Page Specific JS File -->
</body>
</html>
