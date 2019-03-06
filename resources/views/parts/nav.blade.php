<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <!-- Navbar content -->
    <div class="container">

        <!-- Header logo -->
        <div class="navbar-header">
            <a class="navbar-brand" href="../">ChessT</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Content -->
        <div class="collapse navbar-collapse" id="navbarNav" style="margin-left: 50px">

            <!-- Left content -->
            <ul class="navbar-nav">

                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link" href="../../../" style="margin-right: 15px">
                      <span class="octicon octicon-home"></span>
                      {{ __('main.home') }} <span class="sr-only">(current)</span>
                    </a>
                </li>

                <!-- Tournaments list -->
                <li class="nav-item">
                    <a class="nav-link" href="../../../tournaments"  style="margin-right: 15px">
                      <span class="octicon octicon-database"></span>
                      {{ __('main.tournaments') }}
                    </a>
                </li>

                <!-- Explore map -->
                <li class="nav-item">
                    <a class="nav-link" href="../../../explore"  style="margin-right: 15px">
                      <span class="octicon octicon-milestone"></span>
                      {{ __('main.explore') }}
                    </a>
                </li>

            </ul>

            <!-- Right content -->
              <ul class="navbar-nav ml-auto">

                <!-- Languages -->
                <div class="dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span class="octicon octicon-globe" style="font-size: 15px;"></span>
                        {{ __('main.language') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('change_lang', ['lang' => 'en']) }}"> {{ __('main.english') }} </a>
                        <a class="dropdown-item" href="{{ route('change_lang', ['lang' => 'es']) }}"> {{ __('main.spanish') }} </a>
                    </div>
                </div>

                <!-- User -->
                @auth

                <!-- Create tournament button -->
                <li class="nav-item" style="margin-right: 20px; margin-left: 20px">
                    <a href="../../../tournaments/create" class="btn btn-outline-light" role="button">
                      <span class="octicon octicon-cloud-upload"></span>
                      {{ __('main.add tournament') }}
                    </a>
                </li>

                <!-- User name dropdown -->
                <li class="nav-item dropdown">

                    <!-- Name -->
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <!-- Logout -->
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="../mytournaments"> {{ __('tournaments.my tournaments') }} </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <span class="octicon octicon-sign-out" style="font-size: 15px;"></span>
                            {{ __('main.logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>

                </li>

            @endauth

            <!-- Not an user -->
            @guest

                  <!-- Login -->
                  <li class="nav-item">
                      <a class="btn btn-outline-light" role="button"
                      style="margin-left: 20px"
                      href="{{ route('login') }}">
                      <span class="octicon octicon-sign-in"></span>
                      {{ __('login.login') }} </a>
                  </li>

                  <!-- Register -->
                  <li class="nav-item">
                      <a class="btn btn-outline-light" role="button"
                      style="margin-left: 20px"
                      href="{{ route('register') }}">
                      <span class="octicon octicon-person"></span>
                      {{ __('register.register') }} </a>
                  </li>

              </ul>

            @endguest

        </div>

    </div>

</nav>
