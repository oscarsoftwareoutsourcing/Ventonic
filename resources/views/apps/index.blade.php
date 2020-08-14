@extends('layouts.app-dashboard')


@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="card">
                <div class="card-ventonic">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-12 ">
                            <div class="text-ventonic"><strong>Mis Apps<strong></strong>: Aplicaciones que incrementan las ventas de mi empresa</div> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="">

                @foreach($apps as $app)
                    <div class="row match-height">
                        <div class="col-sm-4">
                            <div class="card">
                            <div class="card-content">
                                <img
                                class="card-img-top img-fluid"
                                src="{{ $app->image }}"
                                alt="Card image cap"
                                />
                                <div class="card-body">
                                <h2>{{ $app->name }}</h2>
                                <p class="card-text mb-0">{{ $app->description }}</p>
                                <span class="card-text"></span>
                                <div class="card-btns d-flex justify-content-between mt-2">
                                    <a href="#"></a>
                                    <a
                                    class="btn btn-primary text-white"
                                    href="{{route($app->widget_type)}}"
                                    
                                    >Entrar</a>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>    
            
      

                <!-- card tablet -->
        </div>
    </div>
        
   
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('extra-js')

@endsection