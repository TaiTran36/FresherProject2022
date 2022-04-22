<p>Hi {{$follower}},</p> 
<p>A new post from {{$data['author']}}</p>
<a href="{{ route('post.read', urlencode(utf8_encode($data['url']))) }}">Read post</a>
