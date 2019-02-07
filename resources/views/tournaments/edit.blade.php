@extends('layout')

@section('content')

    <!-- Card -->
    <div class="card">

        <!-- Card Header -->
        <div class="card-header">
            Edit Tournament
        </div>

        <!-- Card content -->
        <div class="card-body">

            <!-- Alerts -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div><br />
            @endif

            <!-- Form -->
            <form method="post" action="{{ route('tournaments.update', $tournament->id) }}">

                @method('PATCH')
                @csrf
                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value={{ $tournament->name }}/>
                </div>

                <!-- Time control & website -->
                <div class="form-row">
                    <!-- Time control -->
                    <div class="form-group col-md-6">
                        <label for="category">Time Control:</label>
                        <input type="text" class="form-control" name="category" value={{ $tournament->category }}/>
                    </div>
                    <!-- Website -->
                    <div class="form-group col-md-6">
                        <label for="website">Website:</label>
                        <input type="url" class="form-control" name="website" value={{ $tournament->website }}/>
                    </div>

                </div>

                <!-- Begin date & End date -->
                <div class="form-row">
                    <!-- Begin date -->
                    <div class="form-group col-md-6">
                        <label for="begin"> Begin date: </label>
                        <input type="text" class="form-control" name="begin" value={{ $tournament->begin }}/>
                    </div>
                    <!-- End date -->
                    <div class="form-group col-md-6">
                        <label for="end"> End date: </label>
                        <input type="text" class="form-control" name="end" value={{ $tournament->end }}/>
                    </div>
                </div>

                <!-- County & City -->
                <div class="form-row">
                    <!-- Country -->
                    <div class="form-group col-md-6">
                        <label for="begin">Country:</label>
                        <input type="text" class="form-control" name="country" value={{ $tournament->country }}/>
                    </div>
                    <!-- City -->
                    <div class="form-group  col-md-6">
                        <label for="begin">City:</label>
                        <input type="text" class="form-control" name="city"  value={{ $tournament->city }}/>
                    </div>
                </div>

                <!-- User_id HIDDEN -->
                <input type="hidden" name="user_id" value={{ Auth::user()->id }}>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary">Create Tournament</button>

            </form>

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
            showDropdowns: true,
            autoUpdateInput: true,
            autoApply: true,
            drops: 'up',
            minDate: today,
            locale: {
              format: 'YYYY/MM/DD'
            }
        });

        // end date input
        $('input[name="end"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: true,
            autoApply: true,
            drops: 'up',
            minDate: today,
            locale: {
              format: 'YYYY/MM/DD'
            }
        });

        // on change begin input changing end input
        $('input[name="begin"]').on('apply.daterangepicker', function(ev, picker) {
            minDate2 = picker.startDate;
            $('input[name="end"').data('daterangepicker').minDate = minDate2;
            $('input[name="end"').val( minDate2.format('YYYY/MM/DD') );
        });
    });

</script>
