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
                    {{-- BEGIND Filtros --}}
                    <div class="card">
                        <div class="card-header">
                            <h4>Crear contacto</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{route('contact.save')}}" method="POST" class="form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            @if(!is_string($contact) && isset($contact->image))
                                                <div class="col-md-6 col-12">
                                                    <div class="users-view-image contact-image">
                                                        <img src="{{route('contact.image', ['filename'=>$contact->image])}}" class="contact-image mb-1 pr-2 ml-1" width="180" height="120" alt="avatar">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group col-12">
                                                <fieldset class="checkbox">
                                                    <div class="vs-checkbox-con vs-checkbox-primary float-right">
                                                        <input type="checkbox" name="favorito" id="favorito" {{App\Contact::checkedFavorite($contact) ?? ''}}>
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                        <span class="">Favorito</span>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                <input type="text" id="nombre-column" class="form-control @error('nombre') is-invalid @enderror" 
                                                       placeholder="Nombre" name="nombre" value="{{$contact->name ?? ''}}" required {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                    <label for="first-name-column">Nombre</label>
                                                </div>
                                                @error('nombre')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="apellido-column" class="form-control @error('apellido') is-invalid @enderror" placeholder="Apellido" 
                                                    name="apellido" value="{{$contact->last_name ?? ''}}" {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                    <label for="last-name-column">Apellido</label>
                                                </div>
                                                @error('apellido')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                             @if(is_string($contact))
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="file" id="image-column" class="form-control @error('image') is-invalid @enderror" placeholder="Imagen del contacto" 
                                                    name="image" {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                    <label for="last-name-column">Foto</label>
                                                </div>
                                                @error('image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            @endif
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="email" id="email-column" class="form-control @error('email') is-invalid @enderror" placeholder="Email" 
                                                    name="email" value="{{$contact->email ?? ''}}" {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                    <label for="city-column">Email</label>
                                                </div>
                                                @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="web-column" class="form-control @error('web') is-invalid @enderror" name="web" placeholder="Web"
                                                    value="{{$contact->web ?? ''}}" {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                    <label for="country-floating">Web</label>
                                                </div>
                                                @error('web')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="number" min=0 id="telefono-column" class="form-control" name="telefono" placeholder="Telefono"  
                                                    value="{{$contact->phone ?? ''}}" {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                    <label for="company-column">Telefono</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="empresa-column" class="form-control  @error('empresa') is-invalid @enderror" name="empresa" placeholder="Empresa"
                                                    value="{{$contact->company ?? ''}}" {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                    <label for="email-id-column">Empresa</label>
                                                </div>
                                                @error('empresa')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" min=0 id="cargo-emprea-column" class="form-control @error('cargo_empresa') is-invalid @enderror" 
                                                    name="cargo_empresa" placeholder="Cargo empresa" value="{{$contact->cargo ?? ''}}" {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                    <label for="company-column">Cargo Empresa</label>
                                                </div>
                                                @error('cargo_empresa')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="codigo-postal-column" class="form-control @error('codigo_postal') is-invalid @enderror" 
                                                    name="codigo_postal" placeholder="Código Postal" value="{{$contact->postal_code ?? ''}}" {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                    <label for="email-id-column">Código Postal</label>
                                                </div>
                                                @error('codigo_postal')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="sector-column" class="form-control @error('sector') is-invalid @enderror" 
                                                    name="sector" placeholder="Sector" value="{{$contact->sector ?? ''}}" {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                    <label for="email-id-column">Sector</label>
                                                </div>
                                                @error('sector')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            @if($contact =='persona' || $contact =='empresa')
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <select class="form-control @error('etiquetas') is-invalid @enderror" id="etiqueta-column" name="etiquetas" {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                        <option value="Cliente">Cliente</option>
                                                        <option value="Cliente Potencial">Cliente Potencial</option>
                                                        <option value="Colaborador">Colaborador</option>
                                                        <option value="Proveedor">Proveedor</option>
                                                    </select>
                                                    <label for="email-id-column">Tipo</label>
                                                </div>
                                                @error('etiquetas')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>

                                            @else
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="sector-column" class="form-control" value="{{$contact->type ?? ''}}" disabled>
                                                    <label for="email-id-column">Tipo</label>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                {{-- <label for="validationTooltip01">Contacto visible para...</label> --}}
                                                <select class="select2 form-control" name="grupos[]" multiple="multiple" id="compratir-column" placeholder="Contacto visible para...">
                                                  <option value="square">Todos los usuarios</option>
                                                  <option value="rectangle">Solo para mi</option>
                                                  <option value="rombo">Para mi y el siguiente grupo</option>
                                                  <option value="romboid">Para mi y los siguientes usuarios</option>                                               
                                                </select>
                                                <label for="compartir-id-column">Contacto visible para...</label>
                                            </div>
                                          </div>


                                            <div class="col-md-12 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="sector-column" class="form-control" name="type_contact" 
                                                    value="{{$contact=="empresa" || $contact=="persona" ? $contact : $contact->type_contact}}" hidden>
                                                    <textarea cols="3" id="anotaciones-column" class="form-control" name="anotaciones" placeholder="Anotaciones" 
                                                    {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>{{$contact->notes ?? ''}}
                                                    </textarea>
                                                    <label for="email-id-column">Anotaciones</label>
                                                </div>
                                            </div>

 
                                            <div class="col-md-12 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="address-input" class="form-control map-input @error('direccion_empresa') is-invalid @enderror" 
                                                    name="direccion_empresa" placeholder="Direccion empresa" value="{{$contact->address ?? ''}}" {{$contact =='persona' || $contact =='empresa' ? '' : 'disabled'}}>
                                                    <input type="text" class="form-control" id="address-latitude" value="0" name="address_latitude" hidden>
                                                    <input type="text" class="form-control" id="address-longitude" value="0" name="address_longitude" hidden>

                                                    <label for="company-column">Direccion Empresa</label>
                                                </div>
                                                @error('direccion_empresa')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror 
                                            </div>
                                            {{-- <div class="form-group col-12">
                                                <fieldset class="checkbox">
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="compartir" id="compartir">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                        <span class="">Compartir</span>
                                                    </div>
                                                </fieldset>
                                            </div> --}}

                                            {{-- BEGIN Mapa --}}
                                            <div class="form-group col-12">
                                                <div id="address-map-container" style="width:100%;height:400px; ">
                                                    <div style="width: 100%; height: 100%" id="address-map"></div>
                                                </div>
                                            </div>
                                            {{-- END Mapa --}}

                                            <div class="col-12">
                                                @if(!isset($contact->id))
                                                <button type="submit" class="btn btn-primary mr-1 mb-1">Guardar</button>
                                                <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Cancelar</button>
                                                @endif
                                            </div>
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
</div>
@endsection
@section('extra-js')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async></script>
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADg2I72vPVAuD_WW21wThK-uHxkbN81vA&libraries=places&callback=initialize" async defer> --}}
<script>
function initialize() {

$('form').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
});
const locationInputs = document.getElementsByClassName("map-input");

const autocompletes = [];
const geocoder = new google.maps.Geocoder;
for (let i = 0; i < locationInputs.length; i++) {

    const input = locationInputs[i];
    const fieldKey = input.id.replace("-input", "");
    const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

    const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || -33.8688;
    const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 151.2195;
    console.log(latitude); 
    const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
        center: {lat: latitude, lng: longitude},
        zoom: 13
    });
    const marker = new google.maps.Marker({
        map: map,
        position: {lat: latitude, lng: longitude},
    });

    marker.setVisible(isEdit);

    const autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.key = fieldKey;
    autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
}

for (let i = 0; i < autocompletes.length; i++) {
    const input = autocompletes[i].input;
    const autocomplete = autocompletes[i].autocomplete;
    const map = autocompletes[i].map;
    const marker = autocompletes[i].marker;

    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        marker.setVisible(false);
        const place = autocomplete.getPlace();

        geocoder.geocode({'placeId': place.place_id}, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                const lat = results[0].geometry.location.lat();
                const lng = results[0].geometry.location.lng();
                setLocationCoordinates(autocomplete.key, lat, lng);
            }
        });

        if (!place.geometry) {
            window.alert("No details available for input: '" + place.name + "'");
            input.value = "";
            return;
        }

        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

    });
}
}

function setLocationCoordinates(key, lat, lng) {
const latitudeField = document.getElementById(key + "-" + "latitude");
const longitudeField = document.getElementById(key + "-" + "longitude");
latitudeField.value = lat;
longitudeField.value = lng;
}

const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
center: {lat: latitude, lng: longitude},
zoom: 13
});
const marker = new google.maps.Marker({
map: map,
position: {lat: latitude, lng: longitude},
});

const autocomplete = new google.maps.places.Autocomplete(input);
autocomplete.key = fieldKey;
autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});

geocoder.geocode({'placeId': place.place_id}, function (results, status) {
if (status === google.maps.GeocoderStatus.OK) {

    const lat = results[0].geometry.location.lat();
    const lng = results[0].geometry.location.lng();

    setLocationCoordinates(autocomplete.key, lat, lng);
}
});

</script>
@endsection

@section('extra-js-app')
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
@endsection