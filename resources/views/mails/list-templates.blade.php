@extends('layouts.app-dashboard')

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/file-uploaders/dropzone.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-12 ">
                    <span class="font-weight-bold" style="font-size: 2rem">Plantillas</span>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12 ">
                    <a class="btn btn-ventonic waves-effect waves-light" type="button"
                       href="{{ route('app.email_templates.create') }}">
                        Agregar plantilla
                    </a>
                </div>
            </div>
            {{-- listado de plantillas --}}
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table zero-configuration" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="35%">Nombre</th>
                                            <th class="text-center" width="35%">Opción del sistema</th>
                                            <th class="text-center" width="15%">Tipo</th>
                                            <th class="text-center" width="15%">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($emailTemplates as $template)
                                            <tr>
                                                <td>{{ $template->name }}</td>
                                                <td>{{ $template->module_name ?? 'Aplicación general' }}</td>
                                                <td>
                                                    @php
                                                        if ($template->type === 'C') {
                                                            echo 'Campaña';
                                                        } elseif ($template->type === 'N') {
                                                            echo 'Notificación';
                                                        } elseif ($template->type === 'E') {
                                                            echo 'Evento';
                                                        } elseif ($template->type === 'O') {
                                                            echo 'Otro';
                                                        } else {
                                                            echo 'N/A';
                                                        }
                                                    @endphp
                                                </td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0)" data-toggle="tooltip" class="mr-1"
                                                       title="Modificar plantilla">
                                                       <i class="feather icon-edit-2 font-medium-4 ml-2"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" data-toggle="tooltip"
                                                       title="Eliminar plantilla">
                                                        <i class="feather icon-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script src="{{ asset('vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('js/scripts/ui/data-list-view.js') }}"></script>
    <script src="{{ asset('/js/scripts/modal/components-modal.js') }}"></script>
    <script>$("#datatable").DataTable();</script>
@endsection
