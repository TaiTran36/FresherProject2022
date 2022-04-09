@extends('layouts.admin')

@section('content')

<div class="page-header"><h4>User-profile</h4></div>


<?php ?>
<p><a class="btn btn-primary" href="/profile/list">Back</a></p>
<div  style="width = 100%">
	<h4>Edit User-profile</h4>
	<form action="{{ url('/profile/update') }}" method="post" enctype="multipart/form-data">
		<input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
		<input type="hidden" id="id" name="id" value="{!! $getprofileById[0]->id !!}" />
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Name" maxlength="255" value="{{ $getprofileById[0]->name }}" required />
		</div>
		<div class="form-group">
			<label for="date_of_birth">Date_of_birth</label>
			<input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="date_of_birth"  value="{{ $getprofileById[0]->date_of_birth }}" required />
		</div>
		<div class="form-group">
			<label for="nickname">Nickname</label>
			<input type="text" class="form-control" id="nickname" name="nickname" placeholder="Nickname" maxlength="255" value="{{ $getprofileById[0]->nickname }}" required />
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $getprofileById[0]->email }}" required />
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<input type="text" class="form-control" id="description" name="description" placeholder="description" value="{{ $getprofileById[0]->description }}" required />
		</div>
		<div class="form-group">
			<label for="avatar">Avatar</label>
			<div>
			<img height="150" onerror="this.src='/storage/image_err/no-image.jpg'"src="{{ asset('/profile/' .$getprofileById[0]->avatar) }}" alt="User Image">
			<input type="file" class="form-control" id="avatar" name="avatar" placeholder="avatar" value="{{ $getprofileById[0]->avatar }}"  />
			</div>
		
		</div>
		<div class="form-group">
			<label for="address">Address</label>
			<input type="text" class="form-control" id="address" name="address" placeholder="address" maxlength="255" value="{{ $getprofileById[0]->address }}" required />
		</div>
		<div class="form-group">
			<label for="phone_number">Phone number</label>
			<input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="phone number" maxlength="15" value="{{ $getprofileById[0]->phone_number }}" required />
		</div>
		<center><button type="submit" class="btn btn-primary">Lưu lại</button></center>
	</form>
</div>

@endsection