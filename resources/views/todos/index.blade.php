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
    <todos-module :todos="{{ $todos }}" :labels="{{ $labels }}" :user="{{ $user_id }}" />

    <div class="sidenav-overlay" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
    <div class="drag-target" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
@endsection

@section('extra-js-app')
    
    <script>
        window.api_url="{{ env('MIX_API_URL') }}";
    </script>

    <script src="{{ asset('js/app.js') }}" defer></script>

@endsection

@section('extra-js')
    {{-- <script src="{{ asset('js/scripts/pages/app-todo.js') }}"></script> --}}
@endsection