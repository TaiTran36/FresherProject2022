@extends('templates.master')

@section('title', 'Posts')

@section('content')

    <?php //Hiển thị thông báo thành công
    ?>
    <div class="page-header">
        <h2>Post List</h2>
    </div>
    <h4> Total: <?php echo count($listpost); ?> records. </h4>
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
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="table-responsive">
                <a class="btn btn-success" href="/post/create">Add post</a>
                <table id="DataList" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Writer</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $page = $listpost_pagination->currentPage();
                        $index = ($page - 1) * 5 + 1; ?>
                        @foreach ($listpost_pagination as $post)
                            <tr>
                                <td><?php echo $index; ?></td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->writer_username_login}}</td>
                                <td><a class="btn btn-info" href="/post/{{ $post->id }}/details">Details</a></td>
                                @if (Auth::user()->can('edit post') || $post->writer_id == Auth::user()->id)
                                    <td><a class="btn btn-primary" href="/post/{{ $post->id }}/edit">Edit</a></td>
                                @endif
                                @if (Auth::user()->can('delete post') || $post->writer_id == Auth::user()->id)
                                    <td><a class="btn btn-danger" href="/post/{{ $post->id }}/delete">Delete</a></td>
                                @endif
                            </tr>
                            <?php $index++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="margin: auto ;width: 40%;padding: 10px;">
                {{ $listpost_pagination->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

@endsection
