

@extends('layouts.app-dashboard')

@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/app-chat.css') }}">
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
   
        <chat :user="{{ auth()->user() }}"></chat>
        
</div>
@endsection

@section('extra-js')
<script src="{{ asset('js/scripts/pages/app-chat.js') }}"></script>
@endsection