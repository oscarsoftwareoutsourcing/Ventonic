{{-- @extends('layouts.app') --}}
@extends('layouts.app-dashboard')

@section('content')

<div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Verifica tú dirección de correo') }}</div>

                            <div class="card-body">
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}
                                    </div>
                                @endif

                                {{ __('Antes de continuar, revise su correo electrónico con el enlace de verificación.') }}
                                {{ __('Si no recibiste el correo electrónico') }},
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                        {{ __('haga clic aquí para solicitar otro') }}
                                    </button>.
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>

@endsection
