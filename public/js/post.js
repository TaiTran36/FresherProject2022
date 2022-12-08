$(document).ready(function () {

    /////////////////////// test /////

    $(document).on('click', '.post_tr', function () {
        $url = $(this).attr('data-url');
        if ($(".post_tr_expand[data-url='" + $url + "']").hasClass('hidden')) {
            $.ajax({
                type: 'get',
                url: '/post/expands',
                data: {
                    'url': $url
                },
                success: function (data) {
                    $(".post_tr_expand[data-url='" + $url + "']").html(data);
                    $(".post_tr_expand[data-url='" + $url + "']").removeClass('hidden');
                    // $(".post_tr_expand[data-url='" + $url + "']").html(data);
                }
            });
        } else {
            $(".post_tr_expand[data-url='" + $url + "']").html('');
            $(".post_tr_expand[data-url='" + $url + "']").addClass('hidden');
        }
    });


    ////////////////////////////
    $(document).on('change', '#number2', function (event) {
        $search = $("#search2").val();
        $number = $("#number2").val();
        if ($search == '') {
            $.ajax({
                type: 'get',
                url: '/post/get_list',
                data: {
                    'number': $number
                },
                success: function (data) {
                    $('#data_post').html(data);
                }
            });
        } else {
            ajaxsearch();
        }
    });
    $('#submit_edit').click(function () {
        var page = localStorage.getItem('current_posts_page');
        checked = $("input[type=checkbox]:checked").length;
        if (!checked) {
            $('#err').text("You must check this !").css("color", "red");
            return false;
        } else {
            realtime_pusher();
        }
    });
    $('#submit_add').click(function (event) {
        // document.getElementById("form_create").submit();
        checked = $("input[type=checkbox]:checked").length;
        if (!checked) {
            $('#err').text("You must check this !").css("color", "red");
            return false;
        } else {
            setTimeout(function () {
                realtime_pusher();
            }, 100);    /// nếu set time out là 0 hoặc không set time out thì nó sẽ thực thi lệnh này khi dữ liệu chưa dc chèn xong.
            /// set time out bao nhiêu milisecond thì optimize ? ??
            // Nên call event ở bên controller luôn để đỡ trục trặc
        }
    });
    var search = debounce(function (e) {
        $value = $(this).val();
        $number = $("#number").val();
        ajaxsearch();
    }, 500);        // sau khi keyup 500ms thì mới thực hiện function -> đỡ bị search khi nhập từng ký tự

    $(document).on('keydown', '#search2', search);
    function ajaxsearch() {
        $.ajax({
            type: 'get',
            url: '/post/search',
            data: {
                'search': $value,
                'number': $number
            },
            success: function (data) {
                $('#data_post').html(data);
                $("#pagination_all_posts").hide();
                $("#pagination_search_posts").removeClass("hidden");
            }
        });
        count();
    }
    function count() {
        $value = $("#search2").val();
        $.ajax({
            type: 'get',
            url: '/post/search_all',
            data: {
                'search': $value
            },
            success: function (data) {
                if (document.getElementById('search2').value.length != 0) {
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
        $number = $("#number2").val();
        event.preventDefault();
        var post_url = $(this).data("url");
        $.ajax({
            method: "get",
            url: "/post/delete",
            data: {
                'url': post_url,
                'number': $number
            }
        })
        $.ajax({
            method: "get",
            url: "/post/count",
            success: function (data) {
                $('#count_posts').html(data);
            }
        })
        count();
        var page = $("#page2").val();  // lấy current phân trang
        if ($("#search2").val() == "") {  // check xem ếu đnag search th s paginate theo search, ko thì theo all
            fetch_data_all2(page);
        } // khi xóa xong thì không tải lại toàn bộ list nữa mà chỉ tải lại phân trang hiện tại
        else { fetch_data2(page); }
        //realtime pusher đến thằng khacs /:
        realtime_pusher();
    });

    $(document).on('click', '#pagination_all_posts a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        localStorage.setItem('current_posts_page', page);
        fetch_data_all2(page);
    });

    function fetch_data_all2(page) {
        $number = $("#number2").val();
        $.ajax({
            url: "/post/get_list?page=" + page,
            data: {
                'number': $number
            },
            success: function (data) {
                $('#data_post').html(data);
            }
        });
    }
    $(document).on('click', '#pagination_search_posts a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data2(page);
    });

    function fetch_data2(page) {
        $number = $("#number2").val();
        $.ajax({
            type: 'get',
            url: "/post/search?page=" + page,
            data: {
                'search': $value,
                'number': $number
            },
            success: function (data) {
                $('tbody').html('');
                $('#data_post').html(data);
                $("#pagination_all_posts").hide();
                $("#pagination_search_posts").removeClass("hidden");
            }
        });
    }

    // Khởi tạo một đối tượng Pusher với app_key
    var pusher = new Pusher('b54757f85063e8401c1b', {
        cluster: 'ap1',
        encrypted: true
    });

    //Đăng ký với kênh chanel đã tạo trong file CommentEvent.php
    var channel = pusher.subscribe('dashboard_post');

    //Bind js function reload với sự kiện pusher
    channel.bind('App\\Events\\DashboardPostEvent', reloadPosts);

    function reloadPosts() {
        var page = $("#current_page").val();
        if ($("#search2").val() == '') {
            fetch_data_all2(page);
        } else {
            fetch_data2(page);
        }
        $.ajax({
            method: "get",
            url: "/post/count",
            success: function (data) {
                $('#count_posts').html(data);  // count tổng
            }
        })
        count();  //count search
    }
    function realtime_pusher() {
        $.ajax({
            method: "get",
            url: "/post_event"
        })
    }

});