<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminProfileController extends Controller
{
    public function AdminProfile()
    {

        $adminData = Admin::find(Auth::id());

        return view('admin.admin_profile_view', compact('adminData'));

    }

    public function AdminProfileEdit()
    {

        $editData = Admin::find(Auth::id());

        return view('admin.admin_profile_edit', compact('editData'));

    }

    public function AdminProfileStore(Request $request)
    {
        if ($request->file('profile_photo_path')) {
            @unlink(public_path($request->old_image));
            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(225, 225)->save(public_path('upload/admin_images/'.$name_gen));
            $save_url = 'upload/admin_images/'.$name_gen;

            Admin::findOrFail(Auth::id())->update([
                'name' => $request->name,
                'email' => $request->email,
                'profile_photo_path' => $save_url,
            ]);

            return redirect()->route('admin.profile');

        } else {
            Admin::findOrFail(Auth::id())->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return redirect()->route('admin.profile');
        }

    }

    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');

    }

    public function AdminUpdateChangePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Admin::find(Auth::id())->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = Admin::find(Auth::id());
            $admin->password = Hash::make($request->password);
            $admin->save();

            return redirect()->route('admin.profile');
        }

    }
}
