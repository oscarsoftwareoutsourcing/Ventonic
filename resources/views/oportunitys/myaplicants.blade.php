@extends('layouts.app-dashboard')

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
                    {{-- BEGIND Filtros --}}
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="list-unstyled mb-0">
                                    <li class="d-inline-block mr-2">
                                        <fieldset>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="customCheck" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">Móvil</label>
                                            </div>
                                        </fieldset>
                                    </li>
                                    <li class="d-inline-block mr-2">
                                        <fieldset>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="customCheck" id="customCheck2">
                                                <label class="custom-control-label" for="customCheck2">Foto</label>
                                            </div>
                                        </fieldset>
                                    </li>
                                    <li class="d-inline-block mr-2">
                                        <fieldset>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="customCheck" id="customCheck3">
                                                <label class="custom-control-label" for="customCheck3">Vídeo</label>
                                            </div>
                                        </fieldset>
                                    </li>
                                    <li class="d-inline-block mr-2">
                                        <fieldset>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="customCheck" id="customCheck4">
                                                <label class="custom-control-label" for="customCheck4">LinkedIn</label>
                                            </div>
                                        </fieldset>
                                    </li>
                                    
                                    <li class="d-inline-block mr-2">
                                        <fieldset>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="customCheck" id="customCheck4">
                                                <label class="custom-control-label" for="customCheck4">Años</label>
                                            </div>
                                        </fieldset>
                                    </li>
                                    <li class="d-inline-block mr-2">
                                        <fieldset>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="customCheck" id="customCheck4">
                                                <label class="custom-control-label" for="customCheck4">Experiencia</label>
                                            </div>
                                        </fieldset>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- END Filtros --}}
                    <div class="card card-oportunity">
                        <div class="card-header"></div>
                     <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success" style="display:none">
                                <button type="button" class="close text-white" id="dismiss" data-dismiss="alert">&times;</button>
                                <span>Estatus modificado exitosamente</span>
                            </div>
                            <div class="input-group">
                                {{-- <div class="input-group-append">
                                    <a href="{{ route('oportunity.form') }}" class="btn btn-primary btn_right_new" type="button">
                                        Nueva
                                    </a>
                                </div> --}}
                                {{-- <form action="{{ route('oportunity.form') }}" style="display:block;width:100%;"> --}}
                                <input type="text" id="textSearch" name="oportunitySearch" class="form-control" placeholder="Buscar postulado..." style="border:1px solid #0087ff;">
                                {{-- <div class="input-group-append">
                                    <button class="btn btn-primary search-oportunity" id="btnSearch" type="button">
                                        <i class="feather icon-search"></i>
                                    </button>
                                </div> --}}
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <table id="oportunityTable" class="table table-hover mb-0 ">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Perfil</th>
                                    <th>Estado</th>
                                    <th>Chat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($aplicants))
                                    @foreach($aplicants as $aplicant)
                                    <tr>
                                        <td style="text-align:center;" width="30%">{{App\Aplicant::getDatos((int)$aplicant->user_id, 'name')}}</td>
                                        <td style="text-align:center;" width="30%">{{App\Aplicant::getDatos((int)$aplicant->user_id, 'surname')}}</td>
                                        <td style="text-align:center;" width="15%"><a class="btn btn-outline-primary btn-md text-white" href="{{route('oportunity.profile', ['id'=>$aplicant->user_id])}}">Ver</a></td>
                                        <td style="text-align:center;" width="15%">
                                            <select class="form-control status_postulation" name="estatus_postulation" id="status_postulation" data-id="{{$aplicant->id}}">
                                                @foreach($status_postulation as $status)
                                            <option value="{{$status->id}}">{{$status->description}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="text-align:center;" width="10%">
                                            @if($aplicant->user->status==1)
                                            <a href="{{ route('chat') }}" class=""><i class="feather icon-message-square" style="foont-size:22px;"></i></a>
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
                            <span class="float-right">{{ $aplicants->links() }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
