@component('mail::message')
Hello 
{{ $details['title'] }}
@component('mail::button', ['url' => 'http://127.0.0.1:8000/post/28529-sdfef/detail_post', 'color' => 'blue'])
Show it
@endcomponent
{{ $details['body'] }}

Thanks,
@endcomponent
