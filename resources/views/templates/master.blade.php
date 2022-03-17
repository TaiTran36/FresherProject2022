<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @extends('layouts.app')
    @section('content')
        <title> @yield('title') </title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" type="text/css"
            rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css" type="text/css" rel="stylesheet" />

    </head>

    <body>
    @section('sidebar')
        @include('templates.sidebar')
    @endsection
    @section('header')
        @include('templates.header')
    @endsection
    @section('footer')
        @include('templates.footer')
    @endsection
    <div class="container">
        @section('content')
        @show
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
</body>
@endsection

</html>
