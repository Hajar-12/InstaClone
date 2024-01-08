@extends('layouts.app')

@section('content')

<div class="container" >
    <div class="row">
        <div class='col-lg-2 col-md-4 col-sm-2 p-5'>
            <img src='{{asset( $userl->profile->avatar) }}'
            alt="" class="rounded-circle w-100">
            
        </div>
        <div class='col-lg-10 col-md-8 pt-5'>
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-middle mb-3" >
                    
                    <div class="d-flex">
                        <div>
                        <h3>{{$userl->name}}</h3>

                        </div>
                    @cannot('update',$userl->profile)                    
<div id='apps'  class="ms-4">
   
<follow-button user-id="{{$userl->id}}" followss='{{$follows}}'></follow-button>

</div>
 @endcannot                  
 </div>              </div>
                @can('update', $userl->profile)
                    <a href="/p/create" class='btn btn-sm btn-primary text-light text-decoration-none'>New Post</a>
                @endcan
            </div>
            @can('update', $userl->profile)
            <button class="mb-4 btn btn-secondary btn-sm">
                <a class='text-light text-decoration-none'href="/profile/{{$userl->username}}/edit">Edit Profile</a>
            </button>
            @endcan
            
            <div class="d-flex">
                <div class="pe-5"><strong>{{$postCount }}</strong> Posts </div>
                <div class="pe-5"><strong>{{$followingCount}} </strong>Following</div>
                <div class="pe-5"><strong>{{$followersCount}} </strong>Followers </div>
            </div>
            <div class="pt-3">
                <p>@ {{$userl->profile->title ?? ''}}
                </p>
                <p>
                   {{$userl->profile->description ?? ''}}
                </p>
            </div>
            
            
        </div>
    </div>
    <div>
        <hr>
    </div>
    <div>
        <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-1 gy-1">
        @forelse($userl->posts as $post)
      
            <div class="col">
            <a type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal{{$post->id}}">
            <img class='' src='{{asset( $post->image) }} 'alt="">
</a>

<div class="modal fade" id="exampleModal{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="w-100">
   <img src='{{asset( $post->image) }}' class="w-100"/>
</div>
      </div>
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">{{$post->caption}}</h5>
      </div>
    </div>
  </div>
</div>
                <a href="/p/{{$post->id}}">
                    
                </a>
               
                <!-- @can('update', $userl->profile)
                <form method="POST" action="{{route('posts.index',[$post->id])}}">
@csrf
@method('delete')
<button type="submit">delete</button>
</form> 
@endcan -->
            </div>
            @empty
            <div class="d-flex justify-content-center mt-5 m-auto">


<h4 class='text-center mt-5 text-secondary'>{{__("No Post Yet")}}</h4>

</div>
@endforelse   
        </div>
    </div>
</div>


@endsection
