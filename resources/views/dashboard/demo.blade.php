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
                <div class="dropdown chart-dropdown text-right">
                    <button class="btn btn-sm border-0 dropdown-toggle px-0" type="button" id="dropdownItem3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Últimos 7 Días
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem3">
                        <a class="dropdown-item" href="#" onclick="filterDashbaord('this week')">Esta semana</a>
                        <a class="dropdown-item" href="#" onclick="filterDashbaord('this month')">Este mes</a>
                        <a class="dropdown-item" href="#" onclick="filterDashbaord('this year')">Este año</a>
                        <a class="dropdown-item" href="#" onclick="filterDashbaord('7 days ago')">Últimos 7 Días</a>
                        <a class="dropdown-item" href="#" onclick="filterDashbaord('30 days ago')">Últimos 30 Días</a>
                        <a class="dropdown-item" href="#" onclick="filterDashbaord('90 days ago')">Últimos 90 Días</a>
                        <a class="dropdown-item" href="#" onclick="filterDashbaord('last year')">Último Año</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="card bg-analytics text-white">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <img src="{{ asset('images/elements/decore-left.png') }}" class="img-left" alt="card-img-left">
                                    <img src="{{ asset('images/elements/decore-right.png') }}" class="img-right" alt="card-img-right">
                                    <div class="  mt-0">
                                        <img src="{{ asset('web/images/logo.png') }}" alt="Ventonic">
                                    </div>
                                    <br>
                                    <div class="text-center">
                                        <h1 class="mb-2 text-white">Bienvenido a Ventonic, {{ Auth::user()->name }}</h1>
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
                            </div>
                            <a href="{{route('contact.list')}}" alt="Contactos">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-users text-primary font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1 mb-25 new_contacts">{{$contacts_data['all']['total']}}</h2>
                                    <p class="mb-0">Nuevos Contactos <span class="selected_time">en los últimos 7 días</span></p>
                                </div>
                                <div class="card-content">
                                    <div id="subscribe_gain_chart"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between pb-0">
                                <h4 class="card-title"></h4>
                            </div>
                            <a href="{{route('negociaciones')}}" alt="Negociaciones">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-warning p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-package text-warning font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1 mb-25" id="total_billed">@money($negs['won']['amount'])€</h2>
                                    
                                    <p class="mb-0">Facturacion Total</p>
                                </div>
                                <div class="card-content">
                                    <div id="orders_received_chart"></div>
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
                                        <div class="col-lg-6 col-12 d-flex justify-content-between flex-column order-lg-1 order-2 mt-lg-0 mt-2">
                                            <div>
                                                <h2 class="text-bold-700 mb-25 new_contacts">{{$contacts_data['all']['total']}}</h2>
                                                <p class="text-bold-500 mb-75"><strong>Nuevos Contactos</strong></p>
                                                <h5 class="font-medium-2">
                                                    <span class="text-success">Contactos: <span id="contacts_percent">{{$contacts_data['all']['percent']}}</span>%</span>
                                                    <span class="selected_time">en los últimos 7 días</span>
                                                </h5>
                                            </div>
                                            <a href="#" class="btn btn-primary shadow">Ver Detalles <i class="feather icon-chevrons-right"></i></a>
                                        </div>
                                        <div class="col-lg-6 col-12 d-flex justify-content-between flex-column text-right order-lg-2 order-1">
                                            <div id="avg_session_chart"></div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row avg-sessions pt-50">
                                        <div class="col-6">
                                            <p class="mb-0">Facturación: <span id="contact_billing">@money($negs['closed']['amount'])€</span></p>
                                            <div class="progress progress-bar-primary mt-25">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="50" aria-valuemax="100" style="width:50%"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-0">Clientes: <span id="contact_clients">{{$contacts_data['new']['total']}}</span></p>
                                            <div class="progress progress-bar-warning mt-25">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="60" aria-valuemax="100" style="width:60%"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-0">En negociación: <span id="contact_negotiation"> @money($negs['in_process']['amount'])€</span></p>
                                            <div class="progress progress-bar-success mt-25">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="90" aria-valuemax="100" style="width:90%"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-0">Clientes Perdidos: <span id="contact_lost">{{$contacts_data['lost']['total']}}</span></p>
                                            <div class="progress progress-bar-danger mt-25">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="70" aria-valuemax="100" style="width:70%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between pb-0">
                                <h4 class="card-title">Negociaciones</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                            <h1 class="font-large-2 text-bold-700 mt-2 mb-0" id="negotiation">{{$negs['all']['total']}}</h1>
                                            <small>Negociaciones</small>
                                        </div>
                                        <div class="col-sm-10 col-12 d-flex justify-content-center">
                                            <div id="support_tracker_chart"></div>
                                        </div>
                                    </div>
                                    <div class="chart-info d-flex justify-content-between">
                                        <div class="text-center">
                                            <p class="mb-50">Exitosas</p>
                                            <span class="font-large-1" id="neg_won">{{$negs['won']['total']}}</span>
                                        </div>
                                        <div class="text-center">
                                            <p class="mb-50">Perdidas</p>
                                            <span class="font-large-1" id="neg_lost">{{$negs['lost']['total']}}</span>
                                        </div>
                                        <div class="text-center">
                                            <p class="mb-50">Tiempo Conversion</p>
                                            <span class="font-large-1" id="neg_cov_time">{{$negs['convDays']}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="row match-height">
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h4 class="card-title">Ofertas</h4>
                    </div>
                
                    <div class="card-content">
                        <div class="card-body py-0">
                            <div id="offers_chart"></div>
                        </div>
                        <ul class="list-group list-group-flush customer-info">
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-primary"></i>
                                    <span class="text-bold-600">Ofertas de Negociación</span>
                                </div>
                                <div class="product-result">
                                    <span id="offer_neg">{{$negs['in_process']['total']}}</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-warning"></i>
                                    <span class="text-bold-600">Ofertas Aceptadas</span>
                                </div>
                                <div class="product-result">
                                    <span id="offer_won">{{$negs['won']['total']}}</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-danger"></i>
                                    <span class="text-bold-600">Ofertas Perdidas</span>
                                </div>
                                <div class="product-result">
                                    <span id="offer_lost">{{$negs['lost']['total']}}</span>
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
                            <p class="text-muted mt-25 mb-0 selected_time">Últimos 7 días</p>
                        </div>
                        <p class="mb-0"><i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i></p>
                    </div>
                    <div class="card-content">
                        <div class="card-body px-0">
                            <div id="sales_chart"></div>
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
                                <!-- <div class="row">
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
                                </div> -->
                                <!-- <div id="myGrid" class="aggrid ag-theme-material"></div> -->

                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">Últimas Conversaciones</div>

                                        <div class="card-body">
                                            <table class="table" id="tableResultSellers">
                                                <thead>
                                                    <tr>
                                                        <th>Imagen</th>
                                                        <th>Nombre</th>
                                                        <th>Apellido</th>
                                                        <th>Correo</th>
                                                        <th>Última Conexión</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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


@section('extra-js')
<script>
    var url = $(location).attr('origin');
    var testChart = '';
    $(document).ready(function() {
        $('.dropdown-menu').on('click', 'a', function() {
            var text = $(this).html();
            var htmlText = text + ' <span class="caret"></span>';
            $(this).closest('.dropdown').find('.dropdown-toggle').html(htmlText);
            $('.selected_time').html('en ' + htmlText);
        });

        axios.get('/get-chat-users').then(function(response) {
            var results = response.data.chatOrigins;
            var html = '';

            for (let i = 0; i < results.length; i++) {
                if (results[i].users.length) {
                    for (let j = 0; j < results[i].users.length; j++) {
                        const users = results[i].users[j];
                        html += "<tr>" +
                            "<td><img src='" + users.user.photo + "' class='media-object rounded-circle' height='42' width='42'> </td>" +
                            "<td>" + users.user.name + "</td>" +
                            "<td>" + users.user.last_name + "</td>" +
                            "<td>" + users.user.email + "</td>" +
                            "<td>" + users.updated_at + "</td>" +
                            "</tr>"
                    }

                }
            }

            $("#tableResultSellers").find("tbody").html(html);
        })["catch"](function(error) {
            console.error(error);
        });

        subscribe_gain = subscribe_gain_chart();
        <?php foreach ($contacts_data['all']['contacts'] as $key => $value) { ?>
            subscribe_gain.series[0].data.push(<?php echo $value['total']; ?>);
        <?php } ?>
        new ApexCharts(document.querySelector("#subscribe_gain_chart"), subscribe_gain).render();

        orders_received = orders_received_chart();
        <?php foreach ($negs['won']['negs'] as $key => $value) { ?>
            orders_received.series[0].data.push(<?php echo $value['amount']; ?>);
        <?php } ?>
        new ApexCharts(document.querySelector("#orders_received_chart"), orders_received).render();


        avg_session = avg_session_chart();
        <?php foreach ($contacts_data['all']['contacts'] as $key => $value) { ?>
            avg_session.series[0].data.push(<?php echo $value['total']; ?>);
        <?php } ?>
        new ApexCharts(document.querySelector("#avg_session_chart"), avg_session).render();

        support_tracker = support_tracker_chart();
        <?php $conersion_ratio = $negs['all']['total'] ? ($negs['won']['total'] / $negs['all']['total']) * 100 : 0; ?>
        support_tracker.series.push(<?php echo round($conersion_ratio, 1) ?>);
        <?php  ?>
        testChart = new ApexCharts(document.querySelector("#support_tracker_chart"), support_tracker).render();


        sales = sales_chart();
        <?php foreach ($negs['closed']['negs'] as $key => $value) { ?>
            sales.series[0].data.push(<?php echo $value['amount']; ?>);
            sales.labels.push('<?php echo $value['day_logged']; ?>');
        <?php } ?>
        <?php foreach ($negs['lost']['negs'] as $key => $value) { ?>
            sales.series[1].data.push(<?php echo $value['amount']; ?>);
        <?php } ?>
        new ApexCharts(document.querySelector("#sales_chart"), sales).render();


        offers = offers_chart();
        offers.series.push(<?php echo $negs['in_process']['total']; ?>);
        offers.series.push(<?php echo $negs['won']['total']; ?>);
        offers.series.push(<?php echo $negs['lost']['total']; ?>);
        <?php  ?>
        new ApexCharts(document.querySelector("#offers_chart"), offers).render();
    });

    function moneyFormat(number) {
        let num = parseFloat(number).toLocaleString('es-ES')
        return num;
    }

    function filterDashbaord(date) {
        $.ajax({
            url: url + '/filterDashbaord',
            type: 'post',
            data: {
                date_range: date,
                _token: '{{csrf_token()}}'
            },
            success: function(response) {
                response = JSON.parse(response);

                $('.new_contacts').html(response.contacts_data.all.total);

                $("#subscribe_gain_chart").html('');
                subscribe_gain = subscribe_gain_chart();
                for (let i = 0; i < response.contacts_data.all.contacts.length; i++) {
                    subscribe_gain.series[0].data.push(response.contacts_data.all.contacts[i].total);
                }
                new ApexCharts(document.querySelector("#subscribe_gain_chart"), subscribe_gain).render();
                
                let contactBilling = moneyFormat(response.negs.closed.amount)+'€';
                let contactNegotiation = moneyFormat(response.negs.in_process.amount)+'€';
                $('#contact_billing').html(contactBilling);
                $('#contacts_percent').html(response.contacts_data.all.percent);
                $('#contact_clients').html(response.contacts_data.new.total);
                $('#contact_lost').html(response.contacts_data.lost.total);
                $('#contact_negotiation').html(contactNegotiation);

                $("#avg_session_chart").html('');
                avg_session = avg_session_chart();
                for (let i = 0; i < response.contacts_data.all.contacts.length; i++) {
                    avg_session.series[0].data.push(response.contacts_data.all.contacts[i].total);
                }
                new ApexCharts(document.querySelector("#avg_session_chart"), avg_session).render();

                let totalBilled = moneyFormat(response.negs.won.amount)+'€';
                $('#total_billed').html(totalBilled);
                $("#orders_received_chart").html('');
                orders_received = orders_received_chart();
                for (let i = 0; i < response.negs.won.negs.length; i++) {
                    orders_received.series[0].data.push(response.negs.won.negs[i].amount);
                }
                new ApexCharts(document.querySelector("#orders_received_chart"), orders_received).render();

                support_tracker_chart

                $('#negotiation').html(response.negs.all.total);
                $('#neg_won').html(response.negs.won.total);
                $('#neg_lost').html(response.negs.lost.total);
                $('#neg_cov_time').html(response.negs.convDays);

                $("#support_tracker_chart").html('');
                let conversion_ratio = (response.negs.won.total / response.negs.all.total) * 100;
                conversion_ratio = conversion_ratio ? conversion_ratio : 0;
                support_tracker = support_tracker_chart();
                support_tracker.series.push(conversion_ratio.toFixed(1));
                testChart = new ApexCharts(document.querySelector("#support_tracker_chart"), support_tracker).render();

                sales = sales_chart();
                $("#sales_chart").html('');
                for (let i = 0; i < response.negs.closed.negs.length; i++) {
                    sales.series[0].data.push(response.negs.closed.negs[i].amount);
                    sales.labels.push(response.negs.closed.negs[i].day_logged);
                }
                for (let i = 0; i < response.negs.lost.negs.length; i++) {
                    sales.series[1].data.push(response.negs.lost.negs[i].amount);
                    sales.labels.push(response.negs.lost.negs[i].day_logged);
                }
                new ApexCharts(document.querySelector("#sales_chart"), sales).render();

                $("#offer_neg").html(response.negs.in_process.total);
                $("#offer_won").html(response.negs.won.total);
                $("#offer_lost").html(response.negs.lost.total);

                $("#offers_chart").html('');
                offers = offers_chart();
                offers.series.push(response.negs.in_process.total);
                offers.series.push(response.negs.won.total);
                offers.series.push(response.negs.lost.total);
                new ApexCharts(document.querySelector("#offers_chart"), offers).render();
            }
        })
    }
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

    function subscribe_gain_chart() {
        const chart_data = {
            chart: {
                height: 100,
                type: "area",
                toolbar: {
                    show: !1
                },
                sparkline: {
                    enabled: !0
                },
                grid: {
                    show: !1,
                    padding: {
                        left: 0,
                        right: 0
                    }
                }
            },
            colors: [e],
            dataLabels: {
                enabled: !1
            },
            stroke: {
                curve: "smooth",
                width: 2.5
            },
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: .9,
                    opacityFrom: .7,
                    opacityTo: .5,
                    stops: [0, 80, 100]
                }
            },
            series: [{
                name: "Subscribers",
                data: []
            }],
            xaxis: {
                labels: {
                    show: !1
                },
                axisBorder: {
                    show: !1
                }
            },
            yaxis: [{
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: {
                    left: 0,
                    right: 0
                }
            }],
            tooltip: {
                x: {
                    show: !1
                }
            }
        }
        return chart_data;
    };

    function orders_received_chart() {
        const chart_data = {
            chart: {
                height: 100,
                type: "area",
                toolbar: {
                    show: !1
                },
                sparkline: {
                    enabled: !0
                },
                grid: {
                    show: !1,
                    padding: {
                        left: 0,
                        right: 0
                    }
                }
            },
            colors: [a],
            dataLabels: {
                enabled: !1
            },
            stroke: {
                curve: "smooth",
                width: 2.5
            },
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: .9,
                    opacityFrom: .7,
                    opacityTo: .5,
                    stops: [0, 80, 100]
                }
            },
            series: [{
                name: "Orders",
                data: []
            }],
            xaxis: {
                labels: {
                    show: !1
                },
                axisBorder: {
                    show: !1
                }
            },
            yaxis: [{
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: {
                    left: 0,
                    right: 0
                }
            }],
            tooltip: {
                x: {
                    show: !1
                }
            }
        }
        return chart_data;
    };

    function avg_session_chart() {
        const chart_data = {
            chart: {
                type: "bar",
                height: 200,
                sparkline: {
                    enabled: !0
                },
                toolbar: {
                    show: !1
                }
            },
            states: {
                hover: {
                    filter: "none"
                }
            },
            colors: [r, r, e, r, r, r],
            series: [{
                name: "Contactos",
                data: []
            }],
            grid: {
                show: !1,
                padding: {
                    left: 0,
                    right: 0
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: "45%",
                    distributed: !0,
                    endingShape: "rounded"
                }
            },
            tooltip: {
                x: {
                    show: !1
                }
            },
            xaxis: {
                type: "numeric"
            }
        }
        return chart_data;
    };

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

    function sales_chart() {
        const chart_data = {
            chart: {
                height: 400,
                type: "radar",
                dropShadow: {
                    enabled: !0,
                    blur: 8,
                    left: 1,
                    top: 1,
                    opacity: .2
                },
                toolbar: {
                    show: !1
                }
            },
            toolbar: {
                show: !1
            },
            series: [{
                name: "Exitosas",
                // data: [90, 50, 86, 40, 100, 20]
                data: []
            }, {
                name: "Pérdida",
                // data: [70, 75, 70, 76, 20, 85]
                data: []
            }],
            stroke: {
                width: 0
            },
            colors: [e, "#0DCCE1"],
            plotOptions: {
                radar: {
                    polygons: {
                        strokeColors: ["#e8e8e8", "transparent", "transparent", "transparent", "transparent", "transparent"],
                        connectorColors: "transparent"
                    }
                }
            },
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    gradientToColors: ["#9f8ed7", "#1edec5"],
                    shadeIntensity: 1,
                    type: "horizontal",
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100, 100, 100]
                }
            },
            markers: {
                size: 0
            },
            legend: {
                show: !0,
                position: "top",
                horizontalAlign: "left",
                fontSize: "16px",
                markers: {
                    width: 10,
                    height: 10
                }
            },
            // labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
            labels: [],
            dataLabels: {
                style: {
                    colors: [o, o, o, o, o, o]
                }
            },
            yaxis: {
                show: !1
            },
            grid: {
                show: !1
            }
        }
        return chart_data;
    };

    function offers_chart() {
        const chart_data = {
            chart: {
                type: 'pie',
                height: 325,
                dropShadow: {
                    enabled: false,
                    blur: 5,
                    left: 1,
                    top: 1,
                    opacity: 0.2
                },
                toolbar: {
                    show: false
                }
            },
            labels: ['Ofertas de Negociación', 'Ofertas Aceptadas', 'Ofertas Perdidas'],
            series: [],
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            stroke: {
                width: 5
            },
            colors: [$primary, $success, $danger],
            fill: {
                type: 'gradient',
                gradient: {
                    gradientToColors: [$primary_light, $warning_light, $danger_light]
                }
            }
        }
        return chart_data;
    };
</script>
@endsection