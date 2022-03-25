@extends('templates.master')

@section('title', 'Post')

@section('content')

    <div class="page-header">
        <h2>Edit Post</h2>
    </div>
    <p><a class="btn btn-primary" href="/post/list">Back</a></p>
    <div class="col-xs-4 col-xs-offset-4">
        <center>
            <h2>Edit Post</h2>
        </center>
        <form action="{{ url('/post/update') }}" method="post">
            <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
            <input type="hidden" id="id" name="id" value="{!! $getpostById[0]->id !!}" />
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="name" name="title" placeholder="title"
                    value="{{ $getpostById[0]->title }}" required />
            </div>
            <div class="form-group">
                <label for="url">Url</label>
                <input type="text" class="form-control" id="name" name="url" placeholder="url"
                    value="{{ $getpostById[0]->url }}" required />
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea type="text" class="form-control" id="name" name="content" placeholder="content"
                    value="{{ $getpostById[0]->content }}" required >{{ $getpostById[0]->content }}</textarea>
            </div>

            <center><button type="submit" class="btn btn-primary">Save</button></center>
        </form>
    </div>

@endsection
