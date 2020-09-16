@extends('layouts.app-dashboard')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>

        <div class="row">
            <div class="new-header mb-1">
                <span  class="title"> Gestion de grupos de usuarios</span>
            </div>
        </div>
        <div class="">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="card">
                    @if(session('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close text-white" id="dismiss" data-dismiss="alert">&times;</button>
                            {{session('message')}}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close text-white" id="dismiss" data-dismiss="alert">&times;</button>
                            {{session('error')}}
                        </div>
                    @endif
                      


                        <div class="card-header">
                            <div>
                                <a type="button" href="{{route('group.form')}}" class="btn bg-gradient-primary btn-md text-white"><i class="feather icon-users text-white"></i> Nuevo grupo </a><span>  o puedes <a href="{{route('contact.list')}}" class="text-primary">gestionar los contactos</a> de tu cuenta</span>
                            </div>
                        </div>
                        @if($groups!=null)
                        <div class="card-body px-75">
                            <div class="list-group">
                                @foreach($groups as $group)
                                    <a href="{{route('group.edit', ['group_id'=> $group->id])}}">
                                        <p class="list-group-item text-primary">
                                            {{$group->name}}
                                            <span class="text-white">
                                                <code>
                                                    <i class='feather icon-user'></i>
                                                    {{-- {{App\Group::getUserByGroup($group->id)}} --}}
                                                    {{ $group->user->name . ' ' . $group->user->last_name }}
                                                </code>
                                            </span>
                                        </p>
                                    </a>
                                @endforeach
                                @if(isset($groups_added) && $groups_added!=null)
                                    @foreach($groups_added as $group)
                                        <a href="javascript:void(0)">
                                            <p class="list-group-item text-primary">
                                                {{$group->group->name}}
                                                <span class="text-white">
                                                    <code>
                                                        <i class='feather icon-user'></i>
                                                        {{-- {{App\Group::getUserByGroup($group->group_id)}} --}}
                                                        Invitado
                                                    </code>
                                                    <button type="button" class="btn btn-sm btn-warning"
                                                            onclick="exitGroup({{ $group->group_id }}, {{ $group->user_id }})"
                                                            data-toggle="tooltip" title="Salir de este grupo">X</button>
                                                </span>
                                            </p>
                                        </a>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                        @else
                        <div class="card-body px-75">
                            <div class="list-group">
                                <p class="list-group-item text-primary">No ha registrado ningún grupo de usuarios</p>
                            </div>
                        </div>
                        @endif
                    </div>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-header mb-1">
                        <h4 class="card-title">Grupo de Usuarios</h4>
                        </div>
                        <div class="card-content p-2">
                        <div class="embed-responsive embed-responsive-item embed-responsive-16by9">
                            <!-- <div v-html="callme.iframe"></div> -->
                            <video id="sampleMovie" width="100%" preload controls>
                            <source src="{{ asset('video/grupos.mp4') }}" />
                            <source src="{{ asset('video/grupos.mp4') }}" />
                            <source src="{{ asset('video/grupos.mp4') }}" />
                            </video>
                        </div>
                        <div class="card-body">
                            <div></div>
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
    <script>
        /**
         * Ejecuta la acción para darse de baja de un grupo
         *
         * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
         *
         * @param     {integer}     group_id    Identificador del grupo
         * @param     {integer}     user_id     Identificador del usuario a dar de baja
         */
        function exitGroup(group_id, user_id) {
            bootbox.confirm({
                title: 'Dar de baja',
                message: "Se va a dar de baja en este grupo, ¿Está seguro de continuar?",
                callback: function(result) {
                    if (result) {
                        axios.post('{{ route('group.destroy') }}', {
                            group_id: group_id,
                            user_id: user_id
                        }).then(response => {
                            if (response.data.result) {
                                location.reload();
                            }
                        }).catch(error => {
                            console.error(error);
                        });
                    }
                }
            });
        }
    </script>
@endsection
