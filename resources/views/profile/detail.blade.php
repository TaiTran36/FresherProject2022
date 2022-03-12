@extends('templates.master')

@section('title','User-profile')

@section('content')

<?php //Hiển thị thông báo thành công?>
<div class="page-header"><h4>User-profile</h4></div>

@if ( Session::has('success') )
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong>{{ Session::get('success') }}</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
	</div>
@endif

<?php //Hiển thị thông báo lỗi?>
@if ( Session::has('error') )
	<div class="alert alert-danger alert-dismissible" role="alert">
		<strong>{{ Session::get('error') }}</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
	</div>
@endif
@if (Auth::user()->can('all user'))
<p><a class="btn btn-primary" href="/profile">Back</a></p>
@endcan
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="table-responsive">
			{{-- <p><a class="btn btn-primary" href="/{{ url('/profile/create') }}">Thêm mới</a></p> --}}
			@foreach($profile as $profile)
			<form action="/profile/{{ $profile->id }}/edit" >
			<table id="DataList" class="table table-bordered table-hover">
				<tbody>
					<tr>
					  <td> Name</td>
                      <td>{{ $profile->name }}</td>
					</tr>
					<tr>
						<td> Birthday</td>
						<td>{{ $profile->date_of_birth }}</td>
					  </tr>
					  <tr>
						<td> Nickname</td>
						<td>{{ $profile->nickname }}</td>
					  </tr>
					  <tr>
						<td> Username</td>
						<td>{{ $profile->username_login }}</td>
					  </tr>
					  <tr>
						<td> Email</td>
						<td>{{ $profile->email }}</td>
					  </tr>
					  <tr>
						<td> Description</td>
						<td>{{ $profile->description }}</td>
					  </tr>
					  <tr>
						<td> Avatar</td>
						<td>{{ $profile->avatar }}</td>
					  </tr>
					  <tr>
						<td> Address</td>
						<td>{{ $profile->address }}</td>
					  </tr>
					  <tr>
						<td> Phone</td>
						<td>{{ $profile->phone_number }}</td>
					  </tr>
				</tbody>
			</table>
			<center><button type="submit" class="btn btn-primary">Edit</button></center>
			</form>
			@endforeach
		</div>

	</div>
</div>

@endsection