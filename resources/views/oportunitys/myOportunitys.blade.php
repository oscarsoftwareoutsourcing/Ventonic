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
            <div class="row justify-content-center">

                    <div class="card">
                         <div class="card-ventonic">
                            
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-12 ">
                                <div class="text-ventonic" data-type="{{ Auth::user()->typeuser }}">Oportunidades</div> 
                                </div>
                                @if(Auth::user()->typeuser=="E")
                                    <div class="col-lg-3 col-md-4 col-sm-12 ">
                                        <a class="btn btn-primary" type="button" href="{{ route('oportunity.form') }}">+ Nueva</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <hr>
                        <div class="card-body">
                            <div class="row">
                            {{-- BEGIN Filltros --}}
                                <div class="{{Auth::user()->typeuser=="E" ? 'col-lg-4' : 'col-lg-3' }}">
                                    <div class="form-label-group">
                                        <select class="form-control" id="tipo-empleo" name="etiquetas">
                                            <option value="0">Busqueda por tipo de Empleo</option>
                                            @foreach($jobType as $type)
                                            <option value="{{$type->id}}">{{$type->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="{{Auth::user()->typeuser=="E" ? 'col-lg-4' : 'col-lg-3' }}">
                                    <div class="form-label-group">
                                        <select class="form-control" id="antiguedad" name="etiquetas">
                                            <option value="0">Busqueda por nivel de antiguedad</option>
                                            @foreach($antiguedad as $antiguo)
                                            <option value="{{$antiguo->id}}">{{$antiguo->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="{{Auth::user()->typeuser=="E" ? 'col-lg-4' : 'col-lg-3' }}">
                                    <div class="form-label-group">
                                        <select class="form-control" id="sectores" name="etiquetas">
                                            <option value="0">Busqueda por sector de la empresa</option>
                                            @foreach($sectors as $sector)
                                            <option value="{{$sector->id}}">{{$sector->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if(Auth::user()->typeuser=="V")
                                <div class="col-lg-3">
                                    <div class="form-label-group">
                                        <select class="form-control" id="estatus-postulados" name="etiquetas">
                                            <option  value="0">Estado</option>
                                            <option value="postulado">Postulado</option>
                                            <option value="no postulado">No postulado</option>
                                        </select>
                                    </div>
                                </div>
                                @endif

                                @if(Auth::user()->typeuser=="E")
                                <div class="col-lg-3">
                                    <div class="extra-ventonic">
                                        &nbsp;
                                    </div>
                                </div>
                                @endif
                                
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body">
                           
                            <!-- Data list view starts -->
                            <section id="data-list-view" class="data-list-view-header">
                                <!-- DataTable starts -->
                                <div class="table-responsive">
                                    <table id="datatable" class="table data-list-view mt-2">
                                        <thead>
                                            <tr>
                                                <th>ESTADO</th>
                                                <th>TITULO</th>
                                                <!--<th>EMPRESA</th>-->
                                                <th>CARGO</th>
                                                <th>UBICACION</th>
                                                <!--<th>TIPO EMPLEO</th>-->
                                                <th>SECTOR</th>
                                                <th>N° INSCRITOS</th>
                                                <th>CANDIDATOS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($oportunitys))
                                            @foreach($oportunitys as $oportunity)
                                            <tr href="{{route('oportunity', ['id'=>$oportunity->id])}}" id="fila{{$oportunity->id}}" class="filaEntera">
                                                <td></td>
                                                <td class="product-name">{{$oportunity->title}}
                                                    <input type="text" class="jobType" value="{{$oportunity->job_type_id}}" data-id="{{$oportunity->id}}" hidden>
                                                    <input type="text" class="antiguedad" value="{{$oportunity->ubication_oportunity_id}}" data-id="{{$oportunity->id}}" hidden>
                                                    <input type="text" class="sector" value="{{$oportunity->sectors}}" data-id="{{$oportunity->id}}" hidden>
                                                </td>
                                                <!--
                                                <td class="product-category">{{$oportunity->user->name}}</td>
                                                -->
                                                <td class="product-category">{{$oportunity->cargo}}</td>
                                                <td class="product-category">{{$oportunity->ubication}}</td>
                                                <!--
                                                <td class="product-price">{{App\JobType::getType((int)$oportunity->job_type_id)}}</td>
                                                -->
                                                <td class="product-price">{{App\Oportunity::listSectors($oportunity->sectors)}}</td>
                                                <td class="product-price" style="text-align:center;">
                                                @if(App\Aplicant::countAplicant($oportunity->id)>0)
                                                    <div class="chip chip-success">
                                                        <div class="chip-body text-center">
                                                            <div class="chip-text text-center">
                                                            <span class="text-center">{{App\Aplicant::countAplicant($oportunity->id)}}</td></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="chip chip-danger" style="text-align:center;" >
                                                        <div class="chip-body text-center">
                                                            <div class="chip-text text-center">
                                                            <span class="text-center">{{App\Aplicant::countAplicant($oportunity->id)}}</td></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                <td class="product-price">
                                                @if(App\Aplicant::countAplicant($oportunity->id)>0)
                                                    <a href="{{route('oportunity.mispostulados', ['oportunity_id'=>$oportunity->id])}}" class="btn btn-primary btn-md text-white" type="button">Ver</a>
                                                @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- DataTable ends -->
                            </section>
                            <!-- Data list view end -->
                        </div>
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
<script src="{{ asset('js/oportunitys/oportunitys.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="{{ asset('js/scripts/ui/data-list-view.js') }}"></script>
<script>$("#datatable").DataTable();</script>
@endsection

