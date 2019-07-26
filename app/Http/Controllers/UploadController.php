<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadForm;
use Illuminate\Support\Facades\Auth;
use App\Models\Upload;

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
        if ($request->hasFile('file')) {
            Upload::create([
                'name' => $request->file->getClientOriginalName(),
                'user_id' => Auth::user()->user_id
            ]);
            $request->file->storeAs(Auth::user()->user_id, $request->file->getClientOriginalName());
        }
        return redirect(route('upload'));
    }
}
