@extends('layouts.master')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form action="{{url('post/store')}}" method="POST">
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
                    <label for="post_body">Nội dung</label>
                    <textarea name="post_body" id="post_body" cols="10" rows="20" class="form-control"></textarea>

                </div>
                @error('post_body')
                <small class="text-danger">{{$message}}</small>
                @enderror

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