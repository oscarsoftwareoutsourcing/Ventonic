

@extends('layouts.app-dashboard')

@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/app-chat.css') }}">
    <style>
        .chat-scroll {
            scrollbar-color: transparent transparent !important;
        }
        .chat-scroll::-webkit-scrollbar {
          width: 0;
        }
    </style>
@endsection

@section('extra-style')
    content-left-sidebar chat-application
@endsection

@section('extra-data')
    ccontent-left-sidebar
@endsection

@section('content')


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    {{-- Sección para chat --}}
    <chat :user="{{ auth()->user() }}" :chat-room-user="{{ json_encode(session('chat_room_user', '')) }}"></chat>

</div>
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('extra-js')
<script src="{{ asset('js/scripts/pages/app-chat.js') }}"></script>
@endsection
