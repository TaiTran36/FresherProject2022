$(document).ready(function () {

    $(document).on('change', '#number', function (event) {
        $search = $("#search").val();
        $number = $("#number").val();
        if ($search == '') {
            $.ajax({
                type: 'get',
                url: '/profile/get_list',
                data: {
                    'number': $number
                },
                success: function (data) {
                    $('#data').html(data);
                }
            });
        } else {
            ajaxsearch();
        }
    });
    var search = debounce(function (e) {
        $value = $(this).val();
        $number = $("#number").val();
        ajaxsearch();
    }, 500);        // sau khi keyup 500ms thì mới thực hiện function -> đỡ bị lag do search ngay khi nhập từng ký tự

    $(document).on('keydown', '#search', search);

    function ajaxsearch() {
        $.ajax({
            type: 'get',
            url: '/profile/search',
            data: {
                'search': $value,
                'number': $number
            },
            beforeSend: function () { 
                $('#searching-gif').show(); 
            },
            success: function (data) {
                if($('#data').html(data)){
                    $('#searching-gif').hide();
                }
                $('#data').html(data)
                $("#pagination_all").hide();
                $("#pagination_search").removeClass("hidden");
            }
        });
        count();
    }
    function count() {
        $value = $("#search").val();
        $.ajax({
            type: 'get',
            url: '/profile/search_all',
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
    $(document).on('click', '#delete_user', function (event) {
        $number = $("#number").val();
        event.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            method: "get",
            url: "/profile/delete",
            data: {
                'id': id,
                'number': $number
            }
        })
        $.ajax({
            method: "get",
            url: "/profile/count",
            success: function (data) {
                $('#count_profiles').html(data);
            }
        })
        count();
        var page = $("#page").val();  // lấy current phân trang
        if ($("#search").val() == "") {  // check xem ếu đnag search th s paginate theo search, ko thì theo all
            fetch_data_all(page);
        } // khi xóa xong thì không tải lại toàn bộ list nữa mà chỉ tải lại phân trang hiện tại
        else { fetch_data(page); }
        realtime_pusher();
    });

    $(document).on('click', '#pagination_all a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        localStorage.setItem('current_users_page', page);
        fetch_data_all(page);
    });

    function fetch_data_all(page) {
        $number = $("#number").val();
        $.ajax({
            url: "/profile/get_list?page=" + page,
            data: {
                'number': $number
            },
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
        $number = $("#number").val();
        $.ajax({
            type: 'get',
            url: "/profile/search?page=" + page,
            data: {
                'search': $value,
                'number': $number
            },
            success: function (data) {
                $('tbody').html('');
                $('#data').html(data);
                $("#pagination_all").hide();
                $("#pagination_search").removeClass("hidden");
            }
        });
    }
    $(document).on('click', '#save_user', function () {
        setTimeout(function () {
            realtime_pusher();
        }, 100);
    });
    // Khởi tạo một đối tượng Pusher với app_key
    var pusher = new Pusher('b54757f85063e8401c1b', {
        cluster: 'ap1',
        encrypted: true
    });

    //Đăng ký với kênh chanel đã tạo trong file CommentEvent.php
    var channel = pusher.subscribe('dashboard_profile');

    //Bind js function reload với sự kiện pusher
    channel.bind('App\\Events\\DashboardProfileEvent', reloadProfiles);

    function reloadProfiles() {
        var page = $("#current_page").val();
        if ($("#search").val() == '') {
            fetch_data_all(page);
            // alert(page);
        } else {
            fetch_data(page);
        }
        $.ajax({
            method: "get",
            url: "/profile/count",
            success: function (data) {
                // alert(data);
                $('#count_profiles').html(data);  // count tổng
            }
        })
        count();  //count search
    }
    function realtime_pusher() {
        $.ajax({
            method: "get",
            url: "/profile_event"
        })
    }

});