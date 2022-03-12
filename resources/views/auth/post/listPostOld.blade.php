@extends('layouts.app')

@section('content') 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('List Posts') }}</div>

                <div class="card-body">
                    <form method="GET" action="{{ route('post.search') }}">
                        

                        <div class="row mb-3">
                            <div class="input-group">
                                <input id="search-input" type="search" class="form-control" placeholder="Search post">  
                                <button id="search-button" type="submit" class="btn btn-primary" name="search" value="search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>

                        @if($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{$message}}</p>
                            </div>
                        @endif 

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
                    </form>
                </div>
            </div> 
        </div> 
    <div> 
</div>


@endsection 
