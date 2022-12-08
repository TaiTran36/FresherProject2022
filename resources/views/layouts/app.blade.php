<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="{{ asset('js/post.js') }}" defer></script>
    <script src="{{ asset('js/profile.js') }}" defer></script>
    <script src="{{ asset('js/category.js') }}" defer></script>
    <script src='{{ asset('js/functions/debounce.js') }}' ></script>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="app">
        <div id="outer-container">
            <div id="sidebar">
                @section('sidebar')
                @show
            </div>
            <div id="content">
                <div id="header">
                    @section('header')
                    @show
                </div>
                <main class="py-4" id="content_page">
                    @yield('content')
                </main>
                <br><br>
                <div id="footer">
                    @section('footer')
                    @show
                </div>
            </div>
        </div>
    </div>
</body>

</html>
