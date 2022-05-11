@extends('layouts.admin')

@section('content')

<div class="page-header"><h4>Profile List</h4></div>



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
<div class="row" style="margin-top :40px">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="table-responsive">
			
			<table id="DataList" class="table table-bordered table-hover">
				<thead>
					<tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th width = "100px">Avatar</th>
                        <th>Phone_number</th>
                        <th colspan="3">Action</th>
                      </tr>
				</thead>
				<tbody>
				<?php $page= $listprofile_pagination->currentPage() ;
					  $index=($page-1)*5+1; ?>
				@foreach($listprofile_pagination as $profile)
					<tr>
				      <td><?php echo $index ?></td>
                      <td>{{ $profile->name }}</td>
                      <td>{{ $profile->email }}</td>
                      <td><img height="100" onerror="this.src='/storage/image_err/no-image.jpg'" src="/profile/{{ $profile->avatar }}" /></td>
                      <td>{{  }}</td>
					</tr>
					<?php $index++ ?>
				@endforeach
				</tbody>
			</table>
			
		</div>
		
		<div style="width: 40%;padding: 10px;">
			{{$listprofile_pagination->appends(request()->all())->links("pagination::bootstrap-4")}}
			</div>
	</div>
</div>

@endsection