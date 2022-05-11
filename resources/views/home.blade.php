@extends('layouts.admin')

@section('content')
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" width="100%">
                
                <div class="row" style="margin-top :40px">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        @if (Session::has('thongbao'))
                        <div class="alert alert-success">
                            {{ Session::get('thongbao') }}
                        </div>
                        
                    @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                
            </div>
        </div>
    </div>
</div>
@endsection