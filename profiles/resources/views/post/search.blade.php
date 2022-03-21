@extends('layouts.master')
@section('content')
<div class="container-fluid py-5">

    <div class="card">
        <div class="form-search form-inline">
            <form action="{{route('post.search')}}" method="POST">
                @csrf
                <input type="search" name="search" class="form-control form-search" placeholder="Tìm kiếm" value="">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </form>
        </div>
        <div class="card-header font-weight-bold">
            Danh sách tìm kiếm 
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tiêu đề bài viết</th>
                        <th scope="col">Tác giả</th>
                        <th scope="col">Thời gian tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if($searchTitle)
                    @foreach($searchTitle as $key => $post)
                    <tr>

                        <td scope="row">{{$key+1}}</td>
                        <td>{{$post->post_title}}</td>
                        <td>{{$post->post_author}}</td>
                        <td>{{$post->created_at}}</td>
                        <td>

                            <a href="{{route('post.edit', $post->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('delete_post', $post->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            <a href="{{route('post.show', $post->id)}}" class="btn btn-warning btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Show"><i class="fa fa-eye" aria-hidden="true"></i></a>

                        </td>

                    </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection