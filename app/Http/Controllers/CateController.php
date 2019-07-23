<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Http\Requests\CateForm;

class CateController extends Controller
{
    public function __construct() 
    {
      $this->middleware('auth:admin');
    }
    
    public function cate()
    {
        $cateList = Category::withTrashed()->get();
        return view('cateList',[
            'cateList' => $cateList
        ]);
    }
    public function cateAdd(CateForm $request)
    {    
        Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return redirect(route('cate'));
    }
    
    public function cateDelete($id)
    {
        $cate = Category::withTrashed()->where('category_id', $id);
        $cate->restore();
        $cate->forceDelete();
        return redirect(route('cate'));
    }

    public function cateHidden($id)
    {
        $cate = Category::find($id);
        $cate->delete();
        return redirect(route('cate'));
    }

    public function cateShow($id)
    {
        Category::withTrashed()
        ->where('category_id', $id)
        ->restore();
        return redirect(route('cate'));
    }

    public function cateEdit($id)
    {
        $cate = Category::find($id);
            if(isset($cate)){
                return view('cateEdit',[
                    'cate' => $cate,
                ]);
            }
        return redirect(route('cate'));
    }

    public function cateEditSuccess($id,CateForm $request)
    {
        $cate = Category::find($id);
        if(isset($cate)){
            $cate->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return redirect(route('cate'));
        }
        return redirect(route('cate')); 
    }

}
