<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\PostForm;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Ban;
use App\Models\Like;
use App\Models\Upload;
use DataTables;


class PostController extends Controller
{
    public function user($id)
    {
        $banList = Ban::with('admin')->withTrashed()->where('user_id',$id)->get();
        $admin = Auth::guard('admin')->check();
        $user = User::with(['post','comment'])->withCount(['post','comment'])->find($id);
        return view('user',[
            'user' => $user,
            'admin' => $admin,
            'banList' => $banList
        ]);
    }

    public function getCategory(Request $request){
        $post = Post::where('category_id',$request->id)
        ->with('comment', 'user')
        ->withCount('comment');
        return DataTables::eloquent($post)
        ->only(['title','user_name','comments_num','time_create'])
        ->addColumn('user_name', function($row){
            return $row->user->name;
        })
        ->editColumn('user_name', function ($row) {
            return '<a href="' . route('userData', ['id' => $row->user_id]) . '">'.$row->user->name.'</a>';
        })
        ->editColumn('title', function ($row) {
            return '<a href="' . route('post', ['id' => $row->post_id]) . '">'.(str_limit($row->title,20)).'</a>';
        })
        ->addColumn('comments_num', function($row){
            return $row->comment_count;
        })
        ->addColumn('time_create', function ($row) {
            return $row->time_create;
        })
        ->filterColumn('user_name', function ($query, $keyword) {
            $query->whereHas('user', function ($query1) use ($keyword) {
                $query1->where('users.name', 'like', '%' . $keyword . '%');
            });
        })
        // ->filterColumn('time_create', function ($query, $keyword) {
        //     $query->whereHas('user', function ($query1) use ($keyword) {
        //         $query1->where('users.name', 'like', '%' . $keyword . '%');
        //     });
        // })
        // ->filterColumn('comments_num', function ($query, $keyword) {
        //     $query->whereHas('comment', function ($query1) use ($keyword) {
        //         $query1->where(\DB::raw('count(comments.comment_id)'), 'like', '%' . $keyword . '%');
        //     });
        // })
        ->rawColumns(['user_name','title'])
        ->make(true);
    }

    public function postByCate($id)
    {

        $category = Category::find($id);
        return view('category',['category' => $category]);
    }

    public function index($id)
    {
        $likePost = null;
        $likeComment = null;
        $user_id = null;
        if(Auth::guard('web')->check()){
            $user_id = Auth::guard('web')->user()->user_id;
            $likePost = Like::where('user_id', $user_id)
                ->where('likeable_type', 'post')
                ->where('likeable_id', $id)
                ->first();
            $likeComment = Like::where('user_id', $user_id)
                ->where('likeable_type', 'comment')
                ->get();        
        }
        $post = Post::with('user','like','like.user')->withCount('like')->find($id);
        $commentList = Comment::with(['like' => function($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }, 'user.post', 'user.comment','upload','user' => function($query){$query->withCount('post','comment');}])
        ->withCount('like')
        ->where('post_id', $id)
        ->paginate(5);
        return view('post',[
            'likePost' => $likePost,
            'likeComment' => $likeComment,
            'post' => $post,
            'commentList' => $commentList,
            'admin' => Auth::guard('admin')->check()
        ]);
    }

    public function addPost($id)
    {
        if(Auth::guard('web')->check()){
            $cateOld = $id;
            $cateList = Category::all();
            $imageList = Upload::where('user_id',Auth::user()->user_id)->latest()->get();
            return view('addPost',[
                'imageList' => $imageList,
                'cateList' => $cateList,
                'cateOld' => $cateOld
            ]);
        }else{
            return redirect(route('login'));
        }
    }
    public function addPostSuccess(PostForm $request)
    {
        $post=Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category,
            'user_id' => Auth::user()->user_id
        ]);
        $post->upload()->sync($request->image);
        return redirect(route('home'));
    }

    public function editPost($id)
    {
        if(Auth::guard('web')->check()){
            $post = Post::with('category')->find($id);
            if(isset($post)){
                $user_id = Auth::user()->user_id;
                if($user_id === $post->user->user_id){
                $cateList = Category::all();
                $imageList = Upload::where('user_id',$user_id)->latest()->get();
                $imageUpload = $post->upload->pluck('post_id', 'upload_id');
                    if(isset($post)){
                        $cateOld = $post->category->name;
                        return view('edit',[
                            'post' => $post,
                            'cateList' => $cateList,
                            'cateOld' => $cateOld,
                            'imageList' => $imageList,
                            'imageUpload' => $imageUpload
                        ]);
                    }
                }
            }else{
                return redirect(route('home')); 
            }
        }  
        else{
            return redirect(route('login'));
        } 
    }

    public function editPostSuccess($id,PostForm $request)
    {
        $post = Post::find($id);
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category
        ]);
        $post->upload()->sync($request->image);
        return redirect(route('post',['id' => $id]));
    }

    public function deletePost($id)
    {
        if(Auth::guard('web')->check()){
            $post = Post::find($id);
            if(isset($post)){
                if(Auth::user()->user_id === $post->user->user_id){
                    Post::find($id)->delete();
                    Comment::where('post_id',$id)->delete();  
                    $post->upload()->detach();
                }
            }
        }
        return redirect(route('home'));
    }

    public function  deletePostByadmin($id){
        if(Auth::guard('admin')->check()){
          $post = Post::find($id);
          if(isset($post)){    
            Post::find($id)->delete();
            Comment::where('post_id',$id)->delete();  
            $post->upload()->detach();
          }
        }
        return redirect(route('home'));
      }
  
    public function  deleteCommentByadmin($id){
        if(Auth::guard('admin')->check()){
          $comment = Comment::find($id);
          if(isset($comment)){    
            Comment::find($id)->delete();
            $comment->upload()->detach();
          }
        }
        return redirect()->back();
    }

}
