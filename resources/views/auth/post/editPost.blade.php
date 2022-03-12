@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if($message = Session::get('success'))
                        <div class="alert alert-success"><p>{{$message}}</p></div>
                    @elseif($message = Session::get('error'))
                        <div class="alert alert-success"><p>{{$message}}</p></div>
                    @endif

                    <form method="POST" action="{{ route('post.update', $post->title) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="title" class="col-md-2 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-9">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$post->title}}" required autofocus>
                                
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="url" class="col-md-2 col-form-label text-md-end">{{ __('Url') }}</label>

                            <div class="col-md-9">
                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" value="{{$post->url}}" name="url">
                                
                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="content" class="col-md-2 col-form-label text-md-end">{{ __('Content') }}</label>

                            <div class="col-md-9">
                                <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" rows="10" name="content" required>{{$post->content}}</textarea>
                                
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-2 offset-md-9">
                                <button type="submit" class="btn btn-primary"> 
                                    {{ __('Edit Post') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
