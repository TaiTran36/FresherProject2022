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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">
</head>

<body>
    <div class="client">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container">
                <div class="col-md-3 order-3 order-md-1">
                    <form action="#" class="search-form">
                        <i class="fa-solid fa-magnifying-glass pl-3 pr-2"></i>
                        <input type="text" placeholder="Search...">
                    </form>
                </div>

                <div class="col-md-6 text-center order-1 order-md-2 mb-3 mb-md-0">
                    <a href="#" class="logo m-0 text-uppercase">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="col-md-3 text-end order-2 order-md-3 mb-3 mb-md-0">
            

                {{-- <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block"> --}}
                    @auth
                        {{-- <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a> --}}
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                    @endauth
                </div>
            </div>
    </div>
    </nav>

    <main class="client-main">
        @yield('content-client')
    </main>

    <footer class="client-footer">
        <p> Copyright &copy;
            <script>
                document.write(new Date().getFullYear());
            </script>-<script>
                document.write(new Date().getFullYear() + 4);
            </script>
            Chainos. All rights reserved.
        </p>
    </footer>
    </div>
</body>

</html>