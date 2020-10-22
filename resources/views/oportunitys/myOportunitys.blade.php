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

        <div class="content-help">
            <div class="link-help">
            <button type="button" class=" btn btn-primary btn-sm waves-effect waves-light"
            data-toggle="modal"
            data-target="#primary"
            id="postularseBtn"
            ><i class="text-white feather icon-video"></i> Ver ayuda </button>
            </div>
        </div>

        <div class="pt-1 content-wrapper">
            <div class="content-header row"></div>

            <div class="row">
                <div class="mb-1 new-header">
                <span  class="title">Mis Oportunidades</span>
                <a href="{{ route('oportunity.form') }}"  
                type="button" class="mb-1 mr-1 btn bg-gradient-primary waves-effect waves-light">
                Crear nueva oportunidad</a>
                </div>
            </div>

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
                            <form action="{{ route('oportunity.saved') }}" method="GET">
                                @csrf
                                {{-- BEGIN Filltros --}}
                                <div class="mb-2 row">
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
                                                    Busqueda por ubicación de oportunidad
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
                                    <div class="text-center col-12">
                                        <button type="submit" class="mb-1 mr-1 btn bg-gradient-primary btn-lg waves-effect waves-light">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    
                        @include('oportunitys.component.card')
                    
                    {{ $oportunitys->links() }}
            </div>
        </div>

        <div class="text-left modal fade" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary white">
                        <h5 class="modal-title" id="myModalLabel160">Chat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeVideo">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="embed-responsive embed-responsive-item embed-responsive-16by9">
                            <!-- <div v-html="callme.iframe"></div> -->
                            <video id="videoContainer" width="100%" preload controls>
                            @if(\Auth::user()->type=="V")
                                <source src="{{ asset('video/Oportunidades-Perfil-Vendedor.mp4') }}" />
                                <source src="{{ asset('video/Oportunidades-Perfil-Vendedor.mp4') }}" />
                                <source src="{{ asset('video/Oportunidades-Perfil-Vendedor.mp4') }}" />
                            @else
                                <source src="{{ asset('video/Oportunidades-MisOportunidades-Perfil-Empresa.mp4') }}" />
                                <source src="{{ asset('video/Oportunidades-MisOportunidades-Perfil-Empresa.mp4') }}" />
                                <source src="{{ asset('video/Oportunidades-MisOportunidades-Perfil-Empresa.mp4') }}" />
                            @endif
                            </video>

                            
                        </div>
                     
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        const boton = document.querySelector("#closeVideo");
        boton.addEventListener("click", function(evento){
            const video = document.getElementById("videoContainer");
            video.pause();
            return false;
        });
    </script>
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

