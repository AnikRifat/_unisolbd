<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\ProductSpecification;
use App\Models\Specification;
use App\Models\SpecificationDetail;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $Products = Product::latest()->paginate(10); // You can change 10 to the number of items per page you want
        $Products = Product::latest()->get();
        // return $Products->items();
        // return response()->json([
        //     'data' => $products->items(),
        //     'pagination' => [
        //         $products->currentPage(),
        //         $products->url(1),
        //        $products->firstItem(),
        //         $products->lastPage(),
        //         $products->url($products->lastPage()),
        //         $products->links(),
        //         $products->nextPageUrl(),
        //         $products->path(),
        //        $products->perPage(),
        //         $products->previousPageUrl(),
        //         $products->lastItem(),
        //       $products->total(),
        //     ],
        // ]);
        return view('backend.product.product_view', compact('Products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specifications = Specification::where('status', 1)->get();
        $specificationDetails = SpecificationDetail::where('status', 1)->get();
        $categories = Category::where('status', 1)->latest()->get();
        $subcategories = SubCategory::where('status', 1)->latest()->get();
        $subsubcategories = SubSubCategory::where('status', 1)->latest()->get();
        $brands = Brand::where('status', 1)->latest()->get();
        $units = Unit::where('status', 1)->latest()->get();
        return view('backend.product.add_product', compact('categories', 'specificationDetails', 'subcategories', 'subsubcategories', 'units', 'brands', 'specifications'));
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
        $commonRules = [
            'product_name' => 'required',
            'selling_price' => 'required',
            'purchase_price' => 'required',
        ];

        if (!$request->ajax()) {
            $commonRules['category_id'] = 'required';
            $commonRules['product_thambnail'] = 'required';
        }

        $request->validate($commonRules);


        $shortDescp = $request->short_descp;
        $pattern = '/<li>(.*?)<\/li>/i';
        preg_match_all($pattern, $shortDescp, $matches);
        $quotation_short_descp = implode(',', $matches[1]);


        // Start a database transaction
        DB::beginTransaction();

        try {

            $data = [
                'brand_id' => $request->brand_id ?? null,
                'category_id' => $request->category_id ?? null,
                'subcategory_id' => $request->subcategory_id ?? null,
                'subsubcategory_id' => $request->subsubcategory_id ?? null,
                'product_name' => $request->product_name ?? null,
                'quotation_product_name' => $request->product_name ?? null,
                'product_code' => $request->product_code ?? null,
                'purchase_price' => $request->purchase_price ?? null,
                'selling_price' => $request->selling_price ?? null,
                'discount_price' => $request->discount_price ?? null,
                'opening_qty' => $request->opening_qty ?? null,
                'product_slug' => strtolower(str_replace(' ', '-', $request->product_name ?? null)),
                'short_descp' => $request->short_descp ?? null,
                'quotation_short_descp' => $quotation_short_descp ?? null,
                'long_descp' => $request->long_descp ?? null,
                'specification_descp' => $request->specification_descp ?? null,
                'on_sale' => $request->on_sale ?? null,
                'unit_id' => $request->unit_id ?? null,
                'barcode' => $request->barcode ?? null,
                'featured' => $request->featured ?? null,
                'special_offer' => $request->special_offer ?? null,
                'top_rated' => $request->top_rated ?? null,
                'is_expireable' => $request->is_expireable ?? null,
                'type' => $request->type,
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => Carbon::now(),
            ];


            if ($request->file('product_thambnail')) {
                $data['product_thambnail'] = uploadAndResizeImage($request->file('product_thambnail'), "upload/products/thambnails", 720, 660); // Fixed the function parameters
            } else {
                $data['product_thambnail'] = "upload/no_product.png";
            }


            $product = Product::create($data);

            $specification_id = $request->specification_id;
            $specification_details_id = $request->specification_details_id;

            if ($specification_id && $specification_details_id) {
                // Assuming both arrays have the same length
                $count = count($specification_id);

                for ($i = 0; $i < $count; $i++) {
                    ProductSpecification::insert([
                        'specification_id' => $specification_id[$i],
                        'specification_details_id' => $specification_details_id[$i],
                        'product_id' => $product->id,
                        "created_by" => Auth::guard('admin')->user()->id,
                        'created_at' => Carbon::now(),
                    ]);
                }
            }



            $images = $request->file('multi_img');
            if ($images != null) {
                foreach ($images as $img) {
                    MultiImg::insert([
                        'product_id' => $product->id,
                        'photo_name' => uploadAndResizeImage($img, "upload/products/multi-image", 720, 660),
                        "created_by" => Auth::guard('admin')->user()->id,
                        'created_at' => Carbon::now(),
                    ]);
                }
            }

            DB::commit();

            if ($request->ajax()) {
                return response()->json(["product"=>$product,"notification"=>notification('Product Information Save Successfully', 'success')]);
            } else {
                return redirect()->route('product.index')->with(notification('Product Information Save Successfully', 'success'));
            }
        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction
            DB::rollback();

            if ($request->ajax()) {
                return response()->json(notification('Error: ' . $e->getMessage(), 'error'));
            } else {
                // Handle the exception or return an error response
                return redirect()->back()->withInput()->with(notification('Error: ' . $e->getMessage(), 'error'));
            }
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
        $specifications = Specification::where('status', 1)->get();
        $specificationDetails = SpecificationDetail::where('status', 1)->get();
        $categories = Category::where('status', 1)->latest()->get();
        $subcategories = SubCategory::where('status', 1)->latest()->get();
        $subsubcategories = SubSubCategory::where('status', 1)->latest()->get();
        $brands = Brand::where('status', 1)->latest()->get();
        $units = Unit::where('status', 1)->latest()->get();
        $multiImgs = MultiImg::where('product_id', $id)->get();
        $productSpecification = ProductSpecification::with('specification', 'specification.specificationdetails')->where('product_id', $id)->get();
        $product = Product::with('category.subcategory', 'category.subsubcategory')->findOrFail($id);
        return view('backend.product.product_edit', compact('categories', 'specifications', 'specificationDetails', 'productSpecification', 'subcategories', 'subsubcategories', 'units', 'brands', 'multiImgs', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //return $request;
    //     $request->validate([
    //         'category_id' => 'required',
    //         'product_name' => 'required',
    //         'selling_price' => 'required',
    //     ]);

    //     try {
    //         DB::beginTransaction(); // Start a database transaction

    //         $data = [
    //             'brand_id' => $request->brand_id,
    //             'category_id' => $request->category_id,
    //             'subcategory_id' => $request->subcategory_id,
    //             'subsubcategory_id' => $request->subsubcategory_id,
    //             'product_name' => $request->product_name,
    //             'product_code' => $request->product_code,
    //             'selling_price' => $request->selling_price,
    //             'discount_price' => $request->discount_price,
    //             'opening_qty' => $request->opening_qty,
    //             'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
    //             'product_tags' => $request->product_tags,
    //             'short_descp' => $request->short_descp,
    //             'long_descp' => $request->long_descp,
    //             'specification_descp' => $request->specification_descp,
    //             'on_sale' => $request->on_sale,
    //             'unit_id' => $request->unit_id,
    //             'barcode' => $request->barcode,
    //             'featured' => $request->featured,
    //             'special_offer' => $request->special_offer,
    //             'top_rated' => $request->top_rated,
    //             'is_expireable' => $request->is_expireable,
    //             "updated_by" => Auth::guard('admin')->user()->id,
    //             "updated_at" => Carbon::now()
    //         ];

    //         if ($request->file('product_thambnail')) {
    //             $product = Product::findOrFail($id);
    //             @unlink($product->product_thambnail);
    //             $data['product_thambnail'] = uploadAndResizeImage($request->file('product_thambnail'), "upload/products/thambnails", 720, 660); // Fixed the function parameters
    //         }

    //         $product_id = Product::findOrFail($id)->update($data);

    //         $specification_id = $request->specification_id;
    //         $specification_details_id = $request->specification_details_id;

    //         if ($specification_id && $specification_details_id) {
    //             ProductSpecification::where('product_id', $id)->delete();
    //             // Assuming both arrays have the same length
    //             $count = count($specification_id);

    //             for ($i = 0; $i < $count; $i++) {
    //                 ProductSpecification::insert([
    //                     'specification_id' => $specification_id[$i],
    //                     'specification_details_id' => $specification_details_id[$i],
    //                     'product_id' => $product_id,
    //                     'created_at' => Carbon::now(),
    //                 ]);
    //             }
    //         }

    //         return redirect()->route('manage-product')->with(notification('Product Information Update Successfully', 'success'));

    //         DB::commit();
    //     } catch (\Exception $e) {
    //         // Something went wrong, so rollback the transaction
    //         DB::rollback();
    //         return redirect()->back()->with('error', 'An error occurred while updating the product.');
    //     }
    // }


    public function update(Request $request, $id)
    {

        //return $request;
        $request->validate([
            'category_id' => 'required',
            'product_name' => 'required',
            'selling_price' => 'required',
        ]);

        try {
            DB::beginTransaction(); // Start a database transaction
            $data = [
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_id' => $request->subsubcategory_id,
                'product_name' => $request->product_name,
                'quotation_product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'purchase_price' => $request->purchase_price,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'opening_qty' => $request->opening_qty,
                'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                'short_descp' => $request->short_descp,
                'quotation_short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'specification_descp' => $request->specification_descp,
                'on_sale' => $request->on_sale,
                'unit_id' => $request->unit_id,
                'barcode' => $request->barcode,
                'featured' => $request->featured,
                'special_offer' => $request->special_offer,
                'top_rated' => $request->top_rated,
                'is_expireable' => $request->is_expireable,
                'type' => $request->type,
                "updated_by" => Auth::guard('admin')->user()->id,
                "updated_at" => Carbon::now()
            ];

            //return $data;

            $product = Product::findOrFail($id);
            if ($request->file('product_thambnail')) {
                @unlink($product->product_thambnail);
                $data['product_thambnail'] = uploadAndResizeImage($request->file('product_thambnail'), "upload/products/thambnails", 720, 660);
            }

            $product->update($data);

            // Handle specification updates (if applicable)
            $specification_id = $request->specification_id;
            $specification_details_id = $request->specification_details_id;

            if ($specification_id && $specification_details_id) {
                ProductSpecification::where('product_id', $id)->delete();
                // Assuming both arrays have the same length
                $count = count($specification_id);

                for ($i = 0; $i < $count; $i++) {
                    ProductSpecification::create([
                        'specification_id' => $specification_id[$i],
                        'specification_details_id' => $specification_details_id[$i],
                        'product_id' => $id,
                        'created_at' => now(),
                    ]);
                }
            }

            //Commit the transaction
            DB::commit();

            return redirect()->route('product.index')->with(notification('Product Information Update Successfully', 'success'));
        } catch (\Exception $e) {

            // Something went wrong, so rollback the transaction
            DB::rollback();
            return redirect()->back()->with('error An error occurred while updating the product.', $e->getMessage());
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
        //
    }

    public function ActiveProduct($id)
    {
        Product::where('id', '=', $id)->update(['status' => 1]);
        return redirect()->back()->with(notification('Product Active Successfully', 'success'));
    }

    public function InactiveProduct($id)
    {
        Product::where('id', '=', $id)->update(['status' => 0]);
        return redirect()->back()->with(notification('Product InActive Successfully', 'success'));
    }
}
