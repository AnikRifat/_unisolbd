<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorPNG;

class ProductBarcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 

        //return $request;
        if ($request->has('length') && $request->length != null) {
            $barcodeValue = '';
            for ($i = 0; $i < $request->length; $i++) {
                $barcodeValue .= mt_rand(0, 9);
            }
        } 

        else if($request->has('input') && $request->input != null){
            $barcodeValue = $request->input;
        }
        
        else {
            $barcodeValue = mt_rand(10000000, 99999999); // Generate a random 8-digit number
        }
        
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($barcodeValue, $generator::TYPE_INTERLEAVED_2_5);
        $base64Barcode = base64_encode($barcode);
        
        return response()->json([
            'randomNumber' => $barcodeValue,
            'barcode' => $base64Barcode
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        return view('backend.barcode.product_barcode', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
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

    public function PrintBarcode(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'number' => 'required',
        ]);
        $product = Product::findOrFail($request->product_id);
        $number =  $request->number;
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode(123, $generator::TYPE_INTERLEAVED_2_5);
        $base64Barcode = base64_encode($barcode);
        return view('backend.barcode.preview_product_barcode',compact('base64Barcode','number'));
   
    }
}
