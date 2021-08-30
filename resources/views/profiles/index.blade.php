@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-4 pt-5 d-flex justify-content-center align-items-center">
            <img src="{{$user->profile->profileImage()}}" style="width: 200px; height: 200px" class="rounded-circle">
        </div>
        <div class="col-8 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-2">
                    <div class="h3">{{ $user->username }}</div>
                    <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                </div>
                <div class="w-50 justify-content-end d-flex">
                    @can('update',$user->profile)
                        <a href="/p/create" class="btn btn-primary align-self-baseline">Add new post</a>
                        <a href="/profile/{{$user->id}}/edit" class="btn btn-secondary align-self-baseline ml-1">Edit profile</a>
                    @endcan
                </div>
            </div>
            <div class="d-flex pt-2 pb-2">
                <div class="pr-5"><strong>{{$postsCount}}</strong> posts</div>
                <div class="pr-5"><strong>{{$followersCount}}</strong> followers</div>
                <div class="pr-5"><strong>{{$followingCount}}</strong> following</div>
            </div>
            <div class="font-weight-bold" style="font-size: 15px;">{{$user->profile->title}}</div>
            <div class="d-flex flex-column">
                <p class="p-0 m-0">{{ $user->profile->description }}</p>
                <div class="p-0 m-0"><a href="#">{{ $user->profile->url}}</a></div>
            </div>
        </div>
    </div>
    <div class="row pt-4">
        @foreach($user->posts as $post)
            <div class="col-4 d-flex justify-content-center pb-4">
               <a href="/p/{{$post->id}}">
                <img src="/storage/{{$post->image}}" class="w-100">
               </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
