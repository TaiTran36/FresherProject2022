@extends('layouts.admin')

@section('content')


<div class="page-header"><h4>User-post</h4></div>


<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="table-responsive">
			<p><a class="btn btn-primary" href="/{{ url('/post/create') }}">Thêm mới</a></p>
			@foreach($post as $post)
			<form action="/post/{{ $post->id }}/edit" >
			<table id="DataList" class="table table-bordered table-hover">
				<tbody>
					<tr>
					  <td> Title</td>
                      <td>{{ $post->title }}</td>
					</tr>
					<tr>
						<td>URL</td>
						<td>{{ $post->url }}</td>
					  </tr>
					  <tr>
						<td>content </td>
						<td>{{ $post->content }}</td>
					  </tr>
					  
					  <tr>
						
				</tbody>
			</table>
			<p><a class="btn btn-primary" href="/post/list">Back</a></p>
			</form>
			@endforeach
		</div>

	</div>
</div>

@endsection