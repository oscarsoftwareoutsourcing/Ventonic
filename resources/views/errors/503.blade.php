@extends('layouts.app-errors')

@section('content')
    <div class="card-content">
    <div class="card-body text-center">
        <img src="{{ asset('images/pages/maintenance-2.png') }}" class="img-fluid align-self-center" alt="branding logo">
            <h1 class="font-large-2 my-1">503!</h1>
              <h3>¡El servicio no esta disponible!
                <br>
               Actualmente no es posible acceder a la aplicación debido a labores de mantenimiento.
              </h3>
            <a class="btn btn-primary btn-lg mt-2" onclick="window.history.back();">Regresar</a>
    </div>
    </div>
@stop
