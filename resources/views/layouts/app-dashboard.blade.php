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
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/charts/apexcharts.css') }}">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/dashboard-ecommerce.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/card-analytics.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/app-user.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- END: Custom CSS-->

    @yield('extra-css')

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <script>
        window.websocketHost = "{{ env('WEBSOCKETS_HOST', '127.0.0.1') }}";
        window.websocketPort = {{ env('WEBSOCKETS_PORT', 6001) }};
        window.currentUserChat = null;
        window.currentChatRoom = '{{ session('chat_room_id', '') }}';
    </script>
    <style>
        .loading-screen {
            z-index: 9999 !important;
        }
        .custom-file input[type="file"] {
            cursor: pointer;
        }
        body.dark-layout.email-application .app-content .content-area-wrapper .email-app-menu .sidebar-menu-list .list-group-messages .list-group-item {
            padding-left: 10px;
        }
        body.dark-layout.email-application .app-content .content-area-wrapper .email-app-menu .sidebar-menu-list .list-group-messages .list-group-item.active, body.dark-layout.email-application .app-content .content-area-wrapper .email-app-menu .sidebar-menu-list .list-group-messages .list-group-item.active i {
            color: #ffffff;
        }
        body.dark-layout.email-application .app-content .content-area-wrapper .email-app-menu .sidebar-menu-list .list-group-messages .list-group-item.active {
            background-color: #0087FF;
            border-radius: 5px;
        }
        body.dark-layout.email-application .app-content .content-area-wrapper .email-app-menu .sidebar-menu-list .list-group-messages .list-group-item.active:hover, body.dark-layout.email-application .app-content .content-area-wrapper .email-app-menu .sidebar-menu-list .list-group-messages .list-group-item.active:hover i {
            color: #C2C6DC;
        }
    </style>
</head>

</head>
<!-- END: Head-->

<!-- BEGIN: Body  vertical-menu-modern-->
<!-- data-menu="vertical-menu-modern" -->
<body class="vertical-layout vertical-menu-modern {{ ($type_device=='mobile') ? 'semi-dark-layout':'dark-layout' }}  @yield('extra-style')
navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-silderbar" data-layout="dark-layout" data-device="{{ $type_device }}">
    <div id="app">

        @include('layouts.element.nav')
        @include('layouts.element.menu')
        @yield('content')

    </div>

        @include('layouts.element.footer')

    <!-- Scripts -->
    @yield('extra-js-app')

   {{-- <script src="{{ asset('js/app.js') }}" defer></script>

     <script src="{{ asset('js/app.js') }}"></script> --}}
    <!-- BEGIN: Vendor JS-->
    @section('vendor-js')
    {{-- <script src="{{ asset('vendors/js/vendors.min.js') }}" defer></script> --}}
    <script src="{{ asset('vendors/js/vendors.min.js') }}"></script>

    @show


   {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
   {{--  <script src="{{ asset('js/app.js') }}"></script> --}}

   <!-- console_error #2 -->
   <script src="{{ asset('js/jquery/jquery-3.5.1.min.js') }}"></script>

    <!-- BEGIN: Vendor JS-->

    <script src="{{ asset('vendors/js/vendors.min.js') }}" defer></script>
    @yield('extra-js-chart')


    <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
    <!-- END Vendor JS-->

    <script src="{{ asset('js/pusher.min.js') }}"></script>

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('js/core/app-menu.js') }}" ></script>
    <script src="{{ asset('js/core/app.js') }}" ></script>
    <script src="{{ asset('js/scripts/components.js') }}" ></script>

    <!-- END: Theme JS-->

    {{--BEGIN:oportuniys scripts --}}
    <script src="{{ asset('js/oportunitys/oportunitys.js') }}"></script>
    {{--END:oportunitys scripts --}}

    <script src="{{ asset('js/geolocalizacion.js') }}"></script>

    {{--BEGIN:Modal --}}
    <script src="{{ asset('js/scripts/modal/components-modal.js') }}"></script>
    {{--END:Modal --}}

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('js/scripts/pages/app-user.js') }}" ></script>
    <!-- END: Page JS-->

    <!-- END: Page JS-->

    {{-- BEGIN:ckeditor --}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    {{-- END:ckeditor --}}

    {{--BEGIN:Select2 --}}
    <script src="{{ asset('js/scripts/forms/select/form-select2.min.js') }}"></script>
    {{--END:select2 --}}

    <!-- console_error #1 -->
    <!-- <script>
        $('.select2').select2();
    </script> -->

    @yield('extra-js')

    <script>
        /*$(document).ready(function() {
            $("[data-toggle=tooltip]").tooltip();
        });*/
    </script>

</body>
<!-- END: Body-->

</html>
