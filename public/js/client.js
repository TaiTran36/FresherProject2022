/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/client.js ***!
  \********************************/
$(document).ready(function () {
  $(".like, .dislike").click(function () {
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
      url: window.location.pathname + '/' + type,
      type: 'POST',
      data: {
        post_id: post_id,
        type: type
      },
      dataType: 'json',
      success: function success(data) {
        var liked = data['liked'];
        var disliked = data['disliked'];
        var likes = data['likeNum'];
        var dislikes = data['dislikeNum'];
        $("#likes_" + post_id).text(likes);
        $("#dislikes_" + post_id).text(dislikes);

        if (type == "like" && liked == 1 && disliked == 0) {
          $(".fa-thumbs-up").css("color", "#007bff");
          $(".fa-thumbs-down").css("color", "#789");
        } else if (type == "dislike" && liked == 0 && disliked == 1) {
          $(".fa-thumbs-up").css("color", "#789");
          $(".fa-thumbs-down").css("color", "#f11b1b");
        } else if (type == "like" && liked == 0 && disliked == 0) {
          $(".fa-thumbs-up").css("color", "#789");
          $(".fa-thumbs-down").css("color", "#789");
        } else if (type == "dislike" && liked == 0 && disliked == 0) {
          $(".fa-thumbs-up").css("color", "#789");
          $(".fa-thumbs-down").css("color", "#789");
        }
      }
    });
  });
  $('.create-comment').click(function () {
    var id = this.id;
    var split_id = id.split("_");
    var post_id = split_id[1];
    var content = $('#content').val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: window.location.pathname + '/comment',
      type: 'POST',
      data: {
        post_id: post_id,
        content: content
      },
      dataType: 'json',
      success: function success(data) {
        var comment = data['comment'];
        var new_comment = '<div class="card col-md-8 offset-md-2 mb-3 comment" id="comment_' + comment['id'] + '">' + '<div class="card-body">' + '<div class="d-flex ml-1">' + '<div class="author-pic">' + '<a href="#">' + '<img src="' + window.location.origin + '/images/' + comment['photo_url'] + '"' + 'class="image rounded-circle avatar mr-2" alt="Image">' + '</a>' + '</div>' + '<div class="col-md-10 text pt-2">' + '<a href="#">' + '<strong>' + comment['username_login'] + '</strong>' + '</a>' + '<p>' + comment['posted_at'] + '</p>' + '</div>' + '<div class="float-right">' + '<a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown"' + 'aria-haspopup="true" aria-expanded="false" v-pre>' + '<i class="bi bi-three-dots-vertical"></i>' + '</a>' + '<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">' + '<a class="dropdown-item edit-comment" id="edit-comment_' + comment['id'] + '">' + 'Edit' + '</a>' + '<a class="dropdown-item delete-comment" id="delete-comment_' + comment['id'] + '">' + 'Delete' + '</a>' + '</div>' + '</div>' + '</div>' + '<div class="content-comment_' + comment['id'] + '">' + '<p id="comment-text_' + comment['id'] + '">' + comment['content'] + '</p>' + '</div>' + '</div>' + '</div>';
        $(".list-comment").prepend(new_comment);
        $("#content").val("");
        var num_comments = data['num_comments'];

        if (num_comments == 1) {
          $(".num-comments").text(num_comments + " Comment");
        } else if (num_comments > 1) {
          $(".num-comments").text(num_comments + " Comments");
        }
      }
    });
  });
  $("body").on('click', '.edit-comment', function () {
    var id = this.id;
    var split_id = id.split("_");
    var comment_id = split_id[1];
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: window.location.pathname + '/comment/' + comment_id + '/edit',
      type: 'GET',
      data: {
        comment_id: comment_id
      },
      dataType: 'json',
      success: function success(data) {
        var old_content = data['content'];
        $(".content-comment_" + comment_id).empty();
        var edit_form = '<textarea id="edit-content_' + comment_id + '" type="text" class="form-control" rows="3" name="edit-content" required>' + old_content + '</textarea>' + '<a class="col-md-2 btn bg-primary mt-2 py-2 edit-content" id="edit-content_' + comment_id + '">' + 'EDIT' + '</a>';
        $(".content-comment_" + comment_id).append(edit_form);
      }
    });
  });
  $("body").on('click', '.edit-content', function () {
    var id = this.id;
    var split_id = id.split("_");
    var comment_id = split_id[1];
    var content = $('#edit-content_' + comment_id).val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: window.location.pathname + '/comment/' + comment_id,
      type: 'PUT',
      data: {
        comment_id: comment_id,
        content: content
      },
      dataType: 'json',
      success: function success(data) {
        $(".content-comment_" + comment_id).empty();
        var update_content = '<p id="comment-text_' + comment_id + '">' + content + '</p>';
        $(".content-comment_" + comment_id).append(update_content);
      }
    });
  });
  $("body").on('click', '.delete-comment', function () {
    var id = this.id;
    var split_id = id.split("_");
    var comment_id = split_id[1];
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: window.location.pathname + '/comment/' + comment_id,
      type: 'DELETE',
      data: {
        comment_id: comment_id
      },
      dataType: 'json',
      success: function success(data) {
        $("#comment_" + comment_id).remove();
        var num_comments = data['num_comments'];

        if (num_comments == 1) {
          $(".num-comments").text(num_comments + " Comment");
        } else if (num_comments > 1) {
          $(".num-comments").text(num_comments + " Comments");
        }
      }
    });
  });
  $(".see-more").click(function () {
    var id = this.id;
    var split_id = id.split("_");
    var comment_id = split_id[1];
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: window.location.pathname + '/comment/' + comment_id,
      type: 'POST',
      data: {
        comment_id: comment_id
      },
      dataType: 'json',
      success: function success(data) {
        var content = data['content'];
        $("#comment-text_" + comment_id).text(content);
      }
    });
  });
  $(".follow").click(function () {
    var id = this.id;
    var split_id = id.split("_");
    var followed_id = split_id[1];
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: window.location.pathname + '/follow',
      type: 'POST',
      data: {
        followed_id: followed_id
      },
      dataType: 'json',
      success: function success(data) {
        if (data['followed'] == 0) {
          $("#follow_" + followed_id).text("Follow");
        }

        if (data['followed'] == 1) {
          $("#follow_" + followed_id).text("Followed");
        }
      }
    });
  });
});
/******/ })()
;