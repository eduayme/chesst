@extends('layout')

@section('title', __('main.tournaments'))

@section('content')

    <!-- Mapbox -->
    <link href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' type='text/css' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
    <!-- Mapbox geocoder -->
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v3.1.2/mapbox-gl-geocoder.min.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v3.1.2/mapbox-gl-geocoder.css' rel='stylesheet' type='text/css' />

    <!-- Mapbox popup -->
    <style>
        .mapboxgl-popup {
          width: 100px;
          text-align: center;
          font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
        }
    </style>

    <!-- Success alerts -->
    @if( session()->get('success') )
        <div class="alert alert-success" role="alert">
          <div class="container text-center" style="margin-bottom: 0">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ session()->get('success') }}
          </div>
        </div>
    @endif
    <!-- Info alerts -->
    @if( session()->get('primary') )
        <div class="alert alert-primary" role="alert">
          <div class="container text-center" style="margin-bottom: 0">
            <a href="#" class="close" data-dismiss="primary" aria-label="close">&times;</a>
              {{ session()->get('primary') }}
          </div>
        </div>
    @endif

    <!-- If NO tournaments -->
    @if( count($tournaments) == 0 )
        <div class="container" style="margin-top: 15px">
          <div class="card text-center">
            <div class="card-body">
              <h1 class="card-title"> {{ __('tournaments.no tournament') }} </h1>
              <p class="card-text"> {{ __('tournaments.add one') }} </p>
              <a href="../tournaments/create" class="btn btn-primary" role="button">
                {{ __('main.add tournament') }}
              </a>
            </div>
          </div>
        </div>

    <!-- If tournaments -->
    @else

    <div class="container" style="margin-top: 15px">

      <!-- Tournaments map -->
      <div id='map' style='height: 500px; width: 100%'></div>

    </div>

    @endif

@endsection


<!-- JQuery 3.3.1 -->
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>

<!-- JS -->
<script>

    $(document).ready(function() {
      // locale language
      var locale = '{{ config('app.locale') }}';

      // mapbox
      mapboxgl.accessToken = 'pk.eyJ1IjoiZWR1YXltZSIsImEiOiJjam56M2p0ZXowN25rM29tYnBscTVjZTFjIn0.Oevt-9WPmmimHIyHHlCk0g';
      var map = new mapboxgl.Map({
          container: 'map',
          style: 'mapbox://styles/mapbox/streets-v11',
          center: [
              [33],
              [33]
          ],
          zoom: 1
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
                      "features": [
                        @foreach( $tournaments as $tournament )
                        {
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
                              "description": '<a class="btn btn-outline-primary" target="_blank" href="'
                                              + {!! json_encode( url('tournaments/'.$tournament->id) ) !!}
                                              + '"> <span class="octicon octicon-eye"></span> </a>',
                              "icon": "marker"
                          }
                        },
                        @endforeach
                    ]
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

      map.on('click', 'points', function (e) {
        var coordinates = e.features[0].geometry.coordinates.slice();
        var description = e.features[0].properties.description;

        // Ensure that if the map is zoomed out such that multiple
        // copies of the feature are visible, the popup appears
        // over the copy being pointed to.
        while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
        }

        new mapboxgl.Popup()
        .setLngLat(coordinates)
        .setHTML(description)
        .addTo(map);
      });

      // Change the cursor to a pointer when the mouse is over the places layer.
      map.on('mouseenter', 'points', function () {
        map.getCanvas().style.cursor = 'pointer';
      });

      // Change it back to a pointer when it leaves.
      map.on('mouseleave', 'points', function () {
        map.getCanvas().style.cursor = '';
      });

      var clusterRadius = 20;
      var clusterMaxZoom = 14;


    });

</script>
