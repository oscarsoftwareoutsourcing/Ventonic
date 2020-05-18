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
                    <div class="card">
                        <div class="card-header">Oportunidades</div>
                        <div class="card-body">
                            <div class="col-lg-12 justify-vh-100">
                                <a type="submit" href="{{ route('oportunityForm') }}" class="btn btn-primary mr-auto mb-1 waves-effect waves-light align-self-center" style="margin:auto;">PUBLICA UNA OPORTUNIDAD</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

