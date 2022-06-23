$(document).ready(function () {

    $(document).on('keyup', '#search3', function (event) {
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '/category/search',
            data: {
                'search': $value
            },
            success: function (data) {
                $('#data').html(data);
                $("#pagination_all_cats").hide();
                $("#pagination_search_cats").removeClass("hidden");
            }
        });
        count();
    });

    function count() {
        $value = $("#search3").val();
        $.ajax({
            type: 'get',
            url: '/category/search_all',
            data: {
                'search': $value
            },
            success: function (data) {
                if (document.getElementById('search3').value.length != 0) {
                    if (data != 0) {
                        $('#count').text(data + ' records found').css("color", "blue");
                    }
                    if (data == 0) {
                        $('#count').text(data + ' records found').css("color", "red");
                    }
                } else
                    $('#count').text('');
            }
        });
    }
    $(document).on('click', '#delete_cat', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        delete_cat(id);
    });
    function delete_cat(id) {
        $.ajax({
            method: "get",
            url: "/category/delete",
            data: {
                'id': id,
            }
        })
        $.ajax({
            method: "get",
            url: "/category/count",
            success: function (data) {
                $('#count_cats').html(data);
            }
        })
        count();
        var page = $("#page2").val();  // lấy current phân trang
        if ($("#search3").val() == "") {  // check xem ếu đnag search th s paginate theo search, ko thì theo all
            fetch_data_all2(page);
        } // khi xóa xong thì không tải lại toàn bộ list nữa mà chỉ tải lại phân trang hiện tại
        else { fetch_data2(page); }
    }
    $(document).on('click', '#add_cat', function (event) {
        event.preventDefault();
        var new_cat = $("#new_cat").val();
        if (new_cat != null) {
            if (confirm('Are you sure to add new category "' + new_cat + '" ?') == true) {
                $.ajax({
                    method: "get",
                    url: "/category/insert",
                    data: {
                        'new_cat': new_cat,
                    },
                    success: function (data) {
                        if (data == 0) {
                            alert("Category existed !!!");
                            $("#new_cat").val(new_cat);
                        }
                    }

                })
                $.ajax({
                    method: "get",
                    url: "/category/count",
                    success: function (data) {
                        $('#count_cats').html(data);
                        $("#new_cat").val("");
                    }
                })
                count();
                var page = $("#page2").val();  // lấy current phân trang
                if ($("#search3").val() == "") {  // check xem ếu đnag search th s paginate theo search, ko thì theo all
                    fetch_data_all2(page);
                } // khi xóa xong thì không tải lại toàn bộ list nữa mà chỉ tải lại phân trang hiện tại
                else { fetch_data2(page); }
            }
        }
    });
    $(document).on('click', '#edit_cat', function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var id = $(this).data("id");
        $('#name_' + id).hide();
        $('#edit_name_' + id).show();
        $('#edit_name_' + id + '_text').focus();
        $('#edit_name_' + id + '_button').show();
        $('#edit_name_' + id + '_cancel').show();

        $(document).on('click', '#edit_name_' + id + '_cancel', function (event) {
            event.stopImmediatePropagation();     // chống ajax confirm bị lặp 
            $('#edit_name_' + id).hide();
            $('#edit_name_' + id + '_button').hide();
            $('#edit_name_' + id + '_cancel').hide();
            $('#name_' + id).show();
        });
        $(document).on('click', '#edit_name_' + id + '_button', function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            var name = $('#edit_name_' + id + '_text').val();
            if (name == "") {
                if (confirm('Delete category "' + $('#name_' + id).html() + '" ?') == true) {
                    delete_cat(id);
                }
            } else {
                if (name == $('#name_' + id).html()) {
                    alert("Nothing changed !");
                    $('#edit_name_' + id).hide();
                    $('#edit_name_' + id + '_button').hide();
                    $('#edit_name_' + id + '_cancel').hide();
                    $('#name_' + id).show();
                } else {
                    if (confirm('Rename this category from "' + $('#name_' + id).html() + '" to "' + $('#edit_name_' + id + '_text').val() + '" ?') == true) {
                        $.ajax({
                            method: "get",
                            url: "/category/edit",
                            data: {
                                'name': name,
                                'id': id
                            },
                            success: function (data) {
                                if (data == 0) {
                                    alert("Category existed !!!");
                                } else {
                                    $('#edit_name_' + id).hide();
                                    $('#edit_name_' + id + '_button').hide();
                                    $('#edit_name_' + id + '_cancel').hide();
                                    $('#name_' + id).show();
                                    $('#name_' + id).html(data);
                                }
                            }
                        })
                    }
                }
            }
        });
    });

    $(document).on('click', '#pagination_all_cats a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data_all2(page);
    });

    function fetch_data_all2(page) {
        $.ajax({
            url: "/category/get_list?page=" + page,
            success: function (data) {
                $('#data').html(data);
            }
        });
    }
    $(document).on('click', '#pagination_search_cats a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data2(page);
    });

    function fetch_data2(page) {
        $.ajax({
            type: 'get',
            url: "/category/search?page=" + page,
            data: {
                'search': $value
            },
            success: function (data) {
                $('tbody').html('');
                $('#data').html(data);
                $("#pagination_all_cats").hide();
                $("#pagination_search_cats").removeClass("hidden");
            }
        });
    }
});