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
                            {{-- <form method="" action="" enctype="multipart/form-data"> --}}
                                @csrf

                                    <div class="form-row">
                                      <div class="col-md-12 col-12 mb-3">
                                        <label for="validationTooltip01">Titulo<span class="obligatorio">*</span></label>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Titulo" value="{{$oportunity->title ?? ''}}" disabled>
                                      </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="col-md-4 col-12 mb-3">
                                          <label for="validationTooltip01">Empresa<span class="obligatorio">*</span></label>
                                          <input type="text" class="form-control" name="oportunity_id" placeholder="oportunity_id" value="{{$oportunity->id ?? ''}}" hidden>
                                          <input type="text" class="form-control" name="empresa" placeholder="Empresa" value="{{\Auth::user()->name}}" required disabled>
                                        </div>

                                        <div class="col-md-4 col-12 mb-3">
                                          <label for="cargo">Cargo<span class="obligatorio">*</span></label>
                                          <input type="text" class="form-control @error('cargo') is-invalid @enderror" name="cargo" value="{{$oportunity->cargo ?? ''}}" placeholder="Cargo" disabled>
                                          @error('cargo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror 
                                        </div>

                                        <div class="col-md-4 col-12 mb-3">
                                          <label for="validationTooltip03">Ubicacion<span class="obligatorio">*</span></label>
                                          <input type="text" class="form-control @error('ubication') is-invalid @enderror" name="ubication" placeholder="Ciudad, Provincia, Pais" value="{{$oportunity->ubication ?? ''}}" disabled>
                                          @error('ubication')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror 
                                        </div>
                                        
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-8 col-12 mb-3">
                                          <label for="validationTooltip01">Funcion laboral (añade hasta 3)<span class="obligatorio">*</span></label>
                                          <input type="text" class="form-control @error('functions') is-invalid @enderror" name="functions" value="{{$oportunity->functions ?? ''}}" disabled>
                                          @error('functions')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror 
                                        </div>

                                        <div class="col-md-4 col-12 mb-3">
                                          <label for="validationTooltip02">Tipo de Empleo<span class="obligatorio">*</span></label>
                                          <select class="form-control  @error('jobType') is-invalid @enderror" id="jobType" name="jobType" disabled>
                                            @foreach($jobTypes as $jobType)
                                              <option value="{{$jobType->id}}" {{$oportunity && $jobType->id==$oportunity->job_type_id ? 'selected' : ''}}>{{$jobType->description}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="col-md-8 col-12 mb-3">
                                          <label for="validationTooltip01">Sector de la empresa<span class="obligatorio">*</span></label>                                         
                                          <select class="select2 form-control max-length @error('sectors') is-invalid @enderror" name="sectors[]" id="sectors" multiple="multiple" disabled>
                                            @foreach($sectorsAll as $sector)
                                              <option value="{{$sector->id}}" {{$oportunity ? App\Oportunity::getSector($oportunity->sectors, $sector->id) :''}}>{{$sector->description}}</option>
                                            @endforeach
                                          </select>
                                        </div>

                                        <div class="col-md-4 col-12 mb-3">
                                          <label for="validationTooltip02">Nivel de antiguedad<span class="obligatorio">*</span></label>
                                          <select class="form-control" name="ubicationOportunity" disabled>
                                            <option>Selecciona una opcion</option>
                                            @foreach($ubicationOportunitys as $ubicationOportunity)
                                              <option value="{{$ubicationOportunity->id}}" {{$oportunity && $ubicationOportunity->id==$oportunity->ubication_oportunity_id ? 'selected' : ''}}>{{$ubicationOportunity->description}}</option>
                                            @endforeach   
                                          </select>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                          <label for="validationTooltip01">Descripcion del empleo<span class="obligatorio">*</span></label>
                                          <textarea class="form-control" name="description" rows="3" disabled>{{App\Oportunity::strTags($oportunity->description)}}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                      <div class="col-md-12 col-12 mb-3">
                                        <label for="validationTooltip01">Aptitudes requeridas</label>
                                        <select class="select2 form-control @error('skills') is-invalid @enderror" name="skills[]" multiple="multiple" disabled>
                                          @foreach($aptitudes as $aptitud)
                                            <option value="{{$aptitud->id}}"  {{$oportunity ? App\Oportunity::getAptitudes($oportunity->skills, $aptitud->id) :''}}>{{$aptitud->description}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                
                                @if(isset($oportunity->email_contact))
                                <div class="form-row">
                                  <div class="col-md-12 col-12 mb-3">
                                    <label for="validationTooltip01">Recibiré solicitudes a través de LikeInd al siguiente correo:</label>
                                    <input type="email" class="form-control" name="email_contact" placeholder="ejemplo@ejemplo.com" value="{{$oportunity->email_contact}}" disable>
                                  </div>
                                </div>
                                @endif

                                @if($oportunity->web!=NULL)
                                <div class="form-row">
                                  <div class="col-md-12 col-12 mb-3">
                                    <label for="validationTooltip01">Sitio Web</label>
                                    <input type="text" class="form-control" name="web" value="{{$oportunity->web}}" placeholder="web@web.com" disable>
                                  </div>
                                </div>
                                @endif

                                @if($oportunity!=NULL)
                                <div class="form-row" hidden>
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
                                                  <div class="divider-text">{{\Auth::user()->type=="E" ? 'Guardar tu publicacion' : 'Postulate'}}</div>
                                              </div> 
                                          </div>

                                          <div class="col-4 justify-content-center content-btn-save-oportunity">
                                            @if(\Auth::user()->type=="E")
                                              <button type="submit" class="btn btn-primary waves-effect waves-light mx-auto mt-1" name="guardar" value="guardar">GUARDAR</button>
                                            @else
                                              <button type="button" class="btn btn-primary waves-effect waves-light mx-auto mt-1" name="candidatura" data-toggle="modal" data-target="#primary" id="postularseBtn" value="candidatura">PRESENTAR MI CANDIDATURA</button>
                                              {{--BEGIN:Modal--}}
                                                <div class="modal fade text-left" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                      <div class="modal-content">
                                                          <div class="modal-header bg-primary white">
                                                              <h5 class="modal-title" id="myModalLabel160">Primary Modal</h5>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                              </button>
                                                          </div>
                                                          <div class="modal-body">
                                                          Está a punto de enviar su candidatura a la oportunidad <span id="nameOportunity">{{$oportunity->title}}</span>
                                                          </div>
                                                          <div class="modal-footer">
                                                              <a type="button" class="btn btn-secondary text-primary"  data-dismiss="modal">Cancelar</a>
                                                              <a href="{{ route('oportunity.postulation') }}"type="button" class="btn btn-primary"  data-dismiss="modal">Confirmar</a>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>

                                                {{--END: Modal--}}
                                            @endif
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('extra-js')
<script src="{{ asset('web/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}" defer></script>

<script>
  $(document).ready(function(){
    $(".select2").select2();
  });


</script>
@endsection