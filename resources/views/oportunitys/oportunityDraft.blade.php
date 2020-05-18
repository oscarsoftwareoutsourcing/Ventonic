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
                        <div class="card-header">
                            @if(session('message'))
                                <div class="alert alert-success">{{session('message')}}</div>
                            @endif
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('previusOportunity') }}" arial-label="" enctype="multipart/form-data" id="crearOportunity">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <b class="mb-3">¿Que te gustaría hacer (Es gratis)?*</b> 
                                        <div class="row">
                                            <div class="col-12">
                                                {{-- <input type="radio" name="estatus" id="estatus" value="borrador" checked hidden> --}}
                                                    <div class="vs-radio-con vs-radio-primary @error('typeOportunity') is-invalid @enderror">
                                                    <input type="radio" name="typeOportunity" id="typeOportunity{{$oportunityDraft->typeOportunity->id}}" value="{{$oportunityDraft->typeOportunity->id}}">
                                                        <span class="vs-radio vs-radio-sm">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                        <span class="">{{$oportunityDraft->typeOportunity->description}}</span>
                                                    </div>
                                                @error('typeOportunity')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="row">
                                    <div class="col-12 mb-2">
                                        <b class="mb-3">¿Para que cargo?*</b> 
                                        <div class="row">
                                            <div class="col-12">
                                                <fieldset class="form-group">
                                                <select class="form-control @error('profesion') is-invalid @enderror" name="profesion" id="basicSelect" >
                                                        @foreach($profesions as $profesion)
                                                            <option value="{{$profesion->sector_id}}">{{$profesion->description}}</option>
                                                        @endforeach 
                                                    </select>
                                                </fieldset>
                                                @error('profesion')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <b class="mb-3">¿A quién estas buscando?*</b> 
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="vs-radio-con vs-radio-primary @error('jobType') is-invalid @enderror">
                                                    <input type="radio" name="jobType" id="jobType{{$oportunityDraft->jobType->id}}" value="{{$oportunityDraft->jobType->id}}" check>
                                                    <span class="vs-radio vs-radio-sm">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">{{$oportunityDraft->jobType->description}}</span>
                                                </div> 
                                                @error('jobType')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <b class="mb-3">Ubicación*</b> 
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="vs-radio-con vs-radio-primary @error('ubicationOportunity') is-invalid @enderror">
                                                    <input type="radio" name="ubicationOportunity" id="ubicationOportunity{{$oportunityDraft->ubicationOportunity->id}}" value="{{$oportunityDraft->ubicationOportunity->id}}" check>
                                                    <span class="vs-radio vs-radio-sm">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">{{$oportunityDraft->ubicationOportunity->description}}</span>
                                                </div>  
                                                @error('ubicationOportunity')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror                                                   
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <b>Zona Horaria*</b> 
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="vs-radio-con vs-radio-primary @error('timeZoneOportunity') is-invalid @enderror">
                                                    <input type="radio" name="timeZoneOportunity" id="timeZoneOportunity{{$oportunityDraft->timeZoneOportunity->id}}" value="{{$oportunityDraft->timeZoneOportunity->id}}" check>
                                                    <span class="vs-radio vs-radio-sm">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">{{$oportunityDraft->timeZoneOportunity->description}}</span>
                                                </div>   
                                                @error('timeZoneOportunity')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror                                                  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        
                                        <div class="row justify-content-center senForm-step1">
                                            <div class="col-12 justify-content-center">
                                                <div class="divider">
                                                    <div class="divider-text">Puedes Añadir detalles adicionales mas adelante</div>
                                                </div> 
                                            </div>
                                            <div class="col-5 justify-content-center content-btn-save-oportunity">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light mx-auto mt-1" name="borrador" value="borrador" id="borrador">COMENZAR BORRADOR</button>
                                                <button type="" class="btn btn-primary waves-effect waves-light mx-auto mt-1" name="publicada" value="publicada" id="publicada">PUBLICAR</button>
                                                {{-- <button type="submit" class="btn btn-primary waves-effect waves-light mx-auto mt-1">COMENZAR BORRADOR</button> --}}
                                            </div>
                                            {{-- <div class="col-6 justify-content-center">
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </form>

                        <div>  
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection