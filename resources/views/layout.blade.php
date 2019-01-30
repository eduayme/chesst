<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'ChessTournaments') | ChessT</title>
    <!-- Bootstrap 4.1 -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <!-- DataTables for Bootstrap 4.1 -->
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <section>
        @include('parts.nav')
    </section>

    <section>
        <div class="container" style="margin-top: 30px; margin-bottom: 30px">
            @yield('content')
        </div>
    </section>

    <section>
        @include('parts.footer')
    </section>

    <!-- Bootstrap 4.1 -->
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>