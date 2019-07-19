<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function commentSuscess($id, Request $request){
        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::user()->user_id,
            'post_id' => $id
        ]);
        return redirect(route('post',['id' => $id]));
    }
    
}
