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
    <div class="content-wrapper pt-1">
        <div class="content-header row">
        </div>
        <div class="">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">

                          <div class="card-ventonic">

                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-12 ">
                                    <div class="text-ventonic">Oportunidades</div>
                                </div>
                                @if(Auth::user()->typeuser=="E")
                                    <div class="col-lg-3 col-md-4 col-sm-12 ">
                                        <a class="btn btn-primary" type="button" href="{{ route('oportunity.form') }}">+ Nueva</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="card-header">Filtros</div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="{{Auth::user()->typeuser=="E" ? 'col-lg-4' : 'col-lg-6' }}">
                                    <div class="input-group">
                                        <input type="text" id="textSearch" name="oportunitySearch" class="form-control" placeholder="Buscar oportunidades..." style="border:1px solid #0087ff;">
                                    </div>
                                </div>
                            </div>
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
                                        <select class="select2 form-control" id="sectores" name="etiquetas">
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

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary float-right">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- END Filltros --}}
                    <div class="row">
                    @if(isset($oportunitys))
                        @foreach($oportunitys as $oportunity)
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="card">
                                 <div class="card-body">
                                     <div class="row">
                                         <div class="col-lg-3 col-md-3 col-sm-3 center">
                                             <div class="mx-auto text-center mx-auto">
                                                <div class="avatar avatar-xl">
                                                    <img class="img-fluid" src="/{{$oportunity->user->photo}}" alt="{{$oportunity->user->name}}">
                                                </div>
                                             </div>
                                         </div>
                                         <div class="col-lg-9 col-md-9 col-sm-9" >
                                                <h5>{{$oportunity->title}}</h5>
                                                <input type="text" class="jobType" value="{{$oportunity->job_type_id}}" data-id="{{$oportunity->id}}" hidden>
                                                <input type="text" class="antiguedad" value="{{$oportunity->ubication_oportunity_id}}" data-id="{{$oportunity->id}}" hidden>
                                                <input type="text" class="sector" value="{{$oportunity->sectors}}" data-id="{{$oportunity->id}}" hidden>
                                                <p class="card-text  mb-0">{{$oportunity->user->name}}</p>
                                                <span class="card-text">{{$oportunity->cargo}}</span>
                                                <p class="card-text  mb-0">{{App\JobType::getType((int)$oportunity->job_type_id)}}</p>
                                                <p class="card-text  mb-0">{{App\Oportunity::listSectors($oportunity->sectors)}}</p>

                                         </div>
                                     </div>

                                    <hr class="my-1">
                                    <div class="card-btns d-flex justify-content-between mt-2">
                                            <a href="#" ></a>
                                            @if((\Auth::user()->typeuser)=="V")
                                                 @if(App\Aplicant::postulationTrue(\Auth::user()->id, $oportunity->id))
                                                    <a href="{{route('oportunity', ['id'=>$oportunity->id])}}" id="fila{{$oportunity->id}}"
                                                    class="btn btn-dark mr-1 mb-1 waves-effect waves-light">
                                                        Postulado<br>
                                                        <span class="small">{{App\Aplicant::datePostulation(\Auth::user()->id, $oportunity->id)}}</span>
                                                    </a>
                                                    <input type="text" class="postulado" value="postulado" data-id="{{$oportunity->id}}" hidden>
                                                @else
                                                    <a href="{{route('oportunity', ['id'=>$oportunity->id])}}" id="fila{{$oportunity->id}}"
                                                    class="btn btn-primary mr-1 mb-1 waves-effect waves-light">
                                                        Aplicar
                                                    </a>
                                                <input type="text" class="postulado" value="no postulado" data-id="{{$oportunity->id}}" hidden>
                                                @endif
                                            @else
                                                    <a href="{{route('oportunity', ['id'=>$oportunity->id])}}" id="fila{{$oportunity->id}}"
                                                    class="btn btn-outline-primary waves-effect waves-light">
                                                        Ver<br>
                                                    </a>
                                            @endif
                                        </div>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    @endif
                    </div>
                            <!--
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">


                            <section id="data-list-view" class="data-list-view-header">

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
                                                @if((\Auth::user()->typeuser)=="V")
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
                                                <td class="product-action" width="12%">
                                                    @if(App\Aplicant::postulationTrue(\Auth::user()->id, $oportunity->id))
                                                    <div class="chip chip-success" style="width:100%">
                                                        <div class="chip-body text-center">
                                                            <div class="chip-text">
                                                            Postulado<br>
                                                            <span class="small">{{App\Aplicant::datePostulation(\Auth::user()->id, $oportunity->id)}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <input type="text" class="postulado" value="postulado" data-id="{{$oportunity->id}}" hidden>
                                                    @else
                                                    <div class="chip chip-danger" style="width:100%">
                                                        <div class="chip-body">
                                                            <div class="chip-text text-center">No postulado</div>
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

                            </section>

                        </div>
                    </div>

                -->
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

