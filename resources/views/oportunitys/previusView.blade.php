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
                        <div class="card-content">
                          @if($oportunityDraft->image)
                            <div class="container-image-oportunity">
                                <img class="card-img-top img-fluid" src="{{ route('oportunityImage', ['filename'=>$oportunityDraft->image])}}">
                            </div>
                            <div class="titleOportunity">
                                <h4>{{$oportunityDraft->profesion->description}}</h4>
                                <p class="card-text">{{$oportunityDraft->jobType->description}}</p>                              
                            </div>
                           
                            @endif
                            <div class="card-body body-oportunitys">
                                {{-- Descripcion --}}
                                @if(!empty($oportunityDraft->description))
                                    <p class="habilidades_cargo_title"><span><i class="feather icon-flag"></i> Descripcion</span></p>  
                                    <div id="description-oportunity">
                                        <p class="oportunity-description">{{$oportunityDraft->description}}</p>
                                    </div>
                                @endif

                                {{-- Habilidades --}}
                                @if(!empty($skillSelecteds))
                                    <p class="habilidades_cargo_title"><span><i class="feather icon-alert-octagon"></i> Habilidades que se requieren para esta oportunidad</span></p>  
                                    @if($oportunityDraft->experience)
                                        <p class="experience_oportunity"><span><i class="feather icon-plus"></i> </span>{{$oportunityDraft->experience}}<span> Años de Experiencia </span></p>
                                    @endif       

                                    <div class="container-habilidades">
                                        @foreach($skillSelecteds as $skill)
                                            <span class="skill">{{App\Oportunity::verifySkill($skill->skill_id)}}</span>
                                        @endforeach 
                                    </div>
                                @endif
                                
                                {{-- Experiencie --}}

                                {{-- Empresa --}}
                                <div class="empresa_oportunity">
                                    @if(Auth::user()->photo)
                                        {{-- <p><img class="imagen-empresa round" src="{{ Auth::user()->photo }}" alt="" height="40" width="40"><span>{{$oportunityDraft->user->name}}</span><p> --}}
                                        <p><img class="imagen-empresa round" src="{{route('oportunityImage', ['filename'=>$oportunityDraft->image])}}" alt="" height="40" width="40"><span>{{$oportunityDraft->user->name}}</span><p>
                                    @endif
                                <div>
                                <div class="clearfix">
                                
                                    {{-- Ubicacion --}}
                                @if(!empty($oportunityDraft->ubication))
                                <div class="">
                                    <p><span><i class="feather icon-map-pin mb-0"></i></span>ubicacion</p>
                                    <p class="ubication-text mt-0">{{$oportunityDraft->ubication}}<p>
                                <div>
                                @endif
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                
                                <div class="row justify-content-center senForm-step1">
                                    <div class="col-12 justify-content-center">
                                            <p>Termina en: </p>
                                            <p>| 23 | 13 | 25 | 12 |</p>
                                    </div>
                                    <div class="col-5 justify-content-center content-btn-save-oportunity">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mx-auto mt-1" name="referir" value="referir">REFERIR</button>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mx-auto mt-1" name="publicada" value="publicada">PUBLICAR</button>
                                    </div>
                                    {{-- <div class="col-6 justify-content-center">
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
