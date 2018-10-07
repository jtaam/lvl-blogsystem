<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.settings');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|image'
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $user = User::findOrFail(Auth::id());

        if (isset($image)) {
            $carrentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $carrentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('profile')) {
                Storage::disk('public')->makeDirectory('profile');
            }
            // delete old image if exists
            if (Storage::disk('public')->exists('profile/' . $user->image)) {
                Storage::disk('public')->delete('profile/' . $user->image);
            }
            $profile = Image::make($image)->resize(500, 500)->save();
            Storage::disk('public')->put('profile/' . $imageName, $profile);
        } else {
            $imageName = $user->image;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->about = $request->about;
        $user->save();

        Toastr::success('Profile updated successfully!', 'Success');

        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        // store present password in hashedPassword
        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashedPassword)) { // check old and new password match
            if (!Hash::check($request->password, $hashedPassword)){ // if not old password matches new password
                $user=User::find(Auth::id());
                $user->password=Hash::make($request->password);
                $user->save();
                Toastr::success('Your password has been successfully saved! Auto logout...','Success');
                Auth::logout();
                return redirect()->back();
            }else{
                Toastr::error('New password is same as old password','Error');
                return redirect()->back();
            }
        }else{
            Toastr::error('Old password is not currect','Error');
            return redirect()->back();
        }
    }
}
