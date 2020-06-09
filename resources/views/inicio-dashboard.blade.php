@extends('layouts.app-dashboard')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">




                <div class="dashboard-ecommerce">
                <div class="row justify-content-center">

                    <div class="col-lg6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex flex-column align-items-start pb-0">
                                <div class="avatar bg-rgba-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-users text-primary font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700 mt-1">92.6k</h2>
                                <h3><a class="text-white" href="{{  route('oportunity.saved')  }}">Oportunidades</a></h3>
                            </div>
                            <div class="card-content" style="position: relative;">
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 350px; height: 101px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex flex-column align-items-start pb-0">
                                <div class="avatar bg-rgba-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-credit-card text-success font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700 mt-1">92.6k</h2>
                                <h3><a class="text-white" href="{{route('negociationCompany.index')}}">Negociaciones</a></h3>
                            </div>
                            <div class="card-content" style="position: relative;">
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 350px; height: 101px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex flex-column align-items-start pb-0">
                                <div class="avatar bg-rgba-danger p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-user text-danger font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700 mt-1">92.6k</h2>
                                <h3><a class="text-white" href="{{route('contact.list')}}">Contactos</a></h3>
                            </div>
                            <div class="card-content" style="position: relative;">
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 350px; height: 101px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex flex-column align-items-start pb-0">
                                <div class="avatar bg-rgba-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-calendar text-warning font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700 mt-1">92.6k</h2>
                                <h3><a class="text-white" href="calender">Calendario</a></h3>
                            </div>
                            <div class="card-content" style="position: relative;">
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 350px; height: 101px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
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
