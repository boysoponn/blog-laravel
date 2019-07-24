<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Ban;
use Illuminate\Http\Request;
use App\Http\Requests\BanForm;

class AdminController extends Controller
{
    public function __construct() 
    {
      $this->middleware('auth:admin');
    }

    public function adminBan($id){
      $user = User::find($id);
      return view('adminBan',[
        'user' => $user
      ]);
    }

    public function adminBanSuccess($id, BanForm $request){
      Ban::create([
        'user_id' => $id,
        'admin_id' => Auth::guard('admin')->user()->admin_id,
        'cancel_at' => Carbon::now()->addDays($request->time),
        'description' => $request->description,
        'time' => $request->time
      ]);
    return redirect(route('userData',['id' => $id]));
    }

    public function adminBanCancel($id){
    $ban = Ban::find($id);
    if($ban){
      $ban->delete();
    }
    return redirect()->back();
    }

    public function adminUser(){
      $banList = Ban::with('user','admin')->get();
        return view('adminUser',[
            'banList' => $banList
        ]);
      }
}
