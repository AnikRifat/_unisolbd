<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();

        return view('backend.categories.category', compact('categories'));
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
            'category_name' => 'required|unique:categories,category_name,except,id',
            'category_icon' => 'required',
        ]);

        $categoryData = [
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'created_by' => Auth::guard('admin')->user()->id,
            'created_at' => Carbon::now(),
        ];

        if ($request->file('category_icon')) {
            $categoryData['category_icon'] = uploadAndResizeImage($request->file('category_icon'), 'upload/icon/category', 40, 40);
        }

        Category::create($categoryData);

        return redirect()->back()->with(notification('Category Save Successfully', 'success'));
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
            'category_name' => 'required|unique:categories,category_name,'.$id,
        ]);

        $categoryData = [
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'updated_by' => Auth::guard('admin')->user()->id,
            'updated_at' => Carbon::now(),
        ];

        $category = Category::findOrFail($id);
        if ($request->file('category_icon')) {
            @unlink(public_path($category->category_icon));
            $categoryData['category_icon'] = uploadAndResizeImage($request->file('category_icon'), 'upload/icon/category', 40, 40);
        }

        Category::findOrFail($id)->update($categoryData);

        return redirect()->back()->with(notification('Category Update Successfully', 'success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function destroy($id)
    {

        $category = Category::findOrFail($id);
        foreach ($category->products as $product) {
            $product->delete();
        }
        $img = $category->category_icon;
        @unlink($img);
        Category::findOrFail($id)->delete();

        return redirect()->back()->with(notification('category Delete Successfully', 'success'));
    }

    public function ActiveCategory($id)
    {
        Category::where('id', '=', $id)->update(['status' => 1]);

        return redirect()->back()->with(notification('Category Active Successfully', 'success'));
    }

    public function InactiveCategory($id)
    {
        Category::where('id', '=', $id)->update(['status' => 0]);

        return redirect()->back()->with(notification('Category Inactive Successfully', 'success'));
    }
}
