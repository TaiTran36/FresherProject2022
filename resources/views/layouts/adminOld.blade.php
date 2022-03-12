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
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <div id="admin">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" id="sidebar-button" data-widget="pushmenu" role="button">
                    <i class="fa fa-bars"></i>
                </a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link" href="{{ url('/') }}">{{ __('Home') }}</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <div class="image">                   
                    <img class="img-circle elevation-2" 
                        src="{{ Auth::user()->photo_url }}" alt="" >
                </div>
            </li> 

            <li class="nav-item">
                <span class="brand-text font-weight-light">
                    {{ Auth::user()->username_login }}
                </span>
            </li>
        </ul>
    </nav>

    <aside id="sidebar" class="main-sidebar sidebar-dark-primary elevation-4">
        <a class="brand-link" href="{{ url('/admin') }}">
            <span class="brand-text font-weight-light">
                {{ __('Admin') }}
            </span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <span class="brand-text font-weight-light">
                    {{ Auth::user()->username_login }}
                </span>
            <div>
        </div>

        <nav class="mt-2">
            <ul clss="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.search') }}">User<a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('post.search') }}">Post<a>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="content"> @yield('content') </div>

    <footer class="main-footer">Copyright &copy; 2022-2026 Chainos. All rights reserved.</footer>
    </div> 
</body>
</html>