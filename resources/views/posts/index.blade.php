@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($posts as $post)

    <div class="card col-8 offset-2 mb-3">
        <div class="card-body d-flex flex-row">
            <a href="/profile/{{$post->user->id}}">
                <img src="/storage/{{$post->user->profile->image}}" class="rounded-circle me-3" height="50px"
                width="50px" alt="avatar" />
            </a>
          <div class="pl-3 d-flex flex-column">
            <h5 class="card-title font-weight-bold mb-0">{{ $post->user->username }}</h5>
            <p class="card-text pe-2">{{$post->created_at }}</p>
          </div>
        </div>
        <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
            <a href="/p/{{$post->id}}">
                <img class="img-fluid" src="/storage/{{$post->image}}"
                alt="Card image cap" />
            </a>
           
          <a href="#!">
            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
          </a>
        </div>
        <div class="card-body d-flex flex-row pt-3 pb-3 p-0">
            <div class="col-9 d-flex p-0 align-items-center">
                <a href="/profile/{{$post->user->id}}">
                    <img src="/storage/{{$post->user->profile->image}}" class="rounded-circle me-3 mr-3" height="50px"
                    width="50px" alt="avatar" />
                </a>
                <p class="w-100"><span class="card-title font-weight-bold pr-3">{{ $post->user->username }}</span>{{ $post->caption }}</p>
            </div>
            <div class="col-3 d-flex justify-content-end">
                @php
                $does_exist = false;
                    foreach ( $likes as $like )
                        {
                            if($like->post_id == $post->id)
                            {
                                $does_exist = true;
                            }
                        }
                @endphp
                <like-button post-id="{{$post->id}}" liked = "{{ $does_exist}}"></like-button>

                @php
                $authUser = auth()->user()->email;
                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
                            $full_url = $protocol . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]p/$post->id";
                            $headers = 'From: ' . $authUser . "\r\n";
                @endphp
                <a href="mailto:?subject=Sharing post&amp;body=Check out this post <?= $full_url?>" class="envelope">
                    <i class="fas fa-share ml-2" style="font-size: 50px; color: black;"></i>
                </a>

            </div>
        </div>
    </div>
@endforeach

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{$posts->onEachSide(5)->links('pagination::bootstrap-4')}}
        </div>
    </div>

</div>
@endsection
