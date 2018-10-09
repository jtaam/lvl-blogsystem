<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->approved()->status()->paginate(12);
        $randomCategory = Category::all()->random(1);
        return view('post.posts',compact('posts','randomCategory'));
    }

    public function details($slug)
    {
        $post = Post::where('slug', $slug)->approved()->status()->first();
        // view count
        $blogKey = 'blog_'.$post->id;
        if (!Session::has($blogKey)){
            $post->increment('view_count');
            Session::put($blogKey,1);
        }
        $randomPosts = Post::approved()->status()->take(3)->inRandomOrder()->get();
        return view('post.post', compact('post', 'randomPosts'));
    }

    public function postByCategory($slug){
        $category = Category::where('slug',$slug)->first();
        $posts = $category->posts()->approved()->status()->get();
        return view('post.category_posts', compact('category','posts'));
    }

    public function postByTag($slug){
        $tag = Tag::where('slug',$slug)->first();
        $posts = $tag->posts()->approved()->status()->get();
        return view('post.tag_posts',compact('tag','posts'));
    }
}
