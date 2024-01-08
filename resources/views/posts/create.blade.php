@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
        <div class="col-8 offset-2">
                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="caption" class="col-md-4 col-form-label"> Post Caption </label>

                           
                                <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}">

                                @error('caption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label"> Post Image </label>

                           
                                <input id="image" type="file" class="form-control-file" name="image">

                                @error('image')
                                        <strong>{{ $message }}</strong>
                                  
                                @enderror
                           
                        </div>
                        <div class="row mb-3">
                            <button class="btn btn-primary">Post</button>
                        </div>
    </div>
   </div>
</div>
@endsection
