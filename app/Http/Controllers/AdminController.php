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

    public function index(){
        return redirect(route('home'));
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
        'cancel_at' => Carbon::now()->addDays($request->day),
        'description' => $request->description,
      ]);
    return redirect(route('userData',['id' => $id]));
    }
}
