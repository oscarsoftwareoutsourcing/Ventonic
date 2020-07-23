@extends('layouts.app-dashboard')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/forms/select/select2.min.css') }}">
@endsection

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
                    <div class="header-ventonic-blue">
                    <div class="card-ventonic">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-12 ">
                                    <div class="text-ventonic-white">Contacto</div> 
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header_ventonic-description">
                            <div class="card_vetonic-description">
                                <div class="text_vetonic-description">
                                    Modificar Contacto
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{route('contact.update')}}" method="POST" class="form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            @if(!is_string($contact) && isset($contact->image))
                                                <div class="col-md-6 col-12">
                                                    <div class="users-view-image contact-image">
                                                        <img src="{{route('contact.image', ['filename'=>$contact->image])}}" class="contact-image mb-1 pr-2 ml-1" width="180" height="120" alt="avatar">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group col-12">
                                                <fieldset class="checkbox">
                                                    <div class="vs-checkbox-con vs-checkbox-primary float-right">
                                                        <input type="checkbox" name="favorito" id="favorito" {{App\Contact::checkedFavorite($contact) ?? ''}}>
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
                                                <input type="text" id="nombre-column" class="form-control @error('nombre') is-invalid @enderror" 
                                                       placeholder="Nombre" name="nombre" value="{{$contact->name ?? ''}}" required>
                                                    <label for="first-name-column">Nombre</label>
                                                </div>
                                                @error('nombre')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="apellido-column" class="form-control @error('apellido') is-invalid @enderror" placeholder="Apellido" 
                                                    name="apellido" value="{{$contact->last_name ?? ''}}">
                                                    <label for="last-name-column">Apellido</label>
                                                </div>
                                                @error('apellido')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="file" id="image-column" class="form-control @error('image') is-invalid @enderror" placeholder="Imagen del contacto" 
                                                    name="image">
                                                    <label for="last-name-column">Foto</label>
                                                </div>
                                                @error('image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="email" id="email-column" class="form-control @error('email') is-invalid @enderror" placeholder="Email" 
                                                    name="email" value="{{$contact->email ?? ''}}">
                                                    <label for="city-column">Email</label>
                                                </div>
                                                @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="web-column" class="form-control @error('web') is-invalid @enderror" name="web" placeholder="Web"
                                                    value="{{$contact->web ?? ''}}">
                                                    <label for="country-floating">Web</label>
                                                </div>
                                                @error('web')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="number" min=0 id="telefono-column" class="form-control" name="telefono" placeholder="Telefono"  
                                                    value="{{$contact->phone ?? ''}}">
                                                    <label for="company-column">Telefono</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="empresa-column" class="form-control  @error('empresa') is-invalid @enderror" name="empresa" placeholder="Empresa"
                                                    value="{{$contact->company ?? ''}}">
                                                    <label for="email-id-column">Empresa</label>
                                                </div>
                                                @error('empresa')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" min=0 id="cargo-emprea-column" class="form-control @error('cargo_empresa') is-invalid @enderror" 
                                                    name="cargo_empresa" placeholder="Cargo empresa" value="{{$contact->cargo ?? ''}}">
                                                    <label for="company-column">Cargo Empresa</label>
                                                </div>
                                                @error('cargo_empresa')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="codigo-postal-column" class="form-control @error('codigo_postal') is-invalid @enderror" 
                                                    name="codigo_postal" placeholder="Código Postal" value="{{$contact->postal_code ?? ''}}">
                                                    <label for="email-id-column">Código Postal</label>
                                                </div>
                                                @error('codigo_postal')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="sector2-column" class="form-control @error('sector') is-invalid @enderror" 
                                                    name="sector" placeholder="Sector" value="{{$contact->sector ?? ''}}">
                                                    <label for="email-id-column">Sector</label>
                                                </div>
                                                @error('sector')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <select class="form-control @error('etiquetas') is-invalid @enderror" id="etiqueta-column" name="etiquetas">
                                                        <option {{$contact->type=="Cliente" ? 'selected': ''}} value="Cliente">Cliente</option>
                                                        <option {{$contact->type=="Cliente Potencial" ? 'selected': ''}} value="Cliente Potencial">Cliente Potencial</option>
                                                        <option {{$contact->type=="Colaborador" ? 'selected': ''}} value="Colaborador">Colaborador</option>
                                                        <option {{$contact->type=="Proveedor" ? 'selected': ''}} value="Proveedor">Proveedor</option>
                                                    </select>
                                                    <label for="email-id-column">Tipo</label>
                                                </div>
                                                @error('etiquetas')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            {{-- <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                <label for="validationTooltip01">Contacto visible para...</label>
                                                <select class="select2 form-control" multiple="multiple" name="private[]">
                                                    <option class="text-white" value="para mi"><strong>Solo para mi</strong></option>
                                                    <optgroup label="Para mi y un grupo especifico">
                                                        @foreach($groups as $group)
                                                        <option {{App\ContactGroup::getContactGroup((int)$contact->id, (int)$group->id)==true ? 'selected' : ''}}value="{{$group->id}}">{{$group->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                    <option class="text-white" value="todos">Para todos los grupos</option>
                                                </select>
                                            <label for="compartir-id-column">Contacto visible para...</label>
                                            </div>
                                          </div> --}}

                                            <div class="col-md-12 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="sector-column" class="form-control" name="type_contact" 
                                                    value="{{$contact=="empresa" || $contact=="persona" ? $contact : $contact->type_contact}}" hidden>
                                                    <textarea cols="3" id="anotaciones-column" class="form-control" name="anotaciones" placeholder="Anotaciones" >{{$contact->notes ?? ''}}
                                                    </textarea>
                                                    <label for="email-id-column">Anotaciones</label>
                                                </div>
                                            </div>

 
                                            <div class="col-md-12 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="address-input" class="form-control map-input" 
                                                    name="direccion_empresa" placeholder="Dirección Empresa" value="{{$contact->address ?? ''}}">
                                                    <input type="text" class="form-control" id="address-latitude" value="{{$contact->address_latitude ?? ''}}" name="address_latitude" hidden>
                                                    <input type="text" class="form-control" id="address-longitude" value="{{$contact->address_longitude ?? ''}}" name="address_longitude" hidden>
                                                    <input type="hidden" class="form-control" value="{{$contact->id}}" name="contact_id">
                                                    {{-- <input type="" class="form-control" value="{{$contact->user_id}}" name="user_id"> --}}
                                                    <label for="company-column">Dirección Empresa</label>
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
                                                <button type="submit" class="btn btn-primary mr-1 mb-1">Guardar</button>
                                                <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Cancelar</button>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCN7QXrQX8mlDNTdtcSY5dzZzrVJ1516hw&libraries=places&callback=initialize" async defer>
<script>
<script src="{{ asset('js/geolocalizacion.js') }}"></script>
@endsection

