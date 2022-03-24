<?php
$list = $data['data'];
// $menu = $data['menu'];
$auth_id = $data['auth_id'];

?>
@extends('layouts.master')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="form-search form-inline">
            <form action="{{route('admin.search')}}" method="POST">
                @csrf
                @if($auth_id==1 or $auth_id == 2)
                <input type="search" name="search" class="form-control form-search" placeholder="Tìm kiếm" value="">

                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                @endif
            </form>
        </div>
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
        </div>
        <div class="card-body">
            <!-- <div class="analytic">
                <a href="" class="text-primary">Trạng thái 1<span class="text-muted">(10)</span></a>
                <a href="" class="text-primary">Trạng thái 2<span class="text-muted">(5)</span></a>
                <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="">
                    <option>Chọn</option>
                    <option>Tác vụ 1</option>
                    <option>Tác vụ 2</option>
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div> -->
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $key => $user)
                    <tr>

                        <td>
                            <input type="checkbox">
                        </td>
                        <td scope="row">{{$key+1}}</td>
                        <td>{{$user->name}}</td>
                        <td><img src="{{ asset(!empty($user->avatar == 'photo_default.png' ) ? 'images/photo_default.png' : 'uploads/profiles/' . $user->avatar) }}" alt="" height="120" width="120"></td>

                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>

                        @if($auth_id==1)
                        <td>
                            <a href="{{route('admin.edit', $user->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            @if(Auth::id() != $user->id)
                            <a href="{{route('delete_user', $user->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" onclick="return confirm('Bạn chắc chắn muốn xóa ?')" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            @endif
                            <a href="{{route('admin.show', $user->id)}}" class="btn btn-warning btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Show"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        </td>
                        @endif

                        @if($auth_id==2)
                        <td>
                            @if(Auth::id() == $user->id)
                            <a href="{{route('admin.edit', $user->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            @endif
                            <a href="{{route('admin.show', $user->id)}}" class="btn btn-warning btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Show"><i class="fa fa-eye" aria-hidden="true"></i></a>

                        </td>
                        @endif
                        @if($auth_id==3)
                        <td>
                            @if(Auth::id() == $user->id)
                            <a href="{{route('admin.edit', $user->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            @endif
                            <a href="{{route('admin.show', $user->id)}}" class="btn btn-warning btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Show"><i class="fa fa-eye" aria-hidden="true"></i></a>

                        </td>
                        @endif

                    </tr>
                    @endforeach


            </table>

        </div>
        <div class="d-flex justify-content-center">

            <span style="">{{ $list->links('pagination::bootstrap-4') }}</span>

        </div>
    </div>
</div>
@endsection