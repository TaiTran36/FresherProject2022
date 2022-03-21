@extends('layouts.master')
@section('content')
<div class="container-fluid py-5">

    <div class="card">
        <div class="form-search form-inline">
            <form action="{{route('admin.search')}}" method="POST">
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
                    @if($searchName)
                    @foreach($searchName as $key => $user)
                    <tr>
                        <td>
                            <input type="checkbox">
                        </td>
                        <td scope="row">{{$key+1}}</td>
                        <td>{{$user->name}}</td>
                        <td><img src="{{ asset('uploads/profiles/'.$user->avatar) }}" alt="" style="width: 100px"></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>

                            <a href="{{route('admin.edit', $user->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('delete_user', $user->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            <a href="{{route('admin.show', $user->id)}}" class="btn btn-warning btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Show"><i class="fa fa-eye" aria-hidden="true"></i></a>

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