<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="keywords" content="Ventonic" />
        <meta name="description" content="Ventonic" />
        <meta name="author" content="potenzaglobalsolutions.com" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'VENTONIC') }} | Error</title>
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Heebo:400,500,700%7CMontserrat:300,400,500,600,700,800&amp;display=swap"
              rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('web/css/font-awesome/all.min.css') }}"" />
        <link rel="stylesheet" href="{{ asset('web/css/flaticon/flaticon.css') }}" />
        <link rel="stylesheet" href="{{ asset('web/css/bootstrap/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('web/css/style.css') }}" />
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('web/images/favicon.ico') }}"/>

        @yield('extra-css')
    </head>
    <body>
        @yield('content')
        <!-- JS Global Compulsory (Do not remove) -->
        <script src="{{ asset('web/js/jquery-3.4.1.min.js') }}" defer></script>
        <script src="{{ asset('web/js/popper/popper.min.js') }}" defer></script>
        <script src="{{ asset('web/js/bootstrap/bootstrap.min.js') }}" defer></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
