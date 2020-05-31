@extends('layouts.app-dashboard')
 
{{-- @section('estilos-extra')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('js-extras')
<script src="{{ asset('js/vendors/forms/select/select2.full.js') }}"></script>
<script src="{{ asset('js/vendors/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('js/vendors/forms/select/select2.js') }}"></script>
<script src="{{ asset('js/vendors/forms/select/select2.min.js') }}"></script>
<script>
  $(document).ready(function(){
    $('#cargos-oportunity').select2();
  });
  
</script>
@endsection --}}
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
                            <form method="POST" action="{{ route('oportunity.save') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-row">
                                      <div class="col-md-12 col-12 mb-3">
                                        <label for="validationTooltip01">Titulo<span class="obligatorio">*</span></label>
                                        <input type="text" class="form-control  @error('title') is-invalid @enderror" name="title" placeholder="titulo" value="{{$oportunity->title ?? ''}}" required>
                                      </div>
                                      @error('title')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror 
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="col-md-4 col-12 mb-3">
                                          <label for="validationTooltip01">Empresa<span class="obligatorio">*</span></label>
                                          <input type="text" class="form-control" name="oportunity_id" placeholder="oportunity_id" value="{{$oportunity->id ?? ''}}" hidden>
                                          <input type="text" class="form-control" name="empresa" placeholder="Empresa" value="{{\Auth::user()->name}}" required disabled>
                                        </div>

                                        <div class="col-md-4 col-12 mb-3">
                                          <label for="cargo">Cargo<span class="obligatorio">*</span></label>
                                          <input type="text" class="form-control @error('cargo') is-invalid @enderror" name="cargo" value="{{$oportunity->cargo ?? ''}}" placeholder="Cargo" required>
                                          @error('cargo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror 
                                        </div>

                                        <div class="col-md-4 col-12 mb-3">
                                          <label for="validationTooltip03">Ubicacion<span class="obligatorio">*</span></label>
                                          <input type="text" class="form-control @error('ubication') is-invalid @enderror" name="ubication" placeholder="Ciudad, Provincia, Pais" value="{{$oportunity->ubication ?? ''}}" required>
                                          @error('ubication')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror 
                                        </div>
                                        
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-8 col-12 mb-3">
                                          <label for="validationTooltip01">Funcion laboral (añade hasta 3)<span class="obligatorio">*</span></label>
                                          <input type="text" class="form-control @error('functions') is-invalid @enderror" name="functions" value="{{$oportunity->functions ?? ''}}" required>
                                          @error('functions')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror 
                                        </div>

                                        <div class="col-md-4 col-12 mb-3">
                                          <label for="validationTooltip02">Tipo de Empleo<span class="obligatorio">*</span></label>
                                          <select class="form-control  @error('jobType') is-invalid @enderror" id="jobType" name="jobType">
                                            @foreach($jobTypes as $jobType)
                                              <option value="{{$jobType->id}}" {{$oportunity && $jobType->id==$oportunity->job_type_id ? 'selected' : ''}}>{{$jobType->description}}</option>
                                            @endforeach
                                            @error('jobType')
                                              <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror  
                                          </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="col-md-8 col-12 mb-3">
                                          <label for="validationTooltip01">Sector de la empresa (selecciona hasta 3)<span class="obligatorio">*</span></label>                                         
                                          <select class="select2 form-control max-length @error('sectors') is-invalid @enderror" name="sectors[]" id="sectors" multiple="multiple">
                                            @foreach($sectorsAll as $sector)
                                              <option value="{{$sector->id}}" {{$oportunity ? App\Oportunity::getSector($oportunity->sectors, $sector->id) :''}}>{{$sector->description}}</option>
                                            @endforeach
                                          </select>
                                          @error('sectors')
                                            <div id="errors-sectors" class="alert alert-danger">{{ $message }}</div>
                                          @enderror
                                            
                                        </div>

                                        <div class="col-md-4 col-12 mb-3">
                                          <label for="validationTooltip02">Nivel de antiguedad<span class="obligatorio">*</span></label>
                                          <select class="form-control @error('ubicationOportunity') is-invalid @enderror" name="ubicationOportunity">
                                            @foreach($ubicationOportunitys as $ubicationOportunity)
                                              <option value="{{$ubicationOportunity->id}}" {{$oportunity && $ubicationOportunity->id==$oportunity->ubication_oportunity_id ? 'selected' : ''}}>{{$ubicationOportunity->description}}</option>
                                            @endforeach
                                            @error('ubicationOportunity')
                                              <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror    
                                          </select>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                          <label for="validationTooltip01">Descripcion del empleo<span class="obligatorio">*</span></label>
                                          <textarea class="form-control ckeditor @error('description') is-invalid @enderror" name="description" rows="3">{{$oportunity->description ?? ''}}</textarea>
                                          @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror 
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                      {{-- Esperando me indiquen el flujo parar programarlo --}}
                                      <div class="col-md-12 col-12 mb-3">
                                        <label for="validationTooltip01">Añade actitudes como palabras claves para que tu oportunidad llegue a los vendedores adecuados</label>
                                        <select class="select2 form-control @error('skills') is-invalid @enderror" name="skills[]" multiple="multiple">
                                          @foreach($aptitudes as $aptitud)
                                            <option value="{{$aptitud->id}}"  {{$oportunity ? App\Oportunity::getAptitudes($oportunity->skills, $aptitud->id) :''}}>{{$aptitud->description}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      @error('skills')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror 
                                    </div>

                                <div class="form-row">
                                  <div class="col-md-12 col-12 mb-3">
                                    <label for="validationTooltip01">¿Cómo quieres recibir las solicitudes?</label>
                                    <div class="vs-radio-con vs-radio-primary">
                                      <input type="radio" {{$oportunity ? 'checked' : ''}}>
                                      <span class="vs-radio vs-radio-sm">
                                          <span class="vs-radio--border"></span>
                                          <span class="vs-radio--circle"></span>
                                      </span>
                                      <span class="">Permitir a los candidatos solicitar empleos con sus perfiles de likeInd y notificarme por email</span>
                                    </div>
                                  <input type="email" class="form-control" name="email_contact" placeholder="ejemplo@ejemplo.com" value="{{$oportunity->email_contact ?? ''}}">
                                  </div>
                                </div>

                                <div class="form-row">
                                  <div class="col-md-12 col-12 mb-3">
                                    <label for="validationTooltip01"></label>
                                    <div class="vs-radio-con vs-radio-primary">
                                      <input type="radio" {{$oportunity ? 'checked':''}}>
                                      <span class="vs-radio vs-radio-sm">
                                          <span class="vs-radio--border"></span>
                                          <span class="vs-radio--circle"></span>
                                      </span>
                                      <span class="">Dirigir a los candidatos a un sitio web externo en el que puedan enviar su solicitud</span>
                                    </div>
                                  <input type="text" class="form-control" name="web" value="{{$oportunity->web ?? ''}}" placeholder="web@web.com">
                                  </div>
                                </div>

                                @if($oportunity!=NULL)
                                <div class="form-row">
                                  <div class="col-md-12 col-12 mb-3 rounded border border-secondary">
                                    <label class="mb-1" for="validationTooltip01">Elige un nuevo estatus para tu publicacion</label>
                                    <select class="form-control mb-2" name="statusOportunity">
                                      @foreach($statusOportunity as $status)
                                        <option value="{{$status->id}}" {{$oportunity && $status->id==$oportunity->status_id ? 'selected' : ''}}>{{App\StatusOportunity::getStatus((int)$status->id)}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                @endif

                                <div class="row">
                                  <div class="col-12">
                                      
                                      <div class="row justify-content-center senForm-step1">
                                          <div class="col-12 justify-content-center">
                                              <div class="divider">
                                                @if($oportunity==NULL)
                                                  <div class="divider-text">Comienza tu publicacion</div>
                                                @else
                                                <div class="divider-text">Modifica tu publicacion</div>
                                                @endif
                                              </div> 
                                          </div>

                                          <div class="" id="botonera">

                                          <button type="submit" class="btn btn-primary waves-effect waves-light mt-1 actions" name="{{$oportunity ? 'newstatus' : 'borrador'}}" value="{{$oportunity ? 'newstatus' : 'borrador'}}">{{$oportunity ? 'GUARDAR' : 'BORRADOR'}}</button>

                                          @if(!isset($oportunity->id))
                                          <button type="submit" class="btn btn-primary waves-effect waves-light mt-1 actions" name="previa" value="previa">VISTA PREVIA</button>
                                          <button type="submit" class="btn btn-primary waves-effect waves-light mt-1 actions" name="publicar" value="publicar">PUBLICAR</button>

                                          @endif
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

@section('extra-js')
<script>
  $(document).ready(function(){
    $(".select2").select2();
  });
</script>
@endsection

