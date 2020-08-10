@extends('layouts.app-errors')

@section('content')
    <div class="error-panel">
        <h1>405!</h1>
        <h3>¡Método no permitido!</h3>
        <p>
            El método que estas usando para acceder no esta permitido.
        </p>
        <button type="button" class="btn btn-sm bt-primary" onclick="window.history.back();">Regresar</button>
    </div>
@stop
