<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use Image;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads','public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();
        
        Post::create([
            'caption'=> $data['caption'],
            'image' => $imagePath,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/profile/'.Auth::user()->getAuthIdentifier());
    }

    public function show(Post $post) {
        $follows = (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;
        $comments = Comment::where('post_id', $post->id)->with('user')->get();
        
        return view('posts.show',compact('post', 'follows', 'comments' ));
    }

    public function delete(Post $post) {
        DB::table('posts')->where('id', $post->id)->delete();

        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        $likes = Like::select('post_id')->where('user_id',Auth::user()->id)->get('id');

        return view('posts.index', compact('posts', 'likes'));
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        $likes = Like::select('post_id')->where('user_id',Auth::user()->id)->get('id');
       
        return view('posts.index', compact('posts', 'likes'));
    }
}
