@extends('layout')

@section('title', __('login.login'))

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
                    {{ __('login.login') }}
                  </div>

                  <!-- Card body -->
                  <div class="card-body">

                      <!-- Form login -->
                      <form method="POST" action="{{ route('login') }}">
                          @csrf

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
                                         class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus>
                                  <!-- Errors -->
                                  @if( $errors->has('email') )
                                      <span class="invalid-feedback" role="alert">
                                          <strong> {{ $errors->first('email') }} </strong>
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
                                          <strong> {{ $errors->first('password') }} </strong>
                                      </span>
                                  @endif
                              </div>

                          </div> <!-- CLOSE Password -->

                          <!-- Remember me -->
                          <div class="form-group row">
                              <div class="col-md-6 offset-md-4">
                                  <div class="form-check">
                                      <!-- Checkbox -->
                                      <input class="form-check-input" id="remember" type="checkbox"
                                             name="remember" {{ old('remember') ? 'checked' : '' }}>
                                      <!-- Label -->
                                      <label class="form-check-label" for="remember">
                                          {{ __('login.remember') }}
                                      </label>
                                  </div>
                              </div>
                          </div> <!-- CLOSE Remember me -->

                          <!-- Submit -->
                          <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-4">
                                  <!-- Button -->
                                  <button type="submit" class="btn btn-primary">
                                      {{ __('login.login') }}
                                  </button>
                                  <!-- Errors -->
                                  @if( Route::has('password.request') )
                                      <a class="btn btn-link" href="{{ route('password.request') }}">
                                          {{ __('login.forgot') }}
                                      </a></br>
                                  @endif
                              </div>
                          </div>

                      </form> <!-- CLOSE Form login -->

                      <!-- Register link -->
                      <div class="d-flex justify-content-center" style="margin-top: 20px">
                          <a class="btn btn-link" href="../register">
                            {{ __('login.register') }}
                          </a>
                      </div>

                  </div> <!-- CLOSE Card body -->

              </div> <!-- CLOSE Card -->

          </div>
      </div>
  </div> <!-- CLOSE Content -->

@endsection
