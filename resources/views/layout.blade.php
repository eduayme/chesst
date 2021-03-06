<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'ChessTournaments') | ChessT</title>
    <!-- Bootstrap 4.1 -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <!-- DataTables for Bootstrap 4.1 -->
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap daterangepicker -->
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <!-- Octicons -->
    <link href="{{ asset('css/octicons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Flickity carousel -->
    <link href="{{ asset('css/flickity.css') }}" rel="stylesheet" type="text/css" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{{ asset('img/logoChessT_64x64.png') }}}">
</head>

<body>
    <section>
        @include('parts.nav')
    </section>

    <section>
        @yield('content')
    </section>

    <section>
        @include('parts.footer')
    </section>

    <!-- JQuery 3.3.1 -->
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <!-- JQuery for DataTables -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <!-- DataTables for Bootstrap 4.1 -->
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Sorting date for DataTables -->
    <script src="{{ asset('js/sortingDate.js') }}"></script>
    <!-- Bootstrap 4.1 -->
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
    <!-- Dismiss messages in Bootstrap 4.1 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <!-- Bootstrap daterangepicker -->
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.min.js') }}"></script>
    <!-- Flickity carousel -->
    <script src="{{ asset('js/flickity.pkgd.js') }}"></script>

</body>

</html>
