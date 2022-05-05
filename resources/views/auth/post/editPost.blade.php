@extends('layouts.admin')

@section('content-admin')
<div class="container">
    <div class="row justify-content-center">
        @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
        @elseif($message = Session::get('error'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
        @endif

        <form method="POST"
            action="{{ route('post.update', $post->url) }}">
            @csrf
            @method('PUT')

            <div class="row mb-3 mt-4">
                <label for="title" class="col-md-2 col-form-label text-md-end">{{ __('Title') }}</label>

                <div class="col-md-9">
                    <input id="id" type="hidden" class="form-control" name="id" value="{{$post->id}}">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        value="{{old('title', $post->title)}}" autofocus>

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
                    <input id="url" type="text" class="form-control @error('url') is-invalid @enderror"
                        value="{{old('url',$post->url)}}" name="url">

                    @error('url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>required
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="category" class="col-md-2 col-form-label text-md-end mr-2 @error('category') is-invalid @enderror">{{ __('Category') }}</label>

                @for($i = 0; $i < count($categories); $i++) 
                    <div class="form-check form-check-inline">
                        <input class="form-check-input mt-1 @error('category') is-invalid @enderror" type="checkbox" name="category[]" id={{$categories[$i]}} value="{{$categories[$i]}}" {{(in_array($categories[$i], $ctgs) ? 'checked' : '')}}>
                    
                        <label class="form-check-label" for={{$categories[$i]}}>{{$categories[$i]}}</label>
                    </div>
                @endfor

                @error('category')
                    <span class="offset-md-2 invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="content" class="col-md-2 col-form-label text-md-end">{{ __('Content') }}</label>

                <div class="col-md-9">
                    <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror"
                        rows="10" name="content" >{{old('content', $post->content)}}</textarea>

                    @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2 offset-md-9">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Edit Post') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection