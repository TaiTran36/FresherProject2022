@extends('layouts.admin')

@section('content-admin')
<div class="container">
    <div class="row justify-content-center">
        @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
        @elseif($message = Session::get('error'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PUT')

            @foreach ($fields as $f => $f_value)
            <div class="row mb-3 mt-4">
                <label for={{$f}} class="col-md-3 col-form-label text-md-end">{{ __($f_value) }}</label>

                <div class="col-md-8">
                    <input id="id" type="hidden" class="form-control" name="id" value="{{$user->id}}">
                    @if ($f == "birth_of_date")
                    <input id={{$f}} type="date" class="form-control @error($f) is-invalid @enderror" name={{$f}}
                        value="{{old($f, $user->$f)}}">
                    @elseif ($f == "email")
                    <input id={{$f}} type="email" class="form-control @error($f) is-invalid @enderror" name={{$f}}
                        value="{{old($f, $user->$f)}}">
                    @elseif ($f == "photo_url")
                    <img id="preview-image" class="img img-fluid" style="max-width: 110px; height: auto;"
                        src="{{old(asset('images/'.$f), asset('images/'.$user->$f))}}" alt="">
                    <input id={{$f}} type="file"
                        onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0]);"
                        class="hidden form-control-file @error($f) is-invalid @enderror" name={{$f}}
                        value="{{old($f, $user->$f)}}">
                    @else
                    <input id={{$f}} type="text" class="form-control @error($f) is-invalid @enderror" name={{$f}}
                        value="{{old($f, $user->$f)}}">
                    @endif

                    @error($f)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            @endforeach

            <div class="row mb-3">
                <div class="col-md-6 offset-md-6">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update profile') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection