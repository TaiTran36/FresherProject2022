$('#search').on('keyup', function() {
    $value = $(this).val();
    $.ajax({
        type: 'get',
        url: '{{ URL::to('search') }}',
        data: {
            'search': $value
        },
        success: function(data) {
            $('tbody').html(data);
        }
    });
    $.ajax({
        type: 'get',
        url: '{{ URL::to('search_all') }}',
        data: {
            'search': $value
        },
        success: function(data) {
            if (document.getElementById('search').value.length != 0) {
                $('#count').text(data + ' records found');
            } else
                $('#count').text('');
        }
    });
    $.ajax({
        type: 'get',
        url: '{{ URL::to('search_pagination') }}',
        data: {
            'search': $value
        },
        success: function(data) {
            $('#pagination').html(data);
        }
    });
})
$.ajaxSetup({
    headers: {
        'csrftoken': '{{ csrf_token() }}'
    }
});