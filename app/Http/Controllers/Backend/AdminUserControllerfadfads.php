<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminUserControllerfadfads extends Controller
{
    public function AllAdminRole()
    {
        $adminuser = Admin::where('type', 2)->latest()->get();

        return view('backend.role.admin_role_all', compact('adminuser'));
    }

    public function AddAdminRole()
    {
        return view('backend.role.admin_role_create');
    }

    public function StoreAdminRole(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'phone' => 'required',

        ]);

        $image = $request->file('profile_photo_path');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(225, 225)->save(public_path('upload/admin_images/'.$name_gen));
        $save_url = 'upload/admin_images/'.$name_gen;

        Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'profile_photo_path' => $save_url,
            'brand' => $request->brand,
            'category' => $request->category,
            'product' => $request->product,
            'slider' => $request->slider,
            'coupons' => $request->coupons,
            'shipping' => $request->shipping,
            'blog' => $request->blog,
            'setting' => $request->setting,
            'returnorder' => $request->returnorder,
            'review' => $request->review,
            'orders' => $request->orders,
            'stock' => $request->stock,
            'reports' => $request->reports,
            'alluser' => $request->alluser,
            'adminuserrole' => $request->adminuserrole,
            'type' => 2,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Admin User Create Successfully',
            'type' => 'success',
        ];

        return redirect()->route('all.admin.user')->with($notification);
    }

    public function EditAdminRole($id)
    {
        $adminuser = Admin::findOrFail($id);

        return view('backend.role.admin_role_edit', compact('adminuser'));
    }

    public function UpdateAdminRole(Request $request, $id)
    {
        $old_image = $request->old_image;

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',

        ]);

        if ($request->file('profile_photo_path')) {
            @unlink(public_path($old_image));
            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(225, 225)->save(public_path('upload/admin_images/'.$name_gen));
            $save_url = 'upload/admin_images/'.$name_gen;

            Admin::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'profile_photo_path' => $save_url,
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupons' => $request->coupons,
                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'review' => $request->review,
                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'alluser' => $request->alluser,
                'adminuserrole' => $request->adminuserrole,
                'type' => 2,
                'updated_at' => Carbon::now(),
            ]);

            $notification = [
                'message' => 'Admin User Update Successfully with profile picture',
                'type' => 'success',
            ];

            return redirect()->route('all.admin.user')->with($notification);
        } else {
            Admin::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupons' => $request->coupons,
                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'review' => $request->review,
                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'alluser' => $request->alluser,
                'adminuserrole' => $request->adminuserrole,
                'type' => 2,
                'updated_at' => Carbon::now(),
            ]);

            $notification = [
                'message' => 'Admin User Update Successfully',
                'type' => 'success',
            ];

            return redirect()->route('all.admin.user')->with($notification);
        }
    }

    public function DeleteAdminRole($id)
    {
        $adminuser = Admin::findOrFail($id);
        $image = $adminuser->profile_photo_path;
        @unlink($image);
        Admin::findOrFail($id)->delete();
        $notification = [
            'message' => 'Admin User Delete Successfully',
            'type' => 'info',
        ];

        return redirect()->back()->with($notification);

    }
}
