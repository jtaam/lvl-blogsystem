<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Admin\Settings\CloudinarySettings;
use App\Notifications\AuthorPostApproved;
use App\Notifications\NewPostSubscriber;
use App\Post;
use App\Subscriber;
use App\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Cloudinary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $settings = new CloudinarySettings;
        $settings->setup_cloudinary();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required'
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)) {
//            make unique name image
            $currentDate = Carbon::now()->toDateString();

            // PRODUCTION ENV
           if (config('app.env') == 'production') {
//            if (config('app.env') == 'local') {
                $imageName = $slug . '-' . $currentDate . '' . uniqid();

                // cloudinary
                $cloudinary_data = null;
                $cloudinary_data = Cloudinary\Uploader::upload($request->image,
                    array(
                        "folder" => "laravel/blogsystem/post/",
                        "public_id" => $imageName,
                        "width" => 1600,
                        "height" => 1066,
                        "overwrite" => TRUE,
                        "resource_type" => "image")
                );
            }
            // LOCAL ENV
//            if (config('app.env') == 'production') {
            if (config('app.env') == 'local'){
                $imageName = $slug . '-' . $currentDate . '' . uniqid() . '-' . $image->getClientOriginalExtension();

                if (!Storage::disk('public')->exists('post')) {
                    Storage::disk('public')->makeDirectory('post');
                }
                $resizeImage = Image::make($image)->resize(1600, 1066)->save();
                Storage::disk('public')->put('post/' . $imageName, $resizeImage);
            }

        } else {
            $imageName = 'default.png';
        }
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->post_promo = $request->post_promo;

        if (config('app.env') == 'local') {
            $post->image = $imageName;
        }
        if (config('app.env') == 'production') {
            $post->image = $cloudinary_data['secure_url'];
            $post->public_id = $cloudinary_data['public_id'];
        }

        $post->body = $request->body;
        if (isset($request->status)) {
            $post->status = true;
        } else {
            $post->status = false;
        }
        $post->is_approved = true;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber) {
            Notification::route('mail', $subscriber->email)
                ->notify(new NewPostSubscriber($post));
        }

        Toastr::success('Post saved successfully!');

        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'image',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required'
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)) {
//            make unique name image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }
//            delete old posts image
            if (Storage::disk('public')->exists('post/' . $post->image)) {
                Storage::disk('public')->delete('post/' . $post->image);
            }
//            delete old posts image
            $resizeImage = Image::make($image)->resize(1600, 1066)->save();
            Storage::disk('public')->put('post/' . $imageName, $resizeImage);
        } else {
            $imageName = $post->image;
        }

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->post_promo = $request->post_promo;
        $post->image = $imageName;
        $post->body = $request->body;
        if (isset($request->status)) {
            $post->status = true;
        } else {
            $post->status = false;
        }
        $post->is_approved = true;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Post updated successfully!');

        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Storage::disk('public')->exists('post/' . $post->image)) {
            Storage::disk('public')->delete('post/' . $post->image);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();

        Toastr::success('Post deleted successfully!');

        return redirect()->route('admin.post.index');
    }

    public function pending()
    {
        $posts = Post::where('is_approved', false)->get();
        return view('admin.post.pending', compact('posts'));
    }

    public function approval($id)
    {
        $post = Post::find($id);
        if ($post->is_approved == false) {
            $post->is_approved = true;
            $post->save();

            $post->user->notify(new AuthorPostApproved($post));

            $subscribers = Subscriber::all();
            foreach ($subscribers as $subscriber) {
                Notification::route('mail', $subscriber->email)
                    ->notify(new NewPostSubscriber($post));
            }

            Toastr::success('Post approved succesfully!', 'Done');
        } else {
            Toastr::info('This post is already approved!', 'Info');
        }
        return redirect()->back();
    }

}
