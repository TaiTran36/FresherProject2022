@extends('layouts.admin')

@section('content')


<div class="page-header"><h4>User-post List</h4></div>

<form action="" method="GET" class="form-inline" >
	<div class="form-group">
		<input class="form-control" name="key" placeholder="Search">
	</div>
	<button type="submit" class="btn btn-primary">
		<i class="fa fa-search"></i>
	</button>
</form>
	<div class="row" style="margin-top :40px">
		<div class="col-xs-12 col-sm-12 col-md-12">
			@if (Session::has('thongbao'))
			<div class="alert alert-success">
				{{ Session::get('thongbao') }}
			</div>
			
		@endif
		<div class="table-responsive">
			<p><a class="btn btn-primary" href="/{{ url('/post/create') }}">Thêm mới</a></p>
			<table id="DataList" class="table table-bordered table-hover">
				<thead>
					<tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>User_Write</th>
                        <th>created_at</th>
                        
                        <th colspan="3">Action</th>
                      </tr>
				</thead>
				<tbody>
				<?php $page= $listpost_pagination->currentPage() ;
					  $index=($page-1)*5+1; ?>
				@foreach($listpost_pagination as $post)
					<tr>
				      <td><?php echo $index ?></td>
                      <td>{{ $post->title }}</td>
                      <td>{{ $post->writer_name }}</td>
					  <td>{{ $post->created_at }}</td>
                      
                      
					  <td><a class="btn btn-info" href="/post/{{ $post->id }}/details"><i class="fa fa-eye" aria-hidden="true"> Details</a></td>
						<td><a class="btn btn-primary" href="/post/{{ $post->id }}/edit"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a></td>
						<td><a class="btn btn-danger" href="/post/{{ $post->id }}/delete"><i class="fa fa-trash" aria-hidden="true"> Delete</a></td>
					</tr>
					<?php $index++ ?>
				@endforeach
				</tbody>
			</table>
		</div>
		
		<div style="width: 40%;padding: 10px;">
			{{$listpost_pagination->appends(request()->all())->links("pagination::bootstrap-4")}}
			</div>
	</div>
</div>

@endsection