@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{$post->image}}" class="w-100">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pr-3">
                        <img src="{{ $post->user->profile->profileImage() }}" class="w-100 rounded-circle" style="max-width:45px">
                    </div>
                    <div class="w-100">
                        <div class="font-weight-bold d-flex">
                            <a href="/profile/{{$post->user->id}}">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a>
                            <div class="d-flex w-100 justify-content-end">
                                <follow-button user-id="{{$post->user->id}}" follows="{{$follows}}"></follow-button>
                                
                                <form 
                                method="post" 
                                action="{{url('/p/delete')}}/{{$post->id}}"> 
                                @csrf
                                {{ method_field('DELETE') }}
                        
                                <button 
                                  type="submit"
                                  onclick="return confirm('Are you sure?')"
                                  class="btn btn-danger ml-2">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <p>
                    <span class="font-weight-bold pr-2">
                        <a href="/profile/{{$post->user->id}}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </span>{{$post->caption}}</p>
            </div>

            {{-- comments --}}
            <div>
                <div>
                    @foreach ( $comments as $comment)
                    <div class="d-flex pb-2 w-100">
                        <a class="w-25" href="/profile/{{$comment->user->id}}">
                            <div class="d-flex pb-2">
                                <img src="{{ $comment->user->profile->profileImage() }}" class="w-100 rounded-circle pr-1" style="max-width:45px">
                            </div>
                        </a>
                        <p class="m-0 w-100" style="word-break: break-all; ">
                            <span class="text-dark pr-3 font-weight-bolder m-0">{{$comment->user->username}}</span>{{$comment->comment}}</p>
                    </div>
                    @endforeach
                </div>
                <form 
                method="post" 
                action="{{url('/comment')}}/{{$post->id}}"> 
                @csrf
                {{ method_field('POST') }}
        
                <div class="input-group mb-3">
                    <input
                    id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" 
                    name="comment" required autocomplete="comment" autofocus placeholder="Type comment here..." aria-describedby="basic-addon2">
                    @error('comment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="input-group-append">
                      <button class="btn btn-outline-primary" type="submit">Send</button>
                    </div>
                </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection