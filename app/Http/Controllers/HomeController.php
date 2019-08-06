<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $postList = Post::with(['category','comment','user'])->limit(10)->latest()->get();
        $cateList = Category::with(['lastpost', 'lastpost.user','comments','post'])->get();
        return view('home',[
            'postList' => $postList,
            'cateList' => $cateList,
        ]);
    }
}
