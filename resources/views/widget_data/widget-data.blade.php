@extends('layouts.app-dashboard')
@section('extra-css')

<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
<!-- <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}"> -->
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="col-12">

            </div>
        </div>
        <div class="content-body">
            <!-- Zero configuration table -->
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2>Listado de solicitudes Call Me</h2>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <p class="card-text">
                                    </p>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Vendedor</th>
                                                    <th>Producto</th>
                                                    <th>Teléfono</th>
                                                    <th>Url</th>
                                                </tr>
                                            </thead>
                                           <tbody>
                                               @foreach($data as $dt)
                                               <tr>
                                                   <td align="center">{{ $dt->created_at->format('d-m-Y H:m') }}</td>
                                                   <td align="center">
                                                        @if (auth()->user()->id === $dt->widget->user_id)
                                                            {{ $dt->widget->user->name }}
                                                            {{ $dt->widget->user->last_name }}
                                                        @else
                                                            {{ $dt->widget->userReferred->name }}
                                                            {{ $dt->widget->userReferred->last_name }}
                                                        @endif
                                                    </td>
                                                   <td align="center">{{ $dt->product }}</td>
                                                   <td align="center">
                                                        @if (!empty($dt->info_data))
                                                            @php
                                                                $phone = json_decode($dt->info_data)->phone;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $sellerProfile = $dt->widget->user->sellerProfile
                                                                                 ?? $dt->widget->userReferred->sellerProfile;
                                                                $phone = ($sellerProfile !== null)
                                                                         ? $sellerProfile->phone_mobil_country . ' ' .
                                                                           $sellerProfile->phone_mobil
                                                                         : 'NO POSEE';
                                                            @endphp
                                                        @endif
                                                        {{ $phone }}
                                                    </td>
                                                   <td align="center">
                                                        {{ (!is_null($dt->origin) && $dt->origin!=='null') ? $dt->origin : $dt->widget->url }}
                                                    </td>
                                               </tr>
                                               @endforeach
                                           </tbody>
                                            <tfoot>
                                                <!-- <tr>
                                                     <th>Fecha</th>
                                                    <th>Vendedor</th>
                                                    <th>Producto</th>
                                                    <th>Teléfono</th>
                                                    <th>Url</th>
                                                </tr> -->
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Zero configuration table -->
        </div>
    </div>
</div>
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>

@endsection

@section('extra-js')
<script src="{{ asset('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{ asset('js/scripts/ui/data-list-view.js') }}"></script>
<script src="{{ asset('/js/scripts/modal/components-modal.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{ asset('vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script>
    $("#datatable").DataTable();

</script>
@endsection
