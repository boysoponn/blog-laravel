<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;

class PostController extends Controller
{
    public function user($id)
    {
        $user = User::find($id);
        return view('user',[
            'user' => $user
        ]);
    }

    public function postByCate($id)
    {
        $category = Category::find($id);
        $postList = Post::where('category_id',$id)->latest()->paginate(10);
        return view('category',[
            'category' => $category,
            'postList' => $postList
        ]);
    }

    public function index($id)
    {
        $post = Post::find($id);
        $commentList = Comment::where('post_id',$id)
        ->paginate(5);
        return view('post',[
            'post' => $post,
            'commentList' => $commentList
        ]);
    }
    public function addPost($id)
    {
        if(Auth::check()){
            $cateOld = $id;
            $cateList = Category::all();
            return view('addPost',[
                'cateList' => $cateList,
                'cateOld' => $cateOld
            ]);
        }else{
            return redirect(route('login'));
        }
    }
    public function addPostSuccess(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
        ]);
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category,
            'user_id' => Auth::user()->user_id
        ]);
        return redirect(route('home'));
    }

    public function editPost($id)
    {
        if(Auth::check()){
            $post = Post::with('category')->find($id);
            if(Auth::user()->user_id === $post->user->user_id){
            $cateList = Category::all();
                if(isset($post)){
                    $cateOld = $post->category->name;
                    return view('edit',[
                        'post' => $post,
                        'cateList' => $cateList,
                        'cateOld' => $cateOld
                    ]);
                }
            }
        }  
        else{
            return redirect(route('login'));
        } 
    }

    public function editPostSuccess($id,Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
        ]);
        $post = Post::find($id);
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category
        ]);
        return redirect(route('post',['id' => $id]));
    }

    public function deletePost($id)
    {
        if(Auth::check()){
            $post = Post::find($id);
            if(isset($post)){
                if(Auth::user()->user_id === $post->user->user_id){
                    Post::find($id)->delete();
                    Comment::where('post_id',$id)->delete();  
                }
            }
        }
        return redirect(route('home'));
    }

}
