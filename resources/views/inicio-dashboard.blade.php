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
                     <div class="card-body menu-dashboard">
                        <div class="menu-item-principal">
                        <h4><a class="text-white" href="{{route('oportunity.list')}}">Oportunidades</a></h4>
                        </div>
                        <div class="menu-item-principal">
                            <h4><a class="text-white" href="{{route('negociationCompany.index')}}">Negociaciones</a></h4>
                        </div>
                        <div class="menu-item-principal">
                            <h4><a class="text-white" href="{{route('contact.list')}}">Contactos</a></h4>
                            {{-- @include('includes.widget-contact') --}}
                        </div>
                        <div class="menu-item-principal">
                            <h4><a class="text-white" href="calender">Calendario</a></h4>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection