@extends('layouts.profile')

@section('title','User-post')

@section('content')

<div class="page-header"><h4>User-post</h4></div>

<?php //Hiển thị thông báo thành công?>
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

<?php //Hiển thị form sửa?>
<p><a class="btn btn-primary" href="/post">Back</a></p>
<div class="col-xs-4 col-xs-offset-4">
	<center><h4>Edit User-post</h4></center>
	<form action="{{ url('/post/update') }}" method="post">
		<input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
		<input type="hidden" id="id" name="id" value="{!! $getpostById[0]->id !!}" />
		<div class="form-group">
			<label for="name">Title</label>
			<input type="text" class="form-control" id="Title" name="Title" placeholder="Title" maxlength="255" value="{{ $getpostById[0]->title }}" required />
		</div>
		<div class="form-group">
			<label for="date_of_birth">URL</label>
			<input type="date" class="form-control" id="URL" name="URL" placeholder="URL"  value="{{ $getpostById[0]->URL }}" required />
		</div>
		<div class="form-group">
			<label for="nickname">Content</label>
			<input type="text" class="form-control" id="Content" name="Content" placeholder="Content" maxlength="255" value="{{ $getpostById[0]->content }}" required />
		</div>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" class="form-control" id="Username" name="username" placeholder="Username" maxlength="255" value="{{ $getpostById[0]->user_post }}" required />
		</div>
		
		<center><button type="submit" class="btn btn-primary">Lưu lại</button></center>
	</form>
</div>

@endsection