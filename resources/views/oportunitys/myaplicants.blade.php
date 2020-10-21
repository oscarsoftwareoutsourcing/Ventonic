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
        <div class="">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Filtros</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-4 col-12">
                                    <b>Datos Personales</b>
                                    <div class="row">
                                        <div class="col-12">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-info">
                                                    <input type="checkbox" value="false" id="customCheck1">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Móvil</span>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-info">
                                                    <input type="checkbox" value="false" id="customCheck2">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Foto</span>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-info">
                                                    <input type="checkbox" value="false" id="customCheck3">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Vídeo</span>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-info">
                                                    <input type="checkbox" value="false" id="customCheck4">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">LinkedIn</span>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-4 col-12">
                                    <b>Años de experiencia en venta</b>
                                    @foreach($anios as $i=>$anio)
                                    <fieldset>
                                        <div class="vs-checkbox-con vs-checkbox-info">
                                        <input type="checkbox" value="{{$anio}}" class="aniosFilter" id="aniosFilter{{$i}}" data-id="{{$i}}">
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                            <span class="">{{$anio}}</span>
                                        </div>
                                    </fieldset>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-4 col-12">
                                    <b>Experiencia demostrable</b>
                                    @foreach($experiencia as $i=>$anio)
                                    <fieldset>
                                        <div class="vs-checkbox-con vs-checkbox-info">
                                            <input type="checkbox" value="{{$anio}}" class="experienciaFilter" id="experienciaFilter{{$i}}" data-id="{{$i}}">
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                            <span class="">{{$anio}}</span>
                                        </div>
                                    </fieldset>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-4 col-12">
                                    <b>Disponibilidad</b>
                                    @foreach($disponibilidad as $i=>$anio)
                                    <fieldset>
                                        <div class="vs-checkbox-con vs-checkbox-info">
                                            <input type="checkbox" value="{{$anio}}" class="disponibilidadFilter" id="disponibilidadFilter{{$i}}" data-id="{{$i}}">
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                            <span class="">{{$anio}}</span>
                                        </div>
                                    </fieldset>
                                    @endforeach
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-12">
                                    <b>Tipo de colaboración</b>
                                    @foreach($colaboracion as $i=>$anio)
                                    <fieldset>
                                        <div class="vs-checkbox-con vs-checkbox-info">
                                            <input type="checkbox" value="{{$anio}}" class="colaboracionFilter" id="colaboracionFilter{{$i}}" data-id="{{$i}}">
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                            <span class="">{{$anio}}</span>
                                        </div>
                                    </fieldset>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-oportunity">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-success" style="display:none">
                                        <button type="button" class="text-white close" id="dismiss" data-dismiss="alert">&times;</button>
                                        <span>Estatus modificado exitosamente</span>
                                    </div>
                                    <div class="input-group">
                                    </div>
                                </div>
                            </div>
                            <section id="data-list-view" class="data-list-view-header">
                                <!-- DataTable starts -->
                                <div class="table-responsive">
                                    <table id="datatable" class="table mt-2 data-list-view">
                                        <thead>
                                            <tr>

                                                <th>FOTO</th>
                                                <th>NOMBRE</th>
                                                <th>APELLIDO</th>
                                                <th>PERFIL</th>
                                                <th>COMENTARIO/VIDEO</th>
                                                <th>CAMBIAR ESTADO</th>
                                                <th>CHAT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($aplicants))
                                            @foreach($aplicants as $aplicant)
                                            <tr class="rowTable" id="row{{$aplicant->id}}" class="filaEntera">

                                                <td class="product-name" style="text-align:center;">
                                                    <div class="avatar">
                                                        <img  src="/{{$aplicant->user->sellerProfile->photo}}" height="40" width="40"
                                                        @if($aplicant->user->status==1)
                                                            title="Conectado"
                                                        @else
                                                            title="Desconectado"
                                                        @endif
                                                        >
                                                        @if($aplicant->user->status==1)
                                                            <span class="avatar-status-online" title="Conectado"></span>
                                                        @else
                                                            <span class="avatar-status-busy" title="Desconectado"></span>
                                                        </div>
                                                @endif
                                                </td>
                                                <td class="product-name">
                                                {{$aplicant->user->name}}
                                                <input type="text" class="movil" id="movil{{$aplicant->id}}" value="{{$aplicant->user->sellerProfile->phone_mobil ?? ''}}" data-id="{{$aplicant->id}}" hidden>
                                                <input type="text" class="photo" id="photo{{$aplicant->id}}" value="{{$aplicant->user->sellerProfile->photo ?? ''}}" data-id="{{$aplicant->id}}" hidden>
                                                <input type="text" class="video" id="video{{$aplicant->id}}" value="{{$aplicant->user->sellerProfile->video ?? ''}}" data-id="{{$aplicant->id}}" hidden>
                                                <input type="text" class="likeind" id="likeind{{$aplicant->id}}" value="{{$aplicant->user->sellerProfile->likeind ?? ''}}" data-id="{{$aplicant->id}}" hidden>
                                                <input type="text" class="anios" id="sector{{$aplicant->id}}" value="{{App\User::getAnsweredAnios($aplicant->user_id, 2)}}" data-id="{{$aplicant->id}}" hidden>
                                                <input type="text" class="experiencia" id="sector{{$aplicant->id}}" value="{{App\User::getExperiencie($aplicant->user_id, 3)}}" data-id="{{$aplicant->id}}" hidden>
                                                <input type="text" class="disponibilidad" id="sector{{$aplicant->id}}" value="{{App\User::getDisponibilidad($aplicant->user_id, 4)}}" data-id="{{$aplicant->id}}" hidden>
                                                <input type="text" class="colaboracion" id="sector{{$aplicant->id}}" value="{{App\User::getTipoColaboration($aplicant->user_id, 5)}}" data-id="{{$aplicant->id}}" hidden>

                                                </td>

                                                <td class="product-category">{{$aplicant->user->last_name}}</td>
                                                <td class="product-category" style="text-align:center;"><a class="text-white btn btn-primary btn-md" href="{{route('oportunity.profile', ['id'=>$aplicant->user_id])}}">Ver</a></td>
                                                <td class="product-category">
                                                    @if ($aplicant->message || $aplicant->video !== null)
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="text-white btn btn-info btn-md"
                                                                data-toggle="modal" data-target="#openVideo">
                                                            Abrir
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="openVideo" role="dialog" style="z-index:9999"
                                                             aria-labelledby="openVideoTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg"
                                                                 role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="openVideoTitle">
                                                                            Comentario / Vídeo
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @if ($aplicant->message)
                                                                            <p class="text-justify">
                                                                                {{ $aplicant->message }}
                                                                            </p>
                                                                        @endif
                                                                        @if ($aplicant->video !== null)
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="embed-responsive embed-responsive-item embed-responsive-16by9">
                                                                                        <video id="sampleMovie" width="100%" preload controls>
                                                                                            <source src="/{{ $aplicant->video }}" />
                                                                                            <source src="/{{ $aplicant->video }}" />
                                                                                            <source src="/{{ $aplicant->video }}" />
                                                                                        </video>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-primary"
                                                                                data-dismiss="modal">Cerrar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        SIN COMENTARIO / VIDEO
                                                    @endif
                                                </td>
                                                <td class="product-category" style="text-align:center;">
                                                <select class="form-control status_postulation" name="estatus_postulation" id="status_postulation" data-id="{{$aplicant->id}}" style="text-align:center;">
                                                    @foreach($status_postulation as $status)
                                                        <option value="{{$status->id}}" {{ $status->id===$aplicant->status_postulations_id ? 'selected' : '' }}>{{$status->description}}</option>
                                                    @endforeach
                                                </select>
                                                </td>


                                                <td class="product-price" style="text-align:center;">
                                                    @if($aplicant->user->status==1)
                                                       <a  href="{{ route('contact-by', ['user_id' => $aplicant->user_id, 'type' => 'ot']) }}" class="mb-1 mr-1 btn btn-icon rounded-circle btn-success waves-effect waves-light"><i class="feather icon-message-square"></i></a>
                                                    @else
                                                    <a href="{{ route('contact-by', ['user_id' => $aplicant->user_id, 'type' => 'ot']) }}" class="mb-1 mr-1 btn btn-icon rounded-circle btn-warning waves-effect waves-light"><i class="feather icon-message-square"></i></a>
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
<script src="{{ asset('vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="{{ asset('js/scripts/ui/data-list-view.js') }}"></script>
<script>$("#datatable").DataTable();</script>
@endsection
