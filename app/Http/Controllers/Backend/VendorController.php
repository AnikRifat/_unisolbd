<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::get();
        return view('backend.vendor.view_vendor', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vendor.create_vendor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            "name" => 'required',
            "phone" => 'required',
        ]);


        //return $request;
        $vendorData = [
            "type" => $request->type,
            "name" => $request->name,
            "address" => $request->address,
            "details" => $request->details,
            "phone" => $request->phone,
            "opening_balance" => $request->opening_balance,
            "email" => $request->email,
            "nid" => $request->nid,
            "created_by" => Auth::guard('admin')->user()->id,
            "created_at" => Carbon::now()
        ]; // Added a semicolon here to end the array definition

        if ($request->file('nid_front')) {
            $vendorData['nid_front'] = uploadAndResizeImage($request->file('nid_front'), "upload/user/nid_front", 300, 300); // Fixed the function parameters
        }

        if ($request->file('nid_back')) {
            $vendorData['nid_back'] = uploadAndResizeImage($request->file('nid_back'), "upload/user/nid_back", 300, 300); // Fixed the function parameters
        }

        Vendor::insert($vendorData);

        if ($request->ajax()) {
            $vendors = Vendor::where('type',$request->type)->latest()->get();
            return response()->json(["vendors"=>$vendors,"notification"=>notification('Vendor Added Successfully', 'success')]);
        } else {
            return redirect()->route('vendor.index')->with(notification('Vendor Added Successfully', 'success'));
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
        $vendor = Vendor::findOrFail($id);
        return view('backend.vendor.edit_vendor', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vendorData = [
            "type" => $request->type,
            "name" => $request->name,
            "address" => $request->address,
            "details" => $request->details,
            "phone" => $request->phone,
            "opening_balance" => $request->opening_balance,
            "email" => $request->email,
            "nid" => $request->nid,
            "updated_by" => Auth::guard('admin')->user()->id,
            "updated_at" => Carbon::now()
        ]; // Added a semicolon here to end the array definition
        $vendor = Vendor::findOrFail($id);
        if ($request->file('nid_front')) {
            @unlink(public_path($vendor->nid_front));
            $vendorData['nid_front'] = uploadAndResizeImage($request->file('nid_front'), "upload/user/nid_front", 300, 300); // Fixed the function parameters
        }

        if ($request->file('nid_back')) {
            @unlink(public_path($vendor->nid_back));
            $vendorData['nid_back'] = uploadAndResizeImage($request->file('nid_back'), "upload/user/nid_back", 300, 300); // Fixed the function parameters
        }

        Vendor::findOrFail($id)->update($vendorData);
        return redirect()->route('vendor.index')->with(notification('Vendor Update Successfully', 'success'));
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
