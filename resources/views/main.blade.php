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
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner row w-100 mx-auto">

                @foreach( $tournaments as $tournament )
                    @if ($loop->first)
                        <div class="carousel-item col-md-3 active">
                    @else
                        <div class="carousel-item col-md-3">
                    @endif

                    <div class="card h-100">
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
                                <b> {{ __('main.starts') }} {{ date('d F', strtotime($tournament->begin)) }} </b>
                            </small>
                        </p>
                      </div>
                    </div>
                  </div>

                @endforeach
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only"> Previous </span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only"> Next </span>
            </a>

          </div>
    </div>

@endsection

<!-- JQuery 3.3.1 -->
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>

<script>
$(document).ready(function() {
  $("#myCarousel").on("slide.bs.carousel", function(e) {
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 4;
    var totalItems = $(".carousel-item").length;

    if (idx >= totalItems - (itemsPerSlide - 1)) {
      var it = itemsPerSlide - (totalItems - idx);
      for (var i = 0; i < it; i++) {
        // append slides to end
        if (e.direction == "left") {
          $(".carousel-item")
            .eq(i)
            .appendTo(".carousel-inner");
        } else {
          $(".carousel-item")
            .eq(0)
            .appendTo($(this).find(".carousel-inner"));
        }
      }
    }
  });
});
</script>
