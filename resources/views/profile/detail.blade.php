@extends('templates.master')

@section('title', 'User-profile')

@section('content')

    <?php //Hiển thị thông báo thành công
    ?>
    <div class="page-header">
        <h2>User-profile</h2>
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
    @if (Auth::user()->can('all user'))
        <p><a class="btn btn-primary" href="/profile/list">Back</a></p>
    @endif
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="table-responsive">
                @foreach ($profile as $profile)
                    <form action="/profile/{{ $profile->id }}/edit">
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
                                    <td> Username</td>
                                    <td>{{ $profile->username_login }}</td>
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
                                    <td> <img style="width:10%;height:10%" onerror="this.src='/profile/error_img/not_found.png'"
                                            src="{{ asset('/profile/' . $profile->avatar) }}" alt="User Image"></td>
                                </tr>
                                <tr>
                                    <td> Address</td>
                                    <td>{{ $profile->address }}</td>
                                </tr>
                                <tr>
                                    <td> Phone</td>
                                    <td>{{ $profile->phone_number }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @if ($profile->id == Auth::user()->id)
                        <center><a class="btn btn-primary" href="/profile/{{ $profile->id }}/edit">Edit</a></center>
                        @endif
                    </form>
                @endforeach
            </div>

        </div>
    </div>

@endsection
