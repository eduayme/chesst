@extends('layout')

@section('title', 'Email')

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
                    {{ __('Reset Password') }}
                  </div>

                  <!-- Card body -->
                  <div class="card-body">

                      <!-- Form reset password -->
                      <form method="POST" action="{{ route('password.email') }}">
                          @csrf

                          <!-- Email -->
                          <div class="form-group row">

                              <!-- Email label -->
                              <label for="email" class="col-md-4 col-form-label text-md-right">
                                {{ __('E-Mail Address') }}
                              </label>

                              <!-- Email input div -->
                              <div class="col-md-6">
                                  <!-- Email input -->
                                  <input id="email" type="email" name="email" value="{{ old('email') }}"
                                         class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required>
                                  <!-- Email errors -->
                                  @if ($errors->has('email'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>

                          </div> <!-- CLOSE Email -->

                          <!-- Submit button -->
                          <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                  <!-- Button -->
                                  <button type="submit" class="btn btn-primary">
                                      {{ __('Send Password Reset Link') }}
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
