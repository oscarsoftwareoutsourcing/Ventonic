@extends('layouts.app-dashboard')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
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
    </div>
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCN7QXrQX8mlDNTdtcSY5dzZzrVJ1516hw&libraries=places&callback=initialize" async defer>
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
