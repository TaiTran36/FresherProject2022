$(document).ready(function () {
    $(document).on('change', '#number3', function (event) {
        $search = $("#search3").val();
        $number = $("#number3").val();
        if ($search == '') {
            $.ajax({
                type: 'get',
                url: '/category/get_list',
                data: {
                    'number': $number
                },
                success: function (data) {
                    $('#data_category').html(data);
                }
            });
        } else {
            ajaxsearch();
        }
    });
    $(document).on('keyup', '#search3', function (event) {
        ajaxsearch();
    });
    function ajaxsearch() {
        $value = $("#search3").val();
        $number = $("#number3").val();
        $.ajax({
            type: 'get',
            url: '/category/search',
            data: {
                'search': $value,
                'number':$number
            },
            success: function (data) {
                $('#data_category').html(data);
                $("#pagination_all_cats").hide();
                $("#pagination_search_cats").removeClass("hidden");
            }
        });
        count();
    }
    function count() {
        $value = $("#search3").val();
        $number = $("#number3").val();
        $.ajax({
            type: 'get',
            url: '/category/search_all',
            data: {
                'search': $value,
                'number':$number
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
        realtime_pusher();
    });
    function delete_cat(id) {
        $number = $("#number3").val();
        $.ajax({
            method: "get",
            url: "/category/delete",
            data: {
                'id': id,
                'number': $number
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
        var check=0;
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
                            check=1;
                        }
                    }
                })
                $.ajax({
                    method: "get",
                    url: "/category/count",
                    success: function (data) {
                        $('#count_cats').html(data);
                        if(check==0){
                        $("#new_cat").val("");} else
                        $("#new_cat").val(new_cat);
                    }
                })
                count();
                var page = $("#page2").val();  // lấy current phân trang
                if ($("#search3").val() == "") {  // check xem ếu đnag search th s paginate theo search, ko thì theo all
                    fetch_data_all2(page);
                } // khi xóa xong thì không tải lại toàn bộ list nữa mà chỉ tải lại phân trang hiện tại
                else { fetch_data2(page); }
                realtime_pusher() ;
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
        $('#edit_name_' + id + '_text').css("background-color", "#F0F8FF");
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
        $number = $("#number3").val();
        $.ajax({
            url: "/category/get_list?page=" + page,
            data: {
                'number': $number
            },
            success: function (data) {
                $('#data_category').html(data);
            }
        });
    }
    $(document).on('click', '#pagination_search_cats a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data2(page);
    });

    function fetch_data2(page) {
        $number = $("#number3").val();
        $.ajax({
            type: 'get',
            url: "/category/search?page=" + page,
            data: {
                'search': $value,
                'number': $number
            },
            success: function (data) {
                $('tbody').html('');
                $('#data_category').html(data);
                $("#pagination_all_cats").hide();
                $("#pagination_search_cats").removeClass("hidden");
            }
        });
    }
       // Khởi tạo một đối tượng Pusher với app_key
       var pusher = new Pusher('b54757f85063e8401c1b', {
        cluster: 'ap1',
        encrypted: true
    });

    //Đăng ký với kênh chanel đã tạo trong file CommentEvent.php
    var channel = pusher.subscribe('dashboard_category');

    //Bind js function reload với sự kiện pusher
    channel.bind('App\\Events\\DashboardCategoryEvent', reloadCats);

    function reloadCats() {
        var page = $("#current_page").val();
        if ($("#search3").val() == '') {
            fetch_data_all2(page);
            // alert(page);
        } else {
            fetch_data2(page);
        }
        $.ajax({
            method: "get",
            url: "/category/count",
            success: function (data) {
                // alert(data);
                $('#count_cats').html(data);  // count tổng
            }
        })
        count();  //count search
    }
    function realtime_pusher() {
        $.ajax({
            method: "get",
            url: "/category_event"
        })
    }
// call đến event ở ngay controller để tránh trục trặc 
});