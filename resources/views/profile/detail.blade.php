@extends('layouts.admin')

@section('content')

<div class="page-header"><h4>User-profile</h4></div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="table-responsive">
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
						<td> Email</td>
						<td>{{ $profile->email }}</td>
					  </tr>
					  <tr>
						<td> Description</td>
						<td>{{ $profile->description }}</td>
					  </tr>
					  <tr>
						<td> Avatar</td>
						<td><img height="100" onerror="this.src='/storage/image_err/no-image.jpg'" src="/profile/{{ $profile->avatar }}" /></td>
					  </tr>
					  <tr>
						<td> Address</td>
						<td>{{ $profile->address }}</td>
					  </tr>
					  <tr>
						<td> Phone</td>
						<td>{{ $profile->phone_number }}</td>
					  </tr>
					  <tr>
						<td> Created_at</td>
						<td>{{ $profile->created_at }}</td>
					  </tr>
				</tbody>
			</table>
			<p><a style="margin-left : 40%" class="btn btn-primary" href="/profile/list">Back</a></p>
			</form>
			@endforeach
		</div>

	</div>
</div>

@endsection