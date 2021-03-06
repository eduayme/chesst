@extends('layout')

@section('title', __('tournaments.my tournaments'))

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
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
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

            <!-- Header -->
            <h1 class="text-center"> {{ __('tournaments.my tournaments') }} </h1>

              <!-- Table -->
              <table class="table dt-responsive nowrap table-hover" id="tournaments" style="width: 100%">

                  <!-- Table header -->
                  <thead class="thead-dark">
                      <tr>
                        <th scope="col"> </th>
                        <th scope="col"> </th>
                        <th scope="col"> {{ __('tournaments.name') }} </th>
                        <th scope="col"> {{ __('tournaments.time control') }} </th>
                        <th scope="col"> {{ __('tournaments.begin date') }} </th>
                        <th scope="col"> {{ __('tournaments.end date') }} </th>
                      </tr>
                  </thead>

                  <!-- Table content -->
                  <tbody>

                      @foreach( $tournaments as $tournament )
                          <tr>
                              <!-- Action -->
                              <td>
                                    <!-- Delete -->
                                    <form action="{{ route('tournaments.destroy', $tournament->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">
                                          <span class="octicon octicon-trashcan"></span>
                                          {{ __('tournaments.delete') }}
                                        </button>
                                    </form>
                              </td>
                              <td>
                                    <!-- Edit -->
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ URL::to('tournaments/' . $tournament->id . '/edit') }}">
                                      <span class="octicon octicon-pencil"></span>
                                      {{ __('tournaments.edit') }}
                                    </a>

                              </td>
                              <!-- Name -->
                              <td>
                                <a href="{{ url('tournaments/'.$tournament->id) }}" target="_blank">
                                   {{ $tournament->name }}
                                </a>
                                <!-- Badge Finished  -->
                                @if( \Carbon\Carbon::parse( $tournament->end )->addDays(1)->lt( now() ) )
                                  <span class="badge badge-warning"> {{ __('tournaments.finished') }} </span>
                                <!-- Badge Started  -->
                                @elseif( \Carbon\Carbon::parse( $tournament->begin )->lt( now() ) )
                                  <span class="badge badge-dark"> {{ __('tournaments.started') }} </span>
                                @endif
                              </td>
                              <!-- Category -->
                              <td> {{ $tournament->category }} </td>
                              <!-- Begin date -->
                              <td> {{ date('d-M-Y', strtotime($tournament->begin)) }} </td>
                              <!-- End date -->
                              <td> {{ date('d-M-Y', strtotime($tournament->end)) }} </td>
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
        $('#tournaments').DataTable({
            "order": [ [ 4, "asc" ], [ 3, "asc" ] ],
            "scrollX": true,
            "pagingType": "full_numbers"
        });
    });

</script>
