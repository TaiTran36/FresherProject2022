@extends('layouts.admin')

@section('content')


<div class="page-header"><h4>User-post</h4></div>


<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="table-responsive">
			
			
			@foreach ($post as $post)
			<form action="/post/{{ $post->id }}/edit">
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
							<td>{{ $post->writer_name }}</td>
						</tr>
						<tr>
							<td> category </td>
							<td>{{ $post->writer_name }}</td>
						</tr>
						<tr>
							<td> photo </td>
							<td><img height="100" onerror="this.src='/storage/image_err/no-image.jpg'" src="/post/{{$post->photo }}" /></td>
							
						</tr>
						<tr>
							<td style="height:300px"> Content </td>
							<td>{{ $post->content }}</td>
						</tr>
					</tbody>
				</table>
				<p><a class="btn btn-primary" href="/post/list">Back</a></p>
			</form>
		@endforeach
		</div>

	</div>
</div>

@endsection