@extends('layouts.app-dashboard')


@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="row">
                <div class="new-header mb-1">
                    <span  class="title">Ventas</span>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row ">
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <form action="{{ route('report.sales') }}" method="GET">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-1">
                                <span>Periodo</span>
                            </div>
                            <div class="col-md-5">
                                <select class="form-control" id="periodo" name="etiquetas" onchange="selectDate()">
                                    <option value="0" {{ request()->etiquetas=='0'?'selected':'' }}>
                                        Busqueda por periodo
                                    </option>
                                    <option value="this week"  {{ request()->etiquetas=='this week'?'selected':'' }}>
                                        Esta semana
                                    </option>
                                    <option value="this month"  {{ request()->etiquetas=='this month'?'selected':'' }}>
                                        Este mes
                                    </option>
                                    <option value="this year"  {{ request()->etiquetas=='this year'?'selected':'' }}>
                                        Este Año
                                    </option>
                                    <option value="7 days ago"  {{ request()->etiquetas=='7 days ago'?'selected':'' }}>
                                        Últimos 7 Días
                                    </option>
                                    <option value="30 days ago"  {{ request()->etiquetas=='30 days ago'?'selected':'' }}>
                                        Últimos 30 Días
                                    </option>
                                    <option value="90 days ago"  {{ request()->etiquetas=='90 days ago'?'selected':'' }}>
                                        Últimos 90 Días
                                    </option>
                                    <option value="last year"  {{ request()->etiquetas=='last year'?'selected':'' }}>
                                        Último Año
                                    </option>
                                </select>
                            </div>

                            <div style="display:none;">
                                 <button type="submit" class="btn btn-primary" id="search" style="display:none;">Buscar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>

            <div class="row">
                
                @if(count($processes)>0)

                <div class="col-lg-12 col-md-12 col-sm-12 ">
                     <div class="card">
                        <div class="bg-gradient-primary">
                            <div class="card_vetonic-description">
                                <div class="text_vetonic-description1">Resultados</div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    @foreach($processes as $process)
                                    <div class="row">
                                        <div class="col-8">{{ $process->desc }}</div>
                                        <div class="col-2">{{ $process->qty }}</div>
                                        <div class="col-2">%</div>
                                    </div>
                                    <hr>
                                    @endforeach
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <br>
                                     @foreach($totals as $total)
                                    <div class="row">
                                        <div class="col-8">{{ $total->desc }}</div>
                                        <div class="col-2">{{ $total->qty }}</div>
                                        <div class="col-2">%</div>
                                    </div>
                                    <hr>
                                    @endforeach
                                    <br>
                                </div>
                            </div>
                           
                        </div>
                     </div>
                </div>

                <div class="col-lg-6 col-md-12 ">
                     <div class="card">
                        <div class="bg-gradient-primary">
                            <div class="card_vetonic-description">
                                <div class="text_vetonic-description1">Negociaciones</div>
                            </div>
                        </div>
                        <div class="card-body">
                             <div class="card-body">
                                <div id="bar-chart"></div>
                            </div>
                        </div>
                     </div>
                </div>

                <div class="col-lg-6 col-md-12 ">
                     <div class="card">
                        <div class="bg-gradient-primary">
                            <div class="card_vetonic-description">
                                <div class="text_vetonic-description1">Estatus</div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div id="pie-chart" class="mx-auto"></div>
                            </div>
                        </div>
                    </div>

                </div>

                @else

                <div class="col-lg-12 col-md-12 justify-content-center">
                     <div class="card">
                        <div class="card-header mb-2">
                            <h2 class="card-title">Registros no encontrados</h2>
                        </div>
                        <div class="card-content">
                        </div>
                    </div>
                </div>

                @endif


            </div>    
            
      

                <!-- card tablet -->
        </div>
    </div>
        
   
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script type="text/javascript">
        var pie_qty = {!!  $pie_qty !!}; 
        var pie_label = {!!  $pie_label !!};
        var pro_label = {!! $pro_label !!};
        var pro_qty = {!! $pro_qty !!};

        function selectDate(e){
            var obj = document.getElementById('search');
            obj.click();
        }

    </script>
@endsection

@section('extra-js')
<script src="{{ asset('vendors/js/ui/jquery.sticky.js') }}"></script>
<script src="{{ asset('vendors/js/charts/apexcharts.min.js') }}"></script>
<script src="{{ asset('js/scripts/charts/chart-sales.js') }}"></script>
@endsection