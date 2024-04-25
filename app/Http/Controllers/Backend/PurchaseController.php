<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Product;
use App\Models\PurchaseDetails;
use App\Models\PurchaseInvoice;
use App\Models\SiteSetting;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\Unit;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    public function CreatePurchase()
    {
        $vendors = Vendor::where('type', 1)->get();
        $products = Product::get();
        $units = Unit::get();
        $admin = Admin::orderBy('id', 'DESC')->get();
        $type = 'purchase';
        $route = 'store.purchase';

        return view('backend.quotation.create_quotation', compact('vendors', 'type', 'route', 'products', 'units', 'admin'));
    }

    public function getProductDetails(Request $request)
    {
        $latestPurchase = PurchaseDetails::where('product_id', $request->id)
            ->latest('created_at')
            ->first(); // Use first() instead of firstOrFail()

        // Get the product details along with the unit information
        $product = Product::with('unit')->findOrFail($request->id);

        return ['product' => $product, 'latestPurchase' => $latestPurchase];

    }

    public function PurchaseDataSession(Request $request)
    {

        //    return $request->all();
        // Retrieve existing data from the session or initialize an empty array
        $data = session()->get('purchase_data') ?? [];
        $userId = Auth::guard('admin')->user()->id;

        // Assuming you want to remove data for a specific user ID
        if (isset($data[$userId])) {
            // Data exists, so remove it
            unset($data[$userId]);
        }

        // Add the data for the specific user ID and counter
        $data[$userId] = [
            'purchase_no' => $request->input('purchase_no'),
            'supplier_id' => $request->input('supplier_id'),
            'product_id' => $request->input('product_id'),
            'product_name' => $request->input('product_name'),
            'unit_id' => $request->input('unit_id'),
            'unit_name' => $request->input('unit_name'),
            'quantity' => $request->input('quantity'),
            'purchase_price' => $request->input('purchase_price'),
            'discount_price' => $request->input('discount_price'),
            'expired_date' => $request->input('expired_date'),
            'unit_cost' => $request->input('unit_cost'),
            'total' => $request->input('total'),
            'vat' => $request->input('vat'),
            'total_vat' => $request->input('total_vat'),
            'subtotal' => $request->input('subtotal'),
            'type' => $request->input('type'),
            'purchase_date' => $request->input('purchase_date'),
            'grand_total' => $request->input('grand_total'),
            'vat_on_parcentage' => $request->input('vat_on_parcentage'),
            'vat_on_taka' => $request->input('vat_on_taka'),
            'total_amount' => $request->input('total_amount'),
            'discout_parcentage' => $request->input('discout_parcentage'),
            'discount_taka' => $request->input('discount_taka'),
            'net_payable' => $request->input('net_payable'),
            'total_paid' => $request->input('total_paid'),
            'total_due' => $request->input('total_due'),
        ];

        if ($request->input('product_name') != null) {
            session()->put('purchase_data', $data);
        } else {
            session()->forget('purchase_data');
        }

        return response()->json(['message' => 'Data stored in session successfully']);
    }

    public function getPurchaseDataSession(Request $request)
    {
        // Retrieve the data from the session with the key 'sale_data'
        $purchaseData = session()->get('purchase_data');
        $userId = Auth::guard('admin')->user()->id;

        if (isset($purchaseData[$userId])) {
            $Data = $purchaseData[$userId];

            // Return the data or perform any other logic you need
            return $Data;
        }

        // If the data doesn't exist, return null or any other default value
        return 0;
    }

    public function StorePurchase(Request $request)
    {
        // return $request;
        try {
            DB::beginTransaction();
            // Create a new customer package
            $purchaseInvoice = PurchaseInvoice::create([
                'supplier_id' => $request->vendor_id,
                'sale_person_id' => $request->sale_person,
                'invoice_no' => generateInvoiceNumber(),
                'purchase_date' => $request->date,
                'type' => $request->type,
                'grand_total' => $request->grand_total,
                'total' => $request->grand_total,
                'discount' => $request->total_discount,
                'net_payable' => $request->net_payable,
                'total_paid' => $request->total_paid,
                'total_due' => $request->total_due,
            ]);

            // Validation rules for the request
            $rules = [
                'product_id.*' => 'required',
                'unit_id.*' => 'required',
                'qty.*' => 'required',
                'price.*' => 'required',
                'total.*' => 'required',
            ];

            // Validate the request
            $this->validate($request, $rules);

            // Update or insert CustomerPackageItems
            foreach ($request->product_id as $key => $productId) {
                // Insert a new CustomerPackageItem
                PurchaseDetails::create([
                    'purchase_invoice_id' => $purchaseInvoice->id,
                    'product_id' => $productId,
                    'unit_id' => $request->unit_id[$key],
                    'qty' => $request->qty[$key],
                    'price' => $request->price[$key],
                    'total' => $request->total[$key],
                    'discount' => $request->discount_price[$key],
                    'updated_at' => now(),
                ]);

            }

            if ($request->total_paid != null) {
                Transaction::insert([
                    'invoice_id' => $purchaseInvoice->id,
                    'last_paid' => $request->total_paid,
                    'type' => $request->type,
                    'payment_status' => 'Paid',
                    'payment_type' => 'New Collection',
                    'created_by' => Auth::guard('admin')->user()->id,
                    'created_at' => Carbon::now(),
                ]);
            }

            DB::commit();

            return response()->json([
                'notification' => notification('Purchase Complete Successfully', 'success'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error Occurred: '.$e->getMessage());

            $notification = [
                'message' => 'Error Occurred: '.$e->getMessage(),
                'type' => 'error',
            ];

            return response()->json($notification, 500);
        }
    }

    // public function store(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //             // Create a new customer package
    //             $purchaseInvoice = PurchaseInvoice::create([
    //                 'supplier_id' => $request->vendor_id,
    //                 'sale_person_id' => $request->sale_person,
    //                 'invoice_no' => generateInvoiceNumber(),
    //                 'purchase_date' => $request->date,
    //                 "type" => $request->type,
    //                 'grand_total' => $request->grand_total,
    //                 "total" => $request->grand_total,
    //                 'discount' => $request->total_discount,
    //                 'net_payable' => $request->net_payable,
    //                 "total_paid" => $request->total_paid,
    //                 "total_due" => $request->total_due,
    //             ]);

    //         // Validation rules for the request
    //         $rules = [
    //             'product_id.*' => 'required',
    //             'unit_id.*' => 'required',
    //             'qty.*' => 'required',
    //             'sale_price.*' => 'required',
    //             'total.*' => 'required',
    //         ];

    //         // Validate the request
    //         $this->validate($request, $rules);

    //         // Update or insert CustomerPackageItems
    //         foreach ($request->product_id as $key => $productId) {
    //                 // Insert a new CustomerPackageItem
    //                 PurchaseDetails::create([
    //                     'purchase_invoice_id' => $purchaseInvoice->id,
    //                     'product_id' => $productId,
    //                     'unit_id' => $request->unit_id[$key],
    //                     'qty' => $request->qty[$key],
    //                     'price' => $request->sale_price[$key],
    //                     'total' => $request->total[$key],
    //                     'discount' => $request->discount_price[$key],
    //                     'updated_at' => now(),
    //                 ]);

    //         }

    //         if ($request->total_paid != null) {
    //             Transaction::insert([
    //                 "invoice_id" => $purchaseInvoice->id,
    //                 "last_paid" => $request->total_paid,
    //                 "type" => $request->type,
    //                 "payment_status" => "Paid",
    //                 "payment_type" => "New Collection",
    //                 "created_by" => Auth::guard('admin')->user()->id,
    //                 "created_at" => Carbon::now()
    //             ]);
    //         }

    //         DB::commit();

    //         return response()->json([
    //             "notification" => notification('Purchase Complete Successfully', 'success')
    //         ]);
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         Log::error('Error Occurred: ' . $e->getMessage());

    //         $notification = [
    //             'message' => 'Error Occurred: ' . $e->getMessage(),
    //             'type' => 'error',
    //         ];
    //         return response()->json($notification, 500);
    //     }
    // }

    public function PurchaseReport(Request $request)
    {
        $purchaseInvoiceId = $request->query('purchase_invoice_id');
        $invoice = PurchaseInvoice::with('purchaseDetails.product', 'purchaseDetails.unit')->find($purchaseInvoiceId); // Using find() instead of where()
        // $supplier = Vendor::find($invoice->supplier_id);
        $setting = SiteSetting::first(); // Using first() instead of get()->first()

        return view('backend.purchase.purchase_report', compact('setting', 'invoice'));
    }

    public function ViewPurchase()
    {
        $purchases = PurchaseInvoice::get();

        return view('backend.purchase.view_purcahse', compact('purchases'));
    }

    public function DateWisePurchase(Request $request)
    {
        //return $request;

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $type = $request->input('type');

        // Convert the 'MM/DD/YYYY' formatted dates to 'YYYY-MM-DD' format
        $startDateFormatted = date('Y-m-d', strtotime($startDate));
        $endDateFormatted = date('Y-m-d', strtotime($endDate));

        // Initialize the query
        $query = PurchaseInvoice::whereBetween('purchase_date', [$startDateFormatted, $endDateFormatted]);

        // Add the 'type' condition only if $type is not equal to 0
        if ($type != 0) {
            $query->where('type', $type)->orderBy('id', 'DESC');
        }

        // Execute the query
        $invoice = $query->get();

        return response()->json($invoice);
    }

    public function generateInvoiceNumber()
    {
        $prefix = 'INV';
        $timestamp = now()->format('YmdHis');
        $randomDigits = mt_rand(1000, 9999);

        return $prefix.$timestamp.$randomDigits;
    }

    public function PurchaseDueCollection()
    {
        $invoice = PurchaseInvoice::select('invoice_no')->get();

        return view('backend.purchase.due_collection', compact('invoice'));
    }

    public function PurchasePaymentHistory(Request $request)
    {

        //return $request;

        // $paymentHistory = DB::table('purchase_invoices')
        //     ->join('transactions', function ($join) {
        //         $join->on('purchase_invoices.id', '=', 'transactions.invoice_id')
        //             ->on('purchase_invoices.type', '=', 'transactions.type');
        //     })
        //     ->where('purchase_invoices.invoice_no', 'INV202308301909163181')
        //     ->select('purchase_invoices.*', 'transactions.*')
        //     ->get();

        // $paymentHistory = PurchaseInvoice::where('invoice_no', $request->invoice_no)
        //                 ->rightjoin('transactions', 'purchase_invoices.id', '=', 'transactions.invoice_id')
        //                 ->whereColumn('purchase_invoices.type', '=', 'transactions.type')
        //                 ->select('purchase_invoices.*', 'transactions.*')
        //                 ->get();

        $paymentHistory = PurchaseInvoice::where('invoice_no', $request->invoice_no)
            ->leftJoin('transactions', function ($join) {
                $join->on('purchase_invoices.id', '=', 'transactions.invoice_id')
                    ->on('purchase_invoices.type', '=', 'transactions.type');
            })
            ->select('purchase_invoices.*', 'transactions.*')
            ->get();

        //$paymentHistory = PurchaseInvoice::with('purchaseTransactions')->where('invoice_no', $request->invoice_no)->get();

        return response()->json($paymentHistory);

        return $paymentHistory;
    }

    public function PurchaseDuePayment(Request $request)
    {

        try {
            DB::beginTransaction(); // Start a database transaction

            $invoice = PurchaseInvoice::where('invoice_no', $request->invoice_no)->lockForUpdate()->firstOrFail();

            // Update the PurchaseInvoice
            $updatedInvoice = PurchaseInvoice::findOrFail($invoice->id)->update([
                'total_paid' => $invoice->total_paid + $request->paid,
                'total_due' => $invoice->total_due - $request->paid,
                'updated_by' => Auth::guard('admin')->user()->id,
                'updated_at' => now(),
            ]);

            if ($updatedInvoice) {
                // Insert a new Transaction
                Transaction::create([
                    'invoice_id' => $invoice->id,
                    'last_paid' => $request->paid,
                    'type' => $invoice->type,
                    'payment_status' => 'Paid',
                    'payment_type' => 'Due Collection',
                    'created_by' => Auth::guard('admin')->user()->id,
                    'created_at' => now(),
                ]);

                DB::commit(); // Commit the transaction if everything is successful

                return response()->json(notification('payment successfully insert', 'success'));
            } else {
                DB::rollback(); // Rollback the transaction if the invoice update fails
            }
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction on any exception
            throw $e; // Rethrow the exception
        }
    }
}
