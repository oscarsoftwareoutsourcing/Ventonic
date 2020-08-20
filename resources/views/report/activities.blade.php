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
                        <div class="text-ventonic" data-type="{{ Auth::user()->typeuser }}">Reporte de Actividades</div> 
                     </div>
                </div>
            </div>

            <hr>
            <div class="card-body">
                <div class="row mb-1">
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <form action="{{ route('report.activities') }}" method="GET">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-1">
                                <span>Periodo</span>
                            </div>
                            <div class="col-md-5">
                                <select class="form-control" id="periodo" name="etiquetas"  onchange="selectDate()">
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

                            <div class="col-md-2">
                                 <button type="submit" class="btn btn-primary" id="search" style="display:none;">Buscar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
        </div>

        
        <div class="card">
            <div class="col-lg-12 col-md-12 ">
                    <div class="card-header">
                        <h4 class="card-title">Informe de actividades</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="height-300">
                                <canvas id="bar-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="card">
            <div class="col-lg-12 col-md-12 ">
                
                    <div class="card-header">
                        <h4 class="card-title">Informe de actividades</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                             <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        
                                            <tr>
                                                <td class="head-table"></td>
                                                <td class="text-center head-table">Total</td>
                                                <td class="text-center head-table">Media</td>
                                               
                                            </tr>
                                        

                                          <td colspan="4"><hr class="hr-report"></td>
                                         @foreach($data as $dt)
                                            <tr>
                                                <td scope="row" class="info-table">{{ $dt['type'] }}</td>
                                                <td class="text-center">{{ $dt['qty'] }}</td>
                                                <td class="text-center"> 0 </td>
                                                
                                            </tr>
                                        @endforeach
                                        
                                     

                                    </table>
                                </div>



                            
                        </div>
                    </div>
                </div>
        </div>


    </div>

</div>

        
   
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript">
        var pro_label = {!! $pro_label !!};
        var pro_qty = {!! $pro_qty !!};
        
        function selectDate(e){
            var obj = document.getElementById('search');
            obj.click();
        }

    </script>
@endsection

@section('extra-js')
    <script src="{{ asset('vendors/js/charts/chart.min.js') }}"></script>
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('js/scripts/charts/chart-activities.js') }}"></script>
@endsection