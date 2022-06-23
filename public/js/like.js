$(document).ready(function () {
    // Khởi tạo một đối tượng Pusher với app_key
    var pusher = new Pusher('b54757f85063e8401c1b', {
        cluster: 'ap1',
        encrypted: true
    });

    //Đăng ký với kênh chanel-demo-real-time mà ta đã tạo trong file DemoPusherEvent.php
    var channel = pusher.subscribe('realtime_like_' + $("#post_url").val());

    //Bind một function addMesagePusher với sự kiện PusherEvent
    channel.bind('App\\Events\\LikeEvent', reloadLikes);
});

function reloadLikes(data) {
    var post_url = $("#post_url").val();
    var post_id = $("#post_id").val();
    $.ajax({
        // method: "get",
        url: "/post/" + post_url + "/count_like_dislike",
        data: {
            'post_id': post_id,
        },
        success: function (data) {
            $('#count_like').html(data.likes);
            $('#count_dislike').html(data.dislikes);
        }
    })
}

$("#likebtn").on('click', function () {
    var post_id = $("#post_id").val();
    var post_url = $("#post_url").val();
    $.ajax({
        method: "get",
        url: "/post/like",
        data: {
            'post_id': post_id,
        },
        success: function (data) {
            // $('#count_like').html(data.likes);
            // $('#count_dislike').html(data.dislikes);
        }
    })
    $.ajax({
        method: "get",
        url: "/like_event",
        data: {
            'post_url': post_url,
        }
    })
})
$("#dislikebtn").on('click', function () {
    var post_id = $("#post_id").val();
    var post_url = $("#post_url").val();
    $.ajax({
        method: "get",
        url: "/post/dislike",
        data: {
            'post_id': post_id,
        },
        success: function (data) {
            // $('#count_like').html(data.likes);
            // $('#count_dislike').html(data.dislikes);
        }
    })
    $.ajax({
        method: "get",
        url: "/like_event",
        data: {
            'post_url': post_url,
        }
    })
})