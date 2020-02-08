@extends('layout')

@section('title', __('main.home'))

@section('content')

    <!-- Alerts -->
    @if( session()->get('success') )
        <div class="alert alert-success" role="alert">
            <div class="container text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times; </a>
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

    <!-- Discover Slider -->
    <div class="container">
        <h1 class="text-center mb-3"> {{ __('main.next tournaments') }} </h1>

        <div class="flickity-carousel" data-flickity='{ "groupCells": true, "autoPlay": 5000, "pauseAutoPlayOnHover": true, "cellAlign": "left", "wrapAround": true, "adaptiveHeight": true }'>

            @foreach( $tournaments as $tournament )
                <div class="col-xl-4 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ url('tournaments/'.$tournament->id) }}" target="_blank">
                                   <b> {{ $tournament->name }} </b>
                                </a>
                            </h5>
                            <!-- Time control -->
                            <p class="card-text" style="margin-bottom: 10px !important">
                                <span class="octicon octicon-clock"></span>
                                <b> {{ $tournament->category }} </b>
                            </p>
                            <!-- Location -->
                            <p class="card-text">
                                <span class="octicon octicon-globe"></span>
                                <b> {{ $tournament->city }}, {{ $tournament->country }} </b>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">
                                    <!-- Begin date -->
                                    <span class="octicon octicon-calendar"></span>
                                    <b> {{ date('d F', strtotime($tournament->begin)) }} </b>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

      </div>

    </div>

@endsection

<!-- JQuery 3.3.1 -->
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
