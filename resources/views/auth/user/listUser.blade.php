@extends('layouts.admin')

@section('content-admin') 
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col sm-6">
                    <h1>{{ __('List Users') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <form method="GET" action="{{ route('user.search') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="input-group">
                                <input id="search-input" type="search" class="form-control" placeholder="Search user" name="search-user">  
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
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ ++$i }}</th>
                                        @foreach ($fields as $f => $f_value) 
                                            @if ($f == 'action')    @break   @endif

                                            @if ($f == "photo_url") 
                                                <td>
                                                    <img class="img img-fluid photo" 
                                                        
                                                        src={{asset('images/'.$user->$f)}} alt="">
                                                </td>
                                            @else 
                                                <td>{{ $user->$f }}</td>
                                            @endif
                                        @endforeach
                                        <td>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <a class="btn btn-info" href="{{ route('user.show', $user->id) }}">
                                                        {{ __('Show') }}
                                                    </a>
                                                </div>

                                                @if (Auth::check() && Auth::user()->role == 1)
                                                    <div class="col-md-3">
                                                        <a class="btn btn-primary" href="{{ route('user.edit', $user->id) }}">
                                                            {{ __('Edit') }}
                                                        </a>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <a class="btn btn-danger" href="{{ route('user.destroy', $user->id) }}"
                                                            onclick="event.preventDefault(); document.getElementById('delete-user').submit();">
                                                            {{ __('Delete') }}
                                                        </a>                  
                                                        
                                                        <form id="delete-user" action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-none">
                                                            @csrf 
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
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

<div class="d-flex justify-content-center">
    {{ $users->links() }}
</div>

@endsection 
