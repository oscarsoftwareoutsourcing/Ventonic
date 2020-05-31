@extends('layouts.app-dashboard')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="container">
            <section class="page-users-view">
                <div class="row">
                    <!-- account start -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Datos Generales</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="users-view-image">
                                        <img src="{{$seller_profile->photo}}" class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                                    </div>
                                    <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                        <table>
                                            <tr>
                                                <td class="font-weight-bold">Nombre</td>
                                                <td>{{App\Aplicant::getDatos((int)$seller_profile->user_id, 'name')}}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Apellido</td>
                                                <td>{{App\Aplicant::getDatos((int)$seller_profile->user_id, 'surname')}}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Email</td>
                                                <td>{{App\Aplicant::getDatos((int)$seller_profile->user_id, 'email')}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-5">
                                        <table class="ml-0 ml-sm-0 ml-lg-0">
                                            <tr>
                                                <td class="font-weight-bold">Status</td>
                                                @if($seller_profile->status==1)
                                                <td>activo</td>
                                                @else
                                                <td>inactivo</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Rol</td>
                                                <td>Vendedor</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Fecha de Registro</td>
                                                <td>{{App\Aplicant::getDatos((int)$seller_profile->user_id, 'date')}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    {{-- <div class="col-12">
                                        <a href="app-user-edit.html" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i> Edit</a>
                                        <button class="btn btn-outline-danger"><i class="feather icon-trash-2"></i> Delete</button>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- account end -->
                    <!-- information start -->
                    <div class="col-md-6 col-12 ">
                        <div class="card information-card">
                            <div class="card-header">
                                <div class="card-title mb-2">Informacion de Contacto</div>
                            </div>
                            <div class="card-body">
                                <table>
                                    {{-- <tr>
                                        <td class="font-weight-bold">Fecha de Nacimiento </td>
                                        @if(isset($seller_profile->user_id))
                                        <td>28 January 1998
                                        </td>
                                        @endif
                                    </tr> --}}

                                    <tr>
                                    <td class="font-weight-bold">Mobil</td>
                                    <td>{{$seller_profile->phone_mobil_country.' '.$seller_profile->phone_mobil}}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold">Likeind</td>
                                        {{-- @if(isset($seller_profile->likeind)) --}}
                                            <td>{{$seller_profile->linkeind}}
                                            </td>
                                        {{-- @else
                                            <td>Sin especificar
                                            </td>
                                        @endif --}}
                                    </tr>
                                    {{-- <tr>
                                        <td class="font-weight-bold">Gender</td>
                                        <td>female</td>
                                    </tr> --}}
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- information start -->
                    <!-- social links end -->
                    <div class="col-md-6 col-12 ">
                        <div class="card information-card">
                            <div class="card-header">
                                <div class="card-title">Video Perfil</div>
                            </div>
                            <div class="card-body" style="overflow:hidden; padding-bottom:5px;">
                                @if($seller_profile->video)
                                <video src="{{$seller_profile->video}}" style="width:100%!important;">
                                </video>
                                @endif    
                            </div>
                        </div>
                    </div>
                    <!-- social links end -->
                    <!-- permissions start -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-bottom mx-2 px-0">
                                <h6 class="py-1 mb-0 font-medium-2"><i class="feather icon-user "></i>Experiencia
                                </h6>
                            </div>
                            <div class="card-body px-75">
                                <div class="list-group">
                                    @foreach($questions as $question)
                                    <p class="list-group-item text-primary">{{$question->name}}<span class="text-white"><code> Dapibus ac facilisis in</code></span></p>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- permissions end -->
                </div>
            </section>
        </div>
    </div>
</div>
@endsection