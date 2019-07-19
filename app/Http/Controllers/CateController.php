<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CateController extends Controller
{
    public function __construct() 
    {
      $this->middleware('auth');
    }
    
    public function cate()
    {
        $cateList = Category::with('post')
        ->get();
        return view('cateList',[
            'cateList' => $cateList
        ]);
    }
    public function cateAdd(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);   
        Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return redirect(route('cate'));
    }
    public function cateDelete($id)
    {
        Category::find($id)->delete();
        Post::where('category_id',$id)->delete();
        return redirect(route('cate'));
    }
}
