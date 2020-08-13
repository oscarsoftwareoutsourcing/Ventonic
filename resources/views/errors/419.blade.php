@extends('layouts.app-errors')

@section('content')

    <div class="card-content">
    <div class="card-body text-center">
        <img src="{{ asset('images/pages/not-authorized.png') }}" class="img-fluid align-self-center" alt="branding logo">
            <h1 class="font-large-2 my-1">419!</h1>
              <h3>La página ha expirado debido a inactividad.
                <br>
               Por favor, actualice y pruebe de nuevo.
              </h3>
            <a class="btn btn-primary btn-lg mt-2" onclick="window.location.assign(window.location.href)">Regresar</a>
    </div>
    </div>
@stop
