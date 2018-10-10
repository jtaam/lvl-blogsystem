<?php

namespace App\Http\Controllers\Admin;


use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function index(){
        $authors = User::authors()
            ->withCount('posts')
            ->withCount('favorite_posts')
            ->withCount('comments')
            ->get();
        return view('admin.authors.index',compact('authors'));
    }

    public function create(){
        return view('admin.authors.create');
    }

    public function store(Request $request){
        return dd($request->all());
    }

    public function destroy($id){
        User::findOrFail($id)->delete();
        Toastr::success('Author deleted successfully.','Success!');
        return redirect()->back();
    }
}
