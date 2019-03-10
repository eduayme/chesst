@extends('layout')

@section('title', __('main.tournaments'))

@section('content')

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

          <!-- Tournaments table -->
          <table class="table dt-responsive nowrap table-hover" id="tourn" style="width: 100%">

              <!-- Table header -->
              <thead class="thead-dark">
                  <tr>
                      <th scope="col"> {{ __('tournaments.name') }} </th>
                      <th scope="col"> {{ __('tournaments.time control') }} </th>
                      <th scope="col"> {{ __('tournaments.begin date') }} </th>
                      <th scope="col"> {{ __('tournaments.end date') }} </th>
                      <th scope="col"> {{ __('tournaments.country') }} </th>
                      <th scope="col"> {{ __('tournaments.city') }} </th>
                      <th scope="col"> {{ __('tournaments.type time control') }} </th>
                  </tr>
              </thead>

              <!-- Table content -->
              <tbody>
                  @foreach( $tournaments as $tournament )
                      <tr>
                          <!-- Name -->
                          <td>
                              <a href="{{ url('tournaments/'.$tournament->id) }}" target="_blank">
                                 {{ $tournament->name }}
                              </a>
                              <!-- Badge Started  -->
                              @if( \Carbon\Carbon::parse($tournament->begin)->lt(now()) )
                                <span class="badge badge-dark"> {{ __('tournaments.started') }} </span>
                              @endif
                          </td>
                          <!-- Category -->
                          <td> {{ $tournament->category }} </td>
                          <!-- Begin date -->
                          <td> {{ date('d-M-Y', strtotime($tournament->begin)) }} </td>
                          <!-- End date -->
                          <td> {{ date('d-M-Y', strtotime($tournament->end)) }} </td>
                          <!-- Country -->
                          <td> {{ $tournament->country }} </td>
                          <!-- City -->
                          <td> {{ $tournament->city }} </td>
                          <!-- Type control time HIDDEN -->
                          @php
                            $cat = $tournament->category;
                            $minuts = substr( $cat, 0, strpos( $cat, "min" ) );
                            if( $minuts <= 5 ) $type = "Blitz";
                            elseif( $minuts <= 60 ) $type = "Rapid";
                            else $type = "Standard";
                          @endphp
                          <td> {{ $type }} </td>
                      </tr>
                  @endforeach
              </tbody>

          </table>

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

        // datetable
         var table = $('#tourn').DataTable({
            "order": [ [ 2, "asc" ], [ 3, "asc" ] ],
            "scrollX": true,
            "pagingType": "full_numbers",
            "columnDefs": [
                {
                    "targets": [ 6 ],
                    "visible": false
                }
            ]
        });

        // categories filter
        $('#categories').on('change', function () {
            table.columns(6).search( this.value ).draw();
        } );

        // dates range filter
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = $('input[name="datefilter"]').data('daterangepicker').startDate._d;
                var max = $('input[name="datefilter"]').data('daterangepicker').endDate._d;
                var startDate = new Date(data[2]);
                var endDate = new Date(data[3]);

                if( min == null && max == null ) { return true; }
                if( $('input[name="datefilter"]').val() == '' ) { return true; }
                if( min == null && endDate <= max ) { return true; }
                if( max == null && startDate >= min ) { return true; }
                if( endDate <= max && startDate >= min ) { return true; }
                return false;
            }
        );

        // today date
        var filter_minDay = new Date();

        // input date range
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

        // countries filter
        $('#countries').on('change', function () {
            table.columns(4).search( this.value ).draw();

            $("#cities").empty();
            $("#cities").append('<option value=""> {{ __("tournaments.all cities") }} </option>');

            var country = $(this).val();
            if(country) {
                $.ajax({
                   type: "GET",
                   url: "{{url('get-cities-list')}}?country=" + country,
                   success:function(res) {
                    if(res) {
                        $.each(res,function(key, value) {
                            $("#cities").append('<option value="'+ value.city +'">'+ value.city +'</option>');
                        });
                    }
                    else {
                        @foreach( $cities as $city )
                            $("#cities").append('<option value="{{ $city["city"] }}"> {{ $city["city"] }} </option>');
                        @endforeach
                    }
                   }
                });
            }
            else {
                @foreach( $cities as $city )
                    $("#cities").append('<option value="{{ $city["city"] }}"> {{ $city["city"] }} </option>');
                @endforeach
            }

            table.columns(5).search( '' ).draw();
        } );

        // cities filter
        $('#cities').on('change', function () {
            table.columns(5).search( this.value ).draw();
        } );

    });

</script>
