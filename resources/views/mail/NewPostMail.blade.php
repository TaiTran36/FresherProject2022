<!DOCTYPE html>
<html>

<head>
    <title>DuckAnh.com</title>
</head>

<body>
    <h1>New post from {{ $details['writer_name'] }}</h1>
    <p>Hello, {{ $details['follower_name'] }}, </p>
    <p>
        Author {{ $details['writer_name'] }} who you follow in Laravel Project has recently posted a new post :
    </p>
    <h2 style="align:center">{{ $details['post_title'] }}</h2>
    <a href="{{ url('post/' . $details['post_url'] . '/client_details') }}"
        style="background-color: #f48536;color: white;padding: 10px 10px;text-align: center;text-decoration: none;display: inline-block;">
        View post </a>
    <p>Thank you</p>
</body>

</html>
