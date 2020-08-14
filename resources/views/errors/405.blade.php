@extends('layouts.app-errors')

@section('content')
    <div class="card-content">
    <div class="card-body text-center">
        <img src="{{ asset('images/pages/not-authorized.png') }}" class="img-fluid align-self-center" alt="branding logo">
            <h1 class="font-large-2 my-1">405!</h1>
              <h3>¡Método no permitido!
                <br>
               El método que estas usando para acceder no esta permitido.
              </h3>
            <a class="btn btn-primary btn-lg mt-2" onclick="window.history.back();">Regresar</a>
    </div>
    </div>
@stop
