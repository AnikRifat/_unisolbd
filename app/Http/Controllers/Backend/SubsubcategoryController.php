<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SubsubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $Subsubcategories=SubSubCategory::with('category','subcategory')->latest()->get();
        return response()->json($Subsubcategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::where('status',1)->orderBy('category_name',"ASC")->get();
        $subcategories = SubCategory::where('status',1)->latest()->get();
        $Subsubcategories=SubSubCategory::with('category','subcategory')->latest()->get();
        return view('backend.categories.subsubcategory',compact('Subsubcategories','categories','subcategories'));
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
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name' => [
                'required',
                Rule::unique('sub_sub_categories', 'subsubcategory_name')
                    ->where(function ($query) use ($request) {
                        return $query->where('category_id', $request->category_id)
                            ->where('subcategory_id', $request->subcategory_id);
                    })
            ]
        ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name' => $request->subsubcategory_name,
            'subsubcategory_slug' =>strtolower(str_replace(' ','-',$request->subsubcategory_name)),
            "created_by" => Auth::guard('admin')->user()->id,
            "created_at" => Carbon::now()
         ]);

         return response()->json(notification('Sub-subcategory Save Successfully', 'success'));
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
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name' => [
                'required',
                Rule::unique('sub_sub_categories', 'subsubcategory_name')
                    ->where(function ($query) use ($request) {
                        return $query->where('category_id', $request->category_id)
                            ->where('subcategory_id', $request->subcategory_id);
                    })->ignore($id, 'id')
            ]
        ]);

        SubSubCategory::findOrFail($id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name' => $request->subsubcategory_name,
            'subsubcategory_slug' =>strtolower(str_replace(' ','-',$request->subsubcategory_name)),
            "updated_by" => Auth::guard('admin')->user()->id,
            "updated_at" => Carbon::now()
         ]);

         return response()->json(notification('Sub-subcategory Update Successfully', 'success'));
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
    public function ActiveSubsubcategory($id)
    {
        SubSubCategory::where('id', '=', $id)->update(['status' => 1]);
        return response()->json(notification('Sub-subcategory Active Successfully', 'success'));
    }

    public function InactiveSubsubcategory($id)
    {
        SubSubCategory::where('id', '=', $id)->update(['status' => 0]);
        return response()->json(notification('Sub-subcategory Inactive Successfully', 'success'));
    }
}
