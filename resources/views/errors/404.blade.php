@extends('layouts.app-errors')

@section('content')
    <div class="error-panel">
        <h1>404!</h1>
        <h3>¡La página que estás buscando no ha sido encontrada!</h3>
        <p>
            La página que está buscando podría haberse eliminado, haber cambiado su nombre o no estar disponible.
        </p>
        <button type="button" class="btn btn-sm bt-primary" onclick="window.history.back();">Regresar</button>
    </div>
@stop
