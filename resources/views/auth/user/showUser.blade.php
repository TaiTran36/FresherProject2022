@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body"> 
                    <form method="GET" action="{{ route('user.show', $user->id) }}">
                        @foreach ($fields as $f => $f_value) 
                        <div class="row mb-3">
                            <label for={{$f}} class="col-md-3 col-form-label text-md-end">{{ __($f_value) }}</label>

                            <div class="col-md-8">
                                @if ($f == "photo_url")
                                    <img id="preview-image" class="img img-fluid" style="max-width: 110px; height: auto;" src="{{asset('images/'.$user->$f)}}" alt="">
                                @else 
                                    <input id={{$f}} type="text" class="form-control" name={{$f}} value="{{$user->$f}}" disabled>
                                @endif 
                            </div>
                        </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection