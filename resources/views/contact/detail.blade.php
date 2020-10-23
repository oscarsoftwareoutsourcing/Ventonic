@extends('layouts.app-dashboard')

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
        <div class="content-wrapper pt-1">
            <div class="content-header row">
            </div>
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row mb-2">
                            <div class="col-12">
                                <span style="font-size:2rem;" class="font-weight-bold mr-2">Mis Contactos</span>
                                @php
                                    $newContact = (auth()->user()->type === 'E') ? 'persona' : 'empresa';
                                @endphp
                                <a href="{{ route('contact.create', ['contact' => $newContact]) }}" type="button"
                                   class="btn btn-ventonic mr-1 mb-1 waves-effect waves-light">
                                    Agregar Contacto
                                </a>
                            </div>
                        </div>
                        <contact-detail :contact="{{ $contact }}" url-list="{!! route('contact.list') !!}"></contact-detail>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-left modal fade" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-primary white">
                            <h5 class="modal-title" id="myModalLabel160">Mis Contactos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeVideo">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="embed-responsive embed-responsive-item embed-responsive-16by9">
                                <!-- <div v-html="callme.iframe"></div> -->
                                <video id="videoContainer" width="100%" preload controls>
                                
                                    <source src="{{ asset('video/Contactos-Ventana-Secundaria.mp4') }}" />
                                    <source src="{{ asset('video/Contactos-Ventana-Secundaria.mp4') }}" />
                                    <source src="{{ asset('video/Contactos-Ventana-Secundaria.mp4') }}" />
                            
                                </video>
                            </div>
                    </div>
                </div>
            </div>
    
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYrS-17BDDkWPgbjRS-hgmk24dyAOiBQk&libraries=places&callback=initialize" async defer>
</script>
    <script>
        const boton = document.querySelector("#closeVideo");
        boton.addEventListener("click", function(evento){
            const video = document.getElementById("videoContainer");
            video.pause();
            return false;
        });
    </script>
<script src="{{ asset('js/geolocalizacion.js') }}"></script>
@endsection

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/file-uploaders/dropzone.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/file-uploaders/dropzone.css') }}">
    <style>
        .ps-width {
            width: 100% !important;
        }
        #appFooter {
            position: relative !important;
        }
        .dropzone {
            border: 2px dashed #0087FF !important;
            min-height: 300px !important;
        }
        .dropzone .dz-message span {
            display:block !important;
            color: #0087FF !important;
        }
    </style>
@endsection
