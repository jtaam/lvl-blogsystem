<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function details($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $randomPosts = Post::all()->random(3);
        return view('post.post', compact('post', 'randomPosts'));
    }
}
