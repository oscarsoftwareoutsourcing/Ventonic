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
                            <div class="text-ventonic" data-type="{{ Auth::user()->typeuser }}">Reporte de Ventas</div> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                
                <div class="col-lg-12 col-md-12 col-sm-12 ">
                     <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        
                                            <tr>
                                                <td class="head-table"></td>
                                                <td class="text-center head-table">Negociación</td>
                                                <td class="text-center head-table">Conversión</td>
                                                <td class="text-center head-table">Total</td>
                                            </tr>
                                        

                                          <td colspan="4"><hr class="hr-report"></td>
                                         @foreach($processes as $process)
                                            <tr>
                                                <td scope="row" class="info-table">{{ $process->desc }}</td>
                                                <td class="text-center">{{ $process->qty }}</td>
                                                <td class="text-center"> % </td>
                                                <td class="text-right">{{ $process->tot }} €</td>
                                            </tr>
                                        @endforeach
                                        
                                        <td colspan="4"><hr class="hr-report"></td>

                                        @foreach($totals as $total)
                                            <tr >
                                                <td scope="row" class="info-table">{{ $total->desc }}</td>
                                                <td class="text-center">{{ $total->qty }}</td>
                                                <td class="text-center"> % </td>
                                                <td class="text-right">{{ $total->tot }} €</td>
                                            </tr>
                                        @endforeach

                                    </table>
                                </div>
                        </div>
                     </div>
                </div>

                <div class="col-lg-6 col-md-12 ">
                     <div class="card">
                        <div class="card-header">
                             <h4 class="card-title">Negociaciones</h4>
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
                        <div class="card-header">
                            <h4 class="card-title">Estatus</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div id="pie-chart" class="mx-auto"></div>
                            </div>
                        </div>
                    </div>

                </div>
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
    </script>
@endsection

@section('extra-js')
<script src="{{ asset('vendors/js/ui/jquery.sticky.js') }}"></script>
<script src="{{ asset('vendors/js/charts/apexcharts.min.js') }}"></script>
<script src="{{ asset('js/scripts/charts/chart-sales.js') }}"></script>
@endsection