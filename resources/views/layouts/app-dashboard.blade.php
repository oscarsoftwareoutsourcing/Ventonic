<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Ventonic" />
    <meta name="description" content="Ventonic" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    {{-- BEGIN: Select2 --}}    
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
    <!-- END: Page Select2-->
    


    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/semi-dark-layout.css') }}">
    

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/app-user.css') }}">
    <!-- END: Page CSS-->

    @yield('extra-css')

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- END: Custom CSS-->


      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<!-- END: Head-->

<!-- BEGIN: Body  vertical-menu-modern-->

<body class="vertical-layout vertical-menu-modern dark-layout 2-columns @yield('extra-style') navbar-floating footer-static" data-open="click" data-menu="@yield('extra-data')" data-col="2-columns" data-layout="dark-layout">
    <div id="app">

        @include('layouts.element.nav')
        @include('layouts.element.menu') 
        @yield('content')

    </div>

        @include('layouts.element.footer') 

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
    <!-- END Vendor JS-->


    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('js/core/app-menu.js') }}"></script>
    <script src="{{ asset('js/core/app.js') }}"></script>
    <script src="{{ asset('js/scripts/components.js') }}"></script>
    <!-- END: Theme JS-->



    <!-- BEGIN: Page JS-->
    <script src="{{ asset('js/scripts/pages/app-user.js') }}"></script>
    <!-- END: Page JS-->

    {{--BEGIN:oportuniys scripts --}}
    <script src="{{ asset('js/oportunitys/oportunitys.js') }}"></script>
    {{--END:oportunitys scripts --}}

    {{-- BEGIN:ckeditor --}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    {{-- END:ckeditor --}}

    {{--BEGIN:Select2 --}}
    <script src="{{ asset('js/scripts/forms/select/form-select2.min.js') }}"></script>
    {{--END:select2 --}}
    
    <script>
        $('.select2').select2();
    </script>
    @yield('extra-js')

</body>
<!-- END: Body-->

</html>