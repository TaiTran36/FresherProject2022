@extends('templates.master')

@section('title', 'User-profile')

@section('content')

    <div class="page-header">
        <center>
            <h2>Edit User-profile</h2>
        </center>
    </div>

    @if (Auth::user()->can('all user'))
        <p><a id="user_back" class="btn btn-primary" href="/profile/list">Back</a></p>
    @else
        <p><a class="btn btn-primary" id="my_user_back" data-id="{{ $getprofileById[0]->id }}"
                href="/profile/{{ $getprofileById[0]->id }}/details">Back</a></p>
    @endif
    <div class="col-xs-4 col-xs-offset-4">
        <form id="edit_user_form" action="{{ url('/profile/update') }}" enctype="multipart/form-data" method="post">
            <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
            <input type="hidden" id="id" name="id" value="{!! $getprofileById[0]->id !!}" />
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" maxlength="255"
                    value="{{ $getprofileById[0]->name }}" required />
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select onchange="return confirm('Are you sure to change role for this user?');"
                    @unlessrole('admin') disabled @endunlessrole class="form-control" name="role" id="role">
                    <option @if ($getprofileById[0]->role == '1') selected @endif value="1">Admin</option>
                    <option @if ($getprofileById[0]->role == '2') selected @endif value="2">Modder</option>
                    <option @if ($getprofileById[0]->role == '3') selected @endif value="3">Normal User</option>
                </select>
                <input id="role" name="role" @role('admin') disabled @endrole hidden value={{ $getprofileById[0]->role }}>
            </div>
            <div class="form-group">
                <label for="date_of_birth">Date_of_birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="date_of_birth"
                    value="{{ $getprofileById[0]->date_of_birth }}" required />
            </div>
            <div class="form-group">
                <label for="nickname">Nickname</label>
                <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Nickname"
                    maxlength="255" value="{{ $getprofileById[0]->nickname }}" required />
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                    maxlength="255" value="{{ $getprofileById[0]->username_login }}" required />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                    value="{{ $getprofileById[0]->email }}" required />
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="description"
                    value="{{ $getprofileById[0]->description }}" required />
            </div>
            <div class="form-group">
                <label for="avatar">Avatar</label>
                <div>
                    <img id="image_show" style="width:7%;height:7%" onerror="this.src='/profile/error_img/not_found.png'"
                        src="{{ asset('/profile/' . $getprofileById[0]->avatar) }}" alt="User Image">
                    <input type="file" class="form-control" id="avatar" onchange="getFileData(this);" name="avatar"
                        placeholder="avatar" value="{{ $getprofileById[0]->avatar }}" />
                    <input type="text" name="avatar_old" placeholder="avatar" value="{{ $getprofileById[0]->avatar }}"
                        hidden />
                </div>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="address" maxlength="255"
                    value="{{ $getprofileById[0]->address }}" required />
            </div>
            <div class="form-group">
                <label for="phone_number">Phone number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="phone number"
                    maxlength="15" value="{{ $getprofileById[0]->phone_number }}" required />
            </div>
            <center><button id="save_user" type="submit" class="btn btn-primary">Save</button></center>
        </form>
    </div>

@endsection
<script src="{{ asset('js/image_upload.js') }}" defer></script>
<script src="{{ asset('js/profile.js') }}" defer></script>
