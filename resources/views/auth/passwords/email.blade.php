@extends('layouts.app-user')

@section('content')

<h2 class="mb-4" data-type="{{ ucfirst($type) }}">Recuperar contraseña </h2>
@if (session('status'))
  <div class="alert alert-success" role="alert">
      {{ session('status') }}
  </div>
@endif

<form class="form-row form-dark align-items-center" method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group col-sm-12">
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
      @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group col-sm-6">
      <div class="custom-control custom-checkbox my-1 mr-sm-2 form-group">
        
      </div>
    </div>
    <div class="form-group col-sm-6 text-left text-sm-right">
      <a href="
      @if ($type === "empresa")
        {{ route('login', ['type' => 'empresa']) }}
        @else
        {{ route('login', ['type' => 'vendedor']) }}
        @endif">Volver a intentar el acceso</a>
    </div>
    <div class="form-group col-sm-12">
      <button type="submit" class="btn btn-primary btn-block">Enviar enlace de restablecimiento de contraseña</button>
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
<div class="col-xl-6 col-lg-5 
@if ($type === "empresa")
        conten-img-recover-empresa 
      @else
        conten-img-recover
      @endif
">
</div>
@endsection
