$(document).ready(function () {
    // Khởi tạo một đối tượng Pusher với app_key
    var pusher = new Pusher('b54757f85063e8401c1b', {
        cluster: 'ap1',
        encrypted: true
    });

    //Đăng ký với kênh chanel đã tạo trong file CommentEvent.php
    var channel = pusher.subscribe('realtime_comment_' + $("#post_url").val());

    //Bind js function reload với sự kiện pusher
    channel.bind('App\\Events\\CommentEvent', reloadComments);
});

function reloadComments() {
    var page = $("#current_page").val();
    var post_url = $("#post_url").val();
    var check = 0;
    $.ajax({
        //method: "get",
        url: "/post/" + post_url + "/client_details_comments?page=" + page,
        success: function (data) {
            $(".checkButt").each(function () {
                if ($(this).css("display") != "none") {
                    check = 1;    //check xem nấu đang edit thì sẽ chưa load lại list vội
                }
            })
            if (check == 0) {
                $('#list_comments').html(data.comments_views);
            }
            $('#count_comment').html(data.count);
        }
    })
}
$('#save-comment').on('click', function () {
    var comment = $("#comment").val();
    var post_id = $("#post_id").val();
    var post_url = $("#post_url").val();
    const comment_area = document.getElementById('comment');
    $.ajax({
        method: "get",
        url: "/post/save-comment",
        data: {
            'post_id': post_id,
            'comment': comment,
            'post_url': post_url
        },
        success: function (data) {
            $('#list_comments').html(data.comments_views);
            $('#count_comment').html(data.count);
            comment_area.value = '';
        }
    })
    $.ajax({
        method: "get",
        url: "/comment_event",
        data: {
            'post_url': post_url
        }
    })
});
$(document).on('click', '#pagination_all a', function (event) {
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    var post_url = $("#post_url").val();
    fetch_data_all(page, post_url);
});
function fetch_data_all(page, post_url) {
    $.ajax({
        url: "/post/" + post_url + "/client_details_comments?page=" + page,
        success: function (data) {
            $('#list_comments').html(data.comments_views);
        }
    });
}
$(document).on('click', '#delete_comment', function (event) {
    event.preventDefault();
    var id = $(this).data("id");
    var post_url = $("#post_url").val();
    $.ajax({
        method: "get",
        url: "/post/delete-comment",
        data: {
            'comment_id': id,
            'post_url': post_url
        },
        success: function (data) {
            $('#list_comments').html(data.comments_views);
            $('#count_comment').html(data.count);
        }
    })
    $.ajax({
        method: "get",
        url: "/comment_event",
        data: {
            'post_url': post_url
        }
    })
    var page = $("#page").val();  // lấy current phân trang
    fetch_data_all(page, post_url); // khi xóa xong thì không tải lại toàn bộ list nữa mà chỉ tải lại phân trang hiện tại

});

$(document).on('click', '#edit_comment', function (event) {
    event.preventDefault();
    var comment_id = $(this).data("id");
    var post_url = $("#post_url").val();
    var comment_text = "comment_text_" + comment_id;
    var comment_text_input = "comment_text_input_" + comment_id;   // lấy ra theo đúng id
    var update_comment = "update_comment_" + comment_id;

    $("#" + comment_text).hide();
    $("#" + comment_text_input).show();
    $("#" + comment_text_input).focus();
    $("#" + update_comment).show();
    $(document).on('click', "#" + update_comment, function (event) {
        event.preventDefault();
        var comment = $("#" + comment_text_input).val();
        $.ajax({
            method: "get",
            url: "/post/edit-comment",
            data: {
                'comment_id': comment_id,
                'comment': comment,
                'post_url': post_url
            },
            success: function (data) {
                $("#" + comment_text_input).hide();
                $("#" + update_comment).hide();
                $("#" + comment_text).show();
                $("#" + comment_text).html(data);
            }
        })
        $.ajax({
            method: "get",
            url: "/comment_event",
            data: {
                'post_url': post_url
            }
        })
    });
});