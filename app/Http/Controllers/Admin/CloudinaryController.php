<?php

namespace App\Http\Controllers\Admin;

use App\Cloudinary;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CloudinaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cloudinary = Cloudinary::all()->first();
        return view('admin.cloudinary.index', compact('cloudinary'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cloudinary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'cloud_name'=>'required',
            'api_key'=>'required',
            'api_secret'=>'required',
            'media_url'=>'required|url'
        ]);

        $cloudinary = new Cloudinary();
        $cloudinary->cloud_name = $request->cloud_name;
        $cloudinary->api_key = $request->api_key;
        $cloudinary->api_secret = $request->api_secret;
        $cloudinary->media_url = $request->media_url;
        $cloudinary->save();

        Toastr::success('Cloudinary Settings saved successfully!','Done');

        return redirect()->route('admin.cloudinary.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cloudinary  $cloudinary
     * @return \Illuminate\Http\Response
     */
    public function show(Cloudinary $cloudinary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cloudinary  $cloudinary
     * @return \Illuminate\Http\Response
     */
    public function edit(Cloudinary $cloudinary)
    {
        return view('admin.cloudinary.edit',compact('cloudinary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cloudinary  $cloudinary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'cloud_name'=>'required',
            'api_key'=>'required',
            'api_secret'=>'required',
            'media_url'=>'required|url'
        ]);

        $cloudinary = Cloudinary::findOrFail($id);

        $cloudinary->cloud_name = $request->cloud_name;
        $cloudinary->api_key = $request->api_key;
        $cloudinary->api_secret = $request->api_secret;
        $cloudinary->media_url = $request->media_url;

        $cloudinary->update();

        Toastr::success('Cloudinary Settings Updated Successfully!','Done');

        return redirect()->route('admin.cloudinary.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cloudinary  $cloudinary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cloudinary $cloudinary)
    {
        //
    }
}
