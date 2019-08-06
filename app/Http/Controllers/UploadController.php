<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadForm;
use Illuminate\Support\Facades\Auth;
use App\Models\Upload;
use Illuminate\Support\Facades\Hash;

class UploadController extends Controller
{
    public function __construct() 
    {
      $this->middleware('auth');
    }

    public function upload(){
        return view('upload');
    }

    public function uploadSuccess(UploadForm $request){
        $fileGroup = $request->file;
        foreach ($fileGroup as $key => $value) {
                Upload::create([
                    'name' => $value->hashName(),
                    'user_id' => Auth::user()->user_id
                ]);
                $value->storeAs(Auth::user()->user_id,$value->hashName());
        }
        return redirect()->back();
    }
}
