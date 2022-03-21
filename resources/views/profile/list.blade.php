@extends('templates.master')

@section('title', 'User-profile')
@section('content')

    <?php //Hiển thị thông báo thành công
    ?>
    <div class="page-header">
        <h2>User-profiles List</h2>
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
    <div class="form-group">
        <input type="text" placeholder="Search for name..." onkeyup="search()" class="form-controller" id="search" name="search"></input>
        <a id="count"></a>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="table-responsive">
                <table style="width:99%" id="DataList" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width:5%; text-align:center">No.</th>
                            <th style="width:25%; text-align:center">Name</th>
                            <th style="width:43%; text-align:center">Email</th>
                            <th style="width:7%; text-align:center">Avatar</th>
                            <th style="width:20%; text-align:center">Phone_number</th>
                            <th colspan="3" style="text-align:center">Action</th>
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
                                <td><img height="60" onerror="this.src='/profile/error_img/not_found.png'" src="{{ asset('/profile/' . $profile->avatar) }}" alt="User Image">
                                <td>{{ $profile->phone_number }}</td>
                                <td><a class="btn btn-info" href="/profile/{{ $profile->id }}/details">Details</a></td>
                                @if ($profile->id == Auth::user()->id || Auth::user()->can('edit user'))
                                <td><a class="btn btn-primary" href="/profile/{{ $profile->id }}/edit">Edit</a></td>
                                @else
                                <td><a hidden>Edit</a></td>
                                @endif
                                @can('delete user')
                                @if ($profile->id != Auth::user()->id)
                                    <td><a class="btn btn-danger" href="/profile/{{ $profile->id }}/delete">Delete</a></td>
                                @else
                                <td><a class="btn btn-secondary disabled" href="/profile/{{ $profile->id }}/delete">Delete</a></td>
                                @endif
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
    <script src="{{ asset('js/search.js') }}" defer></script>
@endsection
