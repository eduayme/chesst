@extends('layout')

@section('title', __('main.home'))

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
            <h1 class="jumbotron-heading"> {{ __('main.welcome') }} </h1>
            <p class="lead text-muted"> {{ __('main.intro') }} </p>
            <p>
              <a href="../tournaments" style="margin: 5px"
                 class="btn btn-primary my-2 btn-lg" role="button">
                 <span class="octicon octicon-search"></span>
                 {{ __('main.find tournaments') }}
              </a>
              <a href="../tournaments/create" style="margin: 5px"
                 class="btn btn-secondary my-2 btn-lg" role="button">
                 <span class="octicon octicon-cloud-upload"></span>
                 {{ __('main.add tournament') }}
              </a>
            </p>
        </div>
    </section>

@endsection
