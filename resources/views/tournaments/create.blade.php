@extends('layout')

@section('title', 'Add Tournament')

@section('content')

<div class="container" style="margin-top: 15px">

    <!-- Card -->
    <div class="card">

        <!-- Card Header -->
        <div class="card-header text-center">
            {{ __('main.add tournament') }}
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
            <form method="post" action="{{ route('tournaments.store') }}"
                  oninput="category.value = standard.value +'min + '+ increment.value +'sec' ">

                <!-- Name && Website -->
                <div class="form-row">
                    @csrf
                    <!-- Name -->
                    <div class="form-group col-md-6">
                      <label for="name"> {{ __('tournaments.name') }}: </label>
                      <input type="text" class="form-control" name="name"/>
                    </div>
                    <!-- Website -->
                    <div class="form-group col-md-6">
                      <label for="website"> {{ __('tournaments.website') }}: </label>
                      <input type="url" class="form-control" name="website"/>
                    </div>
                </div>

                <!-- Time control -->
                <div class="form-group">
                    <label for="category"> {{ __('tournaments.time control') }}: </label>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-3">
                                <input type="number" class="form-control" placeholder="Initial" name="standard">
                            </div>
                            <div class="col-2">
                                <h3> {{ __('tournaments.min') }} </h3>
                            </div>
                            <div class="col-2">
                                <h2 style="text-align: center"> + </h2>
                            </div>
                            <div class="col-3">
                                <input type="number" class="form-control" placeholder="Increment" name="increment">
                            </div>
                            <div class="col-2">
                                <h3> {{ __('tournaments.sec') }} </h3>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="category"/>
                </div>

                <!-- Begin date & End date -->
                <div class="form-row">
                    <!-- Begin date -->
                    <div class="form-group col-md-6">
                        <label for="begin"> {{ __('tournaments.begin date') }}: </label>
                        <input type="text" class="form-control" name="begin" placeholder="YYYY/MM/DD" value=""/>
                    </div>
                    <!-- End date -->
                    <div class="form-group col-md-6">
                        <label for="end"> {{ __('tournaments.end date') }}: </label>
                        <input type="text" class="form-control" name="end" placeholder="YYYY/MM/DD" value=""/>
                    </div>
                </div>

                <!-- County & City -->
                <div class="form-row">
                    <!-- Country -->
                    <div class="form-group col-md-6">
                        <label for="begin"> {{ __('tournaments.country') }}: </label>
                        <select class="form-control" name="country">
                            @include('parts.selectCountries')
                        </select>
                    </div>
                    <!-- City -->
                    <div class="form-group  col-md-6">
                        <label for="begin"> {{ __('tournaments.city') }}: </label>
                        <input type="text" class="form-control" name="city"/>
                    </div>
                </div>

                <!-- User_id HIDDEN -->
                <input type="hidden" name="user_id" value={{ Auth::user()->id }}>

                <!-- Submit button -->
                <div class="text-center" style="margin-top: 15px">
                    <button type="submit" class="btn btn-primary"> {{ __('main.add tournament') }} </button>
                </div>

            </form>

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
            minDate: today,
            locale: {
              format: 'YYYY/MM/DD',
              firstDay: 1
            }
        });
        $('input[name="begin"').val( '' );

        // end date input
        $('input[name="end"]').daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: true,
            autoApply: true,
            drops: 'up',
            minDate: today,
            locale: {
              format: 'YYYY/MM/DD',
              firstDay: 1
            }
        });
        $('input[name="end"').val( '' );

        // on change begin input changing end input
        $('input[name="begin"]').on('apply.daterangepicker', function(ev, picker) {
            minDate2 = picker.startDate;
            $('input[name="end"').data('daterangepicker').minDate = minDate2;
            $('input[name="end"').data('daterangepicker').startDate = minDate2;
            $('input[name="end"').val( minDate2.format('YYYY/MM/DD') );
        });
    });

</script>
