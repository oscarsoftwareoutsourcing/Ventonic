<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Ventonic" />
    <meta name="description" content="Ventonic" />
    <meta name="author" content="potenzaglobalsolutions.com" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
     <!-- Google Font -->
     <link href="https://fonts.googleapis.com/css?family=Heebo:400,500,700%7CMontserrat:300,400,500,600,700,800&amp;display=swap" rel="stylesheet">

    <!-- Styles 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('web/css/font-awesome/all.min.css') }}"" />
    <link rel="stylesheet" href="{{ asset('web/css/flaticon/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/css/bootstrap/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/css/registro.css') }}"/>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('web/images/favicon.ico') }}"/>

    
    @yield('extra-css')
</head>
<body>
    
  <section class="space-ptb position-relative overflow-x-hidden">
    <!-- SVG START -->
    <span class="position-absolute right-0 top-0 mt-n6 mr-n7 d-none d-md-block">
      <svg xmlns="http://www.w3.org/2000/svg" width="264" height="364" viewBox="0 0 264 364">
        <path class="fill-primary" d="M1690.39,1493.54c-8.29,43.35,18.19,74.73,25.25,113.55,7.07,38.67-5.35,84.7-34.63,102.37-29.36,17.74-75.59,7.12-101.15-24.88-25.5-31.91-30.36-85.07-43.36-111.02-12.94-26.01-34.04-24.66-47.15-32.84-13.08-8.31-18.18-26-18.34-45.37-0.18-19.22,4.44-39.99,13.42-67.61,8.92-27.7,22.08-62.27,43.94-71.14s52.27,7.93,96.38,9.36,101.9-12.53,109.38,8.13C1741.53,1394.8,1698.61,1450.12,1690.39,1493.54Z" transform="translate(-1471 -1354)"/>
      </svg>
    </span>
    <!-- SVG END -->
    <div class="container-fluid">
      <div class="row no-gutters justify-content-center">
        <div class="col-xl-5 col-lg-7 bg-gray py-4 py-lg-5 px-4 px-lg-5 px-xl-6">
          <!-- Logo START -->
          <a class="navbar-brand mb-5" href="{{ url('/') }}">
            <img class="img-fluid" src="{{ asset('web/images/logo-ventonic.png') }}" alt="">
          </a>

    


        
            @yield('content')

            
        </div>
      </div>
    </section>  
    
    {{-- <script src="{{ asset('web/js/jquery-3.4.1.min.js') }}"></script> --}}
    <script src="{{ asset('web/js/popper/popper.min.js') }}"></script>
    <script src="{{ asset('web/js/bootstrap/bootstrap.min.js') }}"></script>

    @yield('extra-js')
</body>
</html>
