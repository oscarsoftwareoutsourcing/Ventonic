@extends('layouts.app-dashboard')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/tables/datatable/datatables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/file-uploaders/dropzone.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/forms/select/select2.min.css') }}">

{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/file-uploaders/dropzone.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/data-list-view.css') }}"> --}}
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="">
            <div class="row">
                <div class="new-header mb-1">
                <span  class="title">Contactos</span>
                <a href="{{ route('contact.create', ['contact'=>'persona']) }}" type="button" class="btn bg-gradient-primary mr-1 mb-1 waves-effect waves-light"><i class="feather icon-plus text-white"></i> Persona</a>
                <a href="{{ route('contact.create', ['contact'=>'empresa']) }}" type="button" class="btn bg-gradient-primary mr-1 mb-1 waves-effect waves-light"><i class="feather icon-plus text-white"></i> Empresa</a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <div class="card card-oportunity mb-1">

                        <div class="card-body">
                            @if(session('message'))
                                <div class="alert alert-success">
                                    <button type="button" class="close text-white" id="dismiss" data-dismiss="alert">&times;</button>
                                    {{session('message')}}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    <button type="button" class="close text-white" id="dismiss" data-dismiss="alert">&times;</button>
                                    {{session('error')}}
                                </div>
                            @endif

                            <div class="row mb-2">
                                <div class="col-sm-1 offset-sm-11">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modalSetting"
                                       title="Configuración de contactos externos">
                                        <i class="feather icon-settings"></i>
                                    </a>
                                    <div class="modal fade" id="modalSetting">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Configuración</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            <!-- Opción para seleccionar contactos de google -->
                                                            <div class="custom-control custom-radio custom-control-inline"
                                                                 data-toggle="tooltip" title="Contactos de Google">
                                                                <input type="radio" id="googleContact" name="externalContact"
                                                                       class="custom-control-input" value="gContact" checked/>
                                                                <label class="custom-control-label" for="googleContact">
                                                                    <img src="/images/contact/google-contacts.png"
                                                                         alt="Google Contacts" class="img-sel img-fluid"/>
                                                                    @if ($gContact)
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="alert alert-success" role="alert">
                                                                                    Configurado
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        Cerrar
                                                    </button>
                                                    @if ($gContact)
                                                        <button type="button" class="btn btn-warning"
                                                                onclick="disconnectSetting()">
                                                            Eliminar
                                                        </button>
                                                    @endif
                                                    <button type="button" class="btn btn-primary" onclick="setSetting()">
                                                        Guardar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('contact.list') }}" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-5">
                                        <fieldset class="form-label-group form-group position-relative has-icon-left">
                                            <input type="text" id="textSearch" name="oportunitySearch" class="form-control" placeholder="Buscar contacto..." value="{{ request()->oportunitySearch }}">
                                            <div class="form-control-position">
                                                <i class="feather icon-search"></i>
                                            </div>

                                        </fieldset>


                                    </div>
                                    <div class="col-5">
                                        <div class="form-label-group">
                                            <select class="form-control" id="type-contact" name="etiquetas">
                                                <option value="0" {{ request()->etiquetas=='0'?'selected':'' }}>
                                                    Busqueda por tipo de cliente
                                                </option>
                                                @foreach ($contactTypes as $contactType)
                                                    <option value="{{ $contactType->id }}"
                                                            {{ request()->etiquetas==$contactType->id?'selected':'' }}>
                                                        {{ $contactType->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="email-id-column">Tipo</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary float-right">Buscar</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                    @include('contact.list')


                </div>
                {{--BEGIN:Modal--}}
                <div class="modal fade text-left" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary white">
                                <h5 class="modal-title" id="myModalLabel160">Eliminar Contacto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-white">
                                Está a punto de eliminar un contacto ¿Esta seguro de continuar?
                                <input id="user_id_modal" hidden>
                                <input id="contact_id_modal" hidden>

                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-secondary float-right text-primary" data-dismiss="modal">Cancelar</a>
                                <a id="buttonDelete" class="btn btn-primary" data-dismiss="modal">
                                    Confirmar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            {{--END: Modal--}}
    </div>
</div>
 </div>
 </div>

@endsection

@section('extra-js-app')
<script src="{{ asset('js/app.js') }}"></script>
@endsection

@section('extra-js')
<script src="{{ asset('vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="{{ asset('js/scripts/ui/data-list-view.js') }}"></script>
<script src="{{ asset('/js/scripts/modal/components-modal.js') }}"></script>
<script>$("#datatable").DataTable();</script>
<script>
    var setSetting = function() {
        let type = $('#googleContact').val();
        location.href = `/contacto/set-external-contacts/${type}`;
    }
</script>
@endsection
