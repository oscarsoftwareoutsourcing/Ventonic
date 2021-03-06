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
                                    <a href="{{ route('oportunity.form') }}" class="btn btn-primary btn_right_new" type="button">
                                        Nueva
                                    </a>
                                </div>
                                {{-- <form action="{{ route('oportunity.form') }}" style="display:block;width:100%;"> --}}
                                <input type="text" id="textSearch" name="oportunitySearch" class="form-control" placeholder="Buscar oportunidad..." style="border:1px solid #0087ff;">
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
                                    <th>Titulo</th>
                                    <th>Cargo</th>
                                    <th>Ubicacion</th>
                                    <th>Tipo de Empleo</th>
                                    <th>Sector</th>
                                    <th>N° Inscritos</th>
                                    <th>Candidatos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($oportunitys))
                                    @foreach($oportunitys as $oportunity)
                                    <tr href="{{route('oportunity.form', ['oportunity'=>$oportunity])}}" class="{{App\Oportunity::getstatus((int)$oportunity->id)}}">
                                        <td style="{{App\Oportunity::getStyle((int)$oportunity->id)}}" width="10%">{{$oportunity->title}}</td>
                                        <td style="{{App\Oportunity::getStyle((int)$oportunity->id)}}">{{$oportunity->cargo}}</td>
                                        <td style="{{App\Oportunity::getStyle((int)$oportunity->id)}}">{{$oportunity->ubication}}</td>
                                        <td style="{{App\Oportunity::getStyle((int)$oportunity->id)}}">{{App\JobType::getType((int)$oportunity->job_type_id)}}</td>
                                        <td style="{{App\Oportunity::getStyle((int)$oportunity->id)}}">{{App\Oportunity::listSectors($oportunity->sectors)}}</td>
                                        <td style="{{App\Oportunity::getStyle((int)$oportunity->id)}}"></td>
                                        <td style="{{App\Oportunity::getStyle((int)$oportunity->id)}}"></td>
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
@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
