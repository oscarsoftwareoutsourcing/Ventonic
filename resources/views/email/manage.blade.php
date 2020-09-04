@extends('layouts.app-dashboard')

<!-- Styles -->
@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/app-email.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/editors/quill/katex.min.css') }}">
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/editors/quill/quill.snow.css') }}">-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/editors/quill/monokai-sublime.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <style>
        /*.users-list-wrapper li.media {
            min-width: 780px !important;
        }*/
        .email-app-list-wrapper {
            min-width: 780px !important;
        }
        .email-user-list {
            overflow-x: hidden !important;
            /*max-width: calc(100vh * 2.3) !important;*/
        }
        .email-user-list .media {
                /*max-width: 900px;*/
        }
        nav {
            z-index: 1;
        }

        .custom-file-input:lang(en) ~ .custom-file-label::after {
            content: "Examinar" !important;
          }

          .custom-file-label::after {
            content: "Examinar" !important;
          }
        .content-right .content-wrapper {
            min-width:941px !important;
        }
        /* Estilo para establecer el ancho del listado de mensajes */
        .email-application .app-content .content-area-wrapper .email-user-list .users-list-wrapper li.media .media-body {
            max-width: 980px;
        }
        .chip .chip-body a {
            color:#ffffff;
        }
    </style>
@endsection

@section('extra-style')
    content-left-sidebar email-application
@endsection

@section('content')
    @if (isset($hasEmailConfig) && !$hasEmailConfig)
        <email-setting></email-setting>
    @else
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-area-wrapper">
                <email :download_messages="true"></email>
            </div>
        </div>
    @endif
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}"></script>
    
@endsection
@section('extra-js')
    <!--<script src="{{ asset('web/js/bootstrap/bootstrap.min.js') }}"></script>-->
    <script src="{{ asset('js/scripts/pages/app-email.js') }}"></script>
    <!--<script src="{{ asset('vendors/js/pagination/jquery.bootpag.min.js') }}"></script>
    <script src="{{ asset('vendors/js/pagination/jquery.twbsPagination.min.js') }}"></script>
    <script src="{{ asset('js/scripts/pagination/pagination.js') }}"></script>-->
    <!--
    <script src="{{ asset('vendors/js/editors/quill/katex.min.js') }}"></script>
    <script src="{{ asset('vendors/js/editors/quill/highlight.min.js') }}"></script>
    <script src="{{ asset('vendors/js/editors/quill/quill.js') }}"></script> -->
@endsection
