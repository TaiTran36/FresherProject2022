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
                                {{-- @if ($f == "birth_of_date")
                                    <input id={{$f}} type="date" class="form-control @error($f) is-invalid @enderror" name={{$f}} value="{{old($f, $user->$f)}}" >
                                @elseif ($f == "email")
                                    <input id={{$f}} type="email" class="form-control @error($f) is-invalid @enderror" name={{$f}} value="{{old($f, $user->$f)}}" >
                                @elseif ($f == "photo_url")
                                    <img id="preview-image" class="img img-fluid" style="max-width: 110px; height: auto;" src="{{old(asset('images/'.$f), asset('images/'.$user->$f))}}" alt="">
                                    <input id={{$f}} type="file" onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0]);" class="hidden form-control-file @error($f) is-invalid @enderror" name={{$f}} value="{{old($f, $user->$f)}}" >
                                @else
                                    <input id={{$f}} type="text" class="form-control @error($f) is-invalid @enderror" name={{$f}} value="{{old($f, $user->$f)}}" >
                                @endif --}}
                                <input id={{$f}} type="text" class="form-control" name={{$f}} value="{{$user->$f}}" disabled>
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