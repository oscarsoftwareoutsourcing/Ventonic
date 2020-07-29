@extends('layouts.app-dashboard')

@section('extra-css')

<link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/forms/wizard.css') }}">
@endsection

@section('extra-style')
   
@endsection

@section('extra-data')
   
@endsection

@section('content')


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    {{-- Apps Gratis --}}

    <!-- <chat :user="{{ auth()->user() }}" :chat-room-user="{{ json_encode(session('chat_room_user', '')) }}"></chat> -->
    <free-apps :widgets="{{json_encode($widgets)}}"></free-apps>

</div>
@endsection

@section('extra-js')
<script src="{{ asset('js/scripts/components.js') }}"></script>
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
    
@endsection

