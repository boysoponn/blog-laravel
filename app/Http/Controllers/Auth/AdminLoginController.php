<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginForm;
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
    protected $redirectTo = '/';

    public function __construct() 
    {
      $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        if(Auth::guard('web')->check()){
            return redirect(route('home'));
        }else{
            return view('auth.loginAdmin');
        }
    }

    public function login(AdminLoginForm $request)
    {
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->route('home');
        }
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
