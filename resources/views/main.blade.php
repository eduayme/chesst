@extends('layout')

@section('title', 'Home')

@section('content')

    <!-- Alerts -->
    @if( session()->get('success') )
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('success') }}
        </div><br/>
    @elseif( session()->get('error') )
        <div class="alert alert-error alert-dismissible fade show" role="alert">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('error') }}
        </div><br/>
    @endif

    <div class="text-center">
        <h1 class="card-title"> Welcome to ChessT </h1>
        <p class="card-text"> The best place to find all chess tournaments </p>
        <a href="../tournaments" class="btn btn-outline-primary" role="button">Find Tournaments</a>
        <a href="../tournaments/create" class="btn btn-outline-secondary" role="button">Create Tournament</a>
    </div>

@endsection
