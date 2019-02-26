@extends('layout')

@section('title', $tournament->name )

@section('content')

<link href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>

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

        <h3 class="text-center">
          {{ $tournament->name }}
        </h3>

        <div class="container text-center">

          <div class="row">
            <div class="col-sm" style="padding: 15px">
                <span class="octicon octicon-calendar"></span>
                <b> {{ __('tournaments.begin date') }}: </b> </br>
                {{ date('d-M-Y', strtotime($tournament->begin)) }}
            </div>
            <div class="col-sm" style="padding: 15px">
                <span class="octicon octicon-calendar"></span>
                <b> {{ __('tournaments.end date') }}: </b> </br>
                {{ date('d-M-Y', strtotime($tournament->end)) }}
            </div>
            <div class="col-sm" style="padding: 15px">
                <span class="octicon octicon-location"></span>
                <b> {{ __('tournaments.location') }}: </b> </br>
                {{ $tournament->city }}, {{ $tournament->country }}
            </div>
            <div class="col-sm" style="padding: 15px">
                <span class="octicon octicon-clock"></span>
                <b> {{ __('tournaments.time control') }}: </b> </br>
                {{ $tournament->category }}
            </div>
            <div class="col-sm" style="padding: 15px">
              <a href="{{ $tournament->website }}" class="btn btn-outline-secondary"
                 role="button" target="_blank">
                <span class="octicon octicon-link"></span>
                {{ __('tournaments.website') }}
              </a>
            </div>
          </div>

        </div>

        <div id='map' style='width: 96%; height: 300px; margin: 0 2%'></div>
        <script>
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
        </script>

  </div>

@endsection
