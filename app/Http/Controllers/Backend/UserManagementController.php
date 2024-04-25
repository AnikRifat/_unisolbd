<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use App\Models\UserRole;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::with('userRoles.role')->latest()->get();
        $roles = Role::latest()->get();

        return view('backend.administration.user_management', compact('admins', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request;
        // Validate the input
        $request->validate([
            'name' => 'required|unique:admins,name,except,id',
            // "email" => "required|unique:admins,email,except,id",
            // "phone" => "required",
            // "password" => "required",
        ]);

        $faker = Faker::create();

        // Create the admin user
        $admin = Admin::create([
            'name' => $request->input('name'),
            'email' => $request->filled('email') ? $request->input('email') : $faker->email(),
            'phone' => $request->filled('phone') ? $request->input('phone') : $faker->phoneNumber(),
            'type' => $request->filled('type') ? $request->input('type') : 'Normal User', // Provide a default value if 'type' is not filled
            'password' => $request->filled('password') ? bcrypt($request->input('password')) : bcrypt('password@987654321'),
            'created_at' => now(),
            'created_by' => Auth::guard('admin')->user()->id,
        ]);

        // Associate the selected roles with the admin user
        if ($request->has('roles')) {
            foreach ($request->input('roles') as $role) {
                UserRole::create([
                    'user_id' => $admin->id, // Assuming the user ID is in the 'id' field
                    'role_id' => $role,
                    'created_by' => Auth::guard('admin')->user()->id,
                    'created_at' => now(),
                ]);
            }
        }

        if ($request->ajax()) {
            return response()->json(['salePerson' => $admin, 'notification' => notification('User Created Successfully', 'success')]);
        } else {
            return redirect()->back()->with(notification('User Created Successfully', 'success'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ActiveUser($id)
    {
        Admin::where('id', '=', $id)->update(['status' => 1]);

        return redirect()->back()->with(notification('User Active Successfully', 'success'));
    }

    public function InactiveUser($id)
    {
        Admin::where('id', '=', $id)->update(['status' => 0]);

        return redirect()->back()->with(notification('User Inactive Successfully', 'success'));
    }
}
