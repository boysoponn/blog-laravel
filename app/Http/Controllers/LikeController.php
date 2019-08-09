<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;

class LikeController extends Controller
{
    public function __construct() 
    {
      $this->middleware('auth');
    }

    public function likePostSuccess($post_id){
        $user_id = Auth::user()->user_id;
        Like::create([
        'user_id' => $user_id,
        'likeable_id' => $post_id,
        'likeable_type' => 'post'
        ]);
        $post = Post::where('post_id', $post_id)->withCount('like')->first();
        $msg = $post->like_count;
        return response()->json(['msg'=> $msg]);
    }

    public function unlikePostSuccess($post_id){
        $user_id = Auth::user()->user_id;
        Like::where('user_id', $user_id)
        ->where('likeable_type', 'post')
        ->where('likeable_id', $post_id)
        ->delete();
        $post = Post::where('post_id', $post_id)->withCount('like')->first();
        $msg = $post->like_count;
        return response()->json(['msg'=> $msg]);
    }

    public function likeCommentSuccess($comment_id){
        $user_id = Auth::user()->user_id;
        Like::create([
        'user_id' => $user_id,
        'likeable_id' => $comment_id,
        'likeable_type' => 'comment'
        ]);
        $comment = Comment::where('comment_id', $comment_id)->withCount('like')->first();
        $msg = $comment->like_count;
        return response()->json(['msg'=> $msg]);
    }

    public function unlikeCommentSuccess($comment_id){
        $user_id = Auth::user()->user_id;
        Like::where('user_id', $user_id)
        ->where('likeable_type', 'comment')
        ->where('likeable_id', $comment_id)
        ->delete();
        $comment = Comment::where('comment_id', $comment_id)->withCount('like')->first();
        $msg = $comment->like_count;
        return response()->json(['msg'=> $msg]);
    }

    public function modelLikePost($post_id){
        $post = Post::with('like')->withCount('like')->find($post_id);
        return view('component.modelLike',[
            'post' => $post
        ]);
    }

    public function modelLikeComment($comment_id){
        $comment = Comment::with('like')->withCount('like')->find($comment_id);
        return view('component.modelLike',[
            'post' => $comment
        ]);
    }
}
