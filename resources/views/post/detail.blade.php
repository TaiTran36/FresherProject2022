@extends('templates.master')

@section('title','Post')

@section('content')

<?php //Hiển thị thông báo thành công?>
<div class="page-header"><h4>Posts List</h4></div>

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
<p><a class="btn btn-primary" href="/post">Back</a></p>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="table-responsive">
			{{-- <p><a class="btn btn-primary" href="/{{ url('/post/create') }}">Thêm mới</a></p> --}}
			@foreach($post as $post)
			<form action="/post/{{ $post->id }}/edit" >
			<table id="DataList" class="table table-bordered table-hover">
				<tbody>
					<tr>
					  <td> Title</td>
                      <td>{{ $post->title }}</td>
					</tr>
					<tr>
						<td> Url</td>
						<td>{{ $post->url }}</td>
					  </tr>
					  <tr>
						<td> Writer </td>
						<td>{{ $post->name }}</td>
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