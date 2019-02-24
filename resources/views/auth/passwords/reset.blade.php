@extends('layout')

@section('title', 'Reset password')

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
                  <div class="card-header" style="text-align: center"> {{ __('Reset Password') }} </div>

                  <!-- Card body -->
                  <div class="card-body">

                      <!-- Form reset password -->
                      <form method="POST" action="{{ route('password.update') }}">
                          @csrf

                          <input type="hidden" name="token" value="{{ $token }}">

                          <!-- Email -->
                          <div class="form-group row">

                              <!-- Email label -->
                              <label for="email" class="col-md-4 col-form-label text-md-right">
                                {{ __('E-Mail Address') }}
                              </label>

                              <!-- Email input div -->
                              <div class="col-md-6">
                                  <!-- Email input -->
                                  <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}"
                                         class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus>
                                  <!-- Email errors -->
                                  @if( $errors->has('email') )
                                      <span class="invalid-feedback" role="alert">
                                          <strong> {{ $errors->first('email') }} </strong>
                                      </span>
                                  @endif
                              </div>

                          </div> <!-- CLOSE Email -->

                          <!-- Password -->
                          <div class="form-group row">
                              <!-- Label password -->
                              <label for="password" class="col-md-4 col-form-label text-md-right">
                                {{ __('Password') }}
                              </label>

                              <!-- Password input div -->
                              <div class="col-md-6">
                                  <!-- Password input -->
                                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                  <!-- Password errors -->
                                  @if( $errors->has('password') )
                                      <span class="invalid-feedback" role="alert">
                                          <strong> {{ $errors->first('password') }} </strong>
                                      </span>
                                  @endif
                              </div>

                          </div> <!-- CLOSE Password -->

                          <!-- Confirm password -->
                          <div class="form-group row">
                              <!-- Label confirm password -->
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                {{ __('Confirm Password') }}
                              </label>

                              <!-- Confirm password input div -->
                              <div class="col-md-6">
                                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                              </div>
                          </div>

                          <!-- Submit button -->
                          <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                  <!-- Button -->
                                  <button type="submit" class="btn btn-primary">
                                      {{ __('Reset Password') }}
                                  </button>
                              </div>
                          </div>

                      </form> <!-- CLOSE Form reset password -->

                  </div> <!-- CLOSE Card body -->

              </div> <!-- CLOSE Card -->

          </div>
      </div>
  </div> <!-- CLOSE Content -->

@endsection
