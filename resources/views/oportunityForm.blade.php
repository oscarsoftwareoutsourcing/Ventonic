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
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <form method="POST" action="/profile">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <b class="mb-3">¿Que te gustaría hacer (Es gratis)?*</b> 
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($typeOportunitys as $typeOportunity)
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" value="{{$typeOportunity->id}}"> 
                                                    <label class="form-check-label">{{$typeOportunity->description}}</label>
                                                    </div> 
                                                @endforeach 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <b class="mb-3">¿Para que cargo?*</b> 
                                        <div class="row">
                                            <div class="col-12">
                                                <fieldset class="form-group">
                                                    <select class="form-control" id="basicSelect">
                                                        @foreach($profesions as $profesion)
                                                            <option value="{{$profesion->sector_id}}">{{$profesion->description}}</option>
                                                        @endforeach 
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <b class="mb-3">¿A quién estas buscando?*</b> 
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($jobTypes as $jobType)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" value="{{$jobType->id}}"> 
                                                <label class="form-check-label">{{$jobType->description}}</label>
                                                </div> 
                                                @endforeach 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <b class="mb-3">Ubicación*</b> 
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($ubicationOportunitys as $ubicationOportunity)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" value="{{$ubicationOportunity->id}}"> 
                                                    <label class="form-check-label">{{$ubicationOportunity->description}}</label>
                                                </div> 
                                                @endforeach                                                 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <b>Zona Horaria*</b> 
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($timeZoneOportunitys as $timeZoneOportunity)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" value="{{$timeZoneOportunity->id}}"> 
                                                    <label class="form-check-label">{{$timeZoneOportunity->description}}</label>
                                                </div> 
                                                @endforeach                                                 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection