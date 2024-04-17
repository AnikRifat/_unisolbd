<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Product;
use App\Models\ProductSpecification;
use App\Models\Specification;
use App\Models\SpecificationDetail;
use App\Models\Unit;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProductControllerRename extends Controller
{

    public function ViewSpecification()
    {
        // $categories=Category::orderBy('category_name',"ASC")->get();
        $specification = Specification::latest()->get();
        return view('backend.product.view_specification', compact('specification'));
    }


    public function StoreSpecification(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'category_id' => 'required'
        ]);

        Specification::insert([
            // 'category_id' => $request->category_id,
            'name' => $request->name,
            'filter' => $request->filter
        ]);

        $notification = array([
            'message' => 'Product Specificaiton Save Successfully',
            'type' => 'success',
        ]);
        return redirect()->back()->with($notification);
    }

    public function EditSpecification($id)
    {
        $specification = Specification::findOrFail($id);
        return view('backend.product.edit_specification', compact('specification'));
    }


    public function UpdateSpecification(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            // 'category_id' => 'required'
        ]);


        Specification::findOrFail($id)->update([
            // 'category_id' => $request->category_id,
            'name' => $request->name,
            'filter' => $request->filter
        ]);

        $notification = array([

            'message' => 'Specification Update Successfully',
            'type' => 'success',
        ]);
        return redirect()->route('view.specification')->with($notification);
    }

    public function InactiveSpecification($id)
    {
        $status = Specification::findOrFail($id);
        if ($status->status == 1) {
            Specification::findOrFail($id)->update(['status' => 0]);
        }
        return redirect()->back();
    }

    public function ActiveSpecification($id)
    {
        $status = Specification::findOrFail($id);
        if ($status->status == 0) {
            Specification::findOrFail($id)->update(['status' => 1]);
        }
        return redirect()->back();
    }






    public function ViewSpecificationDetails()
    {
        $categories = Category::orderBy('category_name', "ASC")->get();
        $specification_details = SpecificationDetail::with('category', 'specification')->latest()->get();
        $specifications = Specification::latest()->get();
        // return $specification_details;
        return view('backend.product.view_specification_details', compact('specifications', 'specification_details', 'categories'));
    }

    public function CategoryWiseSpecification(Request $request)
    {
        $specifications = SpecificationDetail::where('category_id', $request->category_id)
            ->groupBy('specification_id')
            ->select('specifications.*')
            ->join('specifications', 'specification_details.specification_id', '=', 'specifications.id')
            ->get();

        return  $specifications;
    }
    public function StoreSpecificationDetails(Request $request)
    {
        // return $request->all();

        // return $request->all();
        $request->validate([
            'specification_id' => 'required',
            'details' => 'required',
            'name' => 'required'
        ]);

        SpecificationDetail::insert([
            'category_id' => $request->category_id,
            'specification_id' => $request->specification_id,
            'name' => $request->name,
            'details' => $request->details,
        ]);

        $notification = array([
            'message' => 'Product Specificaiton Save Successfully',
            'type' => 'success',
        ]);
        return redirect()->back()->with($notification);
    }

    public function EditSpecificationDetails($id)
    {
        $categories = Category::orderBy('category_name', "ASC")->get();
        $specifications = Specification::latest()->get();
        $specification_details = SpecificationDetail::findOrFail($id);

        // return $specification_details->specification;
        return view('backend.product.edit_specification_details', compact('specification_details', 'specifications', 'categories'));
    }


    public function UpdateSpecificationDetails(Request $request, $id)
    {

        // return $id;

        // return $request->all();
        $request->validate([
            'specification_id' => 'required',
            'details' => 'required',
            'name' => 'required'
        ]);

        SpecificationDetail::findOrFail($id)->update([
            'category_id' => $request->category_id,
            'specification_id' => $request->specification_id,
            'name' => $request->name,
            'details' => $request->details,
        ]);

        $notification = array([
            'message' => 'SpecificationDetails Update Successfully',
            'type' => 'success',
        ]);
        return redirect()->route('view.specificationdetails')->with($notification);
    }

    public function InactiveSpecificationDetails($id)
    {
        $status = SpecificationDetail::findOrFail($id);
        if ($status->status == 1) {
            SpecificationDetail::findOrFail($id)->update(['status' => 0]);
        }
        return redirect()->back();
    }

    public function ActiveSpecificationDetails($id)
    {
        $status = SpecificationDetail::findOrFail($id);
        if ($status->status == 0) {
            SpecificationDetail::findOrFail($id)->update(['status' => 1]);
        }
        return redirect()->back();
    }


    public function AddQuantity()
    {
        $specifications = Specification::where('status', 1)->get();
        $products = Product::get();
        return view('backend.product.add_specificaiton_wise_qty', compact('products', 'specifications'));
    }


    public function GetSpecificaitonDetails(Request $request)
    {

        $selectedSpecifications = $request->input('Specifications');
        $specifications = [];
        foreach ($selectedSpecifications as $specification) {
            $id = $specification['id'];
            $specification = Specification::with('specificationdetails')->where('status', 1)->where('id', $id)->get();

            array_push($specifications, $specification); // push each id into the array
        }

        return response()->json($specifications);
    }

    public function AddProduct()
    {
        $specifications = Specification::where('status', 1)->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $brands = Brand::latest()->get();
        $units = Unit::latest()->get();
        return view('backend.product.add_product', compact('categories', 'subcategories', 'subsubcategories', 'units', 'brands', 'specifications'));
    }

    public function StoreProduct(Request $request)
    {


        $request->validate([
            'category_id' => 'required',
            'product_name' => 'required',
            'selling_price' => 'required',
            'product_thambnail' => 'required',
        ]);

        // return $request->all();

        // Start a database transaction
        DB::beginTransaction();

        try {

            $data = [
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_id' => $request->subsubcategory_id,
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'opening_qty' => $request->opening_qty,
                'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                'product_tags' => $request->product_tags,
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'specification_descp' => $request->specification_descp,
                'on_sale' => $request->on_sale,
                'unit_id' => $request->unit_id,
                'barcode' => $request->barcode,
                'featured' => $request->featured,
                'special_offer' => $request->special_offer,
                'top_rated' => $request->top_rated,
                'is_expireable' => $request->is_expireable,
                "created_by" => Auth::guard('admin')->user()->id,
                "created_at" => Carbon::now()
            ];


            if ($request->file('product_thambnail')) {
                $data['product_thambnail'] = uploadAndResizeImage($request->file('product_thambnail'), "upload/products/thambnails", 720, 660); // Fixed the function parameters
            }


            $product_id = Product::insertGetId($data);

            $specification_id = $request->specification_id;
            $specification_details_id = $request->specification_details_id;

            if ($specification_id && $specification_details_id) {
                // Assuming both arrays have the same length
                $count = count($specification_id);

                for ($i = 0; $i < $count; $i++) {
                    ProductSpecification::insert([
                        'specification_id' => $specification_id[$i],
                        'specification_details_id' => $specification_details_id[$i],
                        'product_id' => $product_id,
                        "created_by" => Auth::guard('admin')->user()->id,
                        'created_at' => Carbon::now(),
                    ]);
                }
            }



            $images = $request->file('multi_img');
            if ($images != null) {
                foreach ($images as $img) {
                    MultiImg::insert([
                        'product_id' => $product_id,
                        'photo_name' => uploadAndResizeImage($img, "upload/products/multi-image", 720, 660),
                        "created_by" => Auth::guard('admin')->user()->id,
                        'created_at' => Carbon::now(),
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('manage-product')->with(notification('Product Information Save Successfully', 'success'));
        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction
            DB::rollback();

            // Handle the exception or return an error response
            return redirect()->back()->withInput()->with(notification('Error: ' . $e->getMessage(), 'error'));
        }
    }

    public function ManageProduct()
    {
        $Products = Product::latest()->get();
        return view('backend.product.product_view', compact('Products'));
    }
    public function EditProduct($id)
    {
        $units = Unit::latest()->get();
        $specifications = Specification::where('status', 1)->get();
        $multiImgs = MultiImg::where('product_id', $id)->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $product = Product::with('category.subcategory', 'category.subsubcategory')->findOrFail($id);
        return view('backend.product.product_edit', compact('brands', 'units', 'categories','subcategories','subsubcategories','product', 'multiImgs', 'specifications'));
    }

    public function ProductDataUpdate(Request $request, $id)
    {


         //return $request->all();

        $request->validate([
            'category_id' => 'required',
            'product_name' => 'required',
            'selling_price' => 'required',
        ]);

        $data = [
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'opening_qty' => $request->opening_qty,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_tags' => $request->product_tags,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'specification_descp' => $request->specification_descp,
            'on_sale' => $request->on_sale,
            'unit_id' => $request->unit_id,
            'barcode' => $request->barcode,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'top_rated' => $request->top_rated,
            'is_expireable' => $request->is_expireable,
            "updated_by" => Auth::guard('admin')->user()->id,
            "updated_at" => Carbon::now()
        ];

        if ($request->file('product_thambnail')) {
            $product = Product::findOrFail($id);
            @unlink($product->product_thambnail);
            $data['product_thambnail'] = uploadAndResizeImage($request->file('product_thambnail'), "upload/products/thambnails", 720, 660); // Fixed the function parameters
        }

        $product_id = Product::findOrFail($id)->update($data);

        $specification_id = $request->specification_id;
        $specification_details_id = $request->specification_details_id;

        if ($specification_id && $specification_details_id) {
            ProductSpecification::where('product_id', $id)->delete();
            // Assuming both arrays have the same length
            $count = count($specification_id);

            for ($i = 0; $i < $count; $i++) {
                ProductSpecification::insert([
                    'specification_id' => $specification_id[$i],
                    'specification_details_id' => $specification_details_id[$i],
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        return redirect()->route('manage-product')->with(notification('Product Information Update Successfully', 'success'));

    }


    // public function ViewMultiImg($product_id)
    // {
    //     $MultiImage=MultiImg::where("product_id",$product_id)->get();
    //     return response()->json($MultiImage);
    // }


    // public function StoreMultiImg(Request $request,$product_id)
    // {
    //     // return $doctor_id;
    //     // return $files = $request->file('multi_img');
    //     $multi_images = $request->file('multi_img');
    //     if( $multi_images){
    //         foreach($multi_images as $img) {
    //             $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    //             $image_path = 'image/doctors/multi-image/'.$name_gen;
    //             Image::make($img)->resize(719,1000)->save($image_path);

    //             MultiImg::insert([
    //                 'product_id' => $product_id,
    //                 'image' => $image_path,

    //                 'created_at'=> Carbon::now()
    //             ]);
    //         }
    //     }

    //}





    public function MultiImageUpdate(Request $request)
    {

        if ($request->file('multi_img')) {
            $images  = $request->file('multi_img');
            foreach ($images as $id => $image) {
                $old_image = MultiImg::findOrFail($id);
                if (file_exists($old_image->photo_name)) {
                    unlink($old_image->photo_name);
                }
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(917, 1000)->save(public_path('upload/products/multi-image/' . $name_gen));
                $save_url = 'upload/products/multi-image/' . $name_gen;

                MultiImg::where('id', $id)->update([
                    'photo_name' => $save_url,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        $notification = array([

            'message' => 'Product Multi Image Update Successfully',
            'type' => 'success',
        ]);

        return redirect()->route('manage-product')->with($notification);
    }

    public function ThambnailImageUpdate(Request $request, $id)
    {
        $new_image = $request->file('product_thambnail');
        $old_image = Product::findOrFail($id);
        if ($request->file('product_thambnail')) {
            unlink($old_image->product_thambnail);
            $gen_name = hexdec(uniqid()) . '.' . $new_image->getClientOriginalExtension();
            Image::make($new_image)->resize(917, 1000)->save(public_path('upload/products/thambnails/' . $gen_name));
            $save_url = 'upload/products/thambnails/' . $gen_name;
            Product::findOrFail($id)->update([

                'product_thambnail' => $save_url,
                'updated_at' => Carbon::now(),
            ]);
        }


        $notification = array([

            'message' => 'Product Thaminail Update Successfully',
            'type' => 'success',
        ]);
        return redirect()->route('manage-product')->with($notification);
    }

    public function MultiImageDelete(Request $request)
    {
        $multiimg = MultiImg::findOrFail($request->id);
        unlink($multiimg->photo_name);
        MultiImg::findOrFail($request->id)->delete();
        return redirect()->back();
    }

    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 0
        ]);

        $notification = array([

            'message' => 'Product Inactive Successfully',
            'type' => 'success',


        ]);


        return redirect()->back()->with($notification);
    }

    public function ProductActive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 1
        ]);

        $notification = array([

            'message' => 'Product Active Successfully',
            'type' => 'success',
        ]);
        return redirect()->back()->with($notification);
    }

    public function DeleteProduct($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thambnail);
        Product::findOrFail($id)->delete();
        $multiimg = MultiImg::where('Product_id', $id)->get();
        foreach ($multiimg as $img) {
            unlink($img->photo_name);
            MultiImg::where('Product_id', $id)->delete();
        }

        return redirect()->back();
    }

    //product stock management method
    public function ProductStock()
    {
        $Products = Product::latest()->get();
        return view('backend.product.product_stock', compact('Products'));
    }



    public function generateBarcode(Request $request)
    {

        if ($request->length) {
            $barcodeValue = '';
            for ($i = 0; $i < $request->length; $i++) {
                $barcodeValue .= mt_rand(0, 9);
            }

            $generator = new BarcodeGeneratorPNG();
            $barcode = $generator->getBarcode($barcodeValue, $generator::TYPE_INTERLEAVED_2_5);

            $base64Barcode = base64_encode($barcode);

            return response()->json([
                'randomNumber' => $barcodeValue,
                'barcode' => $base64Barcode
            ]);
        } else {
            $generator = new BarcodeGeneratorPNG();
            $barcode = $generator->getBarcode($request->barcode_value, $generator::TYPE_INTERLEAVED_2_5);
            $base64Barcode = base64_encode($barcode);
            return response()->json([
                'barcode' => $base64Barcode
            ]);
        }
    }

    public function PrintBarcode()
    {
        $products = Product::get();
        return view('backend.barcode.view_barcode', compact('products'));
    }

    public function PrintBarcodePdf(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'amount' => 'required',
        ]);

        $product = Product::findOrFail($request->product_id);

        // return $product;

        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($product->barcode, $generator::TYPE_INTERLEAVED_2_5);
        $barcodeImg = base64_encode($barcode);
        // return $base64Barcode;

        $amount = $request->amount;

        $pdf = PDF::loadView('backend.barcode.product_barcode_pdf', compact('barcodeImg', 'amount'))->setPaper('a4')->setOption('enable-local-file-access', true);
        //     $pdf = Pdf::loadView('backend.barcode.product_barcode_pdf', compact('barcodeImg','amount'))->setPaper('a4')->setOptions([
        //         'tempDir' => public_path(),
        //         'chroot' => public_path(),
        // ]);
        return $pdf->stream('barcode.pdf');
    }
}
