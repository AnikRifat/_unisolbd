<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();

        return view('backend.user.view_user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        //return $request;
        $userData = [
            'type' => $request->type,
            'name' => $request->name,
            'address' => $request->address,
            'details' => $request->details,
            'phone' => $request->phone,
            'opening_balance' => $request->opening_balance,
            'email' => $request->email,
            'nid' => $request->nid,
            'created_by' => Auth::guard('admin')->user()->id,
            'created_at' => Carbon::now(),
        ]; // Added a semicolon here to end the array definition

        if ($request->file('nid_front')) {
            $userData['nid_front'] = uploadAndResizeImage($request->file('nid_front'), 'upload/user/nid_front', 300, 300); // Fixed the function parameters
        }

        if ($request->file('nid_back')) {
            $userData['nid_back'] = uploadAndResizeImage($request->file('nid_back'), 'upload/user/nid_back', 300, 300); // Fixed the function parameters
        }

        User::insert($userData);

        if ($request->ajax()) {
            $users = User::where('type', $request->type)->latest()->get();

            return response()->json(['users' => $users, 'notification' => notification('User Added Successfully', 'success')]);
        } else {
            return redirect()->route('user.index')->with(notification('User Added Successfully', 'success'));
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
        $user = User::findOrFail($id);

        return view('backend.user.edit_user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userData = [
            'type' => $request->type,
            'name' => $request->name,
            'address' => $request->address,
            'details' => $request->details,
            'phone' => $request->phone,
            'opening_balance' => $request->opening_balance,
            'email' => $request->email,
            'nid' => $request->nid,
            'updated_by' => Auth::guard('admin')->user()->id,
            'updated_at' => Carbon::now(),
        ]; // Added a semicolon here to end the array definition
        $user = User::findOrFail($id);
        if ($request->file('nid_front')) {
            @unlink(public_path($user->nid_front));
            $userData['nid_front'] = uploadAndResizeImage($request->file('nid_front'), 'upload/user/nid_front', 300, 300); // Fixed the function parameters
        }

        if ($request->file('nid_back')) {
            @unlink(public_path($user->nid_back));
            $userData['nid_back'] = uploadAndResizeImage($request->file('nid_back'), 'upload/user/nid_back', 300, 300); // Fixed the function parameters
        }

        dd($userData);
        User::findOrFail($id)->update($userData);

        return redirect()->route('user.index')->with(notification('User Update Successfully', 'success'));
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
}
