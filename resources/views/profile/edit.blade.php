@extends('layouts.app')

@section('content')
<div class="container">
    
<div class="row">
        <div class="col-8 offset-2">
                <div class="card-body">
                    <form method="POST" action="{{url('profile',[$user->id])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label"> Name </label>

                           
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title}}">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label"> Bio </label>

                           
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                 name="description">{{  $user->profile->description }}
                                </textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
                        <div class="row mb-3">
                            <label for="url" class="col-md-4 col-form-label">Link</label>

                           
                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url}}">

                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
                        <div class="row mb-3">
                            <label for="avatar" class="col-md-4 col-form-label"> Avatar </label>

                           
                                <input id="avatar" type="file" class="form-control-file" name="avatar">

                                @error('avatar')
                                        <strong>{{ $message }}</strong>
                                  
                                @enderror
                           
                        </div>
                        <div>

                        </div>
                        <div class="row mb-3">
                            <button class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
    </div>
   </div>

</div>
@endsection
