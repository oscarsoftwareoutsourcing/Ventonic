

@extends('layouts.app-dashboard')

@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/app-chat.css') }}">
    <style>
        .user-list-scroll {
            height:100%;
            overflow-y:scroll;
        }
        .chat-scroll, .user-list-scroll {
            scrollbar-color: transparent transparent !important;
        }
        .chat-scroll::-webkit-scrollbar, .user-list-scroll::-webkit-scrollbar {
          width: 0;
        }
    </style>
@endsection

@section('extra-style')
    content-left-sidebar chat-application
@endsection

@section('extra-data')
    content-left-sidebar
@endsection

@section('content')


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>


    <div class="content-help">
        <div class="link-help">
        <button type="button" class=" btn btn-primary btn-sm waves-effect waves-light"
        data-toggle="modal"
        data-target="#primary"
        id="postularseBtn"
        ><i class="text-white feather icon-video"></i> Ver ayuda </button>
        </div>
    </div>    

    {{-- Sección para chat --}}
    <chat :user="{{ auth()->user() }}" :chat-room-user="{{ json_encode(session('chat_room_user', '')) }}"
          :contacts="{{ auth()->user()->contact()->whereNotNull('email')->get('email') }}"></chat>

          <div class="text-left modal fade" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary white">
                        <h5 class="modal-title" id="myModalLabel160">Chat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeVideo">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="embed-responsive embed-responsive-item embed-responsive-16by9">
                            <!-- <div v-html="callme.iframe"></div> -->
                            <video id="videoContainer" width="100%" preload controls>
                            @if(\Auth::user()->type=="V")
                                <source src="{{ asset('video/Chat-Perfil-Vendedor.mp4') }}" />
                                <source src="{{ asset('video/Chat-Perfil-Vendedor.mp4') }}" />
                                <source src="{{ asset('video/Chat-Perfil-Vendedor.mp4') }}" />
                            @else
                                <source src="{{ asset('video/Chat-Perfil-Empresa.mp4') }}" />
                                <source src="{{ asset('video/Chat-Perfil-Empresa.mp4') }}" />
                                <source src="{{ asset('video/Chat-Perfil-Empresa.mp4') }}" />
                            @endif
                            </video>
                        </div>
                </div>
            </div>
        </div>
</div>
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        const boton = document.querySelector("#closeVideo");
        boton.addEventListener("click", function(evento){
            const video = document.getElementById("videoContainer");
            video.pause();
            return false;
        });
    </script>
@endsection

@section('extra-js')
< src="{{ asset('js/scripts/pages/app-chat.js') }}"></>
@endsection
