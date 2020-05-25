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
                                    <th>Empresa</th>
                                    <th>Vendedor</th>
                                    <th>Cargo</th>
                                    <th>Ubicacion</th>
                                    <th>Tipo de Empleo</th>
                                    <th>Sector</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($oportunitys))
                                    @foreach($oportunitys as $oportunity)
                                    <tr class="{{App\Oportunity::getstatus((int)$oportunity->id)}}">
                                        <td>{{\Auth::user()->name}}</td>
                                        <td></td>
                                        <td>{{$oportunity->cargo}}</td>
                                        <td>{{$oportunity->ubication}}</td>
                                        <td>{{App\JobType::getType((int)$oportunity->job_type_id)}}</td>
                                        <td>{{App\SectorOportunity::getSector((int)$oportunity->sector_id)}}</td>
                                    <td>
                                        <a href="{{route('oportunity.form', ['oportunity'=>$oportunity])}}" data-toggle="tooltip" title="Editar oportunidad" class="btn btn-outline-primary btn-sm"><i class="feather icon-search"></i></a>
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
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

