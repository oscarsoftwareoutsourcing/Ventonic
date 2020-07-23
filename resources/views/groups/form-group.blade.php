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
                        <div class="card-header">
                            <h4 class="card-title">Crear grupo de usuarios</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{route('group.saved')}}" class="form form-vertical" method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-icon">Nombre del grupo</label>
                                                    <div class="position-relative has-icon-left">
                                                        <input type="text" id="first-name-icon" class="form-control" name="name" placeholder="Nombre del grupo">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-icon">Usuarios en este grupo</label>
                                                    <select class="select2 form-control" multiple="multiple" id="" name="users[]">
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> --}}
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-icon">Invitar usuarios</label>
                                                    <div class="position-relative has-icon-left">
                                                        {{-- <input type="email" id="first-name-icon" class="form-control" name="email[]" placeholder="Nombre del grupo"> --}}
                                                        <input type="email" id="email-icon" class="form-control" name="email" placeholder="Email">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-mail"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1 mb-1 float-right">Guardar Cambios</button>
                                                <a href="{{route('group.show')}}" type="button" class="btn btn-outline-warning mr-1 mb-1 float-left">Cancelar</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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