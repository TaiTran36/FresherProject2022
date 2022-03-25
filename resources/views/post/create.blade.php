@extends('templates.master')

@section('title', 'Post')

@section('content')

    <div class="page-header">
        <h4>Add Post</h4>
    </div>

    <?php //Hiển thị thông báo thành công
    ?>
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif

    <?php //Hiển thị thông báo lỗi
    ?>
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif

    <?php //Hiển thị form sửa
    ?>
    <p><a class="btn btn-primary" href="/post/list">Back</a></p>
    <div class="col-xs-4 col-xs-offset-4">
        <center>
            <h1>Add Post</h1>
        </center>
        <form action="{{ url('/post/insert') }}" method="post">
            <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="name" name="title" placeholder="title" required />
            </div>
            <div class="form-group">
                <label for="url">Url</label>
                <input type="text" class="form-control" id="name" name="url" placeholder="url" />
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea type="text" class="form-control" id="name" name="content" placeholder="content" required ></textarea>
            </div>

            <center><button type="submit" class="btn btn-primary">Save</button></center>
        </form>
    </div>

@endsection
