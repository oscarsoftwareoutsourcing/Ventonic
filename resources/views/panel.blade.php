@extends('layouts.app-dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel de control</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Te has autenticado en el sistema con éxitoa
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection
