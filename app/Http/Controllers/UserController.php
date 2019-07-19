<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class UserController extends Controller
{
    public function __construct() 
    {
      $this->middleware('auth');
    }

    public function userPost()
    {
        $PostList = Post::where('user_id',(Auth::user()->user_id))
        ->paginate(10);
        return view('userPost',[
            'PostList' => $PostList
        ]);
    }
    public function userComment()
    {
        $commentList = Comment::where('user_id',(Auth::user()->user_id))
        ->paginate(10);
        return view('userComment',[
            'commentList' => $commentList
        ]);
    }
    public function userEditEmail()
    {
        $user = User::find(Auth::user()->user_id);
        return view('userEditEmail',[
            'user' => $user
        ]);
    }
    public function userEditEmailSuccess(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::find(Auth::user()->user_id);
        if (Hash::check($request->password, $user->password)) {
            if(User::where('email',$request->email)->count() === 0){
                $user->update([
                    'email' => $request->email
                ]);
            }else{
                return redirect()->back()->withInput()->withErrors(['email_replace'=> 'ที่อยู่อีเมลนี้ ถูกใช้งานไปแล้ว']);
            }
        }else{
            return redirect()->back()->withInput()->withErrors(['password_wrong'=> 'รหัสผ่านไม่ถูกต้อง']);
        }
        return redirect(route('userData',['id' => Auth::user()->user_id]));
    }

    public function userEditPassword()
    {
        $user = User::find(Auth::user()->user_id);
        return view('userEditPassword',[
            'user' => $user
        ]);
    }

    public function userEditPasswordSuccess(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8',
            'confirmpassword' => 'required|same:newpassword|min:8',
        ]);

        $user = User::find(Auth::user()->user_id);
        if (Hash::check($request->oldpassword, $user->password)) {
            User::where('user_id',Auth::user()->user_id)
            ->update([
            'password' => Hash::make($request->newpassword)
            ]);
        }else{
            return redirect()->back()->withInput()->withErrors(['password_wrong'=> 'รหัสผ่านไม่ถูกต้อง']);
        }

        return redirect(route('userData',['id' => Auth::user()->user_id]));
    }
}
