<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Specification;
use App\Models\SpecificationDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecificationDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specificationDetails = SpecificationDetail::with('category', 'specification')->latest()->get();

        return response()->json($specificationDetails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $specificationDetails = SpecificationDetail::with('category', 'specification')->latest()->get();
        $specifications = Specification::latest()->get();

        return view('backend.product.specification_details', compact('specifications', 'specificationDetails', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'specification_id' => 'required',
            'details' => 'required',
            'name' => 'required',
        ]);

        SpecificationDetail::insert([
            'category_id' => $request->category_id,
            'specification_id' => $request->specification_id,
            'name' => $request->name,
            'details' => $request->details,
            'created_at' => Carbon::now(),
            'created_by' => Auth::guard('admin')->user()->id,
        ]);

        return response()->json(notification('Specificaiton Details Save Successfully', 'success'));
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
            'specification_id' => 'required',
            'details' => 'required',
            'name' => 'required',
        ]);

        SpecificationDetail::findOrFail($id)->update([
            'category_id' => $request->category_id,
            'specification_id' => $request->specification_id,
            'name' => $request->name,
            'details' => $request->details,
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::guard('admin')->user()->id,
        ]);

        return response()->json(notification('Specificaiton Details Update Successfully', 'success'));
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

    public function ActiveSpecificationDetail($id)
    {
        SpecificationDetail::where('id', '=', $id)->update(['status' => 1]);

        return response()->json(notification('Specification Detail Active Successfully', 'success'));
    }

    public function InactiveSpecificationDetail($id)
    {
        SpecificationDetail::where('id', '=', $id)->update(['status' => 0]);

        return response()->json(notification('Specification Detail Inactive Successfully', 'success'));
    }
}
