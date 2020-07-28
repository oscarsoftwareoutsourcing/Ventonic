@extends('layouts.app-dashboard')

@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/extensions/tether-theme-arrows.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/extensions/tether.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/extensions/shepherd-theme-default.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/tables/ag-grid/ag-grid.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/tables/ag-grid/ag-theme-material.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/aggrid.css') }}">
@endsection

@section('content')
 <!-- BEGIN: Content-->
 <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Analytics Start -->
            <section id="dashboard-analytics">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="card bg-analytics text-white">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <img src="{{ asset('images/elements/decore-left.png') }}" class="img-left" alt="
        card-img-left">
                                    <img src="{{ asset('images/elements/decore-right.png') }}" class="img-right" alt="
        card-img-right">
                                    <div class="  mt-0">
                                        <img src="{{ asset('web/images/logo.png') }}" alt="
                                        Ventonic">
                                    </div>
                                    <br>
                                    <div class="text-center">
                                        <h1 class="mb-2 text-white">Bienvenido a Ventonic,  {{ Auth::user()->name }}</h1>
                                       
                                        <p class="m-auto w-75">Has generado <strong>57.6%</strong> más de oportunidades hoy.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        
                        <div class="card">
                             <div class="card-header d-flex justify-content-between pb-0">
                                <h4 class="card-title"></h4>
                                <div class="dropdown chart-dropdown">
                                    <button class="btn btn-sm border-0 dropdown-toggle px-0" type="button" id="dropdownItem3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Últimos 7 Días
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem3">
                                        <a class="dropdown-item" href="#">Esta semana</a>
                                        <a class="dropdown-item" href="#">Este mes</a>
                                        <a class="dropdown-item" href="#">Este Año</a>
                                        <a class="dropdown-item" href="#">Últimos 7 Días</a>
                                        <a class="dropdown-item" href="#">Últimos 30 Días</a>
                                        <a class="dropdown-item" href="#">Últimos 90 Días</a>
                                        <a class="dropdown-item" href="#">Último Año</a>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('contact.list')}}" alt="Contactos">
                            <div class="card-header d-flex flex-column align-items-start pb-0">
                                <div class="avatar bg-rgba-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-users text-primary font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700 mt-1 mb-25">92.6k</h2>
                                <p class="mb-0">Nuevos Contactos este mes</p>
                            </div>
                            <div class="card-content">
                                <div id="subscribe-gain-chart"></div>
                            </div>
                            </a>
                        </div>
                        
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between pb-0">
                                <h4 class="card-title"></h4>
                                <div class="dropdown chart-dropdown">
                                    <button class="btn btn-sm border-0 dropdown-toggle px-0" type="button" id="dropdownItem3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Últimos 7 Días
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem3">
                                        <a class="dropdown-item" href="#">Esta semana</a>
                                        <a class="dropdown-item" href="#">Este mes</a>
                                        <a class="dropdown-item" href="#">Este Año</a>
                                        <a class="dropdown-item" href="#">Últimos 7 Días</a>
                                        <a class="dropdown-item" href="#">Últimos 30 Días</a>
                                        <a class="dropdown-item" href="#">Últimos 90 Días</a>
                                        <a class="dropdown-item" href="#">Último Año</a>
                                    </div>
                                </div>
                            </div>
                             <a href="{{route('negociaciones')}}" alt="Negociaciones">
                            <div class="card-header d-flex flex-column align-items-start pb-0">
                                <div class="avatar bg-rgba-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-package text-warning font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700 mt-1 mb-25">97.5K</h2>
                                <p class="mb-0">Facturacion Total</p>
                            </div>
                            <div class="card-content">
                                <div id="orders-received-chart"></div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row pb-50">
                                        <div class="col-lg-6 col-12 d-flex justify-content-between flex-column order-lg-1 order-2 mt-lg-0 mt-2">
                                            <div>
                                                <h2 class="text-bold-700 mb-25">29</h2>
                                                <p class="text-bold-500 mb-75"><strong>Nuevos Contactos</strong></p>
                                                <h5 class="font-medium-2">
                                                    <span class="text-success">Contactos: +5.2% </span>
                                                    <span>en los últimos 7 días</span>
                                                </h5>
                                            </div>
                                            <a href="#" class="btn btn-primary shadow">Ver Detalles <i class="feather icon-chevrons-right"></i></a>
                                        </div>
                                        <div class="col-lg-6 col-12 d-flex justify-content-between flex-column text-right order-lg-2 order-1">
                                            <div class="dropdown chart-dropdown">
                                                <button class="btn btn-sm border-0 dropdown-toggle p-0" type="button" id="dropdownItem5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Últimos 7 Días
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem5">
                                                    <a class="dropdown-item" href="#">Últimos 28 Días</a>
                                                    <a class="dropdown-item" href="#">Último Mes</a>
                                                    <a class="dropdown-item" href="#">Último Año</a>
                                                </div>
                                            </div>
                                            <div id="avg-session-chart"></div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row avg-sessions pt-50">
                                        <div class="col-6">
                                            <p class="mb-0">Facturación: 121.230€</p>
                                            <div class="progress progress-bar-primary mt-25">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="50" aria-valuemax="100" style="width:50%"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-0">Clientes: 302</p>
                                            <div class="progress progress-bar-warning mt-25">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="60" aria-valuemax="100" style="width:60%"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-0">Clientes Perdidos: 25</p>
                                            <div class="progress progress-bar-danger mt-25">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="70" aria-valuemax="100" style="width:70%"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-0">En Negociación: 74</p>
                                            <div class="progress progress-bar-success mt-25">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="90" aria-valuemax="100" style="width:90%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between pb-0">
                                <h4 class="card-title">Contactos</h4>
                                <div class="dropdown chart-dropdown">
                                    <button class="btn btn-sm border-0 dropdown-toggle px-0" type="button" id="dropdownItem3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Últimos 7 Días
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem3">
                                        <a class="dropdown-item" href="#">Esta semana</a>
                                        <a class="dropdown-item" href="#">Este mes</a>
                                        <a class="dropdown-item" href="#">Este Año</a>
                                        <a class="dropdown-item" href="#">Últimos 7 Días</a>
                                        <a class="dropdown-item" href="#">Últimos 30 Días</a>
                                        <a class="dropdown-item" href="#">Últimos 90 Días</a>
                                        <a class="dropdown-item" href="#">Último Año</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body py-0">
                                    <div id="customer-chart"></div>
                                </div>
                                <ul class="list-group list-group-flush customer-info">
                                    <li class="list-group-item d-flex justify-content-between ">
                                        <div class="series-info">
                                            <i class="fa fa-circle font-small-3 text-primary"></i>
                                            <span class="text-bold-600">Ofertas de Negociación</span>
                                        </div>
                                        <div class="product-result">
                                            <span>29</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between ">
                                        <div class="series-info">
                                            <i class="fa fa-circle font-small-3 text-warning"></i>
                                            <span class="text-bold-600">Ofertas Aceptadas</span>
                                        </div>
                                        <div class="product-result">
                                            <span>12</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between ">
                                        <div class="series-info">
                                            <i class="fa fa-circle font-small-3 text-danger"></i>
                                            <span class="text-bold-600">Ofertas Perdidas</span>
                                        </div>
                                        <div class="product-result">
                                            <span>8</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row match-height">
              
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="card-title">Estadisticas de Ventas</h4>
                                    <p class="text-muted mt-25 mb-0">Últimos 3 Meses</p>
                                </div>
                                <p class="mb-0"><i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i></p>
                            </div>
                            <div class="card-content">
                                <div class="card-body px-0">
                                    <div id="sales-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Actividad Reciente</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="activity-timeline timeline-left list-unstyled">
                                        <li>
                                            <div class="timeline-icon bg-primary">
                                                <i class="feather icon-plus font-medium-2 align-middle"></i>
                                            </div>
                                            <div class="timeline-info">
                                                <p class="font-weight-bold mb-0">Reunión con el Cliente</p>
                                                <span class="font-small-3">Reunión para deiscutir presupuesto de venta</span>
                                            </div>
                                            <small class="text-muted">Hace minutos 25 </small>
                                        </li>
                                        <li>
                                            <div class="timeline-icon bg-warning">
                                                <i class="feather icon-alert-circle font-medium-2 align-middle"></i>
                                            </div>
                                            <div class="timeline-info">
                                                <p class="font-weight-bold mb-0">Enviar email con propuesta</p>
                                                <span class="font-small-3">Enviar email al cliente con propuesta de ventas</span>
                                            </div>
                                            <small class="text-muted">Hace 15 días</small>
                                        </li>
                                        <li>
                                            <div class="timeline-icon bg-danger">
                                                <i class="feather icon-check font-medium-2 align-middle"></i>
                                            </div>
                                            <div class="timeline-info">
                                                <p class="font-weight-bold mb-0">Planificación</p>
                                                <span class="font-small-3">Crear plan de trabajo y estrategia de ventas</span>
                                            </div>
                                            <small class="text-muted">Hace 20 días</small>
                                        </li>
                                        <li>
                                            <div class="timeline-icon bg-success">
                                                <i class="feather icon-check font-medium-2 align-middle"></i>
                                            </div>
                                            <div class="timeline-info">
                                                <p class="font-weight-bold mb-0">Puesta en producción de Website</p>
                                                <span class="font-small-3">Puesta en linea del portal web de la empresa </span>
                                            </div>
                                            <small class="text-muted">HAce 25 días</small>
                                        </li>
                                        <li>
                                            <div class="timeline-icon bg-primary">
                                                <i class="feather icon-check font-medium-2 align-middle"></i>
                                            </div>
                                            <div class="timeline-info">
                                                <p class="font-weight-bold mb-0">Marketing</p>
                                                <span class="font-small-3">Reunión con el equipo de mercadeo.</span>
                                            </div>
                                            <small class="text-muted">Hace 28 dias</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!---------------------->
                        <div id="basic-examples">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="ag-grid-btns d-flex justify-content-between flex-wrap mb-1">
                                                    <div class="dropdown sort-dropdown mb-1 mb-sm-0">
                                                        <button class="btn btn-white filter-btn dropdown-toggle border text-dark" type="button" id="dropdownMenuButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            1 - 20 of 50
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton6">
                                                            <a class="dropdown-item" href="#">20</a>
                                                            <a class="dropdown-item" href="#">50</a>
                                                        </div>
                                                    </div>
                                                    <div class="ag-btns d-flex flex-wrap">
                                                        <input type="text" class="ag-grid-filter form-control w-50 mr-1 mb-1 mb-sm-0" id="filter-text-box" placeholder="Buscar...." />
                                                        <div class="action-btns">
                                                            <div class="btn-dropdown ">
                                                                <div class="btn-group dropdown actions-dropodown">
                                                                    <button type="button" class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Actiones
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="#"><i class="feather icon-trash-2"></i> Eliminar</a>
                                                                        <a class="dropdown-item" href="#"><i class="feather icon-clipboard"></i> Archivar</a>
                                                                        <a class="dropdown-item" href="#"><i class="feather icon-printer"></i> Inprimir</a>
                                                                        <a class="dropdown-item" href="#"><i class="feather icon-download"></i>Exportar CSV</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="myGrid" class="aggrid ag-theme-material"></div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!---------------------->
                    </div>
                </div>
            </section>
            <!-- Dashboard Analytics end -->

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection


@section('extra-js-chart')
    <script src="{{ asset('vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendors/js/extensions/tether.min.js') }}"></script>
    
    <script src="{{ asset('js/scripts/pages/dashboard-analytics.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js') }}"></script>
    <script src="{{ asset('js/scripts/cards/card-customer-chart.js') }}"></script>
@endsection