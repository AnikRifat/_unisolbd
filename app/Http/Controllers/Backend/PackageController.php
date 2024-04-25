<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::orderBy('id', 'DESC')->get();

        return view('backend.package.package', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:packages,name,except,id',
        ]);
        Package::insert([
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'created_by' => Auth::guard('admin')->user()->id,
        ]);

        return redirect()->back()->with(notification('Package Save Successfully', 'success'));
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
        $request->validate([
            'name' => 'required|unique:packages,name,'.$id,
        ]);

        Package::findOrFail($id)->update([
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'created_by' => Auth::guard('admin')->user()->id,
        ]);

        return redirect()->back()->with(notification('Package Save Successfully', 'success'));
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

    public function ActivePackage($id)
    {
        Package::where('id', '=', $id)->update(['status' => 1]);

        return redirect()->back()->with(notification('Package Active Successfully', 'success'));
    }

    public function InactivePackage($id)
    {
        Package::where('id', '=', $id)->update(['status' => 0]);

        return redirect()->back()->with(notification('Package InActive Successfully', 'success'));
    }
}
