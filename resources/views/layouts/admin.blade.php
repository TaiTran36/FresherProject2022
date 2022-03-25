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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <div id="admin">
        <div class="wrapper mr-1">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" id="sidebar-button" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <i class="fa-solid fa-bars" aria-hidden="true"></i>
                    </a>
                </li>

                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link" href="{{ url('/') }}">
                        {{ __('Home') }}
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-brand">
                        <img class="image rounded-circle avatar p-1 mr-3" 
                            src="{{asset('images/'.Auth::user()->photo_url)}}" alt="" >
                    </a>
                </li> 

                <li class="nav-item pr-3">
                    <b class="row navbar-text p-0">
                        {{ Auth::user()->username_login }}
                    </b>
                    <span class="row navbar-text p-0">
                        {{ Auth::user()->email }}
                    </span>
                </li>
            </ul>
        </nav>

        <aside id="sidebar" class="main-sidebar sidebar-dark-primary elevation-4">
            @if (Auth::user()->role == 1) 
                <a class="brand-link" href="{{ url('/admin') }}">
                    <span class="brand-text font-weight-light">
                        {{ __('Admin') }}
                    </span>
                </a>
            @elseif (Auth::user()->role == 2) 
                <a class="brand-link" href="{{ url('/modder') }}">
                    <span class="brand-text font-weight-light">
                        {{ __('Modder') }}
                    </span>
                </a>
            @endif

            <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <div class="user-panel">   
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-user-shield"></i>
                            <p>{{ Auth::user()->username_login }}</p>
                        <a>
                    </div>
                    
                    @if (Route::has('user.search'))
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('user*')) ? 'active' : '' }}" href="{{ route('user.search') }}">
                            <i class="fa-solid fa-user"></i>
                            <p>{{ __('User') }}</p>
                        <a>
                    </li>
                    @endif

                    @if (Route::has('post.search'))
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('post*')) ? 'active' : '' }}" href="{{ route('post.search') }}">
                            <i class="fa-solid fa-blog"></i>
                            <p>{{ __('Post') }}</p>
                        <a>
                    </li>
                    @endif

                    <div class="sidebar-footer">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-arrow-return-right"></i>
                            <p>{{ __('Logout') }}</p>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf 
                        </form>
                    </li>
                    </div>
                </ul>
            </nav>
            </div>
        </aside>

        <main class="content-wrapper"> 
            @yield('content-admin')
        </main>

        <footer class="main-footer">
            <p> Copyright &copy; 
                <script>document.write(new Date().getFullYear());</script>-<script>document.write(new Date().getFullYear() + 4);</script>
                Chainos. All rights reserved. 
            </p>
        </footer>
        </div> 
    </div>
</body>
</html>