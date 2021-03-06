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
                 <form action='{{ route('me.dash') }}' method="POST" enctype="multipart/form-data">
                <div class="mb-2 row">
                   
                        @csrf
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            <h2 class="alert-heading">Dash Demo</h2>
                                <p class="mb-0">
                                  Así es como puede mostrarse tu Dashboard cuando empieces a registrar tu actividad en Ventonic
                                </p>
                        </div>
                        <div class="float-left mr-auto bookmark-wrapper d-flex align-items-center">
                             <fieldset class="checkbox">
                                <div class="float-right vs-checkbox-con vs-checkbox-primary">
                                    <input type="checkbox" name="favorito" id="favorito">
                                        <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>
                                    <span class="">No volver a mostrar este mensaje</span>
                                </div>
                            </fieldset>
                        </div>
                        <div class="float-right mr-auto bookmark-wrapper d-flex align-items-center">
                            <button type="submit" class="mb-1 mr-1 text-white btn bg-gradient-primary waves-effect waves-light">Ver Mi Dashboard</button>
                            <!--
                            <a type="button" class="mb-1 mr-1 text-white btn bg-gradient-primary waves-effect waves-light"
                            href="{{ route('me.dash') }}" title="Mi Dashboard">
                                Ver Mi Dashboard
                            </a>
                        -->
                        </div>
                    </div>
                   

                </div>
                 </form>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="text-white card bg-analytics">
                            <div class="card-content">
                                <div class="text-center card-body">
                                    <img src="{{ asset('images/elements/decore-left.png') }}" class="img-left" alt="
        card-img-left">
                                    <img src="{{ asset('images/elements/decore-right.png') }}" class="img-right" alt="
        card-img-right">
                                    <div class="mt-0 ">
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
                             <div class="pb-0 card-header d-flex justify-content-between">
                                <h4 class="card-title"></h4>
                                <div class="dropdown chart-dropdown">
                                    <button class="px-0 border-0 btn btn-sm dropdown-toggle" type="button" id="dropdownItem3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Últimos 7 Días
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem3">
                                        <a class="dropdown-item" href="#">Esta semana</a>
                                        <a class="dropdown-item" href="#">Este mes</a>
                                        <a class="dropdown-item" href="#">Este Año</a>
                                       <!-- <a class="dropdown-item" href="#">Últimos 7 Días</a> -->
                                        <a class="dropdown-item" href="#">Últimos 30 Días</a>
                                        <a class="dropdown-item" href="#">Últimos 90 Días</a>
                                        <a class="dropdown-item" href="#">Último Año</a>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('contact.list')}}" alt="Contactos">
                            <div class="pb-0 card-header d-flex flex-column align-items-start">
                                <div class="m-0 avatar bg-rgba-primary p-50">
                                    <div class="avatar-content">
                                        <i class="feather icon-users text-primary font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="mt-1 text-bold-700 mb-25">92.6k</h2>
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
                            <div class="pb-0 card-header d-flex justify-content-between">
                                <h4 class="card-title"></h4>
                                <div class="dropdown chart-dropdown">
                                    <button class="px-0 border-0 btn btn-sm dropdown-toggle" type="button" id="dropdownItem3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            <div class="pb-0 card-header d-flex flex-column align-items-start">
                                <div class="m-0 avatar bg-rgba-warning p-50">
                                    <div class="avatar-content">
                                        <i class="feather icon-package text-warning font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="mt-1 text-bold-700 mb-25">97.5K</h2>
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
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row pb-50">
                                        <div class="order-2 mt-2 col-lg-6 col-12 d-flex justify-content-between flex-column order-lg-1 mt-lg-0">
                                            <div>
                                                <h2 class="text-bold-700 mb-25">29</h2>
                                                <p class="text-bold-500 mb-75"><strong>Nuevos Contactos</strong></p>
                                                <h5 class="font-medium-2">
                                                    <span class="text-success">Contactos: +5.2% </span>
                                                    <span>en los últimos 7 días</span>
                                                </h5>
                                            </div>
                                            <a href="#" class="shadow btn btn-primary">Ver Detalles <i class="feather icon-chevrons-right"></i></a>
                                        </div>
                                        <div class="order-1 text-right col-lg-6 col-12 d-flex justify-content-between flex-column order-lg-2">
                                            <div class="dropdown chart-dropdown">
                                                <button class="p-0 border-0 btn btn-sm dropdown-toggle" type="button" id="dropdownItem5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                            <p class="mb-0">En Negociación: 15</p>
                                            <div class="progress progress-bar-danger mt-25">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="90" aria-valuemax="100" style="width:90%"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-0">Comisiones: 1.230€</p>
                                            <div class="progress progress-bar-info mt-25">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="60" aria-valuemax="100" style="width:60%"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-0">Clientes Perdidos: 14</p>
                                            <div class="progress progress-bar-success mt-25">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="70" aria-valuemax="100" style="width:70%"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-0">Cerradas: 7</p>
                                            <div class="progress progress-bar-secondary mt-25">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="90" aria-valuemax="100" style="width:90%"></div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="pb-0 card-header d-flex justify-content-between">
                                    <h4 class="card-title">Negociaciones</h4>
                                    <div class="dropdown chart-dropdown">
                                        <button class="p-0 border-0 btn btn-sm dropdown-toggle" type="button" id="dropdownItem4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Last 7 Days
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem4">
                                            <a class="dropdown-item" href="#">Last 28 Days</a>
                                            <a class="dropdown-item" href="#">Last Month</a>
                                            <a class="dropdown-item" href="#">Last Year</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="pt-0 card-body">
                                        <div class="row">
                                            <div class="flex-wrap text-center col-sm-2 col-12 d-flex flex-column">
                                                <h1 class="mt-2 mb-0 font-large-2 text-bold-700">163</h1>
                                                <small>Negociaciones</small>
                                            </div>
                                            <div class="col-sm-10 col-12 d-flex justify-content-center">
                                                <div id="support-tracker-chart"></div>
                                            </div>
                                        </div>
                                        <div class="chart-info d-flex justify-content-between">
                                            <div class="text-center">
                                                <p class="mb-50">Exitosas</p>
                                                <span class="font-large-1">63</span>
                                            </div>
                                            <div class="text-center">
                                                <p class="mb-50">Perdidas</p>
                                                <span class="font-large-1">29</span>
                                            </div>
                                            <div class="text-center">
                                                <p class="mb-50">Tiempo Conversión</p>
                                                <span class="font-large-1">1d</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
                <div class="row match-height">

                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="pb-0 card-header d-flex justify-content-between">
                                <h4 class="card-title">Contactos</h4>
                                <div class="dropdown chart-dropdown">
                                    <button class="px-0 border-0 btn btn-sm dropdown-toggle" type="button" id="dropdownItem3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                <div class="py-0 card-body">
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
              
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="card-title">Estadisticas de Ventas</h4>
                                    <p class="mb-0 text-muted mt-25">Últimos 3 Meses</p>
                                </div>
                                <p class="mb-0"><i class="cursor-pointer feather icon-more-vertical font-medium-3 text-muted"></i></p>
                            </div>
                            <div class="card-content">
                                <div class="px-0 card-body">
                                    <div id="sales-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Actividad Reciente</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="activity-timeline timeline-left list-unstyled">
                                        <li>
                                            <div class="timeline-icon bg-primary">
                                                <i class="align-middle feather icon-plus font-medium-2"></i>
                                            </div>
                                            <div class="timeline-info">
                                                <p class="mb-0 font-weight-bold">Reunión con el Cliente</p>
                                                <span class="font-small-3">Reunión para deiscutir presupuesto de venta</span>
                                            </div>
                                            <small class="text-muted">Hace minutos 25 </small>
                                        </li>
                                        <li>
                                            <div class="timeline-icon bg-warning">
                                                <i class="align-middle feather icon-alert-circle font-medium-2"></i>
                                            </div>
                                            <div class="timeline-info">
                                                <p class="mb-0 font-weight-bold">Enviar email con propuesta</p>
                                                <span class="font-small-3">Enviar email al cliente con propuesta de ventas</span>
                                            </div>
                                            <small class="text-muted">Hace 15 días</small>
                                        </li>
                                        <li>
                                            <div class="timeline-icon bg-danger">
                                                <i class="align-middle feather icon-check font-medium-2"></i>
                                            </div>
                                            <div class="timeline-info">
                                                <p class="mb-0 font-weight-bold">Planificación</p>
                                                <span class="font-small-3">Crear plan de trabajo y estrategia de ventas</span>
                                            </div>
                                            <small class="text-muted">Hace 20 días</small>
                                        </li>
                                        <li>
                                            <div class="timeline-icon bg-success">
                                                <i class="align-middle feather icon-check font-medium-2"></i>
                                            </div>
                                            <div class="timeline-info">
                                                <p class="mb-0 font-weight-bold">Puesta en producción de Website</p>
                                                <span class="font-small-3">Puesta en linea del portal web de la empresa </span>
                                            </div>
                                            <small class="text-muted">HAce 25 días</small>
                                        </li>
                                        <li>
                                            <div class="timeline-icon bg-primary">
                                                <i class="align-middle feather icon-check font-medium-2"></i>
                                            </div>
                                            <div class="timeline-info">
                                                <p class="mb-0 font-weight-bold">Marketing</p>
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
                                                <div class="flex-wrap mb-1 ag-grid-btns d-flex justify-content-between">
                                                    <div class="mb-1 dropdown sort-dropdown mb-sm-0">
                                                        <button class="border btn btn-white filter-btn dropdown-toggle text-dark" type="button" id="dropdownMenuButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            1 - 20 of 50
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton6">
                                                            <a class="dropdown-item" href="#">20</a>
                                                            <a class="dropdown-item" href="#">50</a>
                                                        </div>
                                                    </div>
                                                    <div class="flex-wrap ag-btns d-flex">
                                                        <input type="text" class="mb-1 mr-1 ag-grid-filter form-control w-50 mb-sm-0" id="filter-text-box" placeholder="Buscar...." />
                                                        <div class="action-btns">
                                                            <div class="btn-dropdown ">
                                                                <div class="btn-group dropdown actions-dropodown">
                                                                    <button type="button" class="px-2 btn btn-white py-75 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

    <script>

     support_tracker = support_tracker_chart();
     <?php $conersion_ratio = 38; ?>
        support_tracker.series.push(<?php echo round($conersion_ratio, 1) ?>);
     <?php  ?>
     testChart = new ApexCharts(document.querySelector("#support_tracker_chart"), support_tracker).render();

     $("#support_tracker_chart").html('');
    let conversion_ratio = 38;
    conversion_ratio = conversion_ratio ? conversion_ratio : 0;
    support_tracker = support_tracker_chart();
    support_tracker.series.push(conversion_ratio.toFixed(1));
    testChart = new ApexCharts(document.querySelector("#support_tracker_chart"), support_tracker).render();

    var $primary = '#0087FF';
    var $danger = '#EA5455';
    var $warning = '#FF9F43';
    var $info = '#00cfe8';
    var $success = '#00db89';
    var $primary_light = '#9c8cfc';
    var $warning_light = '#FFC085';
    var $danger_light = '#f29292';

    var e = "#0087FF",
        t = "#EA5455",
        a = "#FF9F43",
        o = "#b9c3cd",
        r = "#e7eef7";

     function support_tracker_chart() {
        const chart_data = {
            chart: {
                height: 270,
                type: "radialBar"
            },
            plotOptions: {
                radialBar: {
                    size: 150,
                    startAngle: -150,
                    endAngle: 150,
                    offsetY: 20,
                    hollow: {
                        size: "65%"
                    },
                    track: {
                        background: "#fff",
                        strokeWidth: "100%"
                    },
                    dataLabels: {
                        value: {
                            offsetY: 30,
                            color: "#99a2ac",
                            fontSize: "2rem"
                        }
                    }
                }
            },
            colors: [t],
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    type: "horizontal",
                    shadeIntensity: .5,
                    gradientToColors: [e],
                    inverseColors: !0,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100]
                }
            },
            stroke: {
                dashArray: 8
            },
            series: [],
            labels: ["Ratio Conversión"]
        }
        return chart_data;
    };
    </script>
@endsection