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
                    <div class="card card-oportunity">
                        <div class="card-header"></div>
                     <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Buscar oportunidad..."
                                       v-model="searchSeller">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" @click="search()">
                                        Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipo</th>
                                    <th>Vacante</th>
                                    <th>Ubicacion</th>
                                    <th>Zona Horaria</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($oportunitys))
                                    @foreach($oportunitys as $i => $oportunity)
                                    <tr>
                                        <th scope="row">{{$i}}</th>
                                        <td>{{App\JobType::getType((int)$oportunity->job_type_id)}}</td>
                                        <td>{{App\Profesion::getProfesion((int)$oportunity->profesion_id)}}</td>
                                        <td>{{App\UbicationOportunity::getUbication((int)$oportunity->profesion_id)}}</td>
                                        <td>{{App\TimeZoneOportunity::getTime((int)$oportunity->time_zone_id)}}</td>
                                        {{-- {{-- <td>{{$oportunity->profesion}}</td> --}}
                                        <td></td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- <table class="table table-hover table-striped dt-responsive nowrap display datatable">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Última Conexión</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="seller in sellers">
                                <td>{{ seller.name }}</td>
                                <td>{{ seller.last_name }}</td>
                                <td>{{ seller.email }}</td>
                                <td>{{ seller.last_login }}</td>
                                <td>{{ getStatus(seller.status) }}</td>
                                <td>
                                    <div v-if="seller.seller_profile">
                                        <button @click="toChat(seller.seller_profile.user_id)"
                                                class="btn btn-outline-primary btn-sm"
                                                data-toggle="tooltip"
                                                :title="seller.status ? 'Contactar a este vendedor' : 'Vendedor no disponible'"
                                                :disabled="!seller.status">
                                            <i class="fas fa-comments"></i>
                                        </button>
                                        <form action="/chat" method="POST" :id="'chat_'+seller.seller_profile.user_id">
                                            <input type="hidden" name="_token" :value="token">
                                            <input type="hidden" name="user" :value="seller.seller_profile.user_id">
                                        </form>
                                    </div>
                                    <div v-else>
                                        <button class="btn btn-outline-primary btn-sm"
                                                data-toggle="tooltip"
                                                :title="seller.status ? 'Contactar a este vendedor' : 'Vendedor no disponible'"
                                                disabled>
                                            <i class="fas fa-comments"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table> --}}
                </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

