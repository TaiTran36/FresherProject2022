@extends('layouts.admin')

@section('content-admin')
<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-category">Add Category</a>
            <table class="table table-bordered" id="category-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category Name</th>
                        <th>Description</th>
                        <td colspan="2">Action</td>
                    </tr>
                </thead>
                <tbody id="category-list">
                    @foreach($categories as $ctg)
                    <tr id="category_id_{{ $ctg->id }}">
                        <td>{{ $ctg->id }}</td>
                        <td>{{ $ctg->category_name }}</td>
                        <td>{{ $ctg->description }}</td>
                        {{-- <td class="px-3 align-middle">
                            <a href="javascript:void(0)" id="edit-category" data-id="{{ $ctg->id }}"
                                class="btn btn-info">
                                {{ __('Edit') }}
                            </a>
                        </td>
                        <td class="align-middle">
                            <a href="javascript:void(0)" id="delete-category" data-id="{{ $ctg->id }}"
                                class="btn btn-danger delete-category">
                                {{ __('Delete') }}
                            </a>
                        </td> --}}

                        <td>
                            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="bi bi-three-dots"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a href="javascript:void(0)" id="edit-category" data-id="{{ $ctg->id }}"
                                    class="dropdown-item">
                                    {{ __('Edit') }}
                                </a>

                                <a href="javascript:void(0)" id="delete-category" data-id="{{ $ctg->id }}"
                                    class="dropdown-item delete-category">
                                    {{ __('Delete') }}
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $categories->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="categoryCrudModal"></h4>
                @if($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{$message}}</p>
                </div>
                @elseif($message = Session::get('error'))
                <div class="alert alert-success">
                    <p>{{$message}}</p>
                </div>
                @endif
            </div>
            <div class="modal-body">
                <form id="categoryForm" name="categoryForm" class="form-horizontal">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="category_name" class="col-md-4 control-label">Category Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                id="category_name" name="category_name" value="" required>

                            @error('category_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-md-4 control-label">Description</label>
                        <div class="col-sm-12">
                            <textarea type="text" class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" value="" required></textarea>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save" value="create">
                    {{ __('Save') }}
                </button>
            </div>
        </div>
    </div>
</div>

@endsection