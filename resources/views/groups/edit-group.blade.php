@extends('layouts.app-dashboard')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="mb-1 new-header">
                <span  class="title"> Gestion de grupos de usuarios</span>
            </div>
            <div class="">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <div class="mb-2 card">
                            <div class="bg-gradient-primary">
                                <div class="card_vetonic-description">
                                    <div class="text_vetonic-description1"> Editar grupo de usuarios</div>
                                </div>
                            </div>
                            
                            <div class="card-content">
                                <div class="card-body">
                                @if(session('message'))
                                    <div class="alert alert-success">
                                        <button type="button" class="text-white close" id="dismiss" data-dismiss="alert">&times;</button>
                                        {{session('message')}}
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        <button type="button" class="text-white close" id="dismiss" data-dismiss="alert">&times;</button>
                                        {{session('error')}}
                                    </div>
                                @endif
                                    <form action="{{route('group.update')}}" class="form form-vertical" method="POST">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-icon">Nombre del grupo</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" id="first-name-icon"
                                                                   value="{{$group->name}}" class="form-control"
                                                                   name="name" placeholder=""
                                                                   {{$group->user_id != auth()->user()->id ? 'disabled' : ''}}>
                                                            <input type="text" id="first-name-icon"
                                                                   value="{{$group->id}}" class="form-control"
                                                                   name="group_id" placeholder="" hidden>
                                                            <div class="form-control-position">
                                                                <i class="feather icon-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($group->user_id == auth()->user()->id)
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-icon">Invitar usuarios</label>
                                                            <div class="position-relative has-icon-left">
                                                                {{-- <input type="email" id="first-name-icon" class="form-control" name="email[]" placeholder="Nombre del grupo"> --}}
                                                                <input type="email" id="email-icon" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-mail"></i>
                                                                </div>
                                                            </div>
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert" style="display:block">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                     <div class="col-12">
                                                    @if($group->user_id == auth()->user()->id)
                                                    <a href="{{route('group.show')}}" class="float-right mb-1 mr-1 btn btn-outline-warning">Cancelar</a>

                                                    <button type="submit" class="float-left mb-1 mr-1 btn bg-gradient-primary">Invitar al Grupo</button>
                                                    @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--  -->

                        <div class="card">
                            <div class="bg-gradient-primary">
                                <div class="card_vetonic-description">
                                    <div class="text_vetonic-description1">Usuarios en este grupo</div>
                                </div>
                            </div>
                            
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{route('group.update')}}" class="form form-vertical" method="POST">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <!-- DataTable starts -->
                                                        {{-- <div class="table-responsive"> --}}
                                                            <table id="datatable" class="table mt-2 data-list-view" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th><!-- columna para la imagen -->
                                                                        <th>Usuario</th>
                                                                        <th>Nombre</th>
                                                                        <th>Tipo</th><!-- si es empresa o vendedor -->
                                                                        <th>Opciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($userGroup as $groupUsr)
                                                                        <tr>
                                                                            <td>
                                                                                @if ($groupUsr->user->photo !== null)
                                                                                    <img src="{{ $groupUsr->user->photo }}"
                                                                                         class="img-fluid"
                                                                                         alt="imagen" style="max-width: 30px">
                                                                                @else
                                                                                    <img src="{{ url('/images/anonymous-user.png') }}"
                                                                                         alt="imagen" class="img-fluid"
                                                                                         style="max-width: 30px">
                                                                                @endif
                                                                            </td>
                                                                            <td>{{ $groupUsr->user->email }}</td>
                                                                            <td>{{ $groupUsr->user->name }}</td>
                                                                            <td>{{ $groupUsr->user->type }}</td>
                                                                            <td style="padding: 0 8%;">
                                                                                <a data-toggle="modal" data-target="#deleteModalUser"
                                                                                   onclick="setDeleteUser({{ $group->id }},{{ $groupUsr->user->id }})"
                                                                                   class="float-left">
                                                                                    <i class="text-white feather icon-trash-2"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        {{-- </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="bg-gradient-primary">
                                <div class="card_vetonic-description">
                                    <div class="text_vetonic-description1">Estatus de invitaciones</div>
                                </div>
                            </div>
                            
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{route('group.update')}}" class="form form-vertical" method="POST">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <!--  -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                         <!-- DataTable starts -->
                                                        {{-- <div class="table-responsive"> --}}
                                                            <table id="datatable" class="table mt-2 data-list-view" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Email</th>
                                                                        <th>Estatus</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($invitations as $invitation)
                                                                        <tr>
                                                                            <td>{{ $invitation->email }}</td>
                                                                            <td>{{ $invitation->status }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        {{-- </div> --}}
                                                    </div>
                                                </div>
                                                <!-- DataTable ends -->
                                                <div class="col-12">
                                                    @if($group->user_id == auth()->user()->id)
                                                    <a href="{{route('group.show')}}" class="float-left mb-1 mr-1 btn btn-outline-primary">Regresar</a>
                                                    
                                                    <a href="{{route('group.show')}}" class="float-left mb-1 mr-1 btn btn-outline-warning">Cancelar</a>
                                                    @else
                                                    
                                                    @endif
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

        <div class="text-left modal fade" id="deleteModalUser" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel160" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary white">
                        <h5 class="modal-title" id="myModalLabel160">Eliminar usuario del grupo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="text-white modal-body">
                        Está a punto de eliminar un usuario de este grupo ¿Esta seguro de continuar?
                        <input type="hidden" id="group_id_modal">
                        <input type="hidden" id="user_id_modal">
                    </div>
                    <div class="modal-footer">
                        <a class="float-right btn btn-primary" onclick="deleteUser()">
                            Confirmar
                        </a>
                        <a class="btn btn-secondary text-primary" data-dismiss="modal">Cancelar</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('extra-js')
    <script src="{{ asset('js/oportunitys/oportunitys.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script>$("#datatable").DataTable();</script>

    <script>
        function setDeleteUser(group_id, user_id) {
            $("#deleteModalUser").find("#user_id_modal").val(user_id);
            $("#deleteModalUser").find("#group_id_modal").val(group_id);
        }

        function deleteUser() {
            const group_id = $("#deleteModalUser").find("#group_id_modal").val();
            const user_id = $("#deleteModalUser").find("#user_id_modal").val();
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
    </script>
@endsection
