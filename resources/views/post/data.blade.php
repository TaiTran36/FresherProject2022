<table id="DataList" style="width:99%" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width:2%; text-align: center">No.</th>
            <th id="title" style="width:35%; text-align: center" value="title">Title</th>
            <th style="width:8%; text-align: center">Writer</th>
            <th style="width:9%; text-align: center">Created at</th>
            <th style="width:9%; text-align: center">Updated at</th>
            <th style="width:15%; text-align: center" colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $page = $listpost->currentPage();
        $index = ($page - 1) * $listpost->perPage() + 1; ?>
        @foreach ($listpost as $post)
            <tr id='tr1' class='post_tr' data-url={{ $post->url }}>
                <td style="vertical-align: middle; text-align: center"><?php echo $index; ?></td>
                <td style="vertical-align: middle">{{ $post->title }}</td>
                <td style="vertical-align: middle">{{ $post->writer_username_login }}</td>
                <td style="vertical-align: middle">{{ $post->created_at }}</td>
                <td style="vertical-align: middle">{{ $post->updated_at }}</td>
                <td style="vertical-align: middle"><a class="btn btn-info" id="details_post"
                        data-url="{{ $post->url }}" href="/post/{{ $post->url }}/details">Details</a></td>
                <td style="vertical-align: middle">
                    @if (Auth::user()->can('edit post') || $post->writer_id == Auth::user()->id)
                        <a id="edit_post" data-url="{{ $post->url }}" class="btn btn-primary"
                            href="/post/{{ $post->url }}/edit">Edit</a>
                    @else
                        <a class="btn btn-secondary disabled" aria-disabled="true">Edit</a>
                    @endif
                </td>
                <td style="vertical-align: middle">
                    @if (Auth::user()->can('delete post') || $post->writer_id == Auth::user()->id)
                        <input id="page2" value={{ $listpost->currentPage() }} hidden>
                        <a id="delete_post" data-url="{{ $post->url }}" class="btn btn-danger"
                            onclick="return confirm('Are you sure to delete this post?');"
                            href="/post/{{ $post->url }}/delete">Delete</a>
                    @else
                        <a class="btn btn-secondary disabled" aria-disabled="true">Delete</a>
                    @endif
                </td>
            </tr>

            {{-- test --}}

            <tbody class='post_tr_expand hidden' data-url={{ $post->url }}>
            </tbody>

            {{-- /////// test --}}

            <?php $index++; ?>
        @endforeach
        @if (count($listpost) % 5 != 0)
            @for ($i = 0; $i < 5 - count($listpost); $i++)
                <tr height="63px">
                    @for ($j = 0; $j < 8; $j++)
                        <td></td>
                    @endfor
                </tr>
            @endfor
        @endif
    </tbody>
</table>
<input id="current_page" value={{ $listpost->currentPage() }} hidden>
<div id="pagination_search_posts" class="hidden">
    {{ $listpost->links('pagination::bootstrap-4') }}
</div>
<div id="pagination_all_posts">
    {{ $listpost->links('pagination::bootstrap-4') }}
</div>
