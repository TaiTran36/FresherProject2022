$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#create-new-category').click(function () {
        $('#btn-save').val("create-category");
        $('#categoryForm').trigger("reset");
        $('#categoryCrudModal').html("Add New Category");
        $('#ajax-crud-modal').modal('show');
    });

    $('body').on('click', '#edit-category', function () {
        var category_id = $(this).data('id');

        $.get(window.location.pathname + '/' + category_id + '/edit', function (data) {
            $('#categoryCrudModal').html("Edit Category");
            $('#btn-save').val("edit-category_" + category_id);
            $('#ajax-crud-modal').modal('show');
            $('#id').val(data.id);
            $('#category_name').val(data.category_name);
            $('#description').val(data.description);
        })
    });

    $('body').on('click', '.delete-category', function () {
        var category_id = $(this).data('id');

        $.ajax({
            type: "DELETE",
            url: window.location.pathname + '/' + category_id,
            success: function (data) {
                $("#category_id_" + category_id).remove();
            }
        });
    });
});

if ($("#categoryForm").length > 0) {
    $('#btn-save').click(function () {
        var actionType = $('#btn-save').val();

        if (actionType == "create-category") {

            $.ajax({
                data: $('#categoryForm').serialize(),
                url: window.location.pathname,
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    var category = data['category'];

                    var row = '<tr id="category_id_' + category['id'] +
                        '"><td>' + category['id'] +
                        '</td><td>' + category['category_name'] +
                        '</td><td>' + category['description'] + '</td>';
                    row += '<td class="px-3 align-middle"><a href="javascript:void(0)" id="edit-category" data-id="' + category['id'] + '" class="btn btn-info">Edit</a></td>';
                    row += '<td class="align-middle"><a href="javascript:void(0)" id="delete-category" data-id="' + category['id'] + '" class="btn btn-danger delete-category">Delete</a></td></tr>';

                    $('#category-list').append(row);

                    $('#categoryForm').trigger("reset");
                    $('#ajax-crud-modal').modal('hide');
                    $('#btn-save').html('Save');

                },
            });

        } else if (actionType.includes("edit-category")) {
            var split_id = actionType.split("_");
            var category_id = split_id[1];

            $.ajax({
                data: $('#categoryForm').serialize(),
                url: window.location.pathname + '/' + category_id,
                type: "PUT",
                dataType: 'json',
                success: function (data) {
                    var category = data['category'];

                    var row = '<tr id="category_id_' + category['id'] +
                        '"><td>' + category['id'] +
                        '</td><td>' + category['category_name'] +
                        '</td><td>' + category['description'] + '</td>';
                    row += '<td class="px-3 align-middle"><a href="javascript:void(0)" id="edit-category" data-id="' + category['id'] + '" class="btn btn-info">Edit</a></td>';
                    row += '<td class="align-middle"><a href="javascript:void(0)" id="delete-category" data-id="' + category['id'] + '" class="btn btn-danger delete-category">Delete</a></td></tr>';

                    $("#category_id_" + category['id']).replaceWith(row);

                    $('#categoryForm').trigger("reset");
                    $('#ajax-crud-modal').modal('hide');
                    $('#btn-save').html('Save');

                },
            });

        }
    });
}