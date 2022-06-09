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
    @toastr_css
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
                                            {{ __('LOGIN') }}
                                        </b>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-10 offset-md-1">
                                            <input id="email" type="text"
                                                class="form-control border-0 bg-light @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" placeholder="Email address"
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
                                            <input id="password" type="password"
                                                class="form-control border-0 bg-light @error('password') is-invalid @enderror"
                                                name="password" placeholder="Password" autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-1">
                                        <div class="col-md-5 offset-md-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-5 offset-md-1 ml-0 p-0 text-right">
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link pl-0 py-0" style="font-size:15px;"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mb-1">
                                        <div class="offset-md-1">
                                            <button type="submit" class="col-md-10 btn bg-primary">
                                                {{ __('SIGN IN') }}
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6">
                                            <a href="{{ url('auth/google') }}">
                                                <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
                                            </a>
                                        </div>
                                    
                                        <div class="col-md-6" style="padding-top:0.2rem;">
                                            <a href="{{ url('auth/facebook') }}">
                                                <img style="width:185px; height:38px;" 
						    src="https://scontent.fhan2-4.fna.fbcdn.net/v/t39.2365-6/17639236_1785253958471956_282550797298827264_n.png?_nc_cat=105&ccb=1-7&_nc_sid=ad8a9d&_nc_ohc=f2JwhCIezA8AX91NGip&_nc_ht=scontent.fhan2-4.fna&oh=00_AT-G7QHmhEPuBKwDk_L3bGeDRtmL5UH86bNlMQEPkZSE-w&oe=62A5E8D6">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="offset-md-1">
                                            <a class="btn btn-link pl-0 py-0" style="font-size:15px;"
                                                href="{{ route('register') }}">
                                                {{ __('Create a new account') }}
                                            </a>
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
@jquery
@toastr_js
@toastr_render
</html>