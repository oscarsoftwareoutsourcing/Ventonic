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
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    {{-- BEGIN botones nuevo --}}
                    <div class="card">
                        <div class="card-header">
                            <h1 class="text-ventonic">Contactos</h1>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <a href="{{ route('contact.create', ['contact'=>'persona']) }}" type="button" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><i class="feather icon-plus text-white"></i> Persona</a>
                                <a href="{{ route('contact.create', ['contact'=>'empresa']) }}" type="button" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><i class="feather icon-plus text-white"></i> Empresa</a>
                            </div>
                        </div>
                    </div>
                    {{-- END botones nuevo --}}
                    <div class="card card-oportunity">
                        <div class="card-header">Mis contactos</div>
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
                    {{-- <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success" style="display:none">
                                <button type="button" class="close text-white" id="dismiss" data-dismiss="alert">&times;</button>
                                <span>Contacto eliminado exitosamente</span>
                            </div>
                            <div class="input-group">
                            </div>
                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="col-6">

                            <div class="input-group">
                                <div class="input-group-append">
                                    {{-- <a href="{{ route('contact.create') }}" class="btn btn-primary btn_right_new" type="button">
                                        Nueva
                                    </a> --}}
                                </div>
                                <input type="text" id="textSearch" name="oportunitySearch" class="form-control" placeholder="Buscar contacto..." style="border:1px solid #0087ff;">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-label-group">
                                <select class="form-control" id="type-contact" name="etiquetas">
                                    <option>Busqueda por tipo de cliente</option>
                                    <option value="Cliente">Cliente</option>
                                    <option value="Cliente Potencial">Cliente Potencial</option>
                                    <option value="Colaborador">Colaborador</option>
                                    <option value="Proveedor">Proveedor</option>
                                </select>
                                <label for="email-id-column">Tipo</label>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        {{-- <table id="oportunityTable" class="table  data-list-view table-hover mb-0 table-responsive"> --}}
                        <table id="datatable" class="table  oportunityTable data-list-view table-hover mb-0 table-responsive">
                            <thead>
                                <tr>
                                    <th style="text-align:center;" width="20%">Nombre</th>
                                    <th style="text-align:center;" width="20%">Apellido</th>
                                    <th style="text-align:center;" width="10%">Telefono</th>
                                    <th style="text-align:center;" width="20%">Email</th>
                                    <th style="text-align:center;" width="20%">Empresa</th>
                                    <th style="text-align:center;" width="5%">Favoritos</th>
                                    <th style="text-align:center;" width="5%">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)

                                <tr  class="fila" id="fila{{$contact['id']}}">
                                    <td style="text-align:left;" width="20%">
                                        <span><i class="{{App\Contact::getIcon($contact['type_contact'])}} text-primary"></i></span>
                                        @if($contact['private']==1)
                                        <span style="margin-left:5px;margin-right:5px;"><i class="feather icon-eye"></i></span>
                                        @endif
                                        <span style="margin-left:10px;color:color: #C2C6DC!important;">{{$contact['name']}}</span>
                                    </td>
                                    <td style="text-align:center;" width="20%">{{$contact['last_name']}}</td>
                                    <td style="text-align:center;" width="10%">{{$contact['phone']}}</td>
                                    <td style="text-align:center;" width="15%">{{$contact['email']}}</td>
                                    <td style="text-align:center;" width="15%">{{$contact['company']}}
                                    <input type="text" class="tipoContacto" value="{{$contact['type']}}" data-id="{{$contact['id']}}" hidden>
                                    </td>
                                    <td style="text-align:center;" width="5%">
                                        @if($contact['favorite'])
                                            <i class="ficon feather icon-star warning"></i>
                                        @endif
                                    </td>
                                    <td width="15%" style="text-align:center;">
                                        <a href="{{route('contact.detail', ['contact'=>$contact['id']])}}" class="float-left ml-1">
                                            <i class="feather icon-eye text-white"></i>
                                        </a>
                                        <a href="{{route('contact.editForm',['contact_id'=>$contact['id']])}}" class="float-left  mx-1">
                                            <i class="feather icon-edit text-white"></i>
                                        </a>
                                        <a id="iconDelete" data-toggle="modal"  data-target="#deleteModal" class="float-left" onclick="asignarValores({{$contact['id']}})">
                                            <i class="feather icon-trash-2 text-white"></i>
                                        </a>
                                        <input value="{{$contact['user_id']}}" id="user_id{{$contact['id']}}" data-id="{{$contact['id']}}" hidden>
                                        <input value="{{$contact['id']}}" id="contact_id{{$contact['id']}}" data-id="{{$contact['id']}}" hidden>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12 float-right mt-2">
                            {{-- <span class="float-right">{{ $contacts->links() }}</span> --}}
                        </div>
                    </div>
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
@endsection
