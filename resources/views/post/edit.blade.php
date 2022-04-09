@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <h2>Edit Post</h2>
    </div>
    <p><a class="btn btn-primary" href="/post/list">Back</a></p>
    <div class="width = 100%">
        <center>
            <h2>Edit Post</h2>
        </center>
        <form action="{{ url('/post/update') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
            <input type="hidden" id="id" name="id" value="{!! $getpostById[0]->id !!}" />
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="name" name="title" placeholder="title" value="{{ $getpostById[0]->title }}" required />
            </div>
            <div class="form-group">
                <label for="url">Url</label>
                <input type="text" class="form-control" id="name" name="url" placeholder="url" value="{{ $getpostById[0]->url }}"  />
            </div>
			
            <div class="form-group">
                <label for="title" >Category</label>
                  <div style="columns:3; padding-left:10%">
                  @foreach ($categories as $category)
                  <div class="form-check">
                    @foreach ($post_categories as $post_category)
                    <input name="categories[]" class="form-check-input" type="checkbox" value="{{$category->id}}" {{in_array($category->name, $post_category->pluck('category')->toArray()) ? 'checked' : '' }} id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault" >
                        {{$category->categories}}
                    </label>
                  </div>
                  @endforeach
                  @endforeach
                  </div>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <div>
                <img height="150" onerror="this.src='/storage/image_err/no-image.jpg'" src="{{ asset('/post/'.$getpostById[0]->photo)}}" alt="Post Photo">
                <input type="file" class="form-control" id="photo" name="photo" placeholder="photo" value="{{ $getpostById[0]->photo}}"  required/>
                </div>
            
            </div>
            
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea type="text" rows="10" cols="150"  class="form-control" id="name" name="content" placeholder="content" value="{{ $getpostById[0]->content }}" required >{{ $getpostById[0]->content }}</textarea>
            </div>

            <center><button type="submit" class="btn btn-primary">Save</button></center>
        </form>
    </div>

@endsection
