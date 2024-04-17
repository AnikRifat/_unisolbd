<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MultiImg;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class MultiImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $MultiImage = MultiImg::where("product_id", $request->id)->get();
        return response()->json($MultiImage);
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
        //return $request;

        $product_id = $request->input('product_id');
        $multi_images = $request->file('multi_img');

        if ($multi_images) {
            foreach ($multi_images as $img) {
                MultiImg::insert([
                    'product_id' => $product_id,
                    'photo_name' => uploadAndResizeImage($img, "upload/products/multi-image", 720, 660),
                    "created_by" => Auth::guard('admin')->user()->id,
                    'created_at' => Carbon::now(),
                ]);
            }
            return response()->json(notification('Product image save successfully', 'success'));
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
       // return $request;
        $img = $request->file('multi_img');
        $product_id = $request->input('product_id');

        
        if ($img) {
            $old_image = MultiImg::where('id', $id)->where('product_id', $product_id)->first();
            @unlink($old_image->photo_name);
            MultiImg::where('product_id', $product_id)->where('id', $id)->update([
                'photo_name' => uploadAndResizeImage($img, "upload/products/multi-image", 720, 660),
                "updated_by" => Auth::guard('admin')->user()->id,
                'updated_at' => Carbon::now(),
            ]);

            return response()->json(notification('Product image update successfully', 'success'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MultiImg::findOrFail($id)->delete();
        return response()->json(notification('Product image delete successfully', 'success'));
    }
}
