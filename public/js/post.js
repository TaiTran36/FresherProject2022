$(document).ready(function () {
    $('#submit').click(function () {
        checked = $("input[type=checkbox]:checked").length;
        if (!checked) {
            $('#err').text("You must check this !!!!!!").css("color", "red");
            return false;
        }
    });

    $('#search').on('keyup', function () {
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '/post/search',
            data: {
                'search': $value
            },
            success: function (data) {
                $('#data').html(data);
                $("#pagination_all").hide();
                $("#pagination_search").removeClass("hidden");
            }
        });
        count();
    });

    function count() {
        $value = $("#search").val();
        $.ajax({
            type: 'get',
            url: '/post/search_all',
            data: {
                'search': $value
            },
            success: function (data) {
                if (document.getElementById('search').value.length != 0) {
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
    $(document).on('click', '#delete_post', function (event) {
        event.preventDefault();
        var post_url = $(this).data("url");
        $.ajax({
            method: "get",
            url: "/post/delete",
            data: {
                'url': post_url,
            }
        })
        count();
        var page = $("#page").val();  // lấy current phân trang
        if ($("#search").val() == "") {  // check xem ếu đnag search th s paginate theo search, ko thì theo all
            fetch_data_all(page);
        } // khi xóa xong thì không tải lại toàn bộ list nữa mà chỉ tải lại phân trang hiện tại
        else { fetch_data(page); }
    });

    $(document).on('click', '#pagination_all a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data_all(page);
    });

    function fetch_data_all(page) {
        $.ajax({
            url: "/post/get_list?page=" + page,
            success: function (data) {
                $('#data').html(data);
            }
        });
    }
    $(document).on('click', '#pagination_search a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    function fetch_data(page) {
        $.ajax({
            type: 'get',
            url: "/post/search?page=" + page,
            data: {
                'search': $value
            },
            success: function (data) {
                $('tbody').html('');
                $('#data').html(data);
                $("#pagination_all").hide();
                $("#pagination_search").removeClass("hidden");
            }
        });
    }
});