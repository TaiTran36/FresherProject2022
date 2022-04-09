@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <h4>Add Post</h4>
    </div>

    

    <div class="row" style="margin-top :40px">
		<div class="col-xs-12 col-sm-12 col-md-12">
			@if (Session::has('thongbao'))
			<div class="alert alert-success">
				{{ Session::get('thongbao') }}
			</div>
			
		@endif
    <p><a class="btn btn-primary" href="/post/list">Back</a></p>
    <div class="width = 100%">
        <center>
            <h1>Add Post</h1>
        </center>
        <form action="{{ url('/post/insert') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="name" name="title" placeholder="title" required />
            </div>
            <div class="form-group">
                <label for="title" >Category</label>
                  <div style="columns:3; padding-left:10%">
                  @foreach ($categories as $category)
                  <div class="form-check">
                    <input name="categories[]" class="form-check-input" type="checkbox" value="{{$category->id}}" name='categories' id="flexCheckDefault" >
                    <label class="form-check-label" for="flexCheckDefault">
                        {{$category->categories}}
                    </label>
                  </div>
                  @endforeach
                  </div>
            </div>
            <div class="form-group">
                <label for="url">Url</label>
                <input type="text" class="form-control" id="name" name="url" placeholder="url" />
            </div>
            <div class="form-group">
                <label for="photo">photo</label>
                <div>
                    <img id="photo" height="150" src='/storage/image_err/no-image.jpg' alt="photo">
                    <input type="file" class="form-control" id="photo" onchange="getFileData(this);" name="photo" placeholder="photo" value="" required/>
                </div>
            </div>
            
            <div class="form-group">
                <label for="content">Content</label>
                <textarea type="text" class="form-control" rows="10" cols="150" id="name" name="content" placeholder="content" required ></textarea>
            </div>

            <center><button type="submit" class="btn btn-primary">Save</button></center>
        </form>
    </div>

@endsection
