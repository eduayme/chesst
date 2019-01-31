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

            @auth
            <!-- Left content -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../tournaments">Tournaments</a>
                </li>
            </ul>
            @endauth

            <!-- Left content -->
            <ul class="navbar-nav ml-auto">

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif

                    @else
                        <li class="nav-item" style="margin-right: 50px">
                            <a href="../tournaments/create" class="btn btn-outline-light" role="button">Create Tournament</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>

                        </li>

                  @endguest

              </ul>

        </div>

    </div>

</nav>
