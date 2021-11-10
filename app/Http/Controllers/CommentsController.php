<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Carbon\Carbon;

class CommentsController extends Controller
{
    public function store($postId)
    {
        $data = request()->validate([
            'comment'=>'required',
        ]);

        $comment = Comment::create([
            'comment'=> $data['comment'],
            'post_id' => $postId,
            'user_id' => Auth::user()->id,
            'date_posted' => Carbon::now()->timestamp
        ]);
        return redirect("/p/{$postId}");
    }
}
