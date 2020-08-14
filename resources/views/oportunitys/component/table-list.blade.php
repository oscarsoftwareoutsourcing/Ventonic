<!-- Data list view starts -->
                            <section id="data-list-view" class="data-list-view-header">
                                <!-- DataTable starts -->
                                <div class="table-responsive">
                                    <table id="datatable" class="table data-list-view mt-2">
                                        <thead>
                                            <tr>
                                                <th>ESTADO</th>
                                                <th>TITULO</th>
                                                <!--<th>EMPRESA</th>-->
                                                <th>CARGO</th>
                                                <th>UBICACION</th>
                                                <!--<th>TIPO EMPLEO</th>-->
                                                <th>SECTOR</th>
                                                <th>N° INSCRITOS</th>
                                                <th>CANDIDATOS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($oportunitys))
                                            @foreach($oportunitys as $oportunity)
                                            <tr href="{{route('oportunity', ['id'=>$oportunity->id])}}" id="fila{{$oportunity->id}}" class="filaEntera">
                                                <td></td>
                                                <td class="product-name">{{$oportunity->title}}
                                                    <input type="text" class="jobType" value="{{$oportunity->job_type_id}}" data-id="{{$oportunity->id}}" hidden>
                                                    <input type="text" class="antiguedad" value="{{$oportunity->ubication_oportunity_id}}" data-id="{{$oportunity->id}}" hidden>
                                                    <input type="text" class="sector" value="{{$oportunity->sectors}}" data-id="{{$oportunity->id}}" hidden>
                                                </td>
                                                <!--
                                                <td class="product-category">{{$oportunity->user->name}}</td>
                                                -->
                                                <td class="product-category">{{$oportunity->cargo}}</td>
                                                <td class="product-category">{{$oportunity->ubication}}</td>
                                                <!--
                                                <td class="product-price">{{App\JobType::getType((int)$oportunity->job_type_id)}}</td>
                                                -->
                                                <td class="product-price">{{App\Oportunity::listSectors($oportunity->sectors)}}</td>
                                                <td class="product-price" style="text-align:center;">
                                                @if(App\Aplicant::countAplicant($oportunity->id)>0)
                                                    <div class="chip chip-success">
                                                        <div class="chip-body text-center">
                                                            <div class="chip-text text-center">
                                                            <span class="text-center">{{App\Aplicant::countAplicant($oportunity->id)}}</td></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="chip chip-danger" style="text-align:center;" >
                                                        <div class="chip-body text-center">
                                                            <div class="chip-text text-center">
                                                            <span class="text-center">{{App\Aplicant::countAplicant($oportunity->id)}}</td></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <td class="product-price">
                                                @if(App\Aplicant::countAplicant($oportunity->id)>0)
                                                    <a href="{{route('oportunity.mispostulados', ['oportunity_id'=>$oportunity->id])}}" class="btn btn-primary btn-md text-white" type="button">Ver</a>
                                                @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- DataTable ends -->
                            </section>
                            <!-- Data list view end -->
