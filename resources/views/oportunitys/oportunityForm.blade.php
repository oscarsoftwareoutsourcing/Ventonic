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
                                        <div class="col-md-4 col-12 mb-3">
                                          <label for="validationTooltip01">Empresa<span class="obligatorio">*</span></label>
                                          <input type="text" class="form-control" name="oportunity_id" placeholder="oportunity_id" value="{{$oportunity->id ?? ''}}" hidden>
                                          <input type="text" class="form-control" name="empresa" placeholder="Empresa" value="{{\Auth::user()->name}}" required>
                                        </div>

                                        <div class="col-md-4 col-12 mb-3">
                                          <label for="cargo">Cargo<span class="obligatorio">*</span></label>
                                          <input type="text" class="form-control @error('profesion') is-invalid @enderror" name="profesion" value="{{$oportunity->cargo ?? ''}}" placeholder="Cargo" required>
                                          @error('profesion')
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
                                          {{-- <input type="text" class="form-control @error('functions') is-invalid @enderror" name="functions" value="{{$oportunity->functions ?? ''}}" required> --}}
                                          <select class="select2 form-control @error('functions') is-invalid @enderror" name="functions[]" multiple="multiple">
                                            @foreach($profesionAll as $function)
                                              <option value="{{$function->id}}" {{$oportunity ? App\Oportunity::getFunctions($oportunity->functions, $function->id):''}}>{{$function->description}}</option>
                                            @endforeach
                                          </select>
                                          @error('functions')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror 
                                        </div>

                                        <div class="col-md-4 col-12 mb-3">
                                          <label for="validationTooltip02">Tipo de Empleo<span class="obligatorio">*</span></label>
                                          <select class="form-control  @error('jobType') is-invalid @enderror" id="jobType" name="jobType">
                                            <option>Seleciona una opcion</option>
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
                                          <input type="text" class="form-control" placeholder="ingrese sector empresarial" name="sector_id" value="{{$sectorOportunity}}" hidden>
                                          {{-- <input type="text" class="form-control @error('sectors') is-invalid @enderror" placeholder="ingrese sector empresarial" value="{{$sectorName}}" disabled> --}}
                                          
                                          <select class="select2 form-control max-length @error('sectors') is-invalid @enderror" name="sectors[]" multiple="multiple">
                                            @foreach($sectorsAll as $sector)
                                              <option value="{{$sector->id}}" {{$oportunity ? App\Oportunity::getSector($oportunity->sectors, $sector->id) :''}}>{{$sector->description}}</option>
                                            @endforeach
                                          </select>
                                          @error('sectors')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror  
                                        </div>

                                        <div class="col-md-4 col-12 mb-3">
                                          <label for="validationTooltip02">Nivel de antiguedad<span class="obligatorio">*</span></label>
                                          <select class="form-control @error('ubicationOportunity') is-invalid @enderror" name="ubicationOportunity">
                                            <option>Selecciona una opcion</option>
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
                                          @error('decription')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror 
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                      {{-- Esperando me indiquen el flujo parar programarlo --}}
                                      <div class="col-md-12 col-12 mb-3">
                                        <label for="validationTooltip01">Añade actitudes como palabras claves para que tu oportunidad llegue a los vendedores adecuados</label>
                                        {{-- <input type="text" class="form-control" name="skills" value="{{$oportunity->skills ?? ''}}"> --}}
                                        <select class="select2 form-control @error('skills') is-invalid @enderror" name="skills[]" multiple="multiple">
                                          <option value="empatia">Empatia</option>
                                          <option value="Responsabilidad" selected>Responsabilidad</option>
                                          <option value="Puntualidad">Puntualidad</option>
                                          <option value="Trabajo bajo presion">Trabajo bajo presion</option>
                                          <option value="Disponibilidad Inmediata">Disponibilidad Inmediata</option>
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

                                          <div class="col-4 justify-content-center content-btn-save-oportunity">

                                          <button type="submit" class="btn btn-primary waves-effect waves-light mx-auto mt-1" name="{{$oportunity ? 'newstatus' : 'borrador'}}" value="{{$oportunity ? 'newstatus' : 'borrador'}}">{{$oportunity ? 'GUARDAR' : 'BORRADOR'}}</button>
                                          @if(!isset($oportunity->id))
                                          <button type="submit" class="btn btn-primary waves-effect waves-light mx-auto mt-1" name="publicar" value="publicar">PUBLICAR</button>
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

@section('js-selects2')
<script>
  $(document).ready(function(){
    $(".select2").select2();
  });
</script>
@endsection

