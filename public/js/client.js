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
        var likes = data['likeNum'];
        var dislikes = data['dislikeNum'];
        $("#likes_" + post_id).text(likes);
        $("#dislikes_" + post_id).text(dislikes);

        if (type == "like") {
          $(".fa-thumbs-up").css("color", "#000");
          $(".fa-thumbs-down").css("color", "#778899");
        } else if (type == "dislike") {
          $(".fa-thumbs-down").css("color", "#000");
          $(".fa-thumbs-up").css("color", "#778899");
        }
      }
    });
  });
});
/******/ })()
;