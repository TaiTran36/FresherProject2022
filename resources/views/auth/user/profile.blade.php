@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                {{ __('Profile') }}
                </div>

                <div class="card-body"> 
                    @if($message = Session::get('success'))
                        <div class="alert alert-success"><p>{{$message}}</p></div>
                    @elseif($message = Session::get('error'))
                        <div class="alert alert-success"><p>{{$message}}</p></div>
                    @endif

                    <form method="POST" enctype="multipart/form-data" action="{{ route('profile') }}">
                        @csrf

                        @foreach ($fields as $f => $f_value) 
                        <div class="row mb-3">
                            <label for={{$f}} class="col-md-3 col-form-label text-md-end">{{ __($f_value) }}</label>

                            <div class="col-md-8">
                                @if ($f == "birth_of_date")
                                    <input id={{$f}} type="date" class="form-control @error($f) is-invalid @enderror" name={{$f}} value="{{Auth::user()->$f}}" >
                                @elseif ($f == "email")
                                    <input id={{$f}} type="email" class="form-control @error($f) is-invalid @enderror" name={{$f}} value="{{Auth::user()->$f}}" >
                                @elseif ($f == "photo_url")
                                    <img class="img img-fluid" style="max-width: 110px; height: auto;" src="{{asset('images/'.Auth::user()->photo_url)}}" alt="">
                                    <input id={{$f}} type="file" class="hidden form-control-file @error($f) is-invalid @enderror" name={{$f}} value="{{Auth::user()->$f}}" >
                                @else
                                    <input id={{$f}} type="text" class="form-control @error($f) is-invalid @enderror" name={{$f}} value="{{Auth::user()->$f}}" >
                                @endif

                                @error($f)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endforeach

                        <div class="row mb-0">
                            <div class="col-md-5 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update profile') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
