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
        $likePost = Like::where('user_id', $user_id)
        ->where('likeable_type', 'post')
        ->where('likeable_id', $post_id)
        ->first();
        if(isset($likePost)){
            $likePost->restore(); 
        }else{
            Like::create([
            'user_id' => $user_id,
            'likeable_id' => $post_id,
            'likeable_type' => 'post'
            ]);
        }

       return redirect()->back();
    }

    public function unlikePostSuccess($post_id){
        $user_id = Auth::user()->user_id;
        $likePost = Like::where('user_id', $user_id)
        ->where('likeable_type', 'post')
        ->where('likeable_id', $post_id)
        ->delete();

       return redirect()->back();
    }

    public function likeCommentSuccess($post_id){
        $user_id = Auth::user()->user_id;
        $likePost = Like::where('user_id', $user_id)
        ->where('likeable_type', 'comment')
        ->where('likeable_id', $post_id)
        ->first();
        if(isset($likePost)){
            $likePost->restore(); 
        }else{
            Like::create([
            'user_id' => $user_id,
            'likeable_id' => $post_id,
            'likeable_type' => 'post'
            ]);
        }

       return redirect()->back();
    }

    public function unlikeCommentSuccess($post_id){
        $user_id = Auth::user()->user_id;
        $likePost = Like::where('user_id', $user_id)
        ->where('likeable_type', 'comment')
        ->where('likeable_id', $post_id)
        ->delete();

       return redirect()->back();
    }
}
