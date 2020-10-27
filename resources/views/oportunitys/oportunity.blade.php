@extends('layouts.app-dashboard')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>

        <div class="row">
                <div class="mb-1 new-header">
                <span  class="title">Oportunidades</span>

                </div>
        </div>

        <div class="">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    @php
                        $formAction = (
                            \Auth::user()->type=="V" &&
                            App\Aplicant::verifyPostulation(\Auth::user()->id, $oportunity->id)==null
                        ) ? route('oportunity.postulation') : route('oportunity.update');
                    @endphp
                  <form method="POST" action="{{ $formAction }}" enctype="multipart/form-data"
                        id="oportunityForm">
                    <div class="card card-oportunity">
                        <div class="bg-gradient-primary">
                            <div class="card_vetonic-description">
                                <div class="text_vetonic-description1">Detalle de oportunidad</div>
                            </div>
                        </div>
                        <div class="card-body">

                                @csrf
                                  <span class="float-right mb-2">
                                   <a href="{{ url()->previous() }}" title="Cerrar" class="closed-view">
                                    X
                                  </a>
                                </span>
                                    <div class="form-row">
                                      <div class="mb-3 col-md-8 col-8">
                                        <label for="validationTooltip01">Titulo<span class="obligatorio">*</span></label>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Titulo" value="{{$oportunity->title ?? ''}}"
                                        {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}>
                                      </div>
                                      <div class="col-md-4 col-4">
                                        <label for="validationTooltip01">Fecha de caducidad</label>
                                        <flat-pickr name="expire_at" id="expire_at" class="form-control"
                                                    :config="flatPicker.config" placeholder="dd-mm-yyyy"
                                                    value="{{(!is_null($oportunity->expire_at)) ? $oportunity->expire_at->format('d-m-Y') : ''}}"
                                                    {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}/>
                                      </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="mb-3 col-md-4 col-12">
                                          <label for="validationTooltip01">Empresa<span class="obligatorio">*</span></label>
                                          <input type="text" class="form-control" name="oportunity_id" placeholder="oportunity_id" value="{{$oportunity->id ?? ''}}" hidden>
                                          <input type="text" class="form-control" name="empresa" placeholder="Empresa" value="{{$oportunity->user->name}}" required
                                          {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}>
                                        </div>

                                        <div class="mb-3 col-md-4 col-12">
                                          <label for="cargo">Cargo<span class="obligatorio">*</span></label>
                                          <input type="text" class="form-control @error('cargo') is-invalid @enderror" name="cargo" value="{{$oportunity->cargo ?? ''}}" placeholder="Cargo"
                                          {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}>
                                          @error('cargo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror
                                        </div>

                                        <div class="mb-3 col-md-4 col-12">
                                          <label for="validationTooltip03">Ubicacion<span class="obligatorio">*</span></label>
                                          <input type="text" class="form-control @error('ubication') is-invalid @enderror" name="ubication" placeholder="Ciudad, Provincia, Pais" value="{{$oportunity->ubication ?? ''}}" {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}>
                                          @error('ubication')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="mb-3 col-md-8 col-12">
                                          <label for="validationTooltip01">Función laboral (añade hasta 3)<span class="obligatorio">*</span></label>
                                          <select class="select2 form-control max-length @error('functions') is-invalid @enderror" name="functions[]" id="functions" multiple="multiple"
                                          {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}>
                                            @foreach($jobFunctions as $jobFunction)
                                              <option value="{{$jobFunction->id}}" {{$oportunity ? App\Oportunity::getFunction($oportunity->functions, $jobFunction->id) :''}}>{{$jobFunction->name}}</option>
                                            @endforeach
                                          </select>
                                          <!--<input type="text" class="form-control @error('functions') is-invalid @enderror" name="functions" value="{{$oportunity->functions ?? ''}}"
                                          {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}>-->
                                          @error('functions')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror
                                        </div>

                                        <div class="mb-3 col-md-4 col-12">
                                          <label for="validationTooltip02">Tipo de Empleo<span class="obligatorio">*</span></label>
                                          <select class="form-control  @error('jobType') is-invalid @enderror" id="jobType" name="jobType" {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}>
                                            @foreach($jobTypes as $jobType)
                                              <option value="{{$jobType->id}}" {{$oportunity && $jobType->id==$oportunity->job_type_id ? 'selected' : ''}}>{{$jobType->description}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="mb-3 col-md-8 col-12">
                                          <label for="validationTooltip01">Sector de la empresa<span class="obligatorio">*</span></label>
                                          <select class="select2 form-control max-length @error('sectors') is-invalid @enderror" name="sectors[]" id="sectors" multiple="multiple"
                                          {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}>
                                            @foreach($sectorsAll as $sector)
                                              <option value="{{$sector->id}}" {{$oportunity ? App\Oportunity::getSector($oportunity->sectors, $sector->id) :''}}>{{$sector->description}}</option>
                                            @endforeach
                                          </select>
                                        </div>

                                        <div class="mb-3 col-md-4 col-12">
                                          <label for="validationTooltip02">Modalidad de Trabajo<span class="obligatorio">*</span></label>
                                          <select class="form-control" name="ubicationOportunity"
                                                  {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}>
                                            <option>Selecciona una opcion</option>
                                            @foreach($ubicationOportunitys as $ubicationOportunity)
                                              <option value="{{$ubicationOportunity->id}}" {{$oportunity && $ubicationOportunity->id==$oportunity->ubication_oportunity_id ? 'selected' : ''}}>{{$ubicationOportunity->description}}</option>
                                            @endforeach
                                          </select>
                                        </div>

                                    </div>


                                     <div class="form-row">
                                      <div class="mb-3 col-md-4 col-12">
                                          <label for="amount">Valor del producto/servicio</label>
                                          <input type="number" id="userinput" pattern="[0-9]*"
                                          class="form-control @error('amount') is-invalid @enderror"
                                          name="amount" value="{{$oportunity->amount ?? '0'}}"
                                          placeholder="Valor del producto/servicio"
                                          {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}
                                          value="{{$oportunity->amount ?? '0'}}"
                                          >
                                          @error('amount')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror
                                        </div>


                                         <div class="mb-3 col-md-4 col-12 ">
                                          <label for="leads">Nº de Leads</label>
                                          <input type="number" pattern="[0-9]"  min="0"
                                          class="form-control @error('leads') is-invalid @enderror"
                                          name="leads" value="{{$oportunity->leads ?? '0'}}"
                                          placeholder="Nº de Leads"
                                          {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}
                                          >
                                          @error('leads')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror
                                        </div>

                                         <div class="my-2 mb-3 col-md-4 col-12">

                                          <fieldset class="checkbox">
                                            <div class="vs-checkbox-con vs-checkbox-primary ">
                                              <input type="checkbox" name="is_funnel" id="is_funnel"
                                                {{ $oportunity->is_funnel ==1 ? 'checked' : ''}}
                                                {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}
                                                >
                                                <span class="vs-checkbox">
                                                  <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                  </span>
                                                </span>
                                                <span class="">Embudo de ventas</span>
                                            </div>
                                          </fieldset>
                                        </div>
                                    </div>


                                    <div class="form-row">
                                        <div class="mb-3 col-md-12 col-12">
                                          <label for="validationTooltip01">Descripcion del empleo<span class="obligatorio">*</span></label>
                                          <textarea class="form-control" name="description" rows="3"
                                                    {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}>{{App\Oportunity::strTags($oportunity->description)}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                      <div class="mb-3 col-md-12 col-12">
                                        <label for="validationTooltip01">Aptitudes requeridas</label>
                                        <select class="select2 form-control @error('skills') is-invalid @enderror" name="skills[]" multiple="multiple" {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}>
                                          @foreach($aptitudes as $aptitud)
                                            <option value="{{$aptitud->id}}"  {{$oportunity ? App\Oportunity::getAptitudes($oportunity->skills, $aptitud->id) :''}}>{{$aptitud->description}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                @if(isset($oportunity->email_contact))
                                <div class="form-row">
                                  <div class="mb-3 col-md-12 col-12">
                                    <label for="validationTooltip01">Recibiré solicitudes a través de LikeInd al siguiente correo:</label>
                                    <input type="email" class="form-control" name="email_contact" placeholder="ejemplo@ejemplo.com" value="{{$oportunity->email_contact}}" {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}>
                                  </div>
                                </div>
                                @endif

                                @if($oportunity->web!=NULL)
                                <div class="form-row">
                                  <div class="mb-3 col-md-12 col-12">
                                    <label for="validationTooltip01">Sitio Web</label>
                                    <input type="text" class="form-control" name="web" value="{{$oportunity->web}}" placeholder="web@web.com" {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}>
                                  </div>
                                </div>
                                @endif

                                @if($oportunity!=null)
                                <div class="form-row" hidden>
                                  <div class="mb-3 border rounded col-md-12 col-12 border-secondary">
                                    <label class="mb-1" for="validationTooltip01">Elige un nuevo estatus para tu publicacion</label>
                                    <select class="mb-2 form-control" name="statusOportunity" {{ $oportunity->user_id !== auth()->user()->id ? 'disabled' : '' }}>
                                      @foreach($statusOportunity as $status)
                                        <option value="{{$status->id}}" {{$oportunity && $status->id==$oportunity->status_id ? 'selected' : ''}}>{{App\StatusOportunity::getStatus((int)$status->id)}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                @endif
             </div>
                    </div>
                                <div class="row">
                                  <div class="col-12">

                                      <div class="row justify-content-center">
                                          <div class="col-12 justify-content-center">
                                              <div class="divider">
                                                @if(\Auth::user()->type !=="V" && $oportunity->user_id==\Auth::user()->id)
                                                  <div class="divider-text">Guardar tu publicacion</div>
                                                @elseif(\Auth::user()->type=="V" && App\Aplicant::verifyPostulation(\Auth::user()->id, $oportunity->id)==null)
                                                  <div class="divider-text">Postulate</div>
                                                @elseif(\Auth::user()->type=="V" && App\Aplicant::verifyPostulation(\Auth::user()->id, $oportunity->id)!=null)
                                                <div class="divider-text"></div>
                                                @endif

                                              </div>
                                          </div>

                                          <div class="col-12 justify-content-center content-btn-save-oportunity">
                                            <div id="botonera">
                                            @if(\Auth::user()->type !=="V" && $oportunity->user_id ==\Auth::user()->id)
                                              <button type="submit" name="guardar" value="guardar"
                                                      class="mb-1 mr-1 btn bg-gradient-primary waves-effect waves-light">
                                                    GUARDAR
                                              </button>
                                              @if ($oportunity->statusOportunity->description !== 'cerrada')
                                              <!--
                                                  <a href="{{ route('oportunity.change_status', [
                                                    'oportunity' => $oportunity->id, 'statusType' => 'cerrada'
                                                  ]) }}"
                                                     class="mx-auto mt-1 btn bg-gradient-danger waves-effect waves-light"
                                                     data-toggle="tooltip" title="Cerrar oportunidad">
                                                      CERRAR OPORTUNIDAD
                                                  </a> -->
                                              @else
                                                  <a href="{{ route('oportunity.change_status', [
                                                    'oportunity' => $oportunity->id, 'statusType' => 'activa'
                                                  ]) }}"
                                                     class="mb-1 mr-1 btn bg-gradient-warning waves-effect waves-light"
                                                     data-toggle="tooltip" title="Activar oportunidad">
                                                      ACTIVAR
                                                  </a>
                                              @endif
                                              <div class="mb-1 mr-1 btn-group" role="group">
                                                <button id="btnActionStatus" type="button"
                                                        class="mx-auto btn btn-flat-primary border-primary text-primary waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Cambiar Status
                                                </button>
                                                
                                                <div class="dropdown-menu" aria-labelledby="btnActionStatus">
                                                 
                                                  @if($oportunity->status_id !==2) 
                                                  <a class="dropdown-item" href="{{ route('oportunity.change_status', [
                                                    'oportunity' => $oportunity->id, 'statusType' => 'activa'
                                                  ]) }}">Publicar</a>
                                                  @endif
                                                  <a class="dropdown-item" href="{{ route('oportunity.change_status', [
                                                    'oportunity' => $oportunity->id, 'statusType' => 'cerrada'
                                                  ]) }}">Cerrar Oportunidad</a>
                                                    <a class="dropdown-item" href="{{ route('oportunity.change_status', [
                                                    'oportunity' => $oportunity->id, 'statusType' => 'cancelada'
                                                  ]) }}">Cancelada Publicacion</a>
                                                    <a class="dropdown-item" href="{{ route('oportunity.change_status', [
                                                    'oportunity' => $oportunity->id, 'statusType' => 'no+publicada'
                                                  ]) }}">No publicada</a>

                                                </div>
                                              </div>

                                            @elseif(\Auth::user()->type=="V" && App\Aplicant::verifyPostulation(\Auth::user()->id, $oportunity->id)==null)
                                              <button type="button"
                                                      class="mx-auto mt-1 btn btn-primary waves-effect waves-light"
                                                      name="candidatura"
                                                      data-toggle="modal"
                                                      data-target="#primary"
                                                      id="postularseBtn"
                                                      value="candidatura"
                                              >
                                                PRESENTAR MI CANDIDATURA
                                              </button>

                                            @elseif(\Auth::user()->type=="V" && App\Aplicant::verifyPostulation(\Auth::user()->id, $oportunity->id)!=null)
                                              <span> Ya te has postulado para esta oportunidad</span>
                                             @endif

                                             </div>
                                              {{--BEGIN:Modal--}}
                                              @if (\Auth::user()->type=="V" && App\Aplicant::verifyPostulation(\Auth::user()->id, $oportunity->id)==null)


                                                <div class="text-left modal fade" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                                  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                                                      <div class="modal-content">
                                                          <div class="modal-header bg-primary white">
                                                              <h5 class="modal-title" id="myModalLabel160">Postularme</h5>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                              </button>
                                                          </div>

                                                          <form method="POST" action="{{ route('oportunity.postulation') }}"
                                                                id="formPostular" enctype="multipart/form-data">
                                                              @csrf
                                                            <div class="modal-body">
                                                            Está a punto de enviar su candidatura a la oportunidad <span id="nameOportunity">{{$oportunity->title}}</span>
                                                              <div class="form-row">
                                                                <div class="mt-1 mb-1 col-md-12 col-12">
                                                                  <label class="mb-1" for="validationTooltip01">Deja un mensaje a la empresa para tu postulacion<span class="obligatorio"></span></label>
                                                                  <textarea class="form-control" name="message" rows="3" required></textarea>
                                                                  <input type="text" name="oportunity_id" value="{{$oportunity->id}}" hidden>
                                                                  {{-- <input type="text" name="status" value="1" hidden> --}}
                                                                </div>
                                                              </div>

                                                                <div class="form-group row">
                                                                  <label for="video" class="col-md-12 col-form-label ">
                                                                      <h4>{{ __('Vídeo') }}</h4>
                                                                  </label>

                                                                    <div class="col-md-12">

                                                                        <input id="video" type="file" class="form-control @error('video') is-invalid @enderror" name="video" value="" autocomplete="video" onchange="Filevalidation()">
                                                                        <small id="videoHelpBlock" class="form-text text-muted">
                                                                            El tamaño del vídeo debe ser como máximo 10MB.<br>
                                                                            Los formatos soportados son: .avi, .mpeg, .mp4 y .wmv
                                                                        </small>
                                                                        <p id="size"></p>
                                                                        @error('video')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" id="contact-directo" name="contact-directo" value="mensaje-directo" class="btn btn-primary">Confirmar</button>
                                                                @if($oportunity->user->status==1 && auth()->user()->type==="E")
                                                                    <button name="sala-chat" value="sala-chat"
                                                                            class="float-right btn btn-success">
                                                                        <a href='{{url("contact-by/$oportunity->user_id/op/oportunity/$oportunity->id")}}'
                                                                           class="text-white">
                                                                            Chat
                                                                            <i class="ml-1 text-white feather icon-message-circle"></i>
                                                                        </a>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                                </div>
                                                @endif

                                                {{--END: Modal--}}
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

@endsection

@section('extra-js')
    <script src="{{ asset('web/js/jquery-3.4.1.min.js') }}"></script>

     <script type='text/javascript'>

     Filevalidation = () => {
       console.log('validacion');
        const fi = document.getElementById('video');
        // Check if any file is selected.
        if (fi.files.length > 0) {
            for (let i = 0; i <= fi.files.length - 1; i++) {

                const fsize = fi.files.item(i).size;
                const file = Math.round((fsize / 1024));
                // The size of the file.
                if (file >= 10096) {
                    alert(
                      "El tamaño del vídeo debe ser como máximo 10MB.");
                      document.getElementById('video').value = null;
                } else {
                    document.getElementById('size').innerHTML = '<b>'
                    + file + '</b> KB';
                }
            }
        }
    }
    </script>


@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
