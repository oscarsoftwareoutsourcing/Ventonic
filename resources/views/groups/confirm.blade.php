@extends('layouts.app-dashboard')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header justify-content-center border-bottom pb-1">
                            <h5>Nueva Invitacion Recibida</h5>
                        </div>
                        <div class="card-body justify-content-center">
                            <h5 class="mb-3">Saludos {{auth()->user()->name}}!</h5>
                                <p>Has sido invitado por <b>{{App\Group::getName($group->user_id)}}</b> a unirte al grupo <b>"{{$group->name}}"</b></p>
                            <p class="mb-2">¿Deseas aceptar la invitación?</p>
  
                            <a href="{{route('groups.cancel',['id_group'=>$group->id,'invitacion_id'=>$invitacion_id])}}" 
                                type="button" class="btn btn-secondary text-primary mb-2 mr-1">
                            Cancelar
                            </a>
                            <a href="{{route('groups.confirm',['id_group'=>$group->id,'invitacion_id'=>$invitacion_id])}}" type="button" class="btn btn-primary mb-2">Aceptar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('extra-js')
<script src="{{ asset('js/oportunitys/oportunitys.js') }}"></script>
@endsection
