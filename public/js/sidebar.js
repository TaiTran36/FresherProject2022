$(document).on('click', '#posts', function (event) {
    event.preventDefault();
    localStorage.setItem('current_posts_page', 1);
    $.ajax({
        method: "get",
        url: "/post/list",
        success: function (data) {
            $("#sidebar").hide();
            $("#content").html(data);
        }
    })
})
$(document).on('click', '#users', function (event) {
    event.preventDefault();
    localStorage.setItem('current_users_page', 1);
    $.ajax({
        method: "get",
        url: "/profile/list",
        success: function (data) {
            $("#sidebar").hide();
            $("#content").html(data);
        }
    })
})
$(document).on('click', '#my_profile', function (event) {
    event.preventDefault();
    var id = $("#user_id").val();
    $.ajax({
        method: "get",
        url: "/profile/" + id + "/details",
        success: function (data) {
            $("#sidebar").hide();
            $("#content").html(data);
        }
    })
})
$(document).on('click', '#posts', function (event) {
    event.preventDefault();
    $.ajax({
        method: "get",
        url: "/post/list",
        success: function (data) {
            $("#sidebar").hide();
            $("#content").html(data);
        }
    })
})
$(document).on('click', '#users', function (event) {
    event.preventDefault();
    $.ajax({
        method: "get",
        url: "/profile/list",
        success: function (data) {
            $("#sidebar").hide();
            $("#content").html(data);
        }
    })
})
$(document).on('click', '#categories', function (event) {
    event.preventDefault();
    $.ajax({
        method: "get",
        url: "/category/list",
        success: function (data) {
            $("#sidebar").hide();
            $("#content").html(data);
        }
    })
})
$(document).on('click', '#edit_user', function (event) {
    event.preventDefault();
    var user_id = $(this).data("id");
    // alert(user_id);
    $.ajax({
        method: "get",
        url: "/profile/" + user_id + "/edit",
        success: function (data) {
            $("#sidebar").hide();
            $("#content").html(data);
        }
    })
})
$(document).on('click', '#details_user', function (event) {
    event.preventDefault();
    var user_id = $(this).data("id");
    // alert(user_id);
    $.ajax({
        method: "get",
        url: "/profile/" + user_id + "/details",
        success: function (data) {
            $("#sidebar").hide();
            $("#content").html(data);
        }
    })
})
$(document).on('click', '#user_back', function (event) {
    event.preventDefault();
    var page = localStorage.getItem('current_users_page');
    $.ajax({
        method: "get",
        url: "/profile/list?page=" + page,
        success: function (data) {
            $("#sidebar").hide();
            $("#content").html(data);
        }
    })
})
$(document).on('click', '#my_user_back', function (event) {
    event.preventDefault();
    var user_id = $(this).data("id");
    $.ajax({
        method: "get",
        url: "/profile/" + user_id + "/details",
        success: function (data) {
            $("#sidebar").hide();
            $("#content").html(data);
        }
    })
})
// $("#edit_user_form").submit(function(event) {
//     event.preventDefault();
//     var formData = new FormData($("#edit_user_form")[0]);
//     var form = $(this);
//     alert(formData);
//     $.ajax({
//         method: "get",
//         url: "/profile/update",
//         data: form.serialize(), // serializes the form's elements.
//         success: function (data) {
//             $("#sidebar").hide();
//             $("#content").html(data);
//         }
//     })
// })

$(document).on('click', '#add_post', function (event) {
    event.preventDefault();
    $.ajax({
        method: "get",
        url: "/post/create",
        success: function (data) {
            $("#sidebar").hide();
            $("#content").html(data);
        }
    })
})
$(document).on('click', '#post_back', function (event) {
    event.preventDefault();
    var page = localStorage.getItem('current_posts_page');
    $.ajax({
        method: "get",
        url: "/post/list?page=" + page,
        success: function (data) {
            $("#sidebar").hide();
            $("#content").html(data);
        }
    })
})
$(document).on('click', '#edit_post', function (event) {
    event.preventDefault();
    var post_url = $(this).data("url");
    // alert(user_id);
    $.ajax({
        method: "get",
        url: "/post/" + post_url + "/edit",
        success: function (data) {
            $("#sidebar").hide();
            $("#content").html(data);
        }
    })
})
$(document).on('click', '#details_post', function (event) {
    event.preventDefault();
    var post_url = $(this).data("url");
    // alert(user_id);
    $.ajax({
        method: "get",
        url: "/post/" + post_url + "/details",
        success: function (data) {
            $("#sidebar").hide();
            $("#content").html(data);
        }
    })
})