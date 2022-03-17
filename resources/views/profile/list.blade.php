@extends('templates.master')

@section('title', 'User-profile')

@section('content')

    <?php //Hiển thị thông báo thành công
    ?>
    <div class="page-header">
        <h2>User-profile List</h2>
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
    <h4> Total: <?php echo count($listprofile);?> records. </h4>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="table-responsive">
                {{-- <p><a class="btn btn-primary" href="/{{ url('/profile/create') }}">Thêm mới</a></p> --}}
                <table style="width:100%" id="DataList" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width:5%">No.</th>
                            <th style="width:25%">Name</th>
                            <th style="width:43%">Email</th>
                            <th style="width:7%">Avatar</th>
                            <th style="width:20%">Phone_number</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $page = $listprofile_pagination->currentPage();
                        $index = ($page - 1) * 5 + 1; ?>
                        @foreach ($listprofile_pagination as $profile)
                            <tr>
                                <td><?php echo $index; ?></td>
                                <td>{{ $profile->name }}</td>
                                <td>{{ $profile->email }}</td>
                                <td> <img height="60" src="{{ asset('/profile/' . $profile->avatar) }}" alt="User Image"></td>
                                <td>{{ $profile->phone_number }}</td>
                                <td><a class="btn btn-info" href="/profile/{{ $profile->id }}/details">Details</a></td>
                                @can('edit user')
                                    <td><a class="btn btn-primary" href="/profile/{{ $profile->id }}/edit">Edit</a></td>
                                @endcan
                                @can('delete user')
                                    <td><a class="btn btn-danger" href="/profile/{{ $profile->id }}/delete">Delete</a></td>
                                @endcan
                            </tr>
                            <?php $index++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="margin: auto ;width: 40%;padding: 10px;">
                {{ $listprofile_pagination->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

@endsection
