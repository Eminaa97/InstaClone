<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikesController extends Controller
{
    public function store($postId)
    {
        $user = auth()->user();
        $likes = DB::table('likes')->where('post_id', $postId)->first();
        if($likes == null){
            $likes = new Like();
            $likes->post_id = $postId;
            $likes->user_id = $user->id;
            $likes->save();
        }
        else{
            DB::table('likes')->where('post_id', $postId)->delete();
        }
        return $likes;
    }
}
