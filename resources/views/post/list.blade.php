@extends('templates.master')

@section('title', 'Posts')

@section('content')

    <?php //Hiển thị thông báo thành công
    ?>
    <div class="page-header">
        <h2>Posts List</h2>
    </div>
    <h4> Total: <?php echo count($listpost); ?> records. </h4>
    <div class="form-group">
        <input type="text" placeholder="Search for title..." onkeyup="search()" class="form-controller" id="search" name="search"></input>
        <a id="count"></a>
    </div>
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
                <table id="DataList" style="width:99%" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width:5%; text-align: center;">No.</th>
                            <th style="width:45%; text-align: center;">Title</th>
                            <th style="width:15%; text-align: center;">Writer</th>
                            <th style="width:10%; text-align: center;">Created at</th>
                            <th style="width:10%; text-align: center;">Updated at</th>
                            <th style="width:15%; text-align: center;" colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $page = $listpost_pagination->currentPage();
                        $index = ($page - 1) * 5 + 1; ?>
                        @foreach ($listpost_pagination as $post)
                            <tr>
                                <td><?php echo $index; ?></td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->writer_username_login }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->updated_at }}</td>
                                <td><a class="btn btn-info" href="/post/{{ $post->id }}/details">Details</a></td>
                                <td>
                                    @if (Auth::user()->can('edit post') || $post->writer_id == Auth::user()->id)
                                        <a class="btn btn-primary" href="/post/{{ $post->id }}/edit">Edit</a>
                                    @else 
                                        <a class="btn btn-secondary disabled" aria-disabled="true">Edit</a>
                                    @endif
                                </td>
                                <td>
                                    @if (Auth::user()->can('delete post') || $post->writer_id == Auth::user()->id)
                                        <a class="btn btn-danger" href="/post/{{ $post->id }}/delete">Delete</a>
                                    @else 
                                        <a class="btn btn-secondary disabled" aria-disabled="true">Delete</a>
                                    @endif
                                </td>
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
    <script src="{{ asset('js/search.js') }}" defer></script>
@endsection
