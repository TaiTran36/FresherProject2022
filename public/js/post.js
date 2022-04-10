$(document).ready(function () {
    $('#submit').click(function() {
        checked = $("input[type=checkbox]:checked").length;
        if(!checked) {
          $('#err').text("You must check this !!!!!!").css("color", "red");
          return false;
        }
      });

    $('#search').on('keyup', function () {
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '/post/search',
            data: {
                'search': $value
            },
            success: function (data) {
                $('#data').html(data);
                $("#pagination_all").hide();
                $("#pagination_search").removeClass("hidden");
            }
        });
        $.ajax({
            type: 'get',
            url: '/post/search_all',
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
    });

    // $('#title').on('click', function () {
    //     $.ajax({
    //         type: 'get',
    //         url: '/post/sort',
    //         data: {
    //         },
    //         success: function (data) {
    //             $('#data').html(data);
    //         }
    //     });
    // })



    $(document).on('click', '#pagination_all a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data_all(page);
    });

    function fetch_data_all(page) {
        $.ajax({
            url: "/post/get_list?page=" + page,
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
        $.ajax({
            type: 'get',
            url: "/post/search?page=" + page,
            data: {
                'search': $value
            },
            success: function (data) {
                $('tbody').html('');
                $('#data').html(data);
                $("#pagination_all").hide();
                $("#pagination_search").removeClass("hidden");
            }
        });
    }
});