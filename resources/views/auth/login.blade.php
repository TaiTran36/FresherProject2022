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
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div id="login">
        <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="row mb-2">
                                    <b class="title text-center text-decoration-underline">
                                        {{ __('ADMIN LOGIN') }}
                                    </b>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-10 offset-md-1">
                                        <input 
                                            id="email" 
                                            type="text" 
                                            class="form-control border-0 @error('email') is-invalid @enderror" 
                                            name="email" 
                                            value="{{ old('email') }}"
                                            placeholder="Email address"  
                                            autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-10 offset-md-1">
                                        <input 
                                            id="password" 
                                            type="password" 
                                            class="form-control border-0 @error('password') is-invalid @enderror" 
                                            name="password" 
                                            placeholder="Password"
                                            autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="offset-md-1">
                                        <button type="submit" class="col-md-10 btn bg-primary">
                                            {{ __('SIGN IN') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-header">
                            <div class="row mb-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </main>
    </div>
</body>
</html>