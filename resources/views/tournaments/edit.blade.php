@extends('layout')

@section('title', $tournament->name )

<!-- Mapbox -->
<link href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' type='text/css' />
<script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
<!-- Mapbox geocoder -->
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v3.1.2/mapbox-gl-geocoder.min.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v3.1.2/mapbox-gl-geocoder.css' rel='stylesheet' type='text/css' />
<!-- Geocoder for city and country -->
<script src="http://js.api.here.com/v3/3.0/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
<script src="http://js.api.here.com/v3/3.0/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>

@section('content')

<div class="container" style="margin-top: 15px">

    <!-- Card -->
    <div class="card">

        <!-- Card Header -->
        <div class="card-header text-center">
            {{ __('main.edit tournament') }}
        </div>

        <!-- Card content -->
        <div class="card-body">

            <!-- Alerts -->
            @if( $errors->any() )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <ul>
                        @foreach( $errors->all() as $error )
                            <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div><br />
            @endif

            <!-- Form -->
            {{ Form::model($tournament, array('route' => array('tournaments.update', $tournament->id), 'method' => 'PUT')) }}

              <!-- Name && Website -->
              <div class="form-row">
                  <!-- Name -->
                  <div class="form-group col-md-6">
                      {{ Form::label('name', __('tournaments.name')) }}
                      {{ Form::text('name', null, array('class' => 'form-control')) }}
                  </div>
                  <!-- Website -->
                  <div class="form-group col-md-6">
                      {{ Form::label('website', __('tournaments.website')) }}
                      {{ Form::text('website', null, array('class' => 'form-control')) }}
                  </div>
              </div>

              <!-- Time control -->
              <div class="form-group">
                  {{ Form::label('category', __('tournaments.time control')) }}
                  {{ Form::text('category', null, array('class' => 'form-control')) }}
              </div>

              <!-- Begin date & End date -->
              <div class="form-row">
                  <!-- Begin date -->
                  <div class="form-group col-md-6">
                      {{ Form::label('begin', __('tournaments.begin date')) }}
                      {{ Form::text('begin', null, array('class' => 'form-control')) }}
                  </div>
                  <!-- End date -->
                  <div class="form-group col-md-6">
                      {{ Form::label('end', __('tournaments.end date')) }}
                      {{ Form::text('end', null, array('class' => 'form-control')) }}
                  </div>
              </div>

              <!-- Address -->
              <style> .mapboxgl-ctrl-geocoder { min-width:100%; } </style>
              <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="address"> {{ __('tournaments.address') }} </label>
                    <div id='geocoder' class="geocoder" style="min-width: 100%;"></div>
                  </div>
              </div>

              <!-- Map -->
              <div id='map' style='width: 100%; height: 300px;'></div>

              <!-- Address HIDDEN -->
              <input id="address" type="hidden" name="address"/>

              <!-- Country HIDDEN -->
              <input id="country" type="hidden" name="country"/>

              <!-- City HIDDEN -->
              <input id="city" type="hidden" name="city"/>

              <!-- Latitude HIDDEN -->
              <input id="lat" type="hidden" name="latitude"/>

              <!-- Longitude HIDDEN -->
              <input id="lng" type="hidden" name="longitude"/>

              <!-- User_id HIDDEN -->
              <input type="hidden" name="user_id" value={{ Auth::user()->id }}>

              <!-- Submit button -->
              <div class="text-center" style="margin-top: 15px">
                  {{ Form::submit( __('tournaments.save changes'), array('class' => 'btn btn-primary') ) }}
              </div>

            {{ Form::close() }}

        </div>

    </div>

</div>

@endsection

<!-- JQuery 3.3.1 -->
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>

