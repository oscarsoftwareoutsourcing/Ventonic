@extends('layouts.auth-user')

@section('content')
<div class="col-xl-8 col-11 d-flex justify-content-center">
<div class="card bg-authentication rounded-0 mb-0">
    <div class="row m-0">
        <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
            <img src="{{ asset('images/pages/login.png') }}" alt="branding logo">
        </div>
        <div class="col-lg-6 col-12 p-0">
            <div class="card rounded-0 mb-0 px-2">
                <div class="card-header pb-1">
                    <div class="card-title">
                        <h4 class="mb-0">Accede como {{ ucfirst($type) }}</h4>
                    </div>
                </div>
                <p class="px-2">Encuentra a tu candidato de forma rápida, fácil y segura</p>
                <div class="card-content">
                    <div class="card-body pt-1">

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <fieldset class="form-label-group form-group position-relative has-icon-left">
                                <input id="email" type="email" placeholder="Email"  
                                class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                
                                <div class="form-control-position">
                                    <i class="feather icon-user"></i>
                                </div>
                                <label for="email">Email</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </fieldset>

                            <fieldset class="form-label-group position-relative has-icon-left">
                                <input id="password" type="Password" class="form-control" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="form-control-position">
                                    <i class="feather icon-lock"></i>
                                </div>
                                <label for="password">Contraseña</label>
                            </fieldset>
    
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <div class="text-left">
                                    <fieldset class="checkbox">
                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                            <span class="">Mantener mi sesión abierta</span>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="text-right">
                                    @if (Route::has('password.request'))
                                        <a  class="card-link" href="{{ route('password.request', ['type' => $type ?? 'vendedor']) }}">
                                            {{ __('¿Has olvidado tu contraseña?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
    
                                    <a href="
                                    @if ($type === "empresa")
                                        {{ route('register', ['type' => 'empresa']) }}
                                    @else
                                        {{ route('register') }}
                                    @endif" 
                                    class="btn btn-outline-primary float-left btn-inline">Crear cuenta</a>
                                <button type="submit" class="btn btn-primary float-right btn-inline">Inicia sesión</button>


                        </form>
                    </div>
                </div>
                <div class="login-footer">
                    <div class="divider">
                        
                    </div>
                    <div class="footer-btn d-inline">
                        @if ($type === "empresa")
                            <spanl>¿Eres vendedor? </spanl>
                            <a class="link" id="access-link"  title="Accede a tu cuenta" href="{{ route('register') }}">Regístrate</a>
                        @else
                            <span>¿Eres empresa? </span>
                            <a class="link" id="access-link"  title="Accede a tu cuenta" href="{{ route('register', ['type' => 'empresa']) }}">Regístrate</a>
                        @endif
                    </div>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection
