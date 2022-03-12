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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        #outer-container {
            display: table;
            width: 100%;
            height: 100vh;
        }
        
        #sidebar {
            display: table-cell;
            width: 15%;
            position: fixed;
            overflow: auto;  
            padding-bottom: 100%; 
        }
        
        #content {
            
            display: table-cell;
            background-color:#F4F6F9;
            width: 85%;
            height: 100%;
            vertical-align: top;
        }
            </style>
</head>
<body>
    <div id="app">
        <div id="outer-container">
            <div id="sidebar">
                @section('sidebar')
                @show
            </div>
            <div id="content">
                    @section('header')
                    @show
                <main class="py-4" >
                     @yield('content')
                </main>
                @section('footer')
                @show
            </div>
        </div>
    </div>
</body>
</html>
