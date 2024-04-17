<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Product;
use App\Models\PurchaseDetails;
use App\Models\SaleDetails;
use App\Models\SaleInvoice;
use App\Models\SiteSetting;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\Unit;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SaleController extends Controller
{
  // public function CreateSale()
  // {
  //   $customers = Vendor::where('type', 2)->get();
  //   $products = Product::get();
  //   $saleInvoice = SaleInvoice::max('id') + 1;
  //   $units = Unit::get();
  //   return view('backend.sale.sale', compact('customers', 'products', 'units', 'saleInvoice'));
  // }

  // public function CreateSale()
  // {
  // $type = "sale";
  // $customers = Vendor::where('type', 2)->orderBy("id", "DESC")->get();
  // $products = Product::orderBy("id", "DESC")->where('status',1)->get();
  // $admin = Admin::orderBy("id", "DESC")->get();
  // $units = Unit::orderBy("id", "DESC")->where('status',1)->get();
  // return view('backend.quotation.create_quotation', compact('customers', 'products', 'units','type','admin'));

  // }

  public function CreateSale()
  {
      $type = 'sale';
      $route = 'store.quotation.invoice';
      $customerPackage = null;
      $vendors = Vendor::where('type', 2)->orderBy("id", "DESC")->get();
      $products = Product::orderBy("id", "DESC")->where('status',1)->get();
      $admin = Admin::orderBy("id", "DESC")->get();
      $units = Unit::orderBy("id", "DESC")->where('status',1)->get();
      // Dynamically generate the route based on the type
      $route = 'store.quotation.invoice';
      return view('backend.quotation.create_quotation', compact('vendors','route','type','products', 'admin', 'customerPackage', 'type', 'route','units'));
  }



  public function getProductDetails(Request $request)
  {

    $stock = $this->getStock($request->id);

    $latestPurchase = PurchaseDetails::where('product_id', $request->id)
    ->latest('created_at')
    ->first(); // Use first() instead of firstOrFail()

    $latestSale = SaleDetails::where('product_id', $request->id)
      ->latest('created_at')
      ->first(); // Use first() instead of firstOrFail()

    // Get the product details along with the unit information
    $product = Product::with('unit')->findOrFail($request->id);

    // Add the stock information to the product details
    $product->stock = $stock;

    return ['product' => $product, 'latestSale' => $latestSale,'latestPurchase' =>  $latestPurchase];
  }


  public function getStock($id)
  {
    // Get the opening quantity
    $opening_qty = Product::where('id', $id)->value('opening_qty');


    $purchase = PurchaseDetails::join('purchase_invoices', 'purchase_details.purchase_invoice_id', '=', 'purchase_invoices.id')
      ->where('purchase_details.product_id', $id)
      ->where('purchase_invoices.type', 1)
      ->sum('purchase_details.qty');


    $purchaseReturn = PurchaseDetails::join('purchase_invoices', 'purchase_details.purchase_invoice_id', '=', 'purchase_invoices.id')
      ->where('purchase_details.product_id', $id)
      ->where('purchase_invoices.type', 2)
      ->sum('purchase_details.qty');


    $sale = SaleDetails::join('sale_invoices', 'sale_details.sale_invoice_id', '=', 'sale_invoices.id')
      ->where('sale_details.product_id', $id)
      ->where('sale_invoices.type', 3)
      ->sum('sale_details.qty');


    $saleReturn = SaleDetails::join('sale_invoices', 'sale_details.sale_invoice_id', '=', 'sale_invoices.id')
      ->where('sale_details.product_id', $id)
      ->where('sale_invoices.type', 4)
      ->sum('sale_details.qty');


    // Calculate the stock
    return ($opening_qty + $purchase + $saleReturn) - ($purchaseReturn + $sale);
  }


  public function SaleDataSession(Request $request)
  {

    // return $request->all();

    // Retrieve existing data from the session or initialize an empty array
    $data = session()->get('sale_data') ?? [];
    $userId = Auth::guard('admin')->user()->id;
    $counter = $request->input('counter');

    if (isset($data[$userId][$counter])) {
      // Data exists, so remove it
      unset($data[$userId][$counter]);
    }


    if ($request->except('counter')) {
      // Add the data for the specific user ID and counter
      $data[$userId][$counter] = [
        'customer_id' => $request->input('customer_id'),
        'product_id' => $request->input('product_id'),
        'product_name' => $request->input('product_name'),
        'unit_id' => $request->input('unit_id'),
        'unit_name' => $request->input('unit_name'),
        'quantity' => $request->input('quantity'),
        'sale_price' => $request->input('sale_price'),
        'discount_price' => $request->input('discount_price'),
        'unit_cost' => $request->input('unit_cost'),
        'total' => $request->input('total'),
        'vat' => $request->input('vat'),
        'total_vat' => $request->input('total_vat'),
        'subtotal' => $request->input('subtotal'),
        'type' => $request->input('type'),
        'counter' => $counter,
        'sale_date' => $request->input('sale_date'),
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
    }

    // Put the updated data into the session with the same key


    if($request->input('product_name')!=null){
      session()->put('sale_data', $data);
  }
  else{
      session()->forget('sale_data');
  }



    return response()->json(['message' => 'Data stored in session successfully']);
  }


  public function getSaleDataSession(Request $request)
  {
    // Retrieve the data from the session with the key 'sale_data'
    $saleData = session()->get('sale_data');
    $userId = Auth::guard('admin')->user()->id;
    $counter = $request->counter;


    // $counterData = $saleData[$userId][$counter];
    // // Return the data or perform any other logic you need
    // return $counterData;

    if (isset($saleData[$userId][$counter])) {
      $counterData = $saleData[$userId][$counter];
      // Return the data or perform any other logic you need
      return $counterData;
    }
    // If the data doesn't exist, return null or any other default value
    return 0;
  }


  public function StoreSale(Request $request)
  {

    $invoice_no = $this->generateInvoiceNumber();
    DB::beginTransaction();

    try {
      $saleInvoiceId = SaleInvoice::insertGetId([
        "type" => $request->type,
        'invoice_no' => $invoice_no,
        "customer_id" => $request->customer_id,
        "sale_date" => $request->sale_date,
        "sales_channel" => "offline",
        "grand_total" => $request->grand_total,
        "vat_on_invoice" => $request->vat_on_parcentage,
        "total_amount" => $request->total_amount,
        "discount" => $request->discout_parcentage,
        "net_payable" => $request->net_payable,
        "total_paid" => $request->total_paid,
        "total_due" => $request->total_due,
        "created_by" => Auth::guard('admin')->user()->id,
        "created_at" => Carbon::now()
      ]);

      for ($i = 0; $i < count($request->product_id); $i++) {
        if ($this->getStock($request->product_id[$i]) >= $request->quantity[$i]) {
          SaleDetails::insert([
            "sale_invoice_id" => $saleInvoiceId,
            "product_id" => $request->product_id[$i],
            "unit_id" => $request->unit_id[$i],
            "qty" => $request->quantity[$i],
            "price" => $request->sale_price[$i],
            "discount" => $request->discount_price[$i],
            "unit_cost" => $request->unit_cost[$i],
            "total" => $request->total[$i],
            "vat" => $request->vat[$i],
            "total_vat" => $request->total_vat[$i],
            "subtotal" => $request->subtotal[$i],
            "created_by" => Auth::guard('admin')->user()->id,
            "created_at" => Carbon::now()
          ]);
        } else {
          DB::rollBack(); // Roll back the transaction since a product is out of stock

          $notification = [
            'message' => 'Product is out of stock',
            'type' => 'error',
          ];

          return redirect()->back()->with($notification);
        }
      }


      if ($request->total_paid != null) {
        Transaction::insert([
          "invoice_id" => $saleInvoiceId,
          "last_paid" => $request->total_paid,
          "type" => $request->type,
          "created_by" => Auth::guard('admin')->user()->id,
          "created_at" => Carbon::now()
        ]);
      }

      // If the loop completes successfully, commit the transaction and remove session data
      DB::commit();

      $userId = Auth::guard('admin')->user()->id;
      $counter = $request->counter;

      // Forget the specific user ID and counter data from the session
      session()->forget('sale_data.' . $userId . '.' . $counter);

      $notification = [
        'message' => 'Sale Added Successfully',
        'type' => 'success',
      ];

      return response()->json([
        "notification" => $notification,
        'sale_invoice_id' => $saleInvoiceId
      ]);

    } catch (\Exception $e) {
      DB::rollBack();

      $notification = [
        'message' => 'Error Occurred: ' . $e->getMessage(),
        'type' => 'error',
      ];
      return redirect()->back()->with($notification);
    }
  }

  public function SaleReport(Request $request)
  {
    $saleInvoiceId = $request->query('sale_invoice_id');
    $invoice = SaleInvoice::with('saleDetails.product', 'saleDetails.unit')->find($saleInvoiceId); // Using find() instead of where()
    $customer = Vendor::find($invoice->customer_id);
    $setting = SiteSetting::first(); // Using first() instead of get()->first()
    return view('backend.sale.sale_report', compact('setting', 'invoice', 'customer'));

  }

  public function ViewSale()
  {

    $today = Carbon::now();
    $startDate = $today->copy()->subDays(29)->startOfDay(); // Start date 30 days ago
    $endDate = $today->endOfDay(); // End date is today

    $sales = SaleInvoice::with('vendor')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->orderBy('id', 'DESC')
        ->get();
    return view('backend.sale.view_sale',compact('sales'));
  }

  public function DateWiseSale(Request $request)
  {
    //return $request;

    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $type = $request->input('type');

    // Convert the 'MM/DD/YYYY' formatted dates to 'YYYY-MM-DD' format
    $startDateFormatted = date('Y-m-d', strtotime($startDate));
    $endDateFormatted = date('Y-m-d', strtotime($endDate));


    // Initialize the query
    $query = SaleInvoice::with("customer")
    ->whereBetween('sale_date', [$startDateFormatted, $endDateFormatted]);

    // Add the 'type' condition only if $type is not equal to 0
    if ($type != 0) {
        $query->where('type', $type)->orderBy('id', 'DESC');
    }

    // Execute the query
    $invoice = $query->get();

    return response()->json($invoice);
  }








  public function SaleDueCollection()
  {
    $invoice = SaleInvoice::select('invoice_no')->get();
    return view('backend.sale.due_collection', compact('invoice'));
  }

  public function SalePaymentHistory(Request $request)
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

    $paymentHistory = SaleInvoice::where('invoice_no', $request->invoice_no)
      ->leftJoin('transactions', function ($join) {
        $join->on('sale_invoices.id', '=', 'transactions.invoice_id')
          ->on('sale_invoices.type', '=', 'transactions.type');
      })
      ->select('sale_invoices.*', 'transactions.*')
      ->get();




    //$paymentHistory = PurchaseInvoice::with('purchaseTransactions')->where('invoice_no', $request->invoice_no)->get();

    return response()->json($paymentHistory);

    return $paymentHistory;
  }

  public function SaleDuePayment(Request $request)
  {

    try {
      DB::beginTransaction(); // Start a database transaction

      $invoice = SaleInvoice::where('invoice_no', $request->invoice_no)->lockForUpdate()->firstOrFail();

      // Update the SaleInvoice
      $updatedInvoice = SaleInvoice::findOrFail($invoice->id)->update([
        "total_paid" => $invoice->total_paid + $request->paid,
        "total_due" => $invoice->total_due - $request->paid,
        "updated_by" => Auth::guard('admin')->user()->id,
        "updated_at" => now()
      ]);

      if ($updatedInvoice) {
        // Insert a new Transaction
        Transaction::create([
          "invoice_id" => $invoice->id,
          "last_paid" => $request->paid,
          "type" => $invoice->type,
          "payment_status" => "Paid",
          "payment_type" => "Due Collection",
          "created_by" => Auth::guard('admin')->user()->id,
          "created_at" => now()
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

  public function generateInvoiceNumber(){
    // Get the current date and time
    $currentDateTime = now();

    // Format the date and time
    $formattedDateTime = $currentDateTime->format('YmdHis');

    // Generate a unique identifier (you can use various methods for this)
    $uniqueIdentifier = uniqid();

    // Combine the formatted date/time and the unique identifier to create the invoice number
    $invoiceNumber = 'INV-' . $formattedDateTime . '-' . $uniqueIdentifier;

    // Return the generated invoice number
    return $invoiceNumber;
}

}
