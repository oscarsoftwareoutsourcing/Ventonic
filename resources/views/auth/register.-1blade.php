@extends('layouts.auth-user')

@section('content')
<div class="col-xl-8 col-10 d-flex justify-content-center">
    <div class="card bg-authentication rounded-0 mb-0">
        <div class="row m-0">
            <div class="col-lg-6 d-lg-block d-none text-center align-self-center pl-0 pr-3 py-0">
                <img src="{{ asset('images/pages/register.jpg') }}" alt="Registro Ventonic">
            </div>
            <div class="col-lg-6 col-12 p-0">
                <div class="card rounded-0 mb-0 p-2">
                    <div class="card-header pt-50 pb-1">
                        <div class="card-title">
                            <h4 class="mb-0">Regístrate como Vendedor</h4>
                        </div>
                        <p class="px-2">Para continuar, inicia sesión o regístrate:</p>
                        <p class="px-2">¿Ya tienes una cuenta? <a href="{{ route('login', ['type' => 'vendedor']) }}">Accede aquí</a></p>
                    </div>
                 
                    <div class="divider"></div>
                    <div class="card-content">
                        <div class="card-body pt-0">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="type" value="V">

                        <div class="form-label-group">
                            <input type="text" class="form-control" id="name" placeholder="Nombre" title="Nombre" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="px-2 invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="name">Nombre</label>
                        </div>

                        <div class="form-label-group">
                            <input type="text"  id="last_name" placeholder="Apellido" title="Apellido" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                            @error('last_name')
                                <span class="px-2 invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="last_name">Apellido</label>
                        </div>

                        <div class="form-label-group">
                            <input type="email"  id="email" placeholder="Email" 
                            title="Email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" 
                            required autocomplete="email">
                            
                            <label for="email">Email</label>
                    
                            @error('email')
                                <span class="px-2 invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="password"  class="form-control" placeholder="Contraseña" title="Contraseña" required class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <label for="password">Contraseña</label>
                    
                            @error('password')
                                <span class="px-2 invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <fieldset class="checkbox">
                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                        <input class="custom-control-input  @error('accept_terms') is-invalid @enderror"
                                        type="checkbox" name="accept_terms" id="accept_terms" {{ old('accept_terms') ? 'checked' : '' }}>
                                        <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>
                                        <span class=""> Acepto las <a href="#"> Condiciones legales, del servicio</a> y la <a href="#">Información básica de privacidad. </a> 
                                        </span>
                                        @error('accept_terms')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <a href="auth-login.html" class="btn btn-outline-primary float-left btn-inline mb-50">Login</a>
                        <button type="submit" class="btn btn-primary float-right btn-inline mb-50"> {{ __('Registrar') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
