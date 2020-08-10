@extends('layouts.app-errors')

@section('content')
    <div class="error-panel">
        <h1>403!</h1>
        <h3>¡Acceso denegado!</h3>
        <p>Se ha denegado el acceso de la petición solicitada.</p>
        <button type="button" class="btn btn-sm bt-primary" onclick="window.history.back();">Regresar</button>
    </div>
@stop
