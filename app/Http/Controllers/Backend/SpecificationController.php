<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Specification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specification = Specification::latest()->get();
        return view('backend.product.specification', compact('specification'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required|unique:specifications,name,except,id',
        ]);

        Specification::insert([
            'name' => $request->name,
            'filter' => $request->filter,
            'created_at' => Carbon::now(),
            'created_by' => Auth::guard('admin')->user()->id,
        ]);
        return redirect()->back()->with(notification('Product Specificaiton Save Successfully','success'));
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
            'name' => 'required|unique:specifications,name,' . $id
        ]);
        
        Specification::findOrFail($id)->update([
            'name' => $request->name,
            'filter' => $request->filter,
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::guard('admin')->user()->id,
        ]);
        return redirect()->back()->with(notification('Product Specificaiton Update Successfully','success'));
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

    public function ActiveSpecification($id)
    {
        Specification::where('id','=',$id)->update(['status' => 1]);
        return redirect()->back()->with(notification('Specification Active Successfully','success'));
    }

    public function InactiveSpecification($id)
    {
        Specification::where('id','=',$id)->update(['status' => 0]);
        return redirect()->back()->with(notification('Specification Inactive Successfully','success'));
    }

}
