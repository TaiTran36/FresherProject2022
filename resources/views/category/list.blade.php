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
        <input type="text" placeholder="Search for name..." style="width:35%" class="form-controller" id="search3"
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
    <div style="overflow:hidden">
        <a style="display:inline-block;width:4%">Show </a><select class="form-select"
            style="display:inline-block;width:6%" name="number" id="number3">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="999999999">All</option>
        </select>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="table-responsive">
                <div style="height: 10px"></div>
                <div id="data_category">
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
