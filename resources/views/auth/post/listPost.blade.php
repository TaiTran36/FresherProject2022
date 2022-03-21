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
                                <input id="search-input" type="text" class="form-control" placeholder="Search post" name="search-post">  
                                
                                <button id="search-button" type="submit" class="btn btn-primary">
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
                </form>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    @foreach ($fields as $f => $f_value) 
                                        <th scope="col">{{ $f_value }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                        
                            <tbody> 
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        @foreach ($fields as $f => $f_value) 
                                            @if ($f == 'action')    @break   @endif
                                            <td>{{ $post->$f }}</td>
                                        @endforeach
                                        <td>
                                            <div class="row">
                                            <div class="col-md-3">
                                            <a class="btn btn-info" href="{{ route('post.show', $post->id) }}">
                                                {{ __('Show') }}
                                            </a> 
                                            </div>
                                            <div class="col-md-3">
                                            <a class="btn btn-primary" href="{{ route('post.edit', $post->id) }}">
                                                {{ __('Edit') }}
                                            </a>
                                            </div>
                                            <div class="col-md-3">
                                            <a class="btn btn-danger" href="{{ route('post.delete', $post->id) }}"
                                                onclick="event.preventDefault(); document.getElementById('delete-post').submit();">
                                                {{ __('Delete') }}
                                            </a>                  
                                            
                                            <form id="delete-post" action="{{ route('post.delete', $post->id) }}" method="POST" class="d-none">
                                                @csrf 
                                                @method('DELETE')
                                            </form>
                                            </div></div>
                                        </td>
                                    </tr>
                                @endforeach   
                            </tbody> 
                        </table>
                    </div>
                </div>
        </div> 
    <div> 
</div>

{{ $posts->links() }}

@endsection 
