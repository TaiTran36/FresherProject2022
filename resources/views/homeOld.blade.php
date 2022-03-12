@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} 

                    @if (Auth::check() && Auth::user()->role != 3) 
                        <br>
                        <a href="{{ route('user.search') }}">{{ __('List users') }}</a> 
                        <br>
                        <a href="{{ route('post.search') }}">{{ __('List posts') }}</a> 
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
