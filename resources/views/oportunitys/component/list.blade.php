
                            <ul class="list-group list-group-flush">
                                @if(isset($oportunitys))
                                    @foreach($oportunitys as $oportunity)
                                        <li class="list-group-item">
                                            <span class="float-right">
                                                <a href="{{route('oportunity', ['id'=>$oportunity->id])}}" id="fila{{$oportunity->id}}">
                                                    <i class="feather icon-edit controls"></i>
                                                </a>
                                                <!--
                                                <a>
                                                    <i class="feather icon-trash-2 controls"></i>
                                                </a>
                                                -->
                                            </span>
                                            <div class=row>
                                                <div class="col-lg-2 col-md-2 col-sm-2 center">
                                                    @if(App\Aplicant::countAplicant($oportunity->id)>0)
                                                    <a href="{{route('oportunity.mispostulados', ['oportunity_id'=>$oportunity->id])}}" >
                                                    <div class="avatar bg-success mr-1 avatar-lg">
                                                        <div class="avatar-content">
                                                            <strong>
                                                                {{ App\Aplicant::countAplicant($oportunity->id) }}
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    </a>
                                                    @else
                                                    <div class="avatar bg-danger mr-1 avatar-lg">
                                                        <div class="avatar-content">
                                                            <strong>
                                                        0
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    Aplicantes
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9" >
                                                    <h5>{{ $oportunity->title }}</h5>
                                                    <p class="card-text  mb-0">{{ $oportunity->cargo }}</p>
                                                    <span class="card-text">{{ $oportunity->ubication }}</span>
                                                    <p class="card-text  mb-1">{{App\Oportunity::listSectors($oportunity->sectors)}}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                                </ul>
