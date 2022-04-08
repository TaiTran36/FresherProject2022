@extends('layouts.master')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Chỉnh sửa bài viết
        </div>
        <div class="card-body">
            <form action="{{route('post.update', $posts->id)}}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="post_title">Tiêu đề bài viết</label>
                    <input class="form-control" type="text" value="{{$posts->post_title}}" name="post_title" id="post_title">
                    @error('post_title')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="post_url">URL</label>
                    <input class="form-control" type="hidden" value="{{$posts->post_url}}" name="post_url_old" id="post_url">
                    <input class="form-control" type="text" value="{{$posts->post_url}}" name="post_url" id="post_url">
                    @error('post_url')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">

                    <!-- <label>Thể loại</label>
                    <select name="category_id[]" id="" multiple="multiple" class="select2 select2-hidden-accessible">
                    @foreach($categories as $category)
                    
                        <option value="{{$category->id}}"
                            @foreach ($posts->categories as $postCategory)
                                @if($postCategory->id == $category->id)
                                    selected
                                @endif
                            @endforeach>
                        {{$category->category_name}}</option>

                    @endforeach
                    </select> -->

                    <label for="category">Thể loại</label>
                    @foreach($categories as $category)
                    <div class="form-check">


                        <input name="category_id[]" type="checkbox" value="{{$category->id}}" @foreach ($posts->categories as $postCategory)
                        @if($postCategory->id == $category->id)
                            checked
                        @endif
                        @endforeach">
                        <label for="">{{$category->category_name}}</label>


                    </div>
                    @endforeach
                </div>
                @error('category_id')
                <small class="text-danger">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="post_body">Nội dung</label>
                    <textarea class="form-control" type="text" value="{{$posts->post_body}}" name="post_body" id="post_body" cols="10" rows="20"></textarea>
                    @error('post_body')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="post_thumbnail">Ảnh</label>
                    <input class="form-control" type="file" value="" name="post_thumbnail" id="post_thumbnail">
                    <img src="{{ asset('uploads/posts/'.$posts->post_thumbnail) }}" alt="" style="width: 200px">
                    @error('avatar')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="post_author">Tác giả</label>
                    <input class="form-control" type="text" value="{{$posts->post_author}}" name="post_author" id="post_author">
                    @error('post_author')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="post_created_at">Ngày tạo</label>
                    <input class="form-control" type="text" value="{{$posts->created_at}}" name="created_at" id="created_at" disabled>
                    @error('created_at')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <button type="submit" name='btn_edit' class="btn btn-primary">Sửa</button>
            </form>
        </div>
    </div>
</div>

@endsection