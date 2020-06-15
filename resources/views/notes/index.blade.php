@extends('layouts.app-dashboard')

<!-- Styles -->
@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/app-todo.css') }}">
@endsection

@section('extra-style')
    content-left-sidebar todo-application
@endsection

@section('extra-data')
@endsection

@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-area-wrapper">

            {{-- Left sidebar --}}
            <div class="sidebar-left">
                <todo-sidebar />
            </div>

            {{-- Right container --}}
            <div class="content-right">
                <todo-list :notes="{{ $notes }}" />
            </div>

            {{-- Todo Modal --}}
            <todo-form />
        </div>
    </div>

    <div class="sidenav-overlay" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
    <div class="drag-target" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('extra-js')
    <!-- <script src="{{ asset('js/scripts/pages/app-todo.js') }}" defer></script> -->
@endsection