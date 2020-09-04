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
                <span  class="title">Buscar vendedor</span>
            </div>
        </div>

        
            <search-sellers></search-sellers>
            {{-- <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Filtros</div>
                        <div class="card-body">
                            @foreach ($questions as $q)
                                @if (!is_null($q->options))
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <b>{{ $q->name }}</b>
                                            @foreach (json_decode($q->options) as $key => $option)
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="{{ $q->id . '_' . $key }}"
                                                                name="filter_{{ $q->id . '_' . $key }}"
                                                                @if (session($q->id . '_' . $key)) checked @endif>
                                                            <label class="form-check-label">
                                                                {{ $option }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Vendedores</div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form method="POST" action="{{ route('search') }}">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Buscar vendedor..." id="searchSeller"
                                                value="{{ old('search') ?? $search_input ?? '' }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">Buscar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table class="table" id="tableResultSellers">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Correo</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($users))
                                        @forelse ($users as $user)
                                            <tr id="row_{{ $user->id }}" class="row_result">
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->status)
                                                        Conectado
                                                    @else
                                                        Desconectado
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">
                                                    No existen registros con los parámetros de consulta
                                                </td>
                                            </tr>
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
        
        
    </div>

</div>

@endsection

@section('extra-js')
    @parent
    <script>
        let $body = $('body');
        $body.addClass('menu-collapsed');
    </script>
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection