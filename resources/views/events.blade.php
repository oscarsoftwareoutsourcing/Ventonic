@extends('layouts.app-dashboard')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>

        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-header">
                                    <h6>Últimos 10 eventos</h6>
                                    <a class="btn btn-primary btn-sm" href="{{ route('events.calender') }}">
                                        Ver calendario
                                    </a>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover table-striped dt-responsive nowrap display datatable">
                                        <thead>
                                            <tr>
                                                <th class="col-sm-3">Fecha y hora inicial</th>
                                                <th class="col-sm-3">Fecha y hora final</th>
                                                <th class="col-sm-2">Título</th>
                                                <th class="col-sm-2">Descripción</th>
                                                <th class="col-sm-2">Categoría</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($events as $event)
                                                <tr>
                                                    <td>{{ $event->start_at->format('d-m-Y H:i:s') }}</td>
                                                    <td>{{ $event->end_at->format('d-m-Y H:i:s') }}</td>
                                                    <td>{{ $event->title }}</td>
                                                    <td>{{ $event->notes }}</td>
                                                    <td class="text-center">
                                                        <div class="chip chip-{{ $event->category_color_class }}">
                                                            <div class="chip-body">
                                                                <span class="chip-text">
                                                                    {{ $event->category_name }}
                                                                </span>
                                                            </div>
                                                        </div>
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
    </div>
@endsection

@section('vendor-js')

@stop
