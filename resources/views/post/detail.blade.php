@extends('templates.master')

@section('title', 'Post')

@section('content')

    <div class="page-header">
        <center>
            <h2>Post Details</h2>
        </center>
    </div>

    <p><a id="post_back" class="btn btn-primary" style="color:white">Back</a></p>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="table-responsive">
                @foreach ($post as $post)
                    <form action="/post/{{ $post->id }}/edit">
                        <table id="DataList" class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td> Title</td>
                                    <td>{{ $post->title }}</td>
                                </tr>
                                <tr>
                                    <td> Url</td>
                                    <td>{{ $post->url }}</td>
                                </tr>
                                <tr>
                                    <td> Writer </td>
                                    <td>{{ $post->writer_username_login }}</td>
                                </tr>
                                <tr>
                                    <td> Category </td>
                                    <td>
                                        @foreach ($categories as $category)
                                            {{ $category->pluck('category')->implode(', ') }}
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td> Content </td>
                                    <td>{{ $post->content }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                @endforeach
            </div>

        </div>
    </div>

@endsection
