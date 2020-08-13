@extends('layouts.app-dashboard')

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/file-uploaders/dropzone.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/file-uploaders/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/data-list-view.css') }}">
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper pt-1">
            <div class="content-header row"></div>

            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-ventonic">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-12 ">
                                    <div class="text-ventonic" data-type="{{ Auth::user()->typeuser }}">
                                        Oportunidades
                                    </div>
                                </div>
                                @if (Auth::user()->typeuser=="E")
                                    <div class="col-lg-3 col-md-4 col-sm-12 ">
                                        <a class="btn btn-primary" type="button" href="{{ route('oportunity.form') }}">
                                            + Nueva
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr>
                        <div class="card-header">Filtros</div>
                        <div class="card-body">
                            <form action="{{ route('oportunity.saved') }}" method="GET">
                                @csrf
                                {{-- BEGIN Filltros --}}
                                <div class="row mb-2">
                                    <div class="{{Auth::user()->typeuser=="E" ? 'col-lg-4' : 'col-lg-6' }}">
                                        <div class="input-group">
                                            <input type="text" id="textSearch" name="oportunitySearch"
                                                   class="form-control" placeholder="Buscar oportunidades..."
                                                   style="border:1px solid #0087ff;"
                                                   value="{{ request()->oportunitySearch }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                            <select class="form-control" id="antiguedad" name="antiguedad">
                                                <option value="0" {{ request()->antiguedad=='0'?'selected':'' }}>
                                                    Busqueda por nivel de antiguedad
                                                </option>
                                                @foreach($antiguedad as $antiguo)
                                                    <option value="{{$antiguo->id}}"
                                                            {{ request()->antiguedad==$antiguo->id?'selected':'' }}>
                                                        {{$antiguo->description}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="{{Auth::user()->typeuser=="E" ? 'col-lg-4' : 'col-lg-3' }}">
                                        <div class="form-label-group">
                                            <select class="form-control" id="sectores" name="sector">
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
                                                    <option value="0" {{ request()->status=='0'?'selected':'' }}>
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

                                    @if (Auth::user()->typeuser=="E")
                                        <div class="col-lg-3">
                                            <div class="extra-ventonic">
                                                &nbsp;
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary float-right">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        @include('oportunitys.component.list')
                    </div>
                    {{ $oportunitys->links() }}
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

