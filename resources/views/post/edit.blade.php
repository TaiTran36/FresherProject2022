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
        <form action="{{ url('/post/update') }}" enctype="multipart/form-data" method="post">
            <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
            <input type="hidden" id="id" name="id" value="{!! $getpostById[0]->id !!}" />
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="name" name="title" placeholder="title"
                    value="{{ $getpostById[0]->title }}" required />
            </div>
            <div class="form-group">
                <label for="title" >Category</label>
                <p id="err"></p>
                  <div style="columns:3; padding-left:10%">
                  @foreach ($categories as $category)
                  <div class="form-check">
                    @foreach ($post_categories as $post_category)
                    <input name="categories[]" class="form-check-input" type="checkbox" value="{{$category->id}}" {{in_array($category->name, $post_category->pluck('category')->toArray()) ? 'checked' : '' }} id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        {{$category->name}}
                    </label>
                  </div>
                  @endforeach
                  @endforeach
                  </div>
            </div>
            <div class="form-group">
                <label for="url">Url</label>
                <input type="text" class="form-control" id="name" name="url" placeholder="url"
                    value="{{ $getpostById[0]->url }}" required />
            </div>
            <div class="form-group">
                <label for="avatar">Featured Image</label>
                <div>
                <img id="image_show" style="width:7%;height:7%" onerror="this.src='/post/error_img/not_found.png'"
                    src="{{ asset('/post/' .$getpostById[0]->photo_path) }}" alt="Post Image">
                <input type="file" class="form-control" id="image" onchange="getFileData(this);" name="image" placeholder="image"
                    value="{{ $getpostById[0]->photo_path }}"  />
                    <input type="text" name="image_old" placeholder="image"
                    value="{{ $getpostById[0]->photo_path }}"  hidden />
                </div>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea  rows="10" type="text" class="form-control" id="name" name="content" placeholder="content"
                    value="{{ $getpostById[0]->content }}" required >{{ $getpostById[0]->content }}</textarea>
            </div>
            <input type="text" name="id" placeholder="id"
            value="{{ $getpostById[0]->id }}"  hidden />
            <center><button id="submit" type="submit" class="btn btn-primary">Save</button></center>
        </form>
    </div>

@endsection
<script src="{{ asset('js/image_upload.js') }}" defer></script>
<script src="{{ asset('js/post.js') }}" defer></script>

