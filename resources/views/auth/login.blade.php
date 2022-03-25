<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Custom Theme Style -->
        <link href="/css/admin_login.css" rel="stylesheet">

    </head>

        

        
        <body class="login">
           
   
            <div class="login-page">
                <div class="form">
                    
                    <form id="login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <h1>ADMIN LOGIN</h1>
                        <div>
                            
                            <input type="email" id="email"  placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" :value="old('email')" required autocomplete="email" autofocus />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>

                        <div class="mt-4">
                            
                            <input type="password" id="password"  placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-jet-button class="ml-4">
                                {{ __('Log in') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        
        <script type="text/javascript" src="/js/admin_login.js" ></script>
    </body>

