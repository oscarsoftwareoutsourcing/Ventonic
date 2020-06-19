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
                                        <select class="select2 form-control" id="sectores" name="etiquetas">
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
                    {{-- END Filltros --}}
                    {{-- 
                    <div class="card card-oportunity">
                        <div class="card-header">
                        
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group-append">
                                    @if(Auth::user()->type=="E")
                                        <a href="{{ route('oportunity.form') }}" class="btn btn-primary btn_right_new" type="button">
                                            Nueva
                                        </a>
                                    </div>
                                    <hr>
                                    <br>
                                    @endif
                                    <div class="input-group">
                                        <input type="text" id="textSearch" name="oportunitySearch" class="form-control" placeholder="Buscar oportunidad..." style="border:1px solid #0087ff; border-radius:4px;">
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <table id="oportunityTable" class="table table-hover mb-0 table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Titulo</th>
                                            <th>Empresa</th>
                                            <th>Cargo</th>
                                            <th>Ubicacion</th>
                                            <th>Tipo de Empleo</th>
                                            <th>Sector</th>
                                            @if(App\Aplicant::postulationsTrue(\Auth::user()->id)==true)
                                            <th>Estado</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($oportunitys))
                                            @foreach($oportunitys as $oportunity)
                                            <tr href="{{route('oportunity', ['id'=>$oportunity->id])}}">
                                                <td>{{$oportunity->title}}</td>
                                                <td>{{$oportunity->user->name}}</td>
                                                <td>{{$oportunity->cargo}}</td>
                                                <td>{{$oportunity->ubication}}</td>
                                                <td>{{App\JobType::getType((int)$oportunity->job_type_id)}}</td>
                                                <td>{{App\Oportunity::listSectors($oportunity->sectors)}}</td>
                                                @if(App\Aplicant::postulationsTrue(\Auth::user()->id)==true)
                                                <td style="text-align:center;">
                                                    @if(App\Aplicant::postulationTrue(\Auth::user()->id, $oportunity->id))
                                                    <div class="chip chip-success">
                                                        <div class="chip-body">
                                                            <div class="chip-text">Postulado
                                                            <span class="small">{{App\Aplicant::datePostulation(\Auth::user()->id, $oportunity->id)}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="chip chip-warning">
                                                        <div class="chip-body">
                                                            <div class="chip-text">No postulado</div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </td>
                                                
                                                @endif
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
                            </div>
                        </div>
                    </div> --}}
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
                                                <th></th>
                                                <th>TITULO</th>
                                                <th>EMPRESA</th>
                                                <th>CARGO</th>
                                                <th>UBICACION</th>
                                                <th>TIPO EMPLEO</th>
                                                <th>SECTOR</th>
                                                @if((\Auth::user()->type)=="V")
                                                <th>ESTADO</th>
                                                @endif
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
                                                <td class="product-category">{{$oportunity->user->name}}</td>
                                                <td class="product-category">{{$oportunity->cargo}}</td>
                                                <td class="product-category">{{$oportunity->ubication}}</td>
                                                <td class="product-price">{{App\JobType::getType((int)$oportunity->job_type_id)}}</td>
                                                <td class="product-price">{{App\Oportunity::listSectors($oportunity->sectors)}}</td>
                                                @if((\Auth::user()->type)=="V")
                                                <td class="product-action">
                                                    @if(App\Aplicant::postulationTrue(\Auth::user()->id, $oportunity->id))
                                                    <div class="chip chip-success">
                                                        <div class="chip-body text-center">
                                                            <div class="chip-text small">Postulado
                                                            <span class="small">{{App\Aplicant::datePostulation(\Auth::user()->id, $oportunity->id)}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <input type="text" class="postulado" value="postulado" data-id="{{$oportunity->id}}" hidden>
                                                    @else
                                                    <div class="chip chip-danger">
                                                        <div class="chip-body">
                                                            <div class="chip-text small text-center">No postulado</div>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="postulado" value="no postulado" data-id="{{$oportunity->id}}" hidden>
                                                    @endif
                                                </td>
                                                @endif
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

{{-- @section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection --}}