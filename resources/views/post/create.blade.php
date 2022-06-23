@extends('templates.master')

@section('title', 'Post')

@section('content')

    <div class="page-header">
        <h4>Add Post</h4>
    </div>
    <p><a id="post_back" class="btn btn-primary" href="/post/list">Back</a></p>
    <div class="col-xs-4 col-xs-offset-4">
        <center>
            <h1>Add Post</h1>
        </center>
        <form id="form_create" name="form_create" style="width:98%" action="{{ url('/post/insert') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="name" name="title" placeholder="Enter title" required />
            </div>
            <div class="form-group">
                <label for="title">Category</label>
                <p id="err"></p>
                <div class="required" style="columns:3; padding-left:10%">
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input name="categories[]" class="form-check-input" type="checkbox" value="{{ $category->id }}"
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                {{-- <select class="select" name="categories[]" multiple>
                    @foreach ($categories as $category)
                    <option>{{$category->name}}</option>
                    @endforeach
                  </select> --}}
            </div>
            <div class="form-group">
                <label for="url">Url</label>
                <input type="text" class="form-control" id="name" name="url" placeholder="Enter url" />
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <div>
                    <img id="image_show" style="width:7%;height:7%" src='/post/error_img/not_found.png' alt="Image">
                    <input type="file" class="form-control" id="image" onchange="getFileData(this);" name="image"
                        placeholder="image" value="" />
                </div>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea rows="10" type="text" class="form-control" id="name" name="content" placeholder="Enter content" required></textarea>
            </div>
            <center><button id="submit_add" type="submit" class="btn btn-primary">Save</button></center>
        </form>
    </div>

@endsection
<script src="{{ asset('js/image_upload.js') }}" defer></script>
<script src="{{ asset('js/post.js') }}" defer></script>
