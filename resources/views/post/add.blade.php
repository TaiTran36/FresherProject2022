@extends('layouts.master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // $(document).ready(function() {
    //     $("#post_title").keyup(function() {
    //         $("#post_url").html($("#post_title").val());
    //     })
    // })
</script>
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form action="{{url('post/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="post_title">Tiêu đề bài viết</label>
                    <input class="form-control" type="text" name="post_title" id="post_title">
                </div>
                @error('post_title')
                <small class="text-danger">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="post_url">URL</label>
                    <input class="form-control" type="text" name="post_url" id="post_url">

                </div>
                @error('post_url')
                <small class="text-danger">{{$message}}</small>
                @enderror

                <div class="form-group">
                    <label for="category">Thể loại</label>
                    @foreach($categories as $category)
                    <div class="form-check">
                        <input class="" type="checkbox" name="category_id[]" id="" value="{{$category->id}}">
                        <label for="">{{$category->category_name}}</label>
                    </div>
                    @endforeach
                </div>
                @error('category_id')
                <small class="text-danger">{{$message}}</small>
                @enderror

                <div class="form-group">
                    <label for="post_body">Nội dung</label>
                    <textarea name="post_body" id="post_body" cols="10" rows="20" class="form-control"></textarea>

                </div>
                @error('post_body')
                <small class="text-danger">{{$message}}</small>
                @enderror

                <div class="form-group">
                    <label for="post_thumbnail">Ảnh</label>
                    <input class="form-control" type="file" value="" name="post_thumbnail" id="post_thumbnail">
                    @error('avatar')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <!-- <div class="form-group">
                    <label for="post_author">Tác giả</label>
                    <input class="form-control" type="text" name="post_author" id="post_author">
                </div>
                @error('post_author')
                <small class="text-danger">{{$message}}</small>
                @enderror -->
                <!-- <div class="form-group">
                    <label for="post_create_at">Ngày tạo/chỉnh sửa</label>
                    <input class="form-control" type="text" name="post_create_at" id="post_create_at" disabled>
                </div> -->


                <button type="submit" value="Đăng bài" class="btn btn-primary">Đăng bài</button>
            </form>
        </div>
    </div>
</div>
@endsection