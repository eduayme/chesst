@extends('layout')

@section('title', 'Home')

@section('content')

    <div class="text-center">
        <h1 class="card-title"> Welcome to ChessT </h1>
        <p class="card-text"> The best place to find all chess tournaments </p>
        <a href="../tournaments" class="btn btn-outline-primary" role="button">Find Tournaments</a>
        <a href="../tournaments/create" class="btn btn-outline-secondary" role="button">Create Tournament</a>
    </div>

@endsection
