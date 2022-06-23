@extends('templates.master')

@section('title', 'Posts')

@section('content')

    <div class="page-header">
        <center>
            <h2>Posts List</h2>
        </center>
    </div>
    <h4> Total: <a id="count_posts">{{ $listpost->total() }}</a> records. </h4>
    <div style="overflow: hidden">
        <div style="width:50%;display: inline-block; float:left">
            <div class="form-group ">
                <input style="width:70%" type="text" placeholder="Search for title..." class="form-controller" id="search2"
                    name="search"></input>
                <a id="count"></a><br>
            </div>
            <div style="overflow:hidden">
                <a style="display:inline-block;width:8%">Show </a><select class="form-select"
                    style="display:inline-block;width:12%" name="number" id="number2">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="999999999">All</option>
                </select>
                <a id="add_post" class="btn btn-success" style="margin-right:1%; margin-bottom:1%" href="/post/create">Add
                    post</a>
            </div>
        </div>
        <div style="width:10%; float:right;margin-right:1%">
            <a class="btn btn-warning btn-sm" style="position: absolute; float:right; width:10% "
                href="{{ route('posts.export') }}">Export Excel</a> <br> <br>
            <button onclick="document.getElementById('form_import').style.display='block'"
                class="btn btn-sm btn-success"style="width:100%; display: inline-block;">Import Excel</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="table-responsive">
                <div style="height: 10px"></div>
                <div id="data_post">
                    @include('post/data')
                </div>
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
            </div>
        </div>
    </div>
    <div id="form_import" class="w3-modal">
        <div class="w3-modal-content" style="width:30%; border:1px solid green; background-color: #F4F6F9">
            <div class="w3-container">
                <span onclick="document.getElementById('form_import').style.display='none'"
                    class="w3-button w3-display-topright">&times;</span> <br>
                <center>
                    <h2>Import Posts</h2>
                </center> <br>
                <form action="{{ route('posts.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input required type="file" name="file" class="form-control"> <br>
                    <center>
                        <button class="btn btn-sm btn-success">Import</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
    <link href="{{ asset('css/w3.css') }}" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="{{ asset('js/post.js') }}" defer></script>
@endsection
