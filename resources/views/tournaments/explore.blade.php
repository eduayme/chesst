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

      <!-- Filters -->
      <div class="row text-center" style="margin-bottom: 20px">

          <!-- Categories filter -->
          <div class="col-sm">
              <select class="form-control" id="categories" style="margin: 5px 0">
                  <option value=""> {{ __('tournaments.all controls') }} </option>
                  <option value="Blitz"> {{ __('tournaments.blitz') }} </option>
                  <option value="Rapid"> {{ __('tournaments.rapid') }} </option>
                  <option value="Standard"> {{ __('tournaments.standard') }} </option>
              </select>
          </div>

          <!-- Dates filter -->
          <div class="col-sm-5">
              <input class="form-control" type="text" name="datefilter"
                    value="" placeholder="{{ __('tournaments.all dates') }}" style="margin: 5px 0"/>
          </div>

          <!-- Country filter -->
          <div class="col-sm">
              <select class="form-control" id="countries" style="margin: 5px 0">
                  <option value=""> {{ __('tournaments.all countries') }} </option>
                  @foreach( $countries as $country )
                      <option value="{{ $country['country'] }}"> {{ $country['country'] }} </option>
                  @endforeach
              </select>
          </div>

          <!-- Cities filter -->
          <div class="col-sm">
              <select class="form-control" id="cities" style="margin: 5px 0">
                  <option value=""> {{ __('tournaments.all cities') }} </option>
                  @foreach( $cities as $city )
                      <option value="{{ $city['city'] }}"> {{ $city['city'] }} </option>
                  @endforeach
              </select>
          </div>

      </div>

      <!-- Tournaments map -->
      <div id='map' style='height: 500px; width: 100%'></div>

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

      var filter_minDay = new Date();

      if( locale == 'en' ){
        $('input[name="datefilter"]').daterangepicker({
            autoUpdateInput: false,
            minDate: filter_minDay,
            opens: "center",
            locale: {
                cancelLabel: 'Clear',
                firstDay: 1
            }
        });
      }
      else if( locale == 'es' ) {
        $('input[name="datefilter"]').daterangepicker({
            autoUpdateInput: false,
            minDate: filter_minDay,
            opens: "center",
            locale: {
                cancelLabel: 'Borrar',
                firstDay: 1,
                applyLabel: 'Aceptar',
                cancelLabel: 'Cancelar',
                daysOfWeek: [
                    'Do',
                    'Lu',
                    'Ma',
                    'Mi',
                    'Ju',
                    'Vi',
                    'Sa'
                ],
                monthNames: [
                    'Ene',
                    'Feb',
                    'Mar',
                    'Abr',
                    'May',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dic'
                ]
            }
        });
      }

      // apply button dates range filter
      $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val( 'From ' + picker.startDate.format('DD-MMM-Y') + ' to ' + picker.endDate.format('DD-MMM-Y') );
           table.draw();
      });

      // cancel button dates range filter
      $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val( '' );
          table.draw();
      });

    });

</script>
