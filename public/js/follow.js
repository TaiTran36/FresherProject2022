$("#follow").on('click', function () {
    var writer_id = $("#writer_id").val();
    $.ajax({
        method: "get",
        url: "/profile/follow",
        data: {
            'writer_id': writer_id
        },
        success: function (data) {
            $('#count_follow').html(data + " followers");
            $("#follow").hide();
            $("#followed").show();
        }
    })
})
$("#followed").on('click', function () {
    var writer_id = $("#writer_id").val();
    $.ajax({
        method: "get",
        url: "/profile/unfollow",
        data: {
            'writer_id': writer_id
        },
        success: function (data) {
            $('#count_follow').html(data + " followers");
            $("#followed").hide();
            $("#follow").show();
        }
    })
})

