<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostSearchController extends Controller
{
    public function search(Request $request){
       $query = $request->input('query');
       $posts = Post::where('title','LIKE',"%$query%")->approved()->status()->get();
       return view('post.search_posts',compact('posts','query'));
    }
}
