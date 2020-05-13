@extends('layouts.app-user')
@section('content')

<h2 class="mb-4">Regístrate como Vendedor</h2>
<p class="lead mb-4">Para continuar, inicia sesión o regístrate:</p>
<p>¿Ya tienes una cuenta? <a href="{{ route('login', ['type' => 'vendedor']) }}">Accede aquí</a></p>
        
<form class="form-row form-dark align-items-center" id="register"  method="POST" action="{{ route('register') }}">
    @csrf
    <input type="hidden" name="type" value="V">
    <div class="form-group col-sm-6">
        <input type="text" class="form-control" id="name" placeholder="Nombre" title="Nombre" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    <p id="span_name" class="error-info error-span">Campo obligatorio</p>
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>
    <div class="form-group col-sm-6">
        <input type="text" class="form-control"  id="last_name" placeholder="Apellido" title="Apellido" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

        <p id="span_lastName" class="error-info error-span">Campo obligatorio</p>

        @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
             
    <div class="form-group col-sm-6">
        <input type="email" class="form-control" id="email" placeholder="Email" title="Email" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        
        <p id="span_email" class="error-info error-span">Campo obligatorio</p>

        @error('email')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-sm-6">
        <input type="password" id="password"  class="form-control" placeholder="Contraseña" title="Contraseña" requiredclass="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <p id="span_password" class="error-info error-span">Campo obligatorio</p>
    </div>
           
    <div class="form-group col-sm-12">
        <div class="custom-control custom-checkbox my-1 mr-sm-2 form-group">
            <input class="custom-control-input  @error('accept_terms') is-invalid @enderror"
            type="checkbox" name="accept_terms" id="accept_terms" {{ old('accept_terms') ? 'checked' : '' }}>
            <label class="custom-control-label" for="accept_terms">
                Acepto las <a href="#"> Condiciones legales, del servicio</a> y la <a href="#">Información básica de privacidad. </a> 
            </label>
            @error('accept_terms')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group col-sm-12">
        <button type="submit" class="btn btn-primary" name="btnSend" id="btnSend">Registrarse</button>
    </div>


    <div class="w-100 d-block my-4 inner-empresa border-top">
        <p>¿Eres empresa?  
            <a class="link" id="access-link"  title="Accede a tu cuenta" href="{{ route('register', ['type' => 'empresa']) }}">Regístrate</a>
        </p>
    </div>
</form>

            <!-- SVG START -->
            <span class="position-absolute left-0 bottom-0 mb-n5 ml-n5 z-index-n1 d-none d-md-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="110" height="110" viewBox="0 0 110 110">
                <path class="fill-primary" d="M1602.62,632.3a6.31,6.31,0,1,1-6.31-6.315A6.309,6.309,0,0,1,1602.62,632.3Zm32.46,0a6.31,6.31,0,1,1-6.31-6.315A6.315,6.315,0,0,1,1635.08,632.3Zm32.46,0a6.315,6.315,0,1,1-6.32-6.315A6.318,6.318,0,0,1,1667.54,632.3Zm32.45,0a6.31,6.31,0,1,1-6.31-6.315A6.309,6.309,0,0,1,1699.99,632.3Zm-97.37,32.465a6.31,6.31,0,1,1-6.31-6.315A6.31,6.31,0,0,1,1602.62,664.769Zm32.46,0a6.31,6.31,0,1,1-6.31-6.315A6.316,6.316,0,0,1,1635.08,664.769Zm32.46,0a6.315,6.315,0,1,1-6.32-6.315A6.318,6.318,0,0,1,1667.54,664.769Zm32.45,0a6.31,6.31,0,1,1-6.31-6.315A6.31,6.31,0,0,1,1699.99,664.769Zm-97.37,32.465a6.31,6.31,0,1,1-6.31-6.315A6.308,6.308,0,0,1,1602.62,697.234Zm32.46,0a6.31,6.31,0,1,1-6.31-6.315A6.315,6.315,0,0,1,1635.08,697.234Zm32.46,0a6.315,6.315,0,1,1-6.32-6.315A6.317,6.317,0,0,1,1667.54,697.234Zm32.45,0a6.31,6.31,0,1,1-6.31-6.315A6.308,6.308,0,0,1,1699.99,697.234ZM1602.62,729.7a6.31,6.31,0,1,1-6.31-6.314A6.309,6.309,0,0,1,1602.62,729.7Zm32.46,0a6.31,6.31,0,1,1-6.31-6.314A6.315,6.315,0,0,1,1635.08,729.7Zm32.46,0a6.315,6.315,0,1,1-6.32-6.314A6.318,6.318,0,0,1,1667.54,729.7Zm32.45,0a6.31,6.31,0,1,1-6.31-6.314A6.309,6.309,0,0,1,1699.99,729.7Z" transform="translate(-1590 -626)"/>
              </svg>
            </span>
            <!-- SVG END -->
          </div>
          <div class="col-xl-6 col-lg-5 conten-img">
          </div>

@endsection
