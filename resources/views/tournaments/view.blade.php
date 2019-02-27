@extends('layout')

@section('title', $tournament->name )

@section('content')

  <!-- Alerts -->
  @if( session()->get('success') )
      <div class="alert alert-success" role="alert">
        <div class="container text-center" style="margin-bottom: 0">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('success') }}
        </div>
      </div>
  @endif

  <!-- Content -->
  <div class="container" style="margin-top: 15px; margin-bottom: 15px">

      <div class="card" style="padding: 30px 15px">

        <h3 class="text-center">
          {{ $tournament->name }}
        </h3>

        <div class="container text-center">

          <div class="row">
            <div class="col-sm" style="padding: 15px">
                <span class="octicon octicon-calendar"></span>
                <b> {{ __('tournaments.begin date') }}: </b> </br>
                {{ date('d-M-Y', strtotime($tournament->begin)) }}
            </div>
            <div class="col-sm" style="padding: 15px">
                <span class="octicon octicon-calendar"></span>
                <b> {{ __('tournaments.end date') }}: </b> </br>
                {{ date('d-M-Y', strtotime($tournament->end)) }}
            </div>
            <div class="col-sm" style="padding: 15px">
                <span class="octicon octicon-location"></span>
                <b> {{ __('tournaments.location') }}: </b> </br>
                {{ $tournament->city }}, {{ $tournament->country }}
            </div>
            <div class="col-sm" style="padding: 15px">
                <span class="octicon octicon-clock"></span>
                <b> {{ __('tournaments.time control') }}: </b> </br>
                {{ $tournament->category }}
            </div>
            <div class="col-sm" style="padding: 15px">
              <a href="{{ $tournament->website }}" class="btn btn-outline-secondary"
                 role="button" target="_blank">
                <span class="octicon octicon-link"></span>
                {{ __('tournaments.website') }}
              </a>
            </div>
          </div>

        </div>

  </div>

@endsection
