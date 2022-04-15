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
        success: function(data) {
            $('#list_comments').html(data.comments_views);
            $('#count_comment').html(data.count);
            comment_area.value='';
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
        url: "/post/"+post_url+"/client_details_comments?page=" + page,
        success: function (data) {
            $('#list_comments').html(data);
        }
    });
}
// function fetch_data_all(page, post_url) {
//     $.ajax({
//         url: "/post/"+post_url+"/client_details?page=" + page,
//         success: function (data) {
//             $('#post').html(data);
//         }
//     });
// }