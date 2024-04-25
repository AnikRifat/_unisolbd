<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CustomerPackage;
use App\Models\CustomerPackageItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuotationItemController extends Controller
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

        try {
            DB::beginTransaction();

            $customer_package = CustomerPackage::findOrFail($request->customer_package_id);

            // Create the CustomerPackage only if there are items
            $customer_package->update([
                'total' => (int) $customer_package->total + (int) $request->total,
                'net_payable' => (((int) $customer_package->net_payable + (int) $request->total) - (int) $customer_package->discount),
                'updated_by' => Auth::guard('admin')->user()->id,
                'updated_at' => now(),
            ]);

            // Create the CustomerPackageItem only if all required fields are valid
            CustomerPackageItem::create([
                'customer_package_id' => $request->customer_package_id,
                'product_id' => $request->product_id,
                'unit_id' => $request->unit_id,
                'qty' => $request->qty,
                'description' => $request->description,
                'price' => $request->price,
                'total' => $request->total,
                'discount' => $request->discount, // Assuming discount is optional
                'total' => $request->total,
                'created_at' => now(),
            ]);

            DB::commit();

            return response()->json(['notification' => notification('Quotation Item Add Successfully', 'success')]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error Occurred: '.$e->getMessage());

            $notification = ['message' => 'Error Occurred: '.$e->getMessage(), 'type' => 'error'];

            return response()->json($notification, 500);
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

        $customerPackageItem = CustomerPackageItem::findOrFail($id);
        $customerPackage = CustomerPackage::findOrFail($customerPackageItem->customer_package_id);

        try {
            DB::beginTransaction();

            CustomerPackageItem::findOrFail($id)->update(['delete' => 1]);

            // Create the CustomerPackage only if there are items
            $customerPackage->update([
                'total' => (int) $customerPackage->total - (int) $customerPackageItem->total,
                'net_payable' => (int) $customerPackage->net_payable - (int) $customerPackageItem->total,
                'updated_by' => Auth::guard('admin')->user()->id,
                'updated_at' => now(),
            ]);

            DB::commit();

            $customer_package_items = CustomerPackageItem::with('product', 'unit')->where('customer_package_id', $customerPackage->id)->where('delete', 0)->get();

            return response()->json([
                'notification' => notification('Quotation item remove successfully', 'success'),
                'customerPackage' => $customerPackage,
                'customerPackageItems' => $customer_package_items,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error Occurred: '.$e->getMessage());

            $notification = ['message' => 'Error Occurred: '.$e->getMessage(), 'type' => 'error'];

            return response()->json($notification, 500);
        }

    }
}
