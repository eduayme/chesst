@extends('layout')

@section('title', 'Home')

@section('content')

    <!-- Alerts -->
    @if( session()->get('success') )
        <div class="alert alert-success" role="alert">
            <div class="container text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('success') }}
            </div>
        </div>

    @elseif( session()->get('error') )
        <div class="alert alert-error alert-dismissible fade show" role="alert">
            <div class="container text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  {{ session()->get('error') }}
            </div>
        </div>
    @endif

    <!-- Header -->
    <section class="jumbotron text-center" style="background-color: white">
        <div class="container">
            <h1 class="jumbotron-heading"> Welcome to ChessT </h1>
            <p class="lead text-muted"> The best place to find chess tournaments </p>
            <p>
              <a href="../tournaments" style="margin: 5px"
                 class="btn btn-primary my-2 btn-lg" role="button">
                 Find Tournaments
              </a>
              <a href="../tournaments/create" style="margin: 5px"
                 class="btn btn-secondary my-2 btn-lg" role="button">
                 Create Tournament
              </a>
            </p>
        </div>
    </section>

    <!-- Advantages -->
    <div class="container">
    <div class="container" style="margin: 50px 0">
      <div class="row">
        <div class="col-sm-4 text-center">
            <span class="octicon octicon-search" style="font-size: 100px;"></span>
            <h3> Find quick and easy a lot of chess tournaments around the world </h3>
        </div>
        <div class="col-sm-4 text-center">
          <span class="octicon octicon-cloud-upload" style="font-size: 100px;"></span>
          <h3> Upload your own tournaments to reach a lot of chess players </h3>
        </div>
        <div class="col-sm-4 text-center">
          <span class="octicon octicon-database" style="font-size: 100px;"></span>
          <h3> One of the biggest chess tournaments database on internet </h3>
        </div>
      </div>
    </div>
  </div>

@endsection
