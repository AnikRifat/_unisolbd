<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();

        return view('backend.administration.role', compact('roles'));

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
        // Validate the request data
        $request->validate([
            'name' => 'required|unique:roles,name,except,id',
        ]);

        // Insert the data into the database
        Role::insert([
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'created_by' => Auth::guard('admin')->user()->id,
        ]);

        // Create a notification message
        $notification = [
            'message' => 'Role Add Successfully',
            'type' => 'success',
        ];

        // Redirect back with the notification message
        return redirect()->back()->with($notification);
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
        // Validate the request data
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id,
        ]);

        Role::findOrFail($id)->update([
            'name' => $request->name,
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::guard('admin')->user()->id,
        ]);

        // Create a notification message
        $notification = [
            'message' => 'Role Update Successfully',
            'type' => 'success',
        ];

        // Redirect back with the notification message
        return redirect()->back()->with($notification);

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

    public function ActiveRole($id)
    {
        Role::where('id', '=', $id)->update(['status' => 1]);

        return redirect()->back()->with(notification('Role Active Successfully', 'success'));
    }

    public function InactiveRole($id)
    {
        Role::where('id', '=', $id)->update(['status' => 0]);

        return redirect()->back()->with(notification('Role Inactive Successfully', 'success'));
    }
}
