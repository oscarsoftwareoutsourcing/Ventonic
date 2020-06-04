@extends('layouts.app-dashboard')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/tables/datatable/datatables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/file-uploaders/dropzone.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/file-uploaders/dropzone.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/data-list-view.css') }}">
@endsection

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="container">
            <section class="page-users-view">
                <div class="row">
                    <!-- account start -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Datos Generales</div>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-success" style="display:none">
                                    <button type="button" class="close text-white" id="dismiss" data-dismiss="alert">&times;</button>
                                    <span>Estatus modificado exitosamente</span>
                                </div>
    
                                <!-- Data list view starts -->
                            <section id="data-list-view" class="data-list-view-header">
           
                                {{-- <div class="action-btns d-none">
                                    <div class="btn-dropdown mr-1 mb-1">
                                        <div class="btn-group dropdown actions-dropodown">
                                            <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#"><i class="feather icon-trash"></i>Delete</a>
                                                <a class="dropdown-item" href="#"><i class="feather icon-archive"></i>Archive</a>
                                                <a class="dropdown-item" href="#"><i class="feather icon-file"></i>Print</a>
                                                <a class="dropdown-item" href="#"><i class="feather icon-save"></i>Another Action</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- DataTable starts -->
                                <div class="table-responsive">
                                    <table class="table data-list-view table-responsive">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                @if(\Auth::user()->type=='V')
                                                <th style="text-align:center;" width="15%">EMPRESA</th>
                                                @endif

                                                @if(\Auth::user()->type=='E')
                                                <th style="text-align:center;"  width="15%">VENDEDOR</th>
                                                <th style="text-align:center;"  width="20%">PRODUCTO</th>
                                                @endif
                                                @if(\Auth::user()->type=='V')
                                                <th style="text-align:center;" width="15%">RESPONSABLE</th>
                                                @endif

                                                <th style="text-align:center;" width="15%">FECHA</th>
                                                <th style="text-align:center;" width="15%">STATUS</th>
                                                @if(\Auth::user()->type=='V')
                                                <th style="text-align:center;" width="5%">IMPORTE ESTIMADO</th>
                                                @endif

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($negociationsCompanys as $negociation)
                                            <tr>
                                                <td></td>
                                                @if(\Auth::user()->type=='V')
                                                <td style="text-align:center;">{{$negociation->user->name}}</td>
                                                @endif

                                                @if(\Auth::user()->type=='E')
                                                <td class="product-name" style="text-align:center;">{{$negociation->sellerProfile->user->name}}</td>
                                                <td class="product-category" style="text-align:center;">{{$negociation->producto}}</td>
                                                @endif

                                                @if(\Auth::user()->type=='V')
                                                <td class="product-category" style="text-align:center;">{{$negociation->responsable}}</td>
                                                @endif

                                                <td class="product-category" style="text-align:center;">{{App\NegociationCompany::dateNegociation((int)$negociation->id)}}</td>

                                                <td style="text-align:center;">
                                                    <div class="{{App\NegociationCompany::statusClass((int)$negociation->status_negociations_id, \Auth::user()->type)}}">
                                                        <div class="chip-body">
                                                            <div class="chip-text">{{App\NegociationCompany::textStatus((int)$negociation->status_negociations_id, \Auth::user()->type)}}</div>
                                                        </div>
                                                    </div>
                                                </td>

                                                @if(\Auth::user()->type=='V')
                                                <td class="product-category" style="text-align:center;">{{$negociation->importe}}</td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- DataTable ends -->

                                <!-- Formulario para agregar negociaciones -->
                                <div class="add-new-data-sidebar">
                                    <div class="overlay-bg"></div>
                                    <div class="add-new-data">
                                        <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                                            <div>
                                                <h4 class="text-uppercase">Registar nueva negociacion</h4>
                                            </div>
                                            <div class="hide-data-sidebar">
                                                <i class="feather icon-x"></i>
                                            </div>
                                        </div>
                                        <div class="data-items pb-3">
                                            <div class="data-fields px-2 mt-3">
                                                <div class="row">
                                                    <div class="col-sm-12 data-field-col">
                                                    {{-- <form  method="POST" action="{{route('negociationCompany.store')}}">
                                                        @csrf --}}
                                                        <div class="col-sm-12 data-field-col">
                                                        <label for="data-category"> Vendedor </label>
                                                            <select class="form-control" name ="seller_profile_id" id="seller_profile_id" required>
                                                                    <option></option>
                                                                @foreach($sellers as $seller)
                                                                    <option  value="{{(int)$seller->id}}">{{$seller->user->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback" id="validation-seller" style="display:none">
                                                                Por favor selecciones una opcion.
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 bdata-field-col mt-1">
                                                            <label for="">Producto</label>
                                                            <input type="text" class="form-control" name ="producto" id="producto" placeholder="describa el producto" required>
                                                            <div class="invalid-feedback" id="validation-producto" style="display:none">
                                                                Por favor selecciones una opcion.
                                                            </div> 
                                                        </div>

                                                        <div class="col-sm-12 bdata-field-col mt-1">
                                                            <label for="">Responsable</label>
                                                            <input type="text" class="form-control" name ="responsable" id="responsable" placeholder="describa al responsable" required>
                                                            <div class="invalid-feedback" id="validation-responsable" style="display:none">
                                                                Por favor indica un responsable.
                                                            </div> 
                                                        </div>

                                                        <div class="col-sm-12 bdata-field-col mt-1">
                                                            <label for="">Importe Estimado</label>
                                                            <input type="number" min=0 class="form-control" name ="importe" id="importe" placeholder="describa el producto" required>
                                                            <div class="invalid-feedback" id="validation-importe" style="display:none">
                                                                Por favor inserta el importe estimado.
                                                            </div> 
                                                        </div>

                                                        <div class="col-sm-12 data-field-col">
                                                            <label for="data-category"> Estatus </label>
                                                            <select class="form-control" name="status_negociations_id" id="status_negociations_id" required>
                                                                <option></option>
                                                                @foreach($status as $statu)
                                                                    <option value="{{(int)$statu->id}}">{{$statu->description}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback" id="validation-status" style="display:none">
                                                                Por favor selecciones una opcion.
                                                            </div> 
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-around px-3 mt-2">
                                            <div class="">
                                                <button type="submit" class="btn btn-primary" id="saveNegociation">Guardar</button>
                                            </div>
                                            <div class="">
                                                <button type="" class="btn btn-outline-danger">Cancelar</button>
                                            </div>
                                        </div>
                                    {{-- </form> --}}
                                    </div>
                                </div>
                                <!-- add new sidebar ends -->
                            </section>
                            <!-- Data list view end -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('extra-js')
{{-- <script src="{{ asset('vendors/js/extensions/dropzone.min.js') }}"></script> --}}
<script src="{{ asset('vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="{{ asset('js/scripts/ui/data-list-view.js') }}"></script>
@endsection