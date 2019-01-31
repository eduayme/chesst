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

</body>

</html>
