@extends('layout')

@section('title', 'Tournaments')

@section('content')

        @if(session()->get('success'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
            </div><br/>

        @endif

        @if( count($tournaments) == 0)
            <h3 class="card-title">No tournaments to display</h3>

        @else
        <table class="table dt-responsive nowrap table-hover" id="tour">

            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Begin date</th>
                    <th scope="col">End date</th>
                    <th scope="col">Country</th>
                    <th scope="col">City</th>
                    <th scope="col">Website</th>

                    <!--
                    <th colspan="2">Action</th>
                    -->

                </tr>
            </thead>

            <tbody>

                @foreach( $tournaments as $tournament )
                    <tr>
                        <td> {{ $tournament->name }} </td>
                        <td> {{ $tournament->category }} </td>
                        <td> {{ date('d-M-Y', strtotime($tournament->begin)) }} </td>
                        <td> {{ date('d-M-Y', strtotime($tournament->end)) }} </td>
                        <td> {{ $tournament->country }} </td>
                        <td> {{ $tournament->city }} </td>
                        <td> <a href="{{ $tournament->website }}" class="btn btn-sm btn-outline-secondary" target="_blank">
                                Website </a></td>

                        <!--
                        <td> <a href="{{ route('tournaments.edit', $tournament->id) }}" class="btn btn-sm btn-outline-success">
                                Edit </a></td>
                        <td>
                            <form action="{{ route('tournaments.destroy', $tournament->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                            </form>
                        </td>
                        -->

                    </tr>
                @endforeach

            </tbody>

        </table>

        @endif

@endsection

<!-- JQuery 3.3.1 -->
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<!-- JQuery for DataTables -->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<!-- DataTables for Bootstrap 4.1 -->
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Sorting date for DataTables -->
<script src="{{ asset('js/sortingDate.js') }}"></script>

<!-- JS -->
<script>
    $(document).ready(function() {
        $('#tour').DataTable({
            "order": [ [ 2, "asc" ], [ 3, "asc" ] ],
        });
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
    });
</script>