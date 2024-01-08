@extends('layouts.app')

@section('content')
<div class="container">
    @forelse ($posts as $post)    
    <div class="card w-50 m-auto my-5">
        <a href="/profile/{{$post->user->id}}">
            <img src="{{asset($post->image)}}" class="card-img-top" alt="...">
        </a>
        <hr class="my-1">
        <div class="card-body">
            <a href="/profile/{{$post->user->id}}" class="text-decoration-none text-dark">
                <p class="card-text">{{$post->caption}}</p>
            </a>   
       
        </div>
      
    </div> 
    @empty
    <div class="d-flex justify-content-center mt-5">
    <h1 class="">Nothing To Show Yet</h1>

    </div>
    @endforelse
</div>
@endsection