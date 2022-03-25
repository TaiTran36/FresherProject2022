@extends('templates.master')

@section('title', 'User-profile')
@section('content')
<div class="page-header">
    <center ><h2>Users List</h2></center>
</div>
    <h4> Total: {{ $listprofile->total() }} records. </h4>
    <div class="form-group">
        <input type="text" placeholder="Search for name..." class="form-controller" id="search" name="search"></input>
        <a id="count"></a>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div id="data" class="table-responsive">
                @include('profile/data')
            </div>
        </div>
    </div>
    <script src="{{ asset('js/profile.js') }}" defer></script>
@endsection
