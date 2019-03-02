@extends('layout')

@section('title', $tournament->name )

@section('content')

  <!-- Mapbox -->
  <link href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' type='text/css' />
  <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
  <!-- Mapbox geocoder -->
  <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v3.1.2/mapbox-gl-geocoder.min.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v3.1.2/mapbox-gl-geocoder.css' rel='stylesheet' type='text/css' />

  <!-- Alerts -->
  @if( session()->get('success') )
      <div class="alert alert-success" role="alert">
        <div class="container text-center" style="margin-bottom: 0">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('success') }}
        </div>
      </div>
  @endif

  <!-- Content -->
  <div class="container" style="margin-top: 15px; margin-bottom: 15px">

      <div class="card" style="padding: 30px 15px">

        <!-- Name -->
        <h3 class="text-center">
          {{ $tournament->name }}
        </h3>

        <div class="container text-center">

          <div class="row">
            <div class="col-sm" style="padding: 15px">
                <!-- Begin date -->
                <span class="octicon octicon-calendar"></span>
                <b> {{ __('tournaments.begin date') }}: </b> </br>
                {{ date('d-M-Y', strtotime($tournament->begin)) }}
            </div>
            <div class="col-sm" style="padding: 15px">
                <!-- End date -->
                <span class="octicon octicon-calendar"></span>
                <b> {{ __('tournaments.end date') }}: </b> </br>
                {{ date('d-M-Y', strtotime($tournament->end)) }}
            </div>
            <div class="col-sm" style="padding: 15px">
                <!-- Location -->
                <span class="octicon octicon-location"></span>
                <b> {{ __('tournaments.location') }}: </b> </br>
                {{ $tournament->city }}, {{ $tournament->country }}
            </div>
            <div class="col-sm" style="padding: 15px">
                <!-- Time control -->
                <span class="octicon octicon-clock"></span>
                <b> {{ __('tournaments.time control') }}: </b> </br>
                {{ $tournament->category }}
            </div>
            <div class="col-sm" style="padding: 15px">
                <!-- Website -->
                <a href="{{ $tournament->website }}" class="btn btn-outline-secondary"
                   role="button" target="_blank">
                <span class="octicon octicon-link"></span>
                {{ __('tournaments.website') }}
              </a>
            </div>
          </div>

        </div>

        @if( $tournament->address )
            <div id='map' style='height: 300px; margin: 30px'></div>
        @endif

  </div>

@endsection

<!-- JQuery 3.3.1 -->
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>

<!-- JS -->
<script type="text/javascript">

    $(document).ready(function() {
        // mapbox
        mapboxgl.accessToken = 'pk.eyJ1IjoiZWR1YXltZSIsImEiOiJjam56M2p0ZXowN25rM29tYnBscTVjZTFjIn0.Oevt-9WPmmimHIyHHlCk0g';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [
                {!! json_encode( $tournament->longitude ) !!},
                {!! json_encode( $tournament->latitude  ) !!}
            ],
            zoom: 10
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

        map.on('load', function () {

            map.addLayer({
                "id": "points",
                "type": "symbol",
                "source": {
                    "type": "geojson",
                    "data": {
                        "type": "FeatureCollection",
                        "features": [{
                            "type": "Feature",
                            "geometry": {
                                "type": "Point",
                                "coordinates": [
                                    {!! json_encode( $tournament->longitude ) !!},
                                    {!! json_encode( $tournament->latitude  ) !!}
                                ]
                            },
                            "properties": {
                                "title": {!! json_encode( $tournament->name ) !!},
                                "icon": "marker"
                            }
                        }]
                    }
                },
                "layout": {
                    "icon-image": "{icon}-15",
                    "text-field": "{title}",
                    "text-font": ["Open Sans Semibold", "Arial Unicode MS Bold"],
                    "text-offset": [0, 0.6],
                    "text-anchor": "top",
                }
            });
        });

    });

</script>
