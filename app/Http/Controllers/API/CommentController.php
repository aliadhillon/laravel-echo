<?php

namespace App\Http\Controllers\API;

use App\Events\NewComment;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        $comments = $post->comments()->with('user')->latest()->get();
        return response()->json($comments);
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $comment = $post->comments()->create([
            'body' => $request->body,
            'user_id' => Auth::id()
        ]);
        
        $comment->load('user');

        event(new NewComment($comment));

        return $comment->toJson();
    }
}
