<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Cloudinary;
use Cloudinary\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => 'required|unique:categories',
            'image' => 'required|max:10240|mimes:jpeg,jpg,png,gif'
        ]);
        // get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);
        if (isset($image)) {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();

            // LOCAL ENV
            if (config('app.env') == 'local'){
                $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // check category directory existence
             if (!Storage::disk('public')->exists('category')) {
                 Storage::disk('public')->makeDirectory('category');
                }
             // resize image for category
                $category_img = Image::make($image)->resize(1600, 479)->save();
             // save/upload image to directory
                Storage::disk('public')->put('category/' . $imagename, $category_img);
            }

            // PRODUCTION ENV
            if (config('app.env') == 'production'){
                $imagename = $slug . '-' . $currentDate . '-' . uniqid();

                // cloudinary
                Cloudinary::config(array(
                    "cloud_name" => "jtam",
                    "api_key" => "846885957655443",
                    "api_secret" => "A9_WUm6Z6EgxaATJ5gtZ9T95HJw"
                ));
                $cloudinary_data = null;
                $cloudinary_data = Cloudinary\Uploader::upload($request->image,
                    array(
                        "folder" => "laravel/blogsystem/category/",
                        "public_id" => $imagename,
                        "width" => 1600,
                        "height" => 479,
                        "overwrite" => TRUE,
                        "resource_type" => "image")
                );
            }

        } else {
            $imagename = 'default.png';
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;

        if (config('app.env') == 'local') {
            $category->image = $imagename;
        }
        if (config('app.env') == 'production'){
            $category->image = $cloudinary_data['secure_url'];
            $category->public_id = $cloudinary_data['public_id'];
        }

        $category->save();

        Toastr::success('Category saved successfully!', 'Done');

        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif'
        ]);
        // get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);

        $category = Category::findOrFail($id);

        if (isset($image)) {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            // LOCAL ENV
            if (config('app.env') == 'local') {
                $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                // check category directory existence
                if (!Storage::disk('public')->exists('category')) {
                    Storage::disk('public')->makeDirectory('category');
                    }
                // delete old image
                if (Storage::disk('public')->exists('category/' . $category->image)){
                    Storage::disk('public')->delete('category/'. $category->image);
                    }
                // resize image for category
                $category_img = Image::make($image)->resize(1600, 479)->save();

                // save/upload image to directory
                 Storage::disk('public')->put('category/' . $imagename,$category_img);
                }

            // PRODUCTION ENV
            if (config('app.env') == 'production'){
                $imagename = $slug . '-' . $currentDate . '-' . uniqid();

                // cloudinary
                Cloudinary::config(array(
                    "cloud_name" => "jtam",
                    "api_key" => "846885957655443",
                    "api_secret" => "A9_WUm6Z6EgxaATJ5gtZ9T95HJw"
                ));

                if (Cloudinary\Uploader::destroy($category->public_id)){
                    $cloudinary_data = null;
                    $cloudinary_data = Cloudinary\Uploader::upload($request->image,
                        array(
                            "folder" => "laravel/blogsystem/category/",
                            "public_id" => $imagename,
                            "width" => 1600,
                            "height" => 479,
                            "overwrite" => TRUE,
                            "resource_type" => "image")
                    );
                }else{

                Toastr::error('Category update failed!', 'Error');

                return redirect()->route('admin.category.index');
                }

            } else {
                $imagename = $category->image;
            }
        }

        $category->name = $request->name;
        $category->slug = $slug;
        if (config('app.env') == 'local') {
            $category->image = $imagename;
        }
        if (config('app.env') == 'production'){
            $category->image = $cloudinary_data['secure_url'];
            $category->public_id = $cloudinary_data['public_id'];
        }

        $category->update();

        Toastr::success('Category updated successfully!', 'Done');

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // LOCAL ENV
        if (config('app.env') == 'local') {
            if (Storage::disk('public')->exists('category/', $category->image)){
                Storage::disk('public')->delete('category/'.$category->image);
            }
        }
        // PRODUCTION ENV
        if (config('app.env') == 'production'){
            // cloudinary
            Cloudinary::config(array(
                "cloud_name" => "jtam",
                "api_key" => "846885957655443",
                "api_secret" => "A9_WUm6Z6EgxaATJ5gtZ9T95HJw"
            ));
            Cloudinary\Uploader::destroy($category->public_id);
        }

        $category->delete();

        Toastr::success('Category deleted successfully!', 'Done');

        return redirect()->back();
    }
}
