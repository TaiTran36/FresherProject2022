@extends('layouts.profile')

@section('title','User-post')

@section('content')

<?php //Hiển thị thông báo thành công?>
<div class="page-header"><h4>User-post List</h4></div>

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
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="table-responsive">
			<p><a class="btn btn-primary" href="/{{ url('/post/create') }}">Thêm mới</a></p>
			<table id="DataList" class="table table-bordered table-hover">
				<thead>
					<tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>URL</th>
                        <th>Content</th>
                        <th>User</th>
                        <th colspan="3">Action</th>
                      </tr>
				</thead>
				<tbody>
				<?php $page= $listpost_pagination->currentPage() ;
					  $index=($page-1)*5+1; ?>
				@foreach($listpost_pagination as $post)
					<tr>
				      <td><?php echo $index ?></td>
                      <td>{{ $post->name }}</td>
                      <td>{{ $post->email }}</td>
                      <td>{{ $post->avatar }}</td>
                      <td>{{ $post->phone_number}}</td>
					  <td><a class="btn btn-info" href="/post/{{ $post->id }}/details">Details</a></td>
						<td><a class="btn btn-primary" href="/post/{{ $post->id }}/edit">Edit</a></td>
						<td><a class="btn btn-danger" href="/post/{{ $post->id }}/delete">Delete</a></td>
					</tr>
					<?php $index++ ?>
				@endforeach
				</tbody>
			</table>
		</div>
		<h2> Total: <?php echo count($listpost); ?> records. </h2>
		<div style="margin: auto ;width: 40%;padding: 10px;">
			{{$listpost_pagination->links("pagination::bootstrap-4")}}
			</div>
	</div>
</div>

@endsection