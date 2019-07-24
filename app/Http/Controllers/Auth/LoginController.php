<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Ban;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminLoginForm;
class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        if(Auth::guard('admin')->check()){
            return redirect(route('home'));
        }else{
            return view('auth.login');
        }
    }
    
    public function login(AdminLoginForm $request)
    {
        $user = User::where('email',$request->email)->first();
        if(!$user){
            return redirect()->back()->withErrors(['email'=> 'ที่อยู่อีเมลไม่ถูกต้อง']);
        }
        if (Hash::check($request->password, $user->password)) {
            $ban = Ban::where('user_id',$user->user_id)->first();
            $now = Carbon::now();
            if($ban){
                return view('ban',[
                    'ban' => $ban,
                ]);
            }else{
                Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]);
                return redirect()->route('home');
            }
        }else{
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['password'=> 'รหัสผ่านไม่ถูกต้อง']);
        }
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
