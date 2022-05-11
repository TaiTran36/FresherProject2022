
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="width:750px; height:200px;border:1px solid #4287ed;padding-top: 20px; margin: auto;background-color:rgb(231, 231, 231);">
        
            <h1 style="text-align: center;;">Xin chào {{ $details['writer_name'] }}</h1>
            <h2 style="text-align: center;">Bạn có bài viết mới từ {{ $details['writer_name'] }} </h2>
            <button style="margin-left: 40%; margin-bottom: 20px; background-color: #4CAF50; /* Green */border: none;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">
            <a style="color: white;" href="http://127.0.0.1:8000/post/{{ $details['post_url'] }}/detail_post">Xem ngay</a>
        </button>
    
    </div>
</body>
</html>