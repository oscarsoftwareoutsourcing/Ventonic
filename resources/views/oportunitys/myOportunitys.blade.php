@extends('layouts.app-dashboard')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/tables/datatable/datatables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/file-uploaders/dropzone.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/file-uploaders/dropzone.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/data-list-view.css') }}">
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
                    {{-- <div class="card card-oportunity">
                        <div class="card-header"></div>
                     <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group-append">
                                <a href="{{ route('oportunity.form') }}" class="btn btn-primary" type="button">
                                    Nueva
                                </a>
                            </div>
                            <hr>
                            <br>
                            <div class="input-group">
                                <input type="text" id="textSearch" name="oportunitySearch" class="form-control" placeholder="Buscar oportunidad..." style="border:1px solid #0087ff;">
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <table id="oportunityTable" class="table table-hover mb-0 table-responsive">
                            <thead>
                                <tr>
                                    <th width="20%">Titulo</th>
                                    <th width="15%">Cargo</th>
                                    <th width="15%">Ubicacion</th>
                                    <th width="10%">Tipo de Empleo</th>
                                    <th width="25%">Sector</th>
                                    <th width="5%">N° Inscritos</th>
                                    <th width="10%">Candidatos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($oportunitys))
                                    @foreach($oportunitys as $oportunity)
                                    <tr href="{{route('oportunity.form', ['oportunity'=>$oportunity])}}" class="{{App\Oportunity::getstatus((int)$oportunity->id)}}">
                                        <td style="{{App\Oportunity::getStyle((int)$oportunity->id)}}" width="20%">{{$oportunity->title}}</td>
                                        <td style="{{App\Oportunity::getStyle((int)$oportunity->id)}}" width="15%">{{$oportunity->cargo}}</td>
                                        <td style="{{App\Oportunity::getStyle((int)$oportunity->id)}}" width="15%">{{$oportunity->ubication}}</td>
                                        <td style="{{App\Oportunity::getStyle((int)$oportunity->id)}}" width="10%">{{App\JobType::getType((int)$oportunity->job_type_id)}}</td>
                                        <td style="{{App\Oportunity::getStyle((int)$oportunity->id)}}" width="25%">{{App\Oportunity::listSectors($oportunity->sectors)}}</td>
                                        <td style="{{App\Oportunity::getStyle((int)$oportunity->id)}}" width="5%">{{App\Aplicant::countAplicant($oportunity->id)}}</td>
                                        <td style="{{App\Oportunity::getStyle((int)$oportunity->id)}} text-align:center;" width="10%">
                                        @if(App\Aplicant::countAplicant($oportunity->id)>0)
                                        <a href="{{route('oportunity.mispostulados', ['oportunity_id'=>$oportunity->id])}}" class="btn btn-outline-primary btn-md text-white" type="button">Ver</a>
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12 float-right mt-2">
                            <span class="float-right">{{ $oportunitys->links() }}</span>
                        </div>
                    </div> --}}

                    <div class="card">
                        <div class="card-header">Filtros</div>
                        <div class="card-body">
                            <div class="row">
                            {{-- BEGIN Filltros --}}
                                <div class="{{Auth::user()->type=="E" ? 'col-lg-4' : 'col-lg-3' }}">
                                    <div class="form-label-group">
                                        <select class="form-control" id="tipo-empleo" name="etiquetas">
                                            <option value="0">Busqueda por tipo de Empleo</option>
                                            @foreach($jobType as $type)
                                            <option value="{{$type->id}}">{{$type->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="{{Auth::user()->type=="E" ? 'col-lg-4' : 'col-lg-3' }}">
                                    <div class="form-label-group">
                                        <select class="form-control" id="antiguedad" name="etiquetas">
                                            <option value="0">Busqueda por nivel de antiguedad</option>
                                            @foreach($antiguedad as $antiguo)
                                            <option value="{{$antiguo->id}}">{{$antiguo->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="{{Auth::user()->type=="E" ? 'col-lg-4' : 'col-lg-3' }}">
                                    <div class="form-label-group">
                                        <select class="form-control" id="sectores" name="etiquetas">
                                            <option value="0">Busqueda por sector de la empresa</option>
                                            @foreach($sectors as $sector)
                                            <option value="{{$sector->id}}">{{$sector->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if(Auth::user()->type=="V")
                                <div class="col-lg-3">
                                    <div class="form-label-group">
                                        <select class="form-control" id="estatus-postulados" name="etiquetas">
                                            <option  value="0">Estado</option>
                                            <option value="postulado">Postulado</option>
                                            <option value="no postulado">No postulado</option>
                                        </select>
                                    </div>
                                @endif
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body">
                            @if(Auth::user()->type=="E")
                                <div class="input-group-append">
                                    <a href="{{ route('oportunity.form') }}" class="btn btn-primary" type="button">
                                        <i class="feather icon-plus text-white"></i> Nueva
                                    </a>
                                </div>
                                <hr>
                                <br>
                            @endif
                            <!-- Data list view starts -->
                            <section id="data-list-view" class="data-list-view-header">
                                <!-- DataTable starts -->
                                <div class="table-responsive">
                                    <table id="datatable" class="table data-list-view mt-2">
                                        <thead>
                                            <tr>
                                                <th>TITULO</th>
                                                <th>EMPRESA</th>
                                                <th>CARGO</th>
                                                <th>UBICACION</th>
                                                <th>TIPO EMPLEO</th>
                                                <th>SECTOR</th>
                                                <th>N° INSCRITOS</th>
                                                <th>CANDIDATOS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($oportunitys))
                                            @foreach($oportunitys as $oportunity)
                                            <tr href="{{route('oportunity', ['id'=>$oportunity->id])}}" id="fila{{$oportunity->id}}" class="filaEntera">
                                                <td class="product-name">{{$oportunity->title}}
                                                    <input type="text" class="jobType" value="{{$oportunity->job_type_id}}" data-id="{{$oportunity->id}}" hidden>
                                                    <input type="text" class="antiguedad" value="{{$oportunity->ubication_oportunity_id}}" data-id="{{$oportunity->id}}" hidden>
                                                    <input type="text" class="sector" value="{{$oportunity->sectors}}" data-id="{{$oportunity->id}}" hidden>
                                                </td>
                                                <td class="product-category">{{$oportunity->user->name}}</td>
                                                <td class="product-category">{{$oportunity->cargo}}</td>
                                                <td class="product-category">{{$oportunity->ubication}}</td>
                                                <td class="product-price">{{App\JobType::getType((int)$oportunity->job_type_id)}}</td>
                                                <td class="product-price">{{App\Oportunity::listSectors($oportunity->sectors)}}</td>
                                                <td class="product-price">
                                                @if(App\Aplicant::countAplicant($oportunity->id)>0)
                                                    <div class="chip chip-success">
                                                        <div class="chip-body text-center">
                                                            <div class="chip-text text-center">
                                                            <span class="text-center">{{App\Aplicant::countAplicant($oportunity->id)}}</td></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="chip chip-danger">
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

@section('extra-js-app')
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
@endsection