@extends('layouts.app-dashboard')

@section('extra-css')

    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/calendars/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/calendars/extensions/daygrid.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/calendars/extensions/timegrid.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/calendars/fullcalendar.css') }}">


@endsection

@section('content')

    <span type="hidden" id="eventsData" data-info="{{$events}}"></span>
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>

        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">

                {{-- Full calendar start --}}
                <section id="calendarSection">

                    {{-- Bullets and cal container --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">

                                        {{-- Label bullets --}}
                                        <div class="cal-category-bullets d-none">
                                            <div class="bullets-group-1 mt-2">
                                                <div class="category-business mr-1">
                                                    <span class="bullet bullet-success bullet-sm mr-25"></span>
                                                    Eventos
                                                </div>
                                                <div class="category-work mr-1">
                                                    <span class="bullet bullet-warning bullet-sm mr-25"></span>
                                                    Recordatorios
                                                </div>
                                                <div class="category-personal mr-1">
                                                    <span class="bullet bullet-danger bullet-sm mr-25"></span>
                                                    Tareas
                                                </div>
                                                <div class="category-others">
                                                    <span class="bullet bullet-primary bullet-sm mr-25"></span>
                                                    Otros
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Calendar render container --}}
                                        <div id='fc-default'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- calendar Modal starts --}}
                    <div id="modalForm" class="modal fade text-left modal-calendar" tabindex="-1" role="dialog"
                         aria-labelledby="cal-modal" aria-modal="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm"
                             role="document">
                            <div class="modal-content">

                                {{-- Modal header --}}
                                <div class="modal-header">
                                    <h4 class="modal-title text-text-bold-600" id="cal-modal">Agregar evento</h4>
                                    <button type="button" class="close closeBtn" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">

                                    {{-- Labels Dropdown --}}
                                    <div class="d-flex justify-content-between align-items-center add-category">
                                        <div id="labelBullet" class="chip-wrapper"></div>
                                        <div class="label-icon pt-1 pb-2 dropdown calendar-dropdown">
                                            <i class="feather icon-tag dropdown-toggle" id="labelsBtn" data-toggle="dropdown"></i>
                                            <div id="categoriesContainer" class="dropdown-menu dropdown-menu-right" aria-labelledby="cal-event-category">
                                                <span class="dropdown-item bulletOpt" data-key="B">
                                                    <span class="bullet bullet-success bullet-sm mr-25"></span>
                                                    Eventos
                                                </span>
                                                <span class="dropdown-item bulletOpt" data-key="W">
                                                    <span class="bullet bullet-warning bullet-sm mr-25"></span>
                                                    Recordatorios
                                                </span>
                                                <span class="dropdown-item bulletOpt" data-key="P">
                                                    <span class="bullet bullet-danger bullet-sm mr-25"></span>
                                                    Tareas
                                                </span>
                                                <span class="dropdown-item bulletOpt" data-key="O">
                                                    <span class="bullet bullet-primary bullet-sm mr-25"></span>
                                                    Otros
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Calendar form --}}
                                    <form id="calendarForm">

                                        {{-- Title event --}}
                                        <div class="form-group">
                                            <label for="">Evento</label>
                                            <input type="text" class="form-control" id="cal-event-title" placeholder="Título del evento">
                                            <input type="hidden" id="cal-event-id" readonly>
                                            <article class="help-block" id="title-error">
                                            </article>
                                        </div>

                                        {{-- Starts at date --}}
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="">Fecha de Inicio</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="date" class="form-control pickadate" id="cal-start-date" placeholder="dd-mm-yyyy">
                                                </div>
                                                <article class="help-block" id="">
                                                </article>
                                            </div>
                                        </div>

                                        {{-- Starts at time --}}
                                        <div class="form-group">   
                                            <div class="row">    
                                                <div class="col-sm-4">
                                                    <label for="">Hora de Inicio</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control pickatime" id="cal-start-time" placeholder="00:00">
                                                </div>
                                            </div>
                                            <article class="help-block" id="">
                                            </article>
                                        </div>

                                        {{-- Ends at date --}}
                                        <div class="form-group">
                                            <div class="row mt-1">
                                                <div class="col-sm-4">
                                                    <label for="">Fecha Final</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="date" class="form-control pickadate" id="cal-end-date" placeholder="dd-mm-yyyyy">
                                                </div>
                                            </div>
                                            <article class="help-block" id="end_at-error">
                                            </article>
                                        </div>

                                        {{-- Ends at time --}}
                                        <div class="form-group">
                                            <div class="row mt-1">
                                                <div class="col-sm-4">
                                                    <label for="">Hora Final</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control pickatime" id="cal-end-time" placeholder="00:00">
                                                </div>
                                            </div>
                                            <article class="help-block" id="end_time-error">
                                            </article>
                                        </div>

                                        {{-- Note/Description --}}
                                        <div class="form-group">
                                            <label for="">Descripción</label>
                                            <textarea class="form-control" id="cal-description" rows="3" placeholder="Descripción del evento"></textarea>
                                        </div>

                                        {{-- Place --}}
                                        <div class="form-group">
                                            <label for="">Lugar</label>
                                            <input type="text" class="form-control" id="cal-event-place" placeholder="Lugar del evento">
                                        </div>
                                    </form>
                                </div>

                                {{-- Buttons --}}
                                <div class="modal-footer">
                                    <button id="saveBtn" type="button" class="btn btn-primary cal-add-event waves-effect waves-light">Agregar evento</button>
                                    <button type="button" id="updateBtn" class="btn btn-primary d-none cal-submit-event waves-effect waves-light">Actualizar</button>
                                    <button type="button" id="deleteBtn" class="btn btn-flat-danger remove-event d-none waves-effect waves-light">Eliminar</button>
                                    <button type="button" id="cancelBtn" class="btn btn-flat-danger cancel-event waves-effect waves-light closeBtn">Cancelar</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Delete modal --}}
                    <div class="modal fade text-left" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" style="display: none" aria-modal="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xs" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-danger white">
                                    <h5 class="modal-title" id="myModalLabel120">¡Alerta!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Está seguro de eliminar el evento?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="confirmDelete" class="btn btn-danger waves-effect waves-light">Sí</button>
                                    <button type="button" class="btn btn-success waves-effect waves-light" data-dismiss="modal">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    {{-- END: Content --}}
@endsection

@section('vendor-js')

@stop

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('extra-js')
    <script src="{{ asset('web/js/bootstrap/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('vendors/js/extensions/moment.min.js') }}" defer></script>
    <script src="{{ asset('vendors/js/calendar/fullcalendar.min.js') }}" defer></script>
    <script src="{{ asset('vendors/js/calendar/es.js') }}" defer></script>
    <script src="{{ asset('vendors/js/calendar/extensions/daygrid.min.js') }}" defer></script>
    <script src="{{ asset('vendors/js/calendar/extensions/timegrid.min.js') }}" defer></script>
    <script src="{{ asset('vendors/js/calendar/extensions/interactions.min.js') }}" defer></script>
    <script src="{{ asset('vendors/js/pickers/pickadate/picker.js') }}" defer></script>
    <script src="{{ asset('vendors/js/pickers/pickadate/picker.date.js') }}" defer></script>
    <script src="{{ asset('vendors/js/pickers/pickadate/picker.time.js') }}" defer></script>
    <script src="{{ asset('js/scripts/extensions/fullcalendar.js') }}" defer></script>
@endsection

