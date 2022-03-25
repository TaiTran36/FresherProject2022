<table id="DataList" style="width:99%;" class="table table-bordered table-hover" >
    <thead>
        <tr>
            <th style="width:3%; text-align: center;">No.</th>
            <th id="title" style="width:42%; text-align: center;">Title</th>
            <th style="width:10%; text-align: center;">Writer</th>
            <th style="width:15%; text-align: center;">Created at</th>
            <th style="width:15%; text-align: center;">Updated at</th>
            <th style="width:15%; text-align: center;" colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $page = $listpost->currentPage();
        $index = ($page - 1) * 5 + 1; ?>
        @foreach ($listpost as $post)
            <tr>
                <td><?php echo $index; ?></td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->writer_username_login }}</td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->updated_at }}</td>
                <td><a class="btn btn-info" href="/post/{{ $post->url }}/details">Details</a></td>
                <td>
                    @if (Auth::user()->can('edit post') || $post->writer_id == Auth::user()->id)
                        <a class="btn btn-primary" href="/post/{{ $post->url }}/edit">Edit</a>
                    @else
                        <a class="btn btn-secondary disabled" aria-disabled="true">Edit</a>
                    @endif
                </td>
                <td>
                    @if (Auth::user()->can('delete post') || $post->writer_id == Auth::user()->id)
                        <a class="btn btn-danger" href="/post/{{ $post->url }}/delete">Delete</a>
                    @else
                        <a class="btn btn-secondary disabled" aria-disabled="true">Delete</a>
                    @endif
                </td>
            </tr>
            <?php $index++; ?>
        @endforeach
        @if (count($listpost)%5 !=0 ) 
        @for($i=0; $i<(5-count($listpost)); $i++)
            <tr height="63px">
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
    {{ $listpost->links('pagination::bootstrap-4') }}
</div>
<div style="margin: auto ;width: 40%;padding: 10px;" id="pagination_all">
    {{ $listpost->links('pagination::bootstrap-4') }}
</div>

