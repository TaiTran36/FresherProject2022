@extends('layouts.admin')

@section('content-admin') 
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col sm-6">
                    <h1>{{ __('List Posts') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fuild">
            <form method="GET" action="{{ route('post.search') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="input-group">
                                <input id="search-input" type="search" class="form-control" placeholder="Search post">  
                                <button id="search-button" type="submit" class="btn btn-primary" name="search" value="search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        @if($message = Session::get('success'))
                            <div class="alert alert-success pb-0 mt-3 mb-0">
                                <p>{{$message}}</p>
                            </div>
                        @endif 
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @foreach ($fields as $f => $f_value) 
                                        <th scope="col">{{ $f_value }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                        
                            <tbody> 
                                @foreach ($posts as $post)
                                    <tr>
                                        <th scope="row">{{ ++$i }}</th>
                                        @foreach ($fields as $f => $f_value) 
                                            @if ($f == 'action')    @break   @endif
                                            <td>{{ $post->$f }}</td>
                                        @endforeach
                                        <td>
                                            <a type="submit" class="btn btn-primary" name="detail" value="detail"
                                                href="{{ route('post.edit', $post->title) }}">
                                                {{ __('Detail') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach   
                            </tbody> 
                        </table>
                    </div>
                </div>
            </form>
        </div> 
    <div> 
</div>


@endsection 
