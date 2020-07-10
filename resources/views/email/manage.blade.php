@extends('layouts.app-dashboard')

<!-- Styles -->
@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/app-email.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/editors/quill/katex.min.css') }}">
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/editors/quill/quill.snow.css') }}">-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/editors/quill/monokai-sublime.min.css') }}">
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
    <script src="{{ asset('web/js/bootstrap/bootstrap.min.js') }}"></script>
    <!--<script src="{{ asset('vendors/js/editors/quill/katex.min.js') }}"></script>
    <script src="{{ asset('vendors/js/editors/quill/highlight.min.js') }}"></script>
    <script src="{{ asset('vendors/js/editors/quill/quill.js') }}"></script>
    <script src="{{ asset('js/scripts/pages/app-email.js') }}"></script>-->
@endsection
