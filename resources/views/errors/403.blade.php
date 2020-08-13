@extends('layouts.app-errors')

@section('content')

<div class="card-content">
    <div class="card-body text-center">
        <img src="{{ asset('images/pages/500.png') }}" class="img-fluid align-self-center" alt="branding logo">
            <h1 class="font-large-2 my-1">403 - ¡Acceso denegado!</h1>
            <h3>
                Se ha denegado el acceso de la petición solicitada.
            </h3>
            <a class="btn btn-primary btn-lg mt-2" onclick="window.history.back();">Regresar</a>
    </div>
</div>

@stop
