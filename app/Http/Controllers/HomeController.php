<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::where('is_approved',1)->where('status',1)->latest()->limit(13)->get();
        return view('welcome',compact('categories','posts'));
    }
    public function show($id){
        return $id;
    }
}
