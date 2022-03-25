@extends('layouts.admin')



@section('content')

<div class="page-header"><h4>User-post</h4></div>


<?php //Hiển thị form sửa?>
<p><a class="btn btn-primary" href="/post/list">Back</a></p>
<div  style="width = 100%">
	<center><h4>Edit User-post</h4></center>
	<form action="{{ url('/post/update') }}" method="post">
		<input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
		<input type="hidden" id="id" name="id" value="{!! $getpostById[0]->id !!}" />
		<div class="form-group">
			<label for="name">Title</label>
			<input type="text" class="form-control" id="title" name="title" placeholder="Title" maxlength="255" value="{{ $getpostById[0]->title }}" required />
		</div>
		<div class="form-group">
			<label for="url">URL</label>
			<input type="text" class="form-control" id="url" name="url" placeholder="URL"  value="{{ $getpostById[0]->url }}" required />
		</div>
		<div class="form-group">
			<label for="content">Content</label>
			<br>
			<textarea type="textarea" height = "50px" class="form-controltextarea" id="content" name="content" placeholder="Content" value="{{ $getpostById[0]->content }}" required> </textarea>
		</div>
		
		
		<center><button type="submit" class="btn btn-primary">Lưu lại</button></center>
	</form>
</div>

@endsection