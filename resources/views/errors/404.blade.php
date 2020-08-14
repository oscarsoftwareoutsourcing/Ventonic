@extends('layouts.app-errors')

@section('content')

 <div class="card-content">
    <div class="card-body text-center">
        <img src="{{ asset('images/pages/404.png') }}" class="img-fluid align-self-center" alt="branding logo">
            <h1 class="font-large-2 my-1">404!</h1>
              <h3>¡La página que estás buscando no ha sido encontrada!
                <br>
                La página que está buscando podría haberse eliminado, haber cambiado su nombre o no estar disponible.
              </h3>
            <a class="btn btn-primary btn-lg mt-2" onclick="window.history.back();">Regresar</a>
    </div>
</div>

@stop
