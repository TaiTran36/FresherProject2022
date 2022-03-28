@extends('templates.master')

@section('title', 'Posts')

@section('content')

    <div class="page-header">
       <center ><h2 id="title">Posts List</h2></center>
    </div>
    <h4> Total: {{ $listpost->total() }} records. </h4>
    <div class="form-group">
        <input type="text" placeholder="Search for title..." class="form-controller" id="search" name="search"></input>
        <a id="count"></a>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="table-responsive">
                <a class="btn btn-success" href="/post/create">Add post</a>
                <div style="height: 10px"></div>
                <div id="data">
                    @include('post/data')
                </div>
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="{{ asset('js/post.js') }}" defer></script>

@endsection
