@extends('layout')

@section('title', 'Tournaments')

@section('content')

        <!-- Alerts -->
        @if( session()->get('success') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('success') }}
            </div><br/>
        @endif

        <!-- If NO tournaments -->
        @if( count($tournaments) == 0 )
            <div class="card text-center">
              <div class="card-body">
                <h1 class="card-title"> No tournaments to display </h1>
                <p class="card-text"> Maybe you would like to create one? :) </p>
                <a href="../tournaments/create" class="btn btn-primary" role="button">Create Tournament</a>
              </div>
            </div>

        <!-- If tournaments -->
        @else

        <!-- Filters -->
        <div class="text-center" style="margin-bottom: 20px">

            <!-- Categories filter -->
            <select id="categories">
                <option value="">All</option>
                <option value="Software Engineer">Software Engineer</option>
                <option value="Sales Assistant">Sales Assistant</option>
            </select>

            <!-- Dates filter -->


            <!-- Country filter -->
            <select id="countries">
                <option value="">All</option>
                <option value="London">London</option>
                <option value="San Francisco">San Francisco</option>
            </select>

            <!-- Cities filter -->
            <select id="cities">
                <option value="">All</option>
                <option value="London">London</option>
                <option value="San Francisco">San Francisco</option>
            </select>

        </div>

        <!-- Tournaments table -->
        <table class="table dt-responsive nowrap table-hover" id="tourn" style="width: 100%">

            <!-- Table header -->
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Begin date</th>
                    <th scope="col">End date</th>
                    <th scope="col">Country</th>
                    <th scope="col">City</th>
                </tr>
            </thead>

            <!-- Table content -->
            <tbody>
                @foreach( $tournaments as $tournament )
                    <tr>
                        <!-- Name -->
                        <td>
                            <a href="{{ $tournament->website }}"
                               target="_blank" style="color: black">
                               {{ $tournament->name }}
                            </a>
                            <!-- Badge Started  -->
                            @if( \Carbon\Carbon::parse($tournament->begin)->lt(now()) )
                              <span class="badge badge-dark"> Started </span>
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
                    </tr>
                @endforeach
            </tbody>

        </table>
        @endif

@endsection


<!-- JQuery 3.3.1 -->
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>

<!-- JS -->
<script>

    $(document).ready(function() {
        $('#tourn').DataTable({
            "order": [ [ 3, "asc" ], [ 4, "asc" ] ],
            "scrollX": true,
            "pagingType": "full_numbers"
        });
    });

</script>
