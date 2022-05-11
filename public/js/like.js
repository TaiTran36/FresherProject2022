$("#likebtn").on('click', function() {
             
    var post_id = $("#post_id").val();
    
    $.ajax({
    method: "get",
    url: "/post/like",
    data: {
        'post_id': post_id,
    },
    success: function(data) {
       

        $('#count_like').html(data.like);
        $('#count_dislike').html(data.dislike);
        
    }
})
})
$("#dislikebtn").on('click', function() {
var post_id = $("#post_id").val();
$.ajax({
    method: "get",
    url: "/post/dislike",
    data: {
        'post_id': post_id,
    },
    success: function(data) {
        $('#count_like').html(data.like);
        $('#count_dislike').html(data.dislike);

    }
})
})