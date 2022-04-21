$(document).ready(function() {
    $(".like, .dislike").click(function() {
        var id = this.id; 
        var split_id = id.split("_"); 

        var type = split_id[0]; 
        var post_id = split_id[1]; 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:window.location.pathname + '/' + type, 
            type:'POST', 
            data:{post_id, type}, 
            dataType:'json',
            success:function(data) {
                var likes = data['likeNum']; 
                var dislikes = data['dislikeNum']; 
                $("#likes_"+post_id).text(likes); 
                $("#dislikes_"+post_id).text(dislikes); 

                if (type == "like") {
                    $(".fa-thumbs-up").css("color", "#000");
                    $(".fa-thumbs-down").css("color", "#778899");
                } 
                else if (type == "dislike") {
                    $(".fa-thumbs-down").css("color", "#000");
                    $(".fa-thumbs-up").css("color", "#778899"); 
                }
            }
        });
    });

    $(".see-more").click(function() {
        var id = this.id;
        var split_id = id.split("_"); 
        var comment_id = split_id[1]; 

        var pathname = window.location.pathname;
        var split_pathname = pathname.split("/");
        var post_url = 
            decodeURIComponent(
                split_pathname[split_pathname.length - 1]
            );

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:window.location.pathname + '/comment/' + comment_id, 
            type:'POST', 
            data:{comment_id, post_url}, 
            dataType:'json',
            success:function(data) {
                var content = data['content']; 

                $("#comment-text_"+comment_id).text(content);
            }
        });
    });

    $(".follow").click(function() {
        var id = this.id; 
        var split_id = id.split("_");
        var followed_id = split_id[1]; 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:window.location.pathname + '/follow', 
            type:'POST',
            data:{followed_id},
            dataType:'json',
            success:function(data) {
                if (data['followed'] == 0) {
                    $("#follow_"+followed_id).text("Follow+");
                } 
                if (data['followed'] == 1) {
                    $("#follow_"+followed_id).text("Followed");
                }
            }
        });
    });
});