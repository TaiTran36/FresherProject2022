@extends('templates.master')
@section('title', 'Categories')
@section('content')
    <div class="page-header">
        <center>
            <h2>Categories List</h2>
        </center>
    </div>
    <h4> Total: <a id="count_cats">{{ $listcat->total() }}</a> records. </h4>
    <div class="form-group">
        <input type="text" placeholder="Search for name..." style="width:30%" class="form-controller" id="search3"
            name="search"></input>
        <a id="count"></a>
        <div style="float:right; padding-right:1%">
            <input type="text" placeholder="Add category..." class="form-controller" id="new_cat" name="new_cat">
            @role('admin')
                <a id="add_cat" style="color:white" class="btn btn-success">Add</a>
            @else
                <a class="btn btn-secondary disabled" aria-disabled="true">Add</a>
            @endrole
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="table-responsive">
                <div style="height: 10px"></div>
                <div id="data">
                    @include('category/data')
                </div>
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="{{ asset('js/category.js') }}" defer></script>

@endsection
