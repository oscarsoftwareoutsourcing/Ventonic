<div class="row">
@if(isset($oportunitys))
        @foreach($oportunitys as $oportunity)


<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="card">
        <div class="">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                                            
                    <div class="box-avatar">
                        <div class="div-box">
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
                                <br>
                                <a href="{{route('oportunity.mispostulados', ['oportunity_id'=>$oportunity->id])}}" >
                                    Ver Aplicantes
                                </a>
                            @else
                            <div class="avatar bg-danger mr-1 avatar-lg">
                                <div class="avatar-content">
                                    <strong>
                                0
                                    </strong>
                                </div>
                            </div>
                            <br>
                            Aplicantes
                        @endif
                        </div>
                    </div>
                                             
                                         </div>
                                         <div class="col-lg-9 col-md-9 col-sm-9 divide-white" >
                                             
                                             <div class="card-body">
                                                 <span class="float-right">
                                                    <a href="{{route('oportunity', ['id'=>$oportunity->id])}}" id="fila{{$oportunity->id}}">
                                                        <i class="feather icon-edit controls"></i>
                                                    </a>
                                                </span>
                                                <h3>{{$oportunity->title}}</h3>
                                                <input type="text" class="jobType" value="{{$oportunity->job_type_id}}" data-id="{{$oportunity->id}}" hidden>
                                                <input type="text" class="antiguedad" value="{{$oportunity->ubication_oportunity_id}}" data-id="{{$oportunity->id}}" hidden>
                                                <input type="text" class="sector" value="{{$oportunity->sectors}}" data-id="{{$oportunity->id}}" hidden>
                                                <p class="card-text  mb-0"><span class="flag-icon flag-icon-es"></span> {{$oportunity->user->name}}</p>
                                                <span class="card-text">{{$oportunity->cargo}}</span>
                                                <!--
                                                <p class="card-text  mb-0">{{App\JobType::getType((int)$oportunity->job_type_id)}}</p>
                                                -->
                                                <p class="card-text  mb-0">{{App\Oportunity::listSectors($oportunity->sectors)}}</p>

                                             <div class="card-btns justify-content-between mt-2">
                                            <a href="#" ></a>
                                           
                                        </div>
                                        </div>
                                         </div>
                                     </div>

                                   
                                   
                                </div>
                            </div>

                        </div>


                          @endforeach
                    @endif

</div>