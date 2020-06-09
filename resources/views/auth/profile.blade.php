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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Perfil</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @else
                                @if (session('verified'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('El correo fue verificado, ahora puedes completar tu perfil') }}
                                    </div>
                                @endif
                            @endif
                            {{-- Formulario de actualización de datos de perfil --}}
                            <form method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-12 col-form-label text-center">
                                        {{ __('Perfil completado') }}
                                    </label>
                                    <div class="col-12 mb-4">
                                        <div class="progress progress-lg progress-bar-primary">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $status }}%;"
                                                aria-valuenow="{{ $status }}" aria-valuemin="0" aria-valuemax="100">
                                                {{ $status }}%
                                            </div>
                                        </div>
                                        <input type="hidden" name="status" value="{{ $status }}">
                                    </div>
                                </div>
                                @if ($type === 'E')
                                    {{-- Perfil de la empresa --}}
                                    <div class="form-group row">
                                        <label for="country" class="col-md-4 col-form-label text-md-right">
                                            {{ __('Pais') }}
                                        </label>

                                        <div class="col-md-2">
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        @if (!is_null($profile) && $profile->country_flag)
                                                            {!! $profile->country_flag !!}
                                                        @else
                                                            {!! $country_flag !!}
                                                        @endif
                                                    </span>
                                                </div>
                                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') ?? ((!is_null($profile)) ? $profile->country : '+' . $phone_code) }}" required autocomplete="country" autofocus>
                                            </div>

                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dni_rif" class="col-md-4 col-form-label text-md-right">
                                            {{ __('NIF / CIF') }}
                                        </label>

                                        <div class="col-md-6">
                                            <input id="dni_rif" type="text" class="form-control @error('dni_rif') is-invalid @enderror" name="dni_rif" value="{{ old('dni_rif') ?? ((!is_null($profile)) ? $profile->dni_rif : '') }}" autocomplete="dni_rif">

                                            @error('dni_rif')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="photo" class="col-md-4 col-form-label text-md-right">
                                            {{ __('Imagen / Logo') }}
                                        </label>

                                        <div class="col-md-6">
                                            @if(!is_null($profile) && $profile->photo)
                                                <img src="{{ $profile->photo }}" class="img-fluid mb-3" alt="" style="width:200px">
                                            @endif
                                            <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') ?? ((!is_null($profile)) ? $profile->photo : '') }}" autocomplete="photo">
                                            <small id="photoHelpBlock" class="form-text text-muted">
                                                La imagen debe ser mínimo de 100x100 px y máximo de 800x800 px.<br>
                                                El tamaño debe ser como máximo 2MB.<br>
                                                Los formatos soportados son: jpeg, jpg, png y svg
                                            </small>
                                            @error('photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @else
                                    {{-- Perfil del vendedor --}}
                                    <div class="form-group row">
                                        <label for="phone_mobil" class="col-md-4 col-form-label text-md-right">
                                            {{ __('Teléfono móvil') }}
                                        </label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        @if (!is_null($profile) && $profile->mobil_country_flag)
                                                            {!! $profile->mobil_country_flag !!}
                                                        @else
                                                            {!! $country_flag !!}
                                                        @endif
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control col-3 @error('phone_mobil_country') is-invalid @enderror"
                                                    name="phone_mobil_country"
                                                    value="{{ old('phone_mobil_country') ?? ((!is_null($profile)) ? $profile->phone_mobil_country : '+' . $phone_code) }}"
                                                    required autocomplete="phone_mobil_country" onblur="getCountryFlag($(this))"  autofocus>
                                                <input type="text" class="form-control ml-3 @error('phone_mobil') is-invalid @enderror" name="phone_mobil" value="{{ old('phone_mobil') ?? ((!is_null($profile)) ? $profile->phone_mobil : '') }}"
                                                required autocomplete="phone_mobil" maxlength="9">
                                            </div>
                                            @error('phone_mobil_country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">

                                            @error('phone_mobil')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row">
                                        <label for="phone_mobil" class="col-md-4 col-form-label text-md-right">
                                            {{ __('Teléfono mobil') }}
                                        </label>

                                        <div class="col-md-6">
                                            <input id="phone_mobil" type="text" class="form-control @error('phone_mobil') is-invalid @enderror" name="phone_mobil" value="{{ old('phone_mobil') ?? ((!is_null($profile)) ? $profile->phone_mobil : '') }}" required autocomplete="phone_mobil">

                                            @error('phone_mobil')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <div class="form-group row">
                                        <label for="phone_home" class="col-md-4 col-form-label text-md-right">
                                            {{ __('Teléfono de casa') }}
                                        </label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        @if (!is_null($profile) && $profile->home_country_flag)
                                                            {!! $profile->home_country_flag !!}
                                                        @else
                                                            {!! $country_flag !!}
                                                        @endif
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control col-3 @error('phone_home_country') is-invalid @enderror" name="phone_home_country"
                                                value="{{ old('phone_home_country') ?? ((!is_null($profile)) ? $profile->phone_home_country : '+' . $phone_code) }}"
                                                    autocomplete="phone_home_country" onblur="getCountryFlag($(this))" autofocus>
                                                <input type="text" class="form-control ml-3 @error('phone_home') is-invalid @enderror" name="phone_home" value="{{ old('phone_home') ?? ((!is_null($profile)) ? $profile->phone_home : '') }}"
                                                autocomplete="phone_home" maxlength="9">
                                            </div>
                                            @error('phone_home_country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">

                                            @error('phone_home')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="photo" class="col-md-4 col-form-label text-md-right">
                                            {{ __('Foto de perfil') }}
                                        </label>

                                        <div class="col-md-6">
                                            @if(!is_null($profile) && $profile->photo)
                                                <img src="{{ $profile->photo }}" class="img-fluid mb-3" alt="" style="width:200px">
                                            @endif
                                            <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') ?? ((!is_null($profile)) ? $profile->photo : '') }}" autocomplete="photo">
                                            <small id="photoHelpBlock" class="form-text text-muted">
                                                La imagen debe ser mínimo de 100x100 px y máximo de 800x800 px.<br>
                                                El tamaño debe ser como máximo 2MB.<br>
                                                Los formatos soportados son: jpeg, jpg, png y svg
                                            </small>
                                            @error('photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="video" class="col-md-4 col-form-label text-md-right">
                                            {{ __('Vídeo') }}
                                        </label>

                                        <div class="col-md-6">
                                            @if(!is_null($profile) && $profile->video)
                                                <div class="embed-responsive embed-responsive-16by9 mb-3">
                                                    <video class="video" src="{{ $profile->video }}" autoplay loop/>
                                                </div>
                                            @endif
                                            <input id="video" type="file" class="form-control @error('video') is-invalid @enderror" name="video" value="{{ old('video') ?? ((!is_null($profile)) ? $profile->video : '') }}" autocomplete="video">
                                            <small id="videoHelpBlock" class="form-text text-muted">
                                                El tamaño del vídeo debe ser como máximo 2MB.<br>
                                                Los formatos soportados son: .avi, .mpeg, .mp4 y .wmv
                                            </small>
                                            @error('video')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="linkedin" class="col-md-4 col-form-label text-md-right">
                                            {{ __('Usuario linkedin') }}
                                        </label>

                                        <div class="col-md-6">
                                            <input id="linkedin" type="text" class="form-control @error('linkedin') is-invalid @enderror" name="linkedin" value="{{ old('linkedin') ?? ((!is_null($profile)) ? $profile->linkedin : '') }}" autocomplete="linkedin">

                                            @error('linkedin')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                @if (!$questions->isEmpty())
                                    <hr class="mt-5 mb-5">
                                    <h6 class="display-6 text-center mt-3 mb-3">Encuesta</h6>
                                    @php
                                        $answered = ($profile!==null && $profile->answered!==null)
                                                    ? json_decode($profile->answered) : [];
                                    @endphp
                                    @foreach ($questions as $q)
                                        <div class="form-group row ml-4 mr-4">
                                            <label class="col-md-12 col-form-label">
                                                <b>{{ $q->priority }}- {{ $q->name }}</b>
                                            </label>
                                            <div class="col-md-12">
                                                @foreach (json_decode($q->options) as $key => $value)
                                                    @php
                                                        $checked = '';
                                                    @endphp
                                                    @foreach ($answered as $ans)
                                                        @php
                                                            $checked = (
                                                                $ans->question_id == $q->id && $ans->option_index == $key
                                                            ) ? 'checked' : '';
                                                            if ($checked === 'checked') {
                                                                break;
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    <div class="form-check">
                                                        {{--  is-invalid (agregar esta clase cuando hay errores del formulario) --}}
                                                        <input class="form-check-input"
                                                            type="{{ ($q->selection_type === 'U') ? 'radio' : 'checkbox' }}"
                                                            name="question[{{ ($q->selection_type === 'U') ? $q->id :  $q->id . '_' . $key }}]"
                                                            value="{{ $q->id . '_' . $key }}" {{ $checked }}>
                                                        <label class="form-check-label">
                                                            {{ $value }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="form-group row mb-0">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary float-right">
                                            {{ __('Guardar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
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
@endsection

@section('extra-js')
    @parent
    <script>
        function getCountryFlag(el) {
            el.val();
            axios.post('{{ route('get-country-flag') }}', {
                country_code: el.val()
            }).then(response => {
                if (response.data.country_flag) {
                    el.closest('.input-group').find('span').html(response.data.country_flag);
                }
            }).catch(error => {
                console.error(error);
            });
        }
    </script>
@endsection