<!-- JS -->
<script type="text/javascript">

    $(document).ready(function() {
        // today date
        var today = new Date();

        // begin date input
        $('input[name="begin"]').daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: true,
            autoApply: true,
            drops: 'up',
            locale: {
              format: 'YYYY/MM/DD',
              firstDay: 1
            }
        });

        // end date input
        $('input[name="end"]').daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: true,
            autoApply: true,
            drops: 'up',
            locale: {
              format: 'YYYY/MM/DD',
              firstDay: 1
            }
        });

        // on change begin input changing end input
        $('input[name="begin"]').on('apply.daterangepicker', function(ev, picker) {
            minDate2 = picker.startDate;
            $('input[name="end"').data('daterangepicker').minDate = minDate2;
            $('input[name="end"').data('daterangepicker').startDate = minDate2;
            $('input[name="end"').val( minDate2.format('YYYY/MM/DD') );
        });

        // mapbox
        mapboxgl.accessToken = 'pk.eyJ1IjoiZWR1YXltZSIsImEiOiJjam56M2p0ZXowN25rM29tYnBscTVjZTFjIn0.Oevt-9WPmmimHIyHHlCk0g';
        var map = new mapboxgl.Map({
          container: 'map',
          style: 'mapbox://styles/mapbox/streets-v11'
        });

        // Add zoom and rotation controls to the map.
        map.addControl(new mapboxgl.NavigationControl());

        // Add geolocate control to the map.
        map.addControl(new mapboxgl.GeolocateControl({
            positionOptions: {
            enableHighAccuracy: true
          },
          trackUserLocation: true
        }));

        var placeholderValue = {!! json_encode( __('tournaments.search')) !!};
        if( {!! json_encode( $tournament->address ) !!} ) {
          placeholderValue = {!! json_encode( $tournament->address ) !!};
          document.getElementById('address').value = {!! json_encode( $tournament->address ) !!};
          document.getElementById('country').value = {!! json_encode( $tournament->country ) !!};
          document.getElementById('city').value = {!! json_encode( $tournament->city ) !!};
          document.getElementById('lat').value = {!! json_encode( $tournament->latitude ) !!};
          document.getElementById('lng').value = {!! json_encode( $tournament->longitude ) !!};
        }

        var geocoder = new MapboxGeocoder({
          accessToken: mapboxgl.accessToken,
          reverseGeocode: true,
          placeholder: placeholderValue
        });

        document.getElementById('geocoder').appendChild(geocoder.onAdd(map));

        // After the map style has loaded on the page, add a source layer and default
        // styling for a single point.
        map.on('load', function() {
          map.addSource('single-point', {
            "type": "geojson",
            "data": {
              "type": "FeatureCollection",
              "features": []
            }
        });

        map.addLayer({
          "id": "point",
          "source": "single-point",
          "type": "circle",
          "paint": {
            "circle-radius": 7,
            "circle-color": "#7F0308"
          }
        });

        // Listen for the `result` event from the MapboxGeocoder that is triggered when a user
        // makes a selection and add a symbol that matches the result.
        geocoder.on('result', function(ev) {
          map.getSource('single-point').setData(ev.result.geometry);

          // begin address
          console.log( '----------------------------------------------' );

          // get address
          console.log( 'Address: ' + ev.result.place_name );
          document.getElementById("address").value = ev.result.place_name;

          // get latitude
          var latitude = ev.result.geometry.coordinates[1];
          console.log( 'Latitude: ' + latitude );
          document.getElementById("lat").value = latitude;

          // get longitude
          var longitude = ev.result.geometry.coordinates[0];
          console.log( 'Longitude: ' + longitude );
          document.getElementById("lng").value = longitude;

          // get city
          var city = '';
          var length = ev.result.context.length;
          if( length > 0 && length < 3 ) {
              city = ev.result.text;
          }
          else if( length < 4 && length > 2  ) {
              city = ev.result.context[0].text;
          }
          else if( length == 4 ) {
              city = ev.result.context[1].text;
          }
          else if( length == 5 ) {
              city = ev.result.context[2].text;
          }
          console.log( 'City: ' + city );
          document.getElementById("city").value = city;

          // get country
          var country = ev.result.context[ev.result.context.length-1].text;
          console.log( 'Country: ' + country );
          document.getElementById("country").value = country;
          });

          // end address
          console.log( '----------------------------------------------' );
        });

    });

</script>
