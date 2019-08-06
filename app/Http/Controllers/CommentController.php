<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentForm;

class CommentController extends Controller
{
    public function commentSuscess($id,CommentForm $request){
        $comment=Comment::create([
            'content' => $request->content,
            'user_id' => Auth::user()->user_id,
            'post_id' => $id
        ]);
        $comment->upload()->sync($request->file);
        return redirect(route('post',['id' => $id]));
    }
    
}
