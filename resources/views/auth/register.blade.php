@extends('layout')

@section('title', __('register.register'))

@section('content')

  <!-- Alerts -->
  @if( session('status') )
      <div class="alert alert-success" role="alert" style="margin-bottom: 15px">
        <div class="container text-center">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('status') }}
        </div>
      </div>
  @endif

  <!-- Content -->
  <div class="container" style="margin-top: 15px">
      <div class="row justify-content-center">
          <div class="col-md-8">

              <!-- Card -->
              <div class="card">

                  <!-- Card header -->
                  <div class="card-header" style="text-align: center">
                    {{ __('register.register') }}
                  </div>

                  <!-- Card body -->
                  <div class="card-body">

                      <!-- Form tournament register -->
                      <form method="POST" action="{{ route('register') }}">
                          @csrf

                          <!-- Name -->
                          <div class="form-group row">

                              <!-- Name label -->
                              <label for="name" class="col-md-4 col-form-label text-md-right">
                                {{ __('tournaments.name') }}
                              </label>

                              <!-- Name input -->
                              <div class="col-md-6">
                                  <!-- Input -->
                                  <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name" value="{{ old('name') }}" required autofocus>
                                  <!-- Errors -->
                                  @if( $errors->has('name') )
                                      <span class="invalid-feedback" role="alert">
                                          <strong> {{ $errors->first('name') }} </strong>
                                      </span>
                                  @endif
                              </div>

                          </div> <!-- CLOSE Name -->

                          <!-- Email -->
                          <div class="form-group row">

                              <!-- Email label -->
                              <label for="email" class="col-md-4 col-form-label text-md-right">
                                {{ __('login.email') }}
                              </label>

                              <!-- Email input -->
                              <div class="col-md-6">
                                  <!-- Input -->
                                  <input id="email" type="email" name="email" value="{{ old('email') }}"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required>
                                  <!-- Errors -->
                                  @if( $errors->has('email') )
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>

                          </div> <!-- CLOSE Email -->

                          <!-- Password -->
                          <div class="form-group row">

                              <!-- Password label -->
                              <label for="password" class="col-md-4 col-form-label text-md-right">
                                {{ __('login.password') }}
                              </label>

                              <!-- Password input -->
                              <div class="col-md-6">
                                  <!-- Input -->
                                  <input id="password" type="password" name="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                                  <!-- Errors -->
                                  @if( $errors->has('password') )
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                              </div>

                          </div> <!-- CLOSE Password -->

                          <!-- Confirm password -->
                          <div class="form-group row">

                              <!-- Confirm password label -->
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                {{ __('register.confirm password') }}
                              </label>

                              <!-- Confirm password input-->
                              <div class="col-md-6">
                                  <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required>
                              </div>

                          </div> <!-- CLOSE Confirm password -->

                          <!-- Submit -->
                          <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                  <button type="submit" class="btn btn-primary">
                                      <span class="octicon octicon-person"></span>
                                      {{ __('register.register') }}
                                  </button>
                              </div>
                          </div>

                      </form>

                      <!-- Login link -->
                      <div class="d-flex justify-content-center" style="margin-top: 20px">
                          <a class="btn btn-link" href="../login">
                            {{ __('register.already account') }}
                          </a>
                      </div>

                  </div> <!-- CLOSE Card body -->

              </div> <!-- CLOSE Card -->

          </div>
      </div>
  </div> <!-- CLOSE Content -->

@endsection
