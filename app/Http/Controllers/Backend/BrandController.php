<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::latest()->get();

        return view('backend.brand.brand', compact('brand'));
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
        $request->validate([
            'brand_name' => 'required|unique:brands,brand_name,except,id',
        ]);

        $data = [
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'created_by' => Auth::guard('admin')->user()->id,
            'created_at' => Carbon::now(),
        ]; // Added a semicolon here to end the array definition

        if ($request->file('brand_image')) {
            $data['brand_image'] = uploadAndResizeImage($request->file('brand_image'), 'upload/brand', 200, 60); // Fixed the function parameters
        }

        Brand::insert($data);

        return redirect()->back()->with(notification('Brand Add Successfully', 'success'));
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
            'brand_name' => 'required|unique:brands,brand_name,'.$id,
        ]);

        $data = [
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'updated_by' => Auth::guard('admin')->user()->id,
            'updated_at' => Carbon::now(),
        ]; // Added a semicolon here to end the array definition

        $brand = Brand::FindOrFail($id);

        if ($request->file('brand_image')) {
            @unlink($brand->brand_image);
            $data['brand_image'] = uploadAndResizeImage($request->file('brand_image'), 'upload/brand', 200, 60); // Fixed the function parameters
        }
        Brand::findOrFail($id)->update($data);

        return redirect()->back()->with(notification('Brand Update Successfully', 'success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $brand = Brand::findOrFail($id);
        foreach ($brand->products as $product) {
            $product->delete();
        }
        $img = $brand->brand_image;
        @unlink($img);
        Brand::findOrFail($id)->delete();

        return redirect()->back()->with(notification('Brand Delete Successfully', 'success'));
    }

    public function ActiveBrand($id)
    {
        Brand::where('id', '=', $id)->update(['status' => 1]);

        return redirect()->back()->with(notification('Brand Active Successfully', 'success'));
    }

    public function InactiveBrand($id)
    {
        Brand::where('id', '=', $id)->update(['status' => 0]);

        return redirect()->back()->with(notification('Brand Inactive Successfully', 'success'));
    }


}
