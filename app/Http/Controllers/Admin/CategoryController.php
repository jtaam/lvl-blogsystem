<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
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
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            check category directory existence
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }
            // resize image for category
            $category_img = Image::make($image)->resize(1600, 479)->save();
            // save/upload image to directory
            Storage::disk('public')->put('category/' . $imagename, $category_img);

            //            check category sliders directory existence
            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk('public')->makeDirectory('category/slider');
            }
            // resize image for category slider
            $slider_img = Image::make($image)->resize(500, 333)->save();
            // save/upload image to slider directory
            Storage::disk('public')->put('category/slider/' . $imagename, $slider_img);
        } else {
            $imagename = 'default.png';
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imagename;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        Toastr::success('Category deleted successfully!', 'Done');
        return redirect()->back();
    }
}
