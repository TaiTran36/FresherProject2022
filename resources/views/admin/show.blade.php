@extends('layouts.master')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thông tin người dùng
        </div>
        <div class="card-body">
            <form action="" method="POST">
            @csrf 

                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" value="{{$user->name}}" name="name" id="name" disabled>
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="dob">Ngày sinh</label>
                    <input class="form-control" type="text" value="{{$user->dob}}" name="dob" id="dob" disabled>
                    @error('dob')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nickname">Biệt danh</label>
                    <input class="form-control" type="text" value="{{$user->nickname}}" name="nickname" id="nickname" disabled>
                    @error('nickname')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" value="{{$user->email}}" name="email" id="email" disabled>
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Giới thiệu bản thân</label>
                    <input class="form-control" type="text" value="{{$user->description}}" name="description" id="description" disabled>
                    @error('description')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <!-- <input class="form-control" type="file" value="" name="avatar" id="avatar"> -->
                    <br>
                    <img src="{{ asset('uploads/profiles/'.$user->avatar) }}" alt="" style="width: 200px">
                    @error('avatar')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input class="form-control" type="text" value="{{$user->address}}" name="address" id="address" disabled>
                    @error('address')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input class="form-control" type="text" value="{{$user->phone}}" name="phone" id="phone" disabled>
                    @error('phone')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
               
            </form>
        </div>
    </div>
</div>
@endsection

