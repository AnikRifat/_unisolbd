<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use App\Models\PackageItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //return $request;

        $requestData = json_decode($request->getContent(), true);
        $packageItems = $requestData['packageItems'];
        $packageId = $requestData['package_id'];

        // Delete all existing role permissions for the given role ID
        PackageItem::where('package_id', $packageId)->delete();

        foreach ($packageItems as $data) {
            PackageItem::create([
                'package_id' => $packageId,
                'category_id' => $data['category_id'],
                'subcategory_id' => $data['subcategory_id'],
                'subcategory_id' => $data['subcategory_id'],
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => Carbon::now(),
            ]);
        }

        return response()->json(notification('successfully insert package item', 'success'));
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
        $package = Package::findOrFail($id);
        $packageItems = PackageItem::where('package_id', $id)->get();
        $categories = Category::with('subcategory', 'subsubcategory')->orderBy('id', 'asc')->get();

        return view('backend.package.package_items', compact('package', 'packageItems', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
