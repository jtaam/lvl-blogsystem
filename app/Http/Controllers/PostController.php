<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function details($slug)
    {
        $post = Post::where('slug', $slug)->first();
        // view count
        $blogKey = 'blog_'.$post->id;
        if (!Session::has($blogKey)){
            $post->increment('view_count');
            Session::put($blogKey,1);
        }
        $randomPosts = Post::all()->random(3);
        return view('post.post', compact('post', 'randomPosts'));
    }
}
