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

        <div class="row">
                <div class="new-header mb-1">
                <span  class="title">Oportunidades</span>
                @if(Auth::user()->typeuser=="E")
                    <a href="{{ route('oportunity.form') }}"  
                    type="button" class="btn bg-gradient-primary btn-sm mr-1 mb-1 waves-effect waves-light">
                    Crear nueva oportunidad</a>
                @endif
                </div>
        </div>
        <div class="">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">

                         
                         <div class="bg-gradient-primary">
                            <div class="card_vetonic-description">
                                <div class="text_vetonic-description1">Filtros</div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session('message'))
                                <div class="alert alert-success alert-dismissible" role="alert" v-if="success">
                                  <p class="mb-0">{{ session('message') }}</p>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                            @endif
                            <form action="{{ route('oportunity.list') }}" method="GET">
                                @csrf
                                <div class="row mb-2">
                                    <div class="{{Auth::user()->typeuser=="E" ? 'col-lg-4' : 'col-lg-6' }}">
                                        <div class="input-group">
                                            <input type="text" id="textSearch" name="oportunitySearch"
                                                   class="form-control" placeholder="Buscar oportunidades..."
                                                   style="border:1px solid #0087ff;"
                                                   value="{{ request()->oportunitySearch }}">
                                        </div>
                                    </div>
                                    <div class="{{Auth::user()->typeuser=="E" ? 'col-lg-4' : 'col-lg-6' }}">
                                        <div class="input-group">
                                            <flat-pickr name="expire_at" id="expire_at" class="form-control"
                                                    :config="flatPicker.config" placeholder="Fecha de caducidad"
                                                    value="{{ request()->expire_at }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                {{-- BEGIN Filltros --}}
                                    <div class="{{Auth::user()->typeuser=="E" ? 'col-lg-4' : 'col-lg-3' }}">
                                        <div class="form-label-group">
                                            <select class="form-control" id="tipo-empleo" name="jobType">
                                                <option value="0" {{ request()->jobType=='0'?'selected':'' }}>
                                                    Busqueda por tipo de Empleo
                                                </option>
                                                @foreach($jobType as $type)
                                                    <option value="{{$type->id}}"
                                                            {{ request()->jobType==$type->id?'selected':'' }}>
                                                        {{$type->description}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="{{Auth::user()->typeuser=="E" ? 'col-lg-4' : 'col-lg-3' }}">
                                        <div class="form-label-group">
                                            <select class="form-control" id="ubication" name="ubication">
                                                <option value="0" {{ request()->ubication=='0'?'selected':'' }}>
                                                    Busqueda por ubicacióin de oportunidad
                                                </option>
                                                @foreach($ubications as $ubication)
                                                    <option value="{{$ubication->id}}"
                                                            {{ request()->ubication==$ubication->id?'selected':'' }}>
                                                        {{$ubication->description}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="{{Auth::user()->typeuser=="E" ? 'col-lg-4' : 'col-lg-3' }}">
                                        <div class="form-label-group">
                                            <select class="select2 form-control" id="sectores" name="sector">
                                                <option value="0" {{ request()->sector=='0'?'selected':'' }}>
                                                    Busqueda por sector de la empresa
                                                </option>
                                                @foreach($sectors as $sector)
                                                    <option value="{{$sector->id}}"
                                                            {{ request()->sector==$sector->id?'selected':'' }}>
                                                        {{$sector->description}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if (Auth::user()->typeuser=="V")
                                        <div class="col-lg-3">
                                            <div class="form-label-group">
                                                <select class="form-control" id="estatus-postulados" name="status">
                                                    <option  value="0" {{ request()->status=='0'?'selected':'' }}>
                                                        Estado
                                                    </option>
                                                    <option value="postulado"
                                                            {{ request()->status=='postulado'?'selected':'' }}>
                                                        Postulado
                                                    </option>
                                                    <option value="no postulado"
                                                            {{ request()->status=='no postulado'?'selected':'' }}>
                                                        No postulado
                                                    </option>
                                                </select>
                                            </div>

                                        </div>
                                    @endif

                                </div>
                                <div class="row">
                                     <div class="col-12 text-center">
                                        <button type="submit" class="btn bg-gradient-primary btn-lg mr-1 mb-1 waves-effect waves-light">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- END Filltros --}}
                    <div class="row">
                    @if(isset($oportunitys))
                        @foreach($oportunitys as $oportunity)
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="card">
                                 <div class="">
                                     <div class="row">
                                         <div class="col-lg-3 col-md-3 col-sm-3">
                                            
                                                 <div class="box-avatar">
                                                     <div class="div-box">
                                                    <div class="avatar avatar-xl">
                                                        <img class="img-fluid" src="/{{$oportunity->user->photo}}" alt="{{$oportunity->user->name}}">
                                                    </div>
                                                    </div>
                                                </div>
                                             
                                         </div>
                                         <div class="col-lg-9 col-md-9 col-sm-9 divide-white" >
                                             <div class="card-body">
                                                <h3>{{$oportunity->title}}</h3>
                                                <input type="text" class="jobType" value="{{$oportunity->job_type_id}}" data-id="{{$oportunity->id}}" hidden>
                                                <input type="text" class="antiguedad" value="{{$oportunity->ubication_oportunity_id}}" data-id="{{$oportunity->id}}" hidden>
                                                <input type="text" class="sector" value="{{$oportunity->sectors}}" data-id="{{$oportunity->id}}" hidden>
                                                <p class="card-text  mb-0"><span class="flag-icon flag-icon-es"></span> {{$oportunity->user->name}}</p>
                                                <span class="card-text">{{$oportunity->cargo}}</span>
                                                <!--
                                                <p class="card-text  mb-0">{{App\JobType::getType((int)$oportunity->job_type_id)}}</p>
                                                -->
                                                <p class="card-text  mb-0">{{App\Oportunity::listSectors($oportunity->sectors)}}</p>

                                             <div class="card-btns justify-content-between mt-2">
                                            <a href="#" ></a>
                                            @if((\Auth::user()->typeuser)=="V")
                                                 @if(App\Aplicant::postulationTrue(\Auth::user()->id, $oportunity->id))
                                                    <a href="{{route('oportunity', ['id'=>$oportunity->id])}}" id="fila{{$oportunity->id}}"
                                                    class="btn bg-gradient-dark btn-lg mr-1 mb-1 waves-effect waves-light">
                                                        Postulado<br>
                                                        <span class="small">{{App\Aplicant::datePostulation(\Auth::user()->id, $oportunity->id)}}</span>
                                                    </a>
                                                    <input type="text" class="postulado" value="postulado" data-id="{{$oportunity->id}}" hidden>
                                                @else
                                                    <a href="{{route('oportunity', ['id'=>$oportunity->id])}}" id="fila{{$oportunity->id}}"
                                                    class="btn bg-gradient-primary btn-lg mr-1 mb-1 waves-effect waves-light">
                                                        Aplicar
                                                    </a>
                                                <input type="text" class="postulado" value="no postulado" data-id="{{$oportunity->id}}" hidden>
                                                @endif
                                            @else
                                                    <a href="{{route('oportunity', ['id'=>$oportunity->id])}}" id="fila{{$oportunity->id}}"
                                                    class="btn bg-gradient-primary mr-1 mb-1 waves-effect waves-light">
                                                        Ver<br>
                                                    </a>
                                            @endif

                                            <span class="my-0">Oportunidades similares</span>
                                        </div>
                                        </div>
                                         </div>
                                     </div>

                                   
                                   
                                </div>
                            </div>

                        </div>
                        @endforeach
                    @endif
                    </div>
                    <div class="col-lg-4 offset-lg-4">
                        {{ $oportunitys->links() }}
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

