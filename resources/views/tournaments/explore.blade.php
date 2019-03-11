@extends('layout')

@section('title', __('main.tournaments'))

@section('content')

    <!-- Mapbox -->
    <link href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' type='text/css' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
    <!-- Mapbox geocoder -->
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v3.1.2/mapbox-gl-geocoder.min.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v3.1.2/mapbox-gl-geocoder.css' rel='stylesheet' type='text/css' />

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

    });

</script>
