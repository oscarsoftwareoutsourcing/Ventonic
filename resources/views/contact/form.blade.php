@extends('layouts.app-dashboard')

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>

            <div class="mb-1 new-header">
                <span  class="title"> Contacto</span>
            </div>

            <div class="">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        

                        <div class="card">
                            <div class="bg-gradient-primary">
                                <div class="card_vetonic-description">
                                    <div class="text_vetonic-description1"> Crear Contacto</div>
                                </div>
                            </div>
                            

                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{route('contact.save')}}" method="POST" class="form"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                @if (!is_string($contact) && isset($contact->image))
                                                    <div class="col-md-6 col-12">
                                                        <div class="users-view-image contact-image">
                                                            @php
                                                                $filename = ['filename'=>$contact->image];
                                                            @endphp
                                                            <img src="{{route('contact.image', $filename)}}"
                                                                 class="pr-2 mb-1 ml-1 contact-image" alt="avatar"
                                                                 width="180" height="120" >
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="form-group col-12">
                                                    <fieldset class="checkbox">
                                                        <div class="float-right vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox" name="favorito" id="favorito"
                                                                   {{App\Contact::checkedFavorite($contact) ?? ''}}>
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                            <span class="">Favorito</span>
                                                        </div>
                                                    </fieldset>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        @php
                                                            $disabledName = $contact =='persona' || $contact =='empresa'
                                                                            ? '' : 'disabled';
                                                        @endphp
                                                        <input type="text" id="nombre-column" placeholder="Nombre"
                                                               class="form-control @error('nombre') is-invalid @enderror"
                                                               name="nombre" value="{{$contact->name ?? ''}}" required
                                                               {{$disabledName}}>
                                                        <label for="first-name-column">Nombre</label>
                                                    </div>
                                                    @error('nombre')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        @php
                                                            $disabledLastName = $contact =='persona' || $contact=='empresa'
                                                                                ? '' : 'disabled';
                                                        @endphp
                                                        <input type="text" id="apellido-column" placeholder="Apellido"
                                                               class="form-control @error('apellido') is-invalid @enderror"
                                                               name="apellido" value="{{$contact->last_name ?? ''}}"
                                                               {{$disabledLastName}}>
                                                        <label for="last-name-column">Apellido</label>
                                                    </div>
                                                    @error('apellido')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                @if (is_string($contact))
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            @php
                                                                $disabledImage = $contact =='persona' || $contact =='empresa'
                                                                                 ? '' : 'disabled';
                                                            @endphp
                                                            <input type="file" id="image-column"
                                                                   class="form-control @error('image') is-invalid @enderror"
                                                                   placeholder="Imagen del contacto" name="image"
                                                                   {{$disabledImage}}>
                                                            <label for="last-name-column">Foto</label>
                                                        </div>
                                                        @error('image')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                @endif
                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        @php
                                                            $disabledEmail = $contact =='persona' || $contact =='empresa'
                                                                             ? '' : 'disabled';
                                                        @endphp
                                                        <input type="email" id="email-column" placeholder="Email"
                                                               class="form-control @error('email') is-invalid @enderror"
                                                               name="email" value="{{$contact->email ?? ''}}"
                                                               {{$disabledEmail}}>
                                                        <label for="city-column">Email</label>
                                                    </div>
                                                    @error('email')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        @php
                                                            $disabledWeb = $contact =='persona' || $contact =='empresa'
                                                                           ? '' : 'disabled';
                                                        @endphp
                                                        <input type="text" id="web-column" name="web" placeholder="Web"
                                                               class="form-control @error('web') is-invalid @enderror"
                                                               value="{{$contact->web ?? ''}}" {{$disabledWeb}}>
                                                        <label for="country-floating">Web</label>
                                                    </div>
                                                    @error('web')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        @php
                                                            $disabledPhone = $contact =='persona' || $contact =='empresa'
                                                                             ? '' : 'disabled';
                                                        @endphp
                                                        <input type="number" min=0 id="telefono-column"
                                                               class="form-control" name="telefono"
                                                               placeholder="Telefono" value="{{$contact->phone ?? ''}}"
                                                               {{$disabledPhone}}>
                                                        <label for="company-column">Telefono</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        @php
                                                            $disabledBussiness = $contact =='persona' || $contact =='empresa'
                                                                                 ? '' : 'disabled';
                                                        @endphp
                                                        <input type="text" id="empresa-column" name="empresa"
                                                               class="form-control  @error('empresa') is-invalid @enderror" placeholder="Empresa" value="{{$contact->company ?? ''}}"
                                                               {{$disabledBussiness}}>
                                                        <label for="email-id-column">Empresa</label>
                                                    </div>
                                                    @error('empresa')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        @php
                                                            $disabledPosition = $contact =='persona' || $contact =='empresa'
                                                                                ? '' : 'disabled';
                                                        @endphp
                                                        <input type="text" min=0 id="cargo-emprea-column"
                                                               class="form-control @error('cargo_empresa') is-invalid @enderror" name="cargo_empresa" placeholder="Cargo empresa"
                                                               value="{{$contact->cargo ?? ''}}" {{$disabledPosition}}>
                                                        <label for="company-column">Cargo Empresa</label>
                                                    </div>
                                                    @error('cargo_empresa')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        @php
                                                            $disabledPostalCode = $contact =='persona' || $contact =='empresa'
                                                                                  ? '' : 'disabled';
                                                        @endphp
                                                        <input type="text" id="codigo-postal-column" name="codigo_postal"
                                                               class="form-control @error('codigo_postal') is-invalid @enderror" placeholder="Código Postal"
                                                               value="{{$contact->postal_code ?? ''}}"
                                                               {{$disabledPostalCode}}>
                                                        <label for="email-id-column">Código Postal</label>
                                                    </div>
                                                    @error('codigo_postal')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                       <!-- <input type="text" id="sector-column" class="form-control @error('sector') is-invalid @enderror"
                                                        name="sector" placeholder="Sector" value="{{$contact->sector ?? ''}}" {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                        <label for="email-id-column">Sector</label> -->

                                                         <select class="form-control @error('etiquetas') is-invalid @enderror" id="sector-column" name="sector" {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                            <option value="">Sector</option>
                                                            @foreach($sectors as $sector)
                                                                <option value="{{$sector->id}}"
                                                                        {{ request()->sector==$sector->id?'selected':'' }}>
                                                                    {{$sector->description}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <label for="type-id-column">Sector</label>
                                                        
                                                    </div>
                                                    @error('sector')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                @if($contact =='persona' || $contact =='empresa')
                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        <select class="form-control @error('etiquetas') is-invalid @enderror" id="type-column" name="etiquetas" {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                            <option value="">Tipo de contacto</option>
                                                            @foreach ($contactTypes as $contactType)
                                                                <option value="{{ $contactType->id }}">
                                                                    {{ $contactType->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <label for="type-id-column">Tipo</label>
                                                    </div>
                                                    @error('etiquetas')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                @else
                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        <input type="text" id="sector2-column" class="form-control" value="{{$contact->type ?? ''}}" disabled>
                                                        <label for="email-id-column">Tipo</label>
                                                    </div>
                                                </div>
                                                @endif

                                                @if(is_string($contact))
                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                    <label for="validationTooltip01">Contacto visible para...</label> 
                                                    <select class="select2 form-control" multiple="multiple" name="private[]">
                                                        <option class="text-white" value="para mi"><strong>Solo para mi</strong></option>
                                                        <optgroup label="Para mi y un grupo especifico">
                                                            @foreach($groups as $group)
                                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                        <option class="text-white" value="todos">Para todos los grupos</option>
                                                    </select>
                                                <label for="compartir-id-column">Contacto visible para...</label>
                                                </div>
                                              </div>
                                              @endif

                                                <div class="col-md-12 col-12">
                                                    <div class="form-label-group">
                                                        <input type="text" id="sector-column" class="form-control" name="type_contact"
                                                        value="{{$contact=="empresa" || $contact=="persona" ? $contact : $contact->type_contact}}" hidden>
                                                        <textarea cols="3" id="anotaciones-column" class="form-control" name="anotaciones" placeholder="Anotaciones"
                                                        {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>{{$contact->notes ?? ''}}
                                                        </textarea>
                                                        <label for="email-id-column">Anotaciones</label>
                                                    </div>
                                                </div>


                                                <div class="col-md-12 col-12">
                                                    <div class="form-label-group">
                                                        <input type="text" id="address-input" class="form-control map-input @error('direccion_empresa') is-invalid @enderror"
                                                        name="direccion_empresa" placeholder="Direccion empresa" value="{{$contact->address ?? ''}}" {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                        <input type="text" class="form-control" id="address-latitude" value="{{$contact->address_latitude ?? ''}}" name="address_latitude" hidden>
                                                        <input type="text" class="form-control" id="address-longitude" value="{{$contact->address_longitude ?? ''}}" name="address_longitude" hidden>

                                                        <label for="company-column">Direccion Empresa</label>
                                                    </div>
                                                    @error('direccion_empresa')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                {{-- <div class="form-group col-12">
                                                    <fieldset class="checkbox">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox" name="compartir" id="compartir">
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                            <span class="">Compartir</span>
                                                        </div>
                                                    </fieldset>
                                                </div> --}}

                                                {{-- BEGIN Mapa --}}
                                                <div class="form-group col-12">
                                                    <div id="address-map-container" style="width:100%;height:400px; ">
                                                        <div style="width: 100%; height: 100%" id="address-map"></div>
                                                    </div>
                                                </div>
                                                {{-- END Mapa --}}

                                                <div class="col-12">
                                                    @if(!isset($contact->id))
                                                        <button type="submit" class="mb-1 mr-1 btn bg-gradient-primary">Guardar</button>
                                                        <button type="reset" class="float-right mb-1 mr-1 btn btn-outline-warning"
                                                            onclick="window.history.back()">Cancelar</button>
                                                    @endif
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
    </div>
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection

@section('extra-js')
    @parent
    <script src="{{ asset('js/scripts/forms/select/form-select2.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYrS-17BDDkWPgbjRS-hgmk24dyAOiBQk&libraries=places&callback=initialize" async defer>
    </script>
    <script src="{{ asset('js/geolocalizacion.js') }}"></script>
@endsection

