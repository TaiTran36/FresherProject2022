
<table style="width:99%;" id="DataList" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width:5%; text-align:center">No.</th>
            <th style="width:8%; text-align:center">Role</th>
            <th style="width:22%; text-align:center">Name</th>
            <th style="width:40%; text-align:center">Email</th>
            <th style="width:7%; text-align:center">Avatar</th>
            <th style="width:18%; text-align:center">Phone_number</th>
            <th colspan="3" style="text-align:center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $page = $listprofile->currentPage();
        $index = ($page - 1) * 5 + 1; ?>
        @foreach ($listprofile as $profile)
            <tr height="70px">
                <td style="vertical-align: middle; text-align: center"><?php echo $index; ?></td>
                @if ($profile->role=="admin")
                <td style="color:rgb(2, 12, 145); font-weight: bolder; vertical-align: middle; text-align: center">Admin</td>
                @elseif ($profile->role=="modder")
                <td style="color:rgb(3, 60, 184); vertical-align: middle; text-align: center">Modder</td>
                @else
                <td style="color:rgb(3, 147, 230); vertical-align: middle; text-align: center">User</td>
                @endif
                <td style="vertical-align: middle">{{ $profile->name }}</td>
                <td style="vertical-align: middle">{{ $profile->email }}</td>
                <td style="vertical-align: middle"><img height="60" width="60" onerror="this.src='/profile/error_img/not_found.png'" src="{{ asset('/profile/' . $profile->avatar) }}" alt="User Image">
                <td style="vertical-align: middle">{{ $profile->phone_number }}</td>
                <td style="vertical-align: middle"><a class="btn btn-info" href="/profile/{{ $profile->id }}/details">Details</a></td>
                @if ($profile->id == Auth::user()->id || Auth::user()->can('edit user'))
                <td style="vertical-align: middle"><a class="btn btn-primary" href="/profile/{{ $profile->id }}/edit">Edit</a></td>
                @else
                <td style="vertical-align: middle"><a hidden>Edit</a></td>
                @endif
                @can('delete user')
                @if ($profile->id != Auth::user()->id)
                    <td style="vertical-align: middle"><a class="btn btn-danger" href="/profile/{{ $profile->id }}/delete">Delete</a></td>
                @else
                <td style="vertical-align: middle"><a class="btn btn-secondary disabled" href="/profile/{{ $profile->id }}/delete">Delete</a></td>
                @endif
                @endcan
            </tr>
            <?php $index++; ?>
        @endforeach
        @if (count($listprofile)%5 !=0) 
        @for($i=0; $i<(5-count($listprofile)); $i++)
            <tr height="85px">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endfor
        @endif
    </tbody>
</table>
<div style="margin: auto ;width: 30%;padding: 10px;" id="pagination_search" class="hidden">
    {{ $listprofile->links('pagination::bootstrap-4') }}
</div>
<div style="margin: auto ;width: 40%;padding: 10px;" id="pagination_all">
    {{ $listprofile->links('pagination::bootstrap-4') }}
</div>

