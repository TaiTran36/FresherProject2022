<table id="DataList" style="width:99%" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width:5%; text-align: center">No.</th>
            <th id="title" style="width:25%; text-align: center" value="title">Name</th>
            <th style="width:15%; text-align: center">Created at</th>
            <th style="width:15%; text-align: center" colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $page = $listcat->currentPage();
        $index = ($page - 1) * 5 + 1; ?>
        @foreach ($listcat as $cat)
            <tr>
                <td style="vertical-align: middle; text-align: center"><?php echo $index; ?></td>
                <td id="name_{{ $cat->id }}" style="vertical-align: middle">{{ $cat->name }}</td>
                <td style="display: none" id="edit_name_{{ $cat->id }}" style="vertical-align: middle"><input
                        id="edit_name_{{ $cat->id }}_text" style="border:1px solid gray; width:70%"
                        value="{{ $cat->name }}">
                    <button type="button" id="edit_name_{{ $cat->id }}_button" style="display: none"
                        class="btn btn-success btn-sm">Done</button>
                    <button type="button" id="edit_name_{{ $cat->id }}_cancel" style="display: none"
                        onclick="return confirm('Cancel editting ?');" class="btn btn-secondary btn-sm">Cancel</button>
                </td>
                <td style="vertical-align: middle; text-align: center">{{ $cat->created_at }}</td>
                <td style="vertical-align: middle; text-align: center">
                    @role('admin')
                        <a id="edit_cat" data-id="{{ $cat->id }}" class="btn btn-primary"
                            href="/cat/{{ $cat->id }}/edit">Edit</a>
                    @else
                        <a class="btn btn-secondary disabled" aria-disabled="true">Edit</a>
                    @endrole
                </td>
                <td style="vertical-align: middle; text-align: center">
                    <input id="page2" value={{ $listcat->currentPage() }} hidden>
                    @role('admin')
                        <a id="delete_cat" data-id="{{ $cat->id }}" class="btn btn-danger"
                            onclick="return confirm('Are you sure to delete category &quot;'+$('#name_{{ $cat->id }}').html()+'&quot; ?');"
                            href="/cat/{{ $cat->id }}/delete">Delete</a>
                    @else
                        <a class="btn btn-secondary disabled" aria-disabled="true">Delete</a>
                    @endrole
                </td>
            </tr>
            <?php $index++; ?>
        @endforeach
        @if (count($listcat) % 5 != 0)
            @for ($i = 0; $i < 5 - count($listcat); $i++)
                <tr height="63px">
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endfor
        @endif
    </tbody>
</table>
<div style="margin: auto ;width: 30%;padding: 10px;" id="pagination_search_cats" class="hidden">
    {{ $listcat->links('pagination::bootstrap-4') }}
</div>
<div style="margin: auto ;width: 40%;padding: 10px;" id="pagination_all_cats">
    {{ $listcat->links('pagination::bootstrap-4') }}
</div>
