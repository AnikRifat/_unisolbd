<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::latest()->get();
        return view('backend.unit.unit',compact('units'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:units,name,except,id'
        ]);

        Unit::create([
            'name' => $request->name,
            "created_by" => Auth::guard('admin')->user()->id,
            "created_at" => Carbon::now()
        ]);

        return redirect()->back()->with(notification('Unit Save Successfully', 'success'));
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:units,name,' . $id
        ]);

        Unit::findOrFail($id)->update([
            'name' => $request->name,
            "updated_by" => Auth::guard('admin')->user()->id,
            "updated_at" => Carbon::now()
        ]);

        return redirect()->back()->with(notification('Unit Update Successfully', 'success'));
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

    public function ActiveUnit($id)
    {
        Unit::where('id', '=', $id)->update(['status' => 1]);
        return redirect()->back()->with(notification('Unit Active Successfully', 'success'));
    }

    public function InactiveUnit($id)
    {
        Unit::where('id', '=', $id)->update(['status' => 0]);
        return redirect()->back()->with(notification('Unit Inactive Successfully', 'success'));
    }
}
