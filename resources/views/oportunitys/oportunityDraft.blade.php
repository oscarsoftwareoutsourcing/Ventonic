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
                        <form method="POST" action="{{ route('oportunitySave') }}" arial-label="" enctype="multipart/form-data" id="oportunityDraft">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <b class="mb-3">¿Que te gustaría hacer (Es gratis)?*</b> 
                                        <div class="row">
                                            <div class="col-12">
                                                {{-- <input type="radio" name="estatus" id="estatus" value="borrador" checked hidden> --}}
                                                @foreach($typeOportunitys as $typeOportunity)
                                                    <div class="vs-radio-con vs-radio-primary @error('typeOportunity') is-invalid @enderror">
                                                        <input type="input" name="oportunity_id"  value="{{$oportunityDraft->id}}" hidden>
                                                        <input type="radio" name="typeOportunity" value="{{$typeOportunity->id}}" {{ $typeOportunity->id == $oportunityDraft->typeOportunity->id ? 'checked' : ''}}>
                                                        <span class="vs-radio vs-radio-sm">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                        <span class="">{{$typeOportunity->description}}</span>
                                                    </div>
                                                @endforeach
                                                @error('typeOportunity')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
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
                                                <select class="form-control @error('profesion') is-invalid @enderror" name="profesion" id="basicSelect" >
                                                        @foreach($profesions as $profesion)
                                                            <option value="{{$profesion->id}}" {{ $profesion->id == $oportunityDraft->profesion->id ? 'selected' : ''}}>{{$profesion->description}}</option>
                                                        @endforeach 
                                                    </select>
                                                </fieldset>
                                                @error('profesion')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
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
                                                <div class="vs-radio-con vs-radio-primary @error('jobType') is-invalid @enderror">
                                                    <input type="radio" name="jobType" value="{{$jobType->id}}" {{ $jobType->id == $oportunityDraft->jobType->id ? 'checked' : ''}}>
                                                    <span class="vs-radio vs-radio-sm">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">{{$jobType->description}}</span>
                                                </div> 
                                                @endforeach
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
                                                @foreach($ubicationOportunitys as $ubicationOportunity)
                                                <div class="vs-radio-con vs-radio-primary @error('ubicationOportunity') is-invalid @enderror">
                                                    <input type="radio" name="ubicationOportunity" value="{{$ubicationOportunity->id}}" {{ $ubicationOportunity->id == $oportunityDraft->ubicationOportunity->id ? 'checked' : ''}}>
                                                    <span class="vs-radio vs-radio-sm">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">{{$ubicationOportunity->description}}</span>
                                                </div>  
                                                @endforeach
                                                @error('ubicationOportunity')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror                                                   
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <b>Zona Horaria*</b> 
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($timeZoneOportunitys as $timeZoneOportunity)
                                                <div class="vs-radio-con vs-radio-primary @error('timeZoneOportunity') is-invalid @enderror">
                                                    <input type="radio" name="timeZoneOportunity" id="timeZoneOportunity{{$timeZoneOportunity->id}}" value="{{$timeZoneOportunity->id}}" {{ $timeZoneOportunity->id == $oportunityDraft->timeZoneOportunity->id ? 'checked' : ''}}>
                                                    <span class="vs-radio vs-radio-sm">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">{{$timeZoneOportunity->description}}</span>
                                                </div>   
                                                @endforeach
                                                @error('timeZoneOportunity')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror                                                  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card collapse-icon accordion-icon-rotate">
                                            <div class="card-content">
                                              <div class="card-body">
                                                <div class="default-collapse collapse-bordered">
                                                  <div class="card collapse-header">
                                                    <div id="headingCollapse1" class="card-header collapsed" data-toggle="collapse" role="button" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                                      <span class="lead collapse-title float-right" style="display: block!important; width:100%!important;text-align:right; margin-right:30px;">
                                                        DETALLES OPCIONALES
                                                      </span>
                                                    </div>
                                                    <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse" style="">
                                                      <div class="card-content">
                                                        <div class="card-body">

                                                          <span><i class="feather icon-info"></i></span> Lleva tu publicacion al siguiente nivel, atrae al mejor talento.
                                                          <p class="mt-2 mb-2">Mejora tu publicacion completando los campos opcionales. Los detalles y las expectativas claras atraen al mejor talento.</p>


                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Titulo</label>
                                                        <input type="text" class="form-control" id="title" name="title" placeholder="Inserta el titulo" value="{{ $oportunityDraft->title ? $oportunityDraft->title : ''}}" @error('title') is-invalid @enderror>
                                                            @error('title')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </fieldset>

                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Descripcion</label>
                                                            <textarea class="form-control" id="description" rows="3" name="description" placeholder="Descripcion de la oportunidad" value="{{ $oportunityDraft->description ? $oportunityDraft->description : ''}}" @error('description') is-invalid @enderror>{{ $oportunityDraft->description ? $oportunityDraft->description : ''}}</textarea>
                                                            @error('description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </fieldset>

                                                        <fieldset class="form-group">
                                                            <label for="basicInputFile">Foto del equipo de trabajo</label>
                                                            @if($oportunityDraft->image)
                                                                <div class="container-image-oportunity">
                                                                    <img class="image-fluid" src="{{ route('oportunityImage', ['filename'=>$oportunityDraft->image])}}">
                                                                </div>
                                                            @endif
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="image" value="{{ $oportunityDraft->image ? $oportunityDraft->image : ''}}" name="image" @error('image') is-invalid @enderror>
                                                                <label class="custom-file-label" for="inputGroupFile01">Seleccione una imagen</label>
                                                            </div>
                                                            @error('image')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </fieldset>
                                                        
                                                        <fieldset class="form-group">
                                                            <label for="basicInput mb-2s">Habilidades requeridas</label>
                                                                    @foreach($oportunityDraft->profesion->skill as $skill)
                                                                        <div class="vs-checkbox-con vs-checkbox-info">
                                                                            <input type="checkbox" value="{{$skill->id}}" name="skills[]" id="skills{{$skill->id}}">
                                                                            <span class="vs-checkbox">
                                                                            <span class="vs-checkbox--check">
                                                                                <i class="vs-icon feather icon-check"></i>
                                                                            </span>
                                                                            </span>
                                                                            <span class="">{{$skill->description}}</span>
                                                                        </div>
                                                                    @endforeach
                                                        </fieldset>

                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Años de experiencia</label>
                                                            <input type="number" min=0 class="form-control" id="experiencie" name="experience" placeholder="Años de experiencia" value="{{ $oportunityDraft->experience ? $oportunityDraft->experience : ''}}" @error('experiencie') is-invalid @enderror>
                                                            @error('experiencie')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </fieldset>

                                                        @if($oportunityDraft->ubicationOportunity->id !== 1)
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Ubicacion</label>
                                                            <input type="text" class="form-control" id="ubication" name="ubication" placeholder="Describa la ubicacion de la oportunidad" value="{{ $oportunityDraft->ubication ? $oportunityDraft->ubication : ''}}" @error('title') is-invalid @enderror>
                                                        </fieldset>
                                                        @endif


                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>     
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        
                                        <div class="row justify-content-center senForm-step1">
                                            <div class="col-12 justify-content-center">
                                                <div class="divider">
                                                    <div class="divider-text">Detalles de la publicacion</div>
                                                </div> 
                                            </div>
                                            <div class="col-6 justify-content-center content-btn-save-oportunity">
                                                {{-- @if(!isset($oportunityDraft)) --}}
                                                <button type="submit" class="btn btn-primary waves-effect waves-light mx-auto mt-1" name="guardada" value="guardada">GUARDAR</button>
                                                {{-- @endif --}}
                                                <button type="submit" class="btn btn-primary waves-effect waves-light mx-auto mt-1" name="previa" value="previa">VISTA PREVIA</button>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light mx-auto mt-1" name="borrador" value="borrador">BORRADOR</button>

                                                {{-- <button type="submit" class="btn btn-primary waves-effect waves-light mx-auto mt-1">COMENZAR BORRADOR</button> --}}
                                            </div>
                                            {{-- <div class="col-6 justify-content-center">
                                            </div> --}}
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
