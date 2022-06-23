$(document).ready(function () {

    $(document).on('click', '#pagination_author_posts a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    function fetch_data(page) {
        var username_login = $("#writer_username").val();
        $.ajax({
            url: "/author/" + username_login + "/posts_page?page=" + page,
            data: {
                'username_login': username_login
            },
            success: function (data) {
                // alert(data);
                $('#author_posts').html(data);
            }
        });
    }
    $(document).on('click', '#pagination_cate_posts a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data2(page);
    });

    function fetch_data2(page) {
        var category = $("#category_name").val();
        $.ajax({
            url: "/category/" + category + "/posts_page?page=" + page,
            data: {
                'category': category
            },
            success: function (data) {
                // alert(data);
                $('#cate_posts').html(data);
            }
        });
    }
    $(document).on('click', '#pagination_search_posts a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data3(page);
    });

    function fetch_data3(page) {
        var key = $("#key").val();
        $.ajax({
            url: "/post/client_search_page?page=" + page,
            // type: 'post',
            data: {
                'key': key
            },
            success: function (data) {
                // alert(data);
                $('#search_posts').html(data);
            }
        });
    }
});