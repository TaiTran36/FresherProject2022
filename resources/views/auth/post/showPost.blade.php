@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ ($post->url == null) ? route('post.show', $post->id) : route('post.show', $post->url) }}">
                        <div class="row mb-3">
                            <label for="title" class="col-md-2 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-9">
                                <input id="title" type="text" class="form-control" name="title" value="{{$post->title}}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="url" class="col-md-2 col-form-label text-md-end">{{ __('Author') }}</label>

                            <div class="col-md-9">
                                <input id="author" type="text" class="form-control" value="{{$post->author}}" name="author" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="url" class="col-md-2 col-form-label text-md-end">{{ __('Url') }}</label>

                            <div class="col-md-9">
                                <input id="url" type="text" class="form-control" value="{{$post->url}}" name="url" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="content" class="col-md-2 col-form-label text-md-end">{{ __('Content') }}</label>

                            <div class="col-md-9">
                                <textarea id="content" type="text" class="form-control" rows="10" name="content" disabled>{{$post->content}}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
