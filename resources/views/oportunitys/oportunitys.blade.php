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
                    <div class="card card-oportunity">
                        <div class="card-header"></div>
                     <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-append">
                                    @if(Auth::user()->type=="E")
                                    <a href="{{ route('oportunity.form') }}" class="btn btn-primary btn_right_new" type="button">
                                        Nueva
                                    </a>
                                    @endif
                                </div>
                                <input type="text" id="textSearch" name="oportunitySearch" class="form-control" placeholder="Buscar oportunidad..." style="border:1px solid #0087ff; border-radius:4px;">
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <table id="oportunityTable" class="table table-hover mb-0 ">
                            <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Empresa</th>
                                    <th>Cargo</th>
                                    <th>Ubicacion</th>
                                    <th>Tipo de Empleo</th>
                                    <th>Sector</th>
                                    @if(App\Aplicant::postulationsTrue(\Auth::user()->id)==true)
                                    <th>Estatus</th>
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
                                                <p>Postulado el <span>{{App\Aplicant::datePostulation(\Auth::user()->id, $oportunity->id)}}</span></p>
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

            </div>
        </div>
    </div>
</div>
@endsection