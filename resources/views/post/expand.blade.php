@if (isset($expands))
    @foreach ($expands as $expand)
        <tr @if ($loop->index % 2 == 0) style="background-color: #fae8be" @endif>
            <td></td>
            <td style="vertical-align: middle">{{ $expand->title }}</td>
            <td style="vertical-align: middle">{{ $expand->writer_username_login }}</td>
            <td style="vertical-align: middle">{{ $expand->created_at }}</td>
            <td style="vertical-align: middle">{{ $expand->updated_at }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @endforeach
@endif
