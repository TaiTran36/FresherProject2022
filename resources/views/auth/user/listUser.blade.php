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
                                            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                <i class="bi bi-three-dots"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item"
                                                    href="{{ ($user->url == null) ? route('user.show', $user->id) : route('user.show', $user->url) }}">
                                                    {{ __('Show') }}
                                                </a>
        
                                                @if (Auth::check() && Auth::user()->role == 1)
                                                    <a class="dropdown-item"
                                                        href="{{ ($user->url == null) ? route('user.edit', $user->id) : route('user.edit', $user->url) }}">
                                                        {{ __('Edit') }}
                                                    </a>
        
                                                    <a class="dropdown-item" href="{{ route('user.destroy', $user->id) }}"
                                                        onclick="event.preventDefault(); document.getElementById('delete-user_{{$user->id}}').submit();">
                                                        {{ __('Delete') }}
                                                    </a>
        
                                                    <form id="delete-user_{{$user->id}}" action="{{ route('user.destroy', $user->id) }}"
                                                        method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
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
