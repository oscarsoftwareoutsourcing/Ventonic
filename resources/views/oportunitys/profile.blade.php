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
                    <span  class="title">Contacts</span>
                </div>
        </div>
        <div >
            <section class="page-users-view">
                <div class="row">
                    <!-- account start -->
                    <div class="col-12">
                        <div class="card">
                            <div class="bg-gradient-primary">
                                <div class="card_vetonic-description">
                                    <div class="text_vetonic-description1">Datos Generales</div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="users-view-image">
                                        @if($seller_profile->photo)
                                        <img src="/{{$seller_profile->photo}}" class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                                        @endif
                                    </div>
                                    <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                        <table>
                                            <tr>
                                                <td class="font-weight-bold">Nombre</td>
                                                <td>{{$seller_profile->user->name}}</td>

                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Apellido</td>
                                                <td>{{$seller_profile->user->last_name}}</td>

                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Email</td>
                                                <td>{{$seller_profile->user->email}}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Chat</td>
                                                <td>
                                                    @if (App\Aplicant::getStatus((int)$seller_profile->user_id)==1)
                                                       {{-- <a  href="{{ route('contact-by', ['user_id' => $seller_profile->user_id, 'type' => 'ot']) }}" class="btn btn-icon btn-icon rounded-circle btn-success mr-1 mb-1 waves-effect waves-light" alt="Contactar al vendedor"><i class="feather icon-message-square"></i></a> --}}
                                                       <a  href="{{ route('contact-seller', ['id' => $seller_profile->user_id, 'is_js' => 'no']) }}" class="btn btn-icon btn-icon rounded-circle btn-success mr-1 mb-1 waves-effect waves-light" alt="Contactar al vendedor"><i class="feather icon-message-square"></i></a>
                                                    @else
                                                        {{-- <a href="{{ route('contact-by', ['user_id' => $seller_profile->user_id, 'type' => 'ot']) }}" class="btn btn-icon btn-icon rounded-circle btn-warning mr-1 mb-1 waves-effect waves-light"  alt="Dejar un mensaje al vendedor"><i class="ficon feather icon-mail"></i></a> --}}
                                                        <a href="{{ route('contact-seller', ['id' => $seller_profile->user_id, 'is_js' => 'no']) }}" class="btn btn-icon btn-icon rounded-circle btn-warning mr-1 mb-1 waves-effect waves-light"  alt="Dejar un mensaje al vendedor"><i class="ficon feather icon-mail"></i></a>
                                                    @endif
                                                </td>
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
                                                <td>{{App\Aplicant::getDate((int)$seller_profile->user_id)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Valoración</td>
                                                <td>
                                                    <rating-score :to-rate="false" :is-detail="true"
                                                                  :user="{{ $seller_profile->user }}"
                                                                  :inactive-color="'#10163A'"
                                                                  :active-color="'#0086FA'"
                                                                  :border-width="2" :star-size="16"
                                                                  :border-color="'#0086FA'"></rating-score>
                                                </td>
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
                            <div class="bg-gradient-primary">
                                <div class="card_vetonic-description">
                                    <div class="text_vetonic-description1">Informacion de Contacto</div>
                                </div>
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
                                    <td class="font-weight-bold">Móvil</td>
                                    <td>{{$seller_profile->phone_mobil_country.' '.$seller_profile->phone_mobil}}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold">LikedIn</td>
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
                            <div class="bg-gradient-primary">
                                <div class="card_vetonic-description">
                                    <div class="text_vetonic-description1">Video Perfil</div>
                                </div>
                            </div>

                            <div class="card-body" style="overflow:hidden; padding-bottom:5px;">
                                @if($seller_profile->video)
                                    <video id="sampleMovie" width="500" height="260" preload controls>
                                        <source src="/{{ $seller_profile->video }}" />
                                        <source src="/{{ $seller_profile->video }}" />
                                        <source src="/{{ $seller_profile->video }}" />
                                     </video>
                                @endif

                            </div>
                        </div>
                    </div>
                    <!-- social links end -->
                    <!-- permissions start -->
                    <div class="col-12">
                        <div class="card">
                            <div class="bg-gradient-primary">
                                <div class="card_vetonic-description">
                                    <div class="text_vetonic-description1"><i class="feather icon-user "></i>Experiencia</div>
                                </div>
                            </div>
                            <div class="card-body px-75">
                                <div class="list-group">
                                    {{-- @foreach($questions as $i=>$question)
                                    <p class="list-group-item text-primary">{{$question->name}}<span class="text-white"><code> Dapibus ac facilisis in</code></span></p>
                                    @endforeach --}}
                                    <p class="list-group-item text-primary">Años de experiencia en ventas <span class="text-white"><code>{{App\User::getAnsweredAnios($seller_profile->user_id, 2)}}</code></span></p>
                                    <p class="list-group-item text-primary">Areas de experiencia<span class="text-white"><code>{{App\User::getExperiencie($seller_profile->user_id, 3)}}</code></span></p>
                                    <p class="list-group-item text-primary">Disponibilidad<span class="text-white"><code>{{App\User::getDisponibilidad($seller_profile->user_id, 4)}}</code></span></p>
                                    <p class="list-group-item text-primary">Tipo de colaboración <span class="text-white"><code>{{App\User::getTipoColaboration($seller_profile->user_id, 5)}}</code></span></p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- permissions end -->
                    <div class="col-12">
                        <div class="card">
                            <div class="bg-gradient-primary">
                                <div class="card_vetonic-description">
                                    <div class="text_vetonic-description1">
                                        <i class="feather icon-user "></i>Comentarios
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-75">
                                <rating-show :user="{{ $seller_profile->user }}" :inactive-color="'#10163A'"
                                                 :active-color="'#0086FA'" :border-width="2"
                                                 :border-color="'#0086FA'"></rating-show>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('extra-js-app')
     <script src="{{ asset('js/app.js') }}"></script>
@endsection
