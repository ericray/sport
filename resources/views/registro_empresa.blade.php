@extends('layouts.app')

@section('styles')
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100%;
        }
        .controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 300px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        .pac-container {
            font-family: Roboto;
        }

        #type-selector {
            color: #fff;
            background-color: #4d90fe;
            padding: 5px 11px 0px 11px;
        }

        #type-selector label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }
    </style>
@endsection
@section('content')

    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map"></div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Registro de empresa / instructor</h3>
        </div>
        <form action="{{ url('/empresa/registrar') }}" method="post">
            {!! csrf_field() !!}
            <div class="panel-body">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre">
                </div>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control" name="correo" id="correo">
                </div>
                <div class="form-group">
                    <label for="contrasenia">Contraseña</label>
                    <input type="password" class="form-control" name="contrasenia" id="contrasenia">
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
                    <input type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento">
                </div>
                <div class="form-group">
                    <label for="ciudad">Ciudad</label>
                    <select name="ciudad_id" id="ciudad_id" class="form-control">
                        @foreach($ciudades as $key => $val)
                            <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="habilidades">Habilidades</label>
                    <select name="habilidades[]" id="habilidades" class="form-control" multiple>
                        @foreach($deportes as $key => $val)
                            <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                @foreach($paquetes as $paquete)
                    <div class="col-sm-6 col-md-4 text-center">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ $paquete->nombre }}</h3>
                            </div>
                            <div class="panel-body">
                                <input type="radio" name="paquete" value="{{ $paquete->id }}">
                                <h4>
                                    @if($paquete->limite == 0)
                                        <span>Sin costo</span>
                                    @else
                                        ${{ $paquete->limite }}
                                    @endif
                                </h4>
                                <p>Hasta {{ $paquete->limite_eventos }} reservas.</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-success">Registrar</button>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
<script>

    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // [START region_getplaces]
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
        // [END region_getplaces]
    }

    $( function() {
        $( "#fecha_nacimiento" ).datepicker();
        $('#habilidades').select2({
            'placeholder' : 'Seleccione una habilidad',
            'allowClear' : true
        });
    } );
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATa5lt2rlo6KKYMDYXu2PUGjVCXj5H4CM-nkM&libraries=places&callback=initAutocomplete"
        async defer></script>
@endsection