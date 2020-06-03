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
                    {{-- BEGIND Filtros --}}
                    <div class="card">
                        <div class="card-header">
                            <h4>Crear contacto</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{route('contact.save')}}" method="POST" class="form">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                <input type="text" id="nombre-column" class="form-control @error('nombre') is-invalid @enderror" 
                                                       placeholder="Nombre" name="nombre" value="{{$contact->name ?? ''}}" required {{$contact ? 'disabled' : ''}}>
                                                    <label for="first-name-column">Nombre</label>
                                                </div>
                                                @error('nombre')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="apellido-column" class="form-control @error('apellido') is-invalid @enderror" placeholder="Apellido" 
                                                    name="apellido" value="{{$contact->last_name ?? ''}}" {{$contact ? 'disabled' : ''}}>
                                                    <label for="last-name-column">Apellido</label>
                                                </div>
                                                @error('apellido')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="email" id="email-column" class="form-control @error('email') is-invalid @enderror" placeholder="Email" 
                                                    name="email" value="{{$contact->email ?? ''}}" {{$contact ? 'disabled' : ''}}>
                                                    <label for="city-column">Email</label>
                                                </div>
                                                @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="web-column" class="form-control @error('web') is-invalid @enderror" name="web" placeholder="Web"
                                                    value="{{$contact->email ?? ''}}" {{$contact ? 'disabled' : ''}}>
                                                    <label for="country-floating">Web</label>
                                                </div>
                                                @error('web')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="number" min=0 id="telefono-column" class="form-control" name="telefono" placeholder="Telefono"  
                                                    value="{{$contact->phone ?? ''}}" {{$contact ? 'disabled' : ''}}>
                                                    <label for="company-column">Telefono</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="empresa-column" class="form-control  @error('empresa') is-invalid @enderror" name="empresa" placeholder="Empresa"
                                                    value="{{$contact->company ?? ''}}" {{$contact ? 'disabled' : ''}}>
                                                    <label for="email-id-column">Empresa</label>
                                                </div>
                                                @error('empresa')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="direccion-emprea-column" class="form-control @error('direccion_empresa') is-invalid @enderror" 
                                                    name="direccion_empresa" placeholder="Direccion empresa" value="{{$contact->address ?? ''}}" {{$contact ? 'disabled' : ''}}>
                                                    <label for="company-column">Direccion Empresa</label>
                                                </div>
                                                @error('direccion_empresa')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" min=0 id="cargo-emprea-column" class="form-control @error('cargo_empresa') is-invalid @enderror" 
                                                    name="cargo_empresa" placeholder="Cargo empresa" value="{{$contact->cargo ?? ''}}" {{$contact ? 'disabled' : ''}}>
                                                    <label for="company-column">Cargo Empresa</label>
                                                </div>
                                                @error('cargo_empresa')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="ciudad-empresa-column" class="form-control @error('ciudad_empresa') is-invalid @enderror" 
                                                    name="ciudad_empresa" placeholder="Ciudad empresa" value="{{$contact->city ?? ''}}" {{$contact ? 'disabled' : ''}}>
                                                    <label for="email-id-column">Ciudad Empresa</label>
                                                </div>
                                                @error('ciudad_empresa')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="provincia-column" class="form-control @error('provincia') is-invalid @enderror" 
                                                    name="provincia" placeholder="Provincia" value="{{$contact->province ?? ''}}" {{$contact ? 'disabled' : ''}}>
                                                    <label for="company-column">Provincia</label>
                                                </div>
                                                @error('provincia')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="empresa-column" class="form-control @error('empresa') is-invalid @enderror" 
                                                    name="codigo_postal" placeholder="Código Postal" value="{{$contact->postal_code ?? ''}}" {{$contact ? 'disabled' : ''}}>
                                                    <label for="email-id-column">Código Postal</label>
                                                </div>
                                                @error('empresa')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <label for="email-id-column">País</label>
                                                    <select class="form-control @error('pais') is-invalid @enderror" id="pais-column" name="pais" {{$contact ? 'disabled' : ''}}>
                                                        @foreach($countrys as $country)
                                                        <option {{$contact && $country->id==$contact->country_id ? 'selected' : ''}} value="{{$country->id}}">{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="email-id-column">Pais</label>
                                                </div>
                                                @error('pais')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="sector-column" class="form-control @error('sector') is-invalid @enderror" 
                                                    name="sector" placeholder="Sector" value="{{$contact->sector ?? ''}}" {{$contact ? 'disabled' : ''}}>
                                                    <label for="email-id-column">Sector</label>
                                                </div>
                                                @error('sector')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            @if(empty($contact))
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <select class="form-control" id="pais-column @error('etiquetas') is-invalid @enderror" name="etiquetas" {{$contact ? 'disabled' : ''}}>
                                                        <option {{$contact && $country->type=='Cliente' ? 'selected' : ''}} value="Cliente">Cliente</option>
                                                        <option {{$contact && $country->type=='Cliente Potencial' ? 'selected' : ''}} value="Cliente Potencial">Cliente Potencial</option>
                                                        <option {{$contact && $country->type=='Colaborador' ? 'selected' : ''}} value="Colaborador">Colaborador</option>
                                                        <option {{$contact && $country->type=='Proveedor' ? 'selected' : ''}} value="Proveedor">Proveedor</option>
                                                    </select>
                                                    <label for="email-id-column">Tipo</label>
                                                </div>
                                                @error('etiquetas')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            @else
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="sector-column" class="form-control" value="{{$contact->type ?? ''}}" disabled>
                                                    <label for="email-id-column">Tipo</label>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <textarea cols="3" id="anotaciones-column" class="form-control" name="anotaciones" placeholder="Anotaciones" 
                                                    {{$contact ? 'disabled' : ''}}>{{$contact->notes ?? ''}}
                                                    </textarea>
                                                    <label for="email-id-column">Anotaciones</label>
                                                </div>
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
                                            <div class="form-group col-12">
                                                <fieldset class="checkbox">
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="favorito" id="favorito" {{$contact ? 'checked' : ''}}>
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                        <span class="">Favorito</span>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-12">
                                                @if(!isset($contact->id))
                                                <button type="submit" class="btn btn-primary mr-1 mb-1">Guardar</button>
                                                <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Cancelar</button>
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