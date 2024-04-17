<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Currency;
use App\Models\CustomerPackage;
use App\Models\CustomerPackageItem;
use App\Models\Product;
use App\Models\PurchaseDetails;
use App\Models\SaleDetails;
use App\Models\SaleInvoice;
use App\Models\SiteSetting;
use App\Models\Transaction;
use App\Models\Unit;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Customer;
use Illuminate\Support\Str;

use function PHPSTORM_META\type;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now();
        $startDate = $today->copy()->subDays(29)->startOfDay(); // Start date 30 days ago
        $endDate = $today->endOfDay(); // End date is today

        $quotations = CustomerPackage::with('vendor')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.quotation.view_quotation', compact('quotations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::where('type', 2)->orderBy("id", "DESC")->get();
        $products = Product::orderBy("id", "DESC")->where('status', 1)->get();
        $admin = Admin::orderBy("id", "DESC")->get();
        $units = Unit::orderBy("id", "DESC")->where('status', 1)->get();
        $type = 'quotation';

        $route = 'quotation.store';

        return view('backend.quotation.create_quotation', compact('vendors', 'route', 'products', 'type', 'units', 'admin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        //  return $request;

        try {
            DB::beginTransaction();

            // Define the common attributes
            $commonAttributes = [
                'customer_id' => $request->vendor_id,
                'sale_person_id' => $request->sale_person,
                'date' => $request->date,
                'to' => $request->to,
                'subject' => $request->subject,
                'channel' => "offline",
                'total' => $request->grand_total,
                'discount' => $request->total_discount,
                'net_payable' => $request->net_payable,
                "status" => "quotation",

            ];

            // Check if customerPackageId is set
            if ($request->customerPackageId != "undefined") {
                // Update existing customer package
                $invoiceNo = $this->generateInvoiceNumber($request->vendor_id, $request->customerPackageId);

                $customerPackage = CustomerPackage::findOrFail($request->customerPackageId);
                $customerPackage->update(array_merge($commonAttributes, [
                    'invoice_no' => $invoiceNo,
                    'updated_by' => Auth::guard('admin')->user()->id,
                    'updated_at' => now(),
                ]));
            } else {
                $invoiceNo = $this->generateInvoiceNumber($request->vendor_id);

                // Create a new customer package
                $customerPackage = CustomerPackage::create(array_merge($commonAttributes, [
                    'invoice_no' => $invoiceNo,
                    'created_by' => Auth::guard('admin')->user()->id,
                    'created_at' => now(),
                ]));
            }

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
                // Find the existing CustomerPackageItem if it exists
                $customerPackageItem = CustomerPackageItem::find($request->item_id[$key]);

                // Update or create the CustomerPackageItem
                $data = [
                    'product_id' => $productId,
                    'unit_id' => $request->unit_id[$key],
                    'qty' => $request->qty[$key],
                    'description' => $request->description[$key],
                    'price' => $request->price[$key],
                    'total' => $request->total[$key],
                    'discount' => $request->discount_price[$key],
                    'updated_at' => now(),
                ];

                if ($customerPackageItem) {
                    $customerPackageItem->update($data);
                } else {
                    // Insert a new CustomerPackageItem
                    CustomerPackageItem::create(array_merge($data, [
                        'customer_package_id' => $customerPackage->id,
                        'created_at' => now(),
                    ]));
                }
            }


            $customer_package = CustomerPackage::findOrFail($customerPackage->id);
            $customer_package_items = CustomerPackageItem::with('product', 'product.latestPurchase', 'unit')
                ->where('customer_package_id', $customer_package->id)
                ->where("delete", 0)
                ->get();

            DB::commit();

            return response()->json([
                "notification" => notification('Quotation Save Successfully', 'success'),
                'customerPackage' => $customer_package,
                'customerPackageItems' => $customer_package_items,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error Occurred: ' . $e->getMessage());

            $notification = [
                'message' => 'Error Occurred: ' . $e->getMessage(),
                'type' => 'error',
            ];
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
        return $id;

        $customerPackage = CustomerPackage::with([
            'customerPackageItems' => function ($query) {
                // Add a condition to retrieve only items where delete is equal to 0
                $query->where('delete', 0)->with(['product', 'product.latestPurchase', 'unit']);
            },
            'package',
            'vendor',
            'admin',
        ])->findOrFail($id);
        $customers = Vendor::where('type', 2)->orderBy("id", "DESC")->get();
        $products = Product::orderBy("id", "DESC")->where('status', 1)->get();
        $admin = Admin::orderBy("id", "DESC")->where('status', 1)->get();
        $units = Unit::orderBy("id", "DESC")->where('status', 1)->get();
        return view('backend.quotation.edit_or_sale_quotation', compact('customers', 'products', 'admin', 'customerPackage', 'units'));
    }

    public function quotationEditOrInvoice($type, $id)
    {
        // return $type;
        $customerPackage = CustomerPackage::with([
            'customerPackageItems' => function ($query) {
                // Add a condition to retrieve only items where delete is equal to 0
                $query->where('delete', 0)->with(['product', 'product.latestPurchase', 'unit']);
            },
            'package',
            'vendor',
            'admin',
        ])->findOrFail($id);
        $vendors = Vendor::where('type', 2)->orderBy("id", "DESC")->get();
        $products = Product::orderBy("id", "DESC")->where('status', 1)->get();
        $admin = Admin::orderBy("id", "DESC")->get();
        $units = Unit::orderBy("id", "DESC")->where('status', 1)->get();
        $type = $type;

        // Dynamically generate the route based on the type
        $route = ($type === 'edit') ? 'quotation.store' : 'store.quotation.invoice';


        return view('backend.quotation.create_quotation', compact('vendors', 'products', 'admin', 'customerPackage', 'type', 'route', 'units'));
    }

    public function storeQuotationInvoice(Request $request)
    {
            // return $request;

        try {
            DB::beginTransaction();
            $saleInvoice = SaleInvoice::create([
                'customer_id' => $request->vendor_id,
                'sale_person_id' => $request->sale_person,
                'invoice_no' => $request->invoiceNo ? $request->invoiceNo : generateInvoiceNumber(),
                'sale_date' => $request->date,
                'to' => $request->to ?  $request->to : null ,
                'subject' => $request->subject ? $request->subject :null ,
                "type" => $request->type ? $request->type : 3,
                "sales_channel" => "offline",
                'grand_total' => $request->grand_total,
                "total" => $request->grand_total,
                'discount' => $request->total_discount,
                'net_payable' => $request->net_payable,
                "total_paid" => $request->total_paid,
                "total_due" => $request->total_due,
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => now(),
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
                SaleDetails::create([
                    'product_id' => $productId,
                    'unit_id' => $request->unit_id[$key],
                    'qty' => $request->qty[$key],
                    'price' => $request->price[$key],
                    'discount' => $request->discount_price[$key],
                    'total' => $request->total[$key],
                    'sale_invoice_id' => $saleInvoice->id,
                    'created_at' => now(),
                ]);
            }


            if ($request->total_paid != null) {
                Transaction::insert([
                    "invoice_id" => $saleInvoice->id,
                    "last_paid" => $request->total_paid,
                    "type" => $request->type ? $request->type : 3,
                    "created_by" => Auth::guard('admin')->user()->id,
                    "created_at" => Carbon::now()
                ]);
            }


            if ($request->saleType === 'invoice') {
                $customerPackage = CustomerPackage::where("invoice_no", $request->invoiceNo)->first();
                $customerPackage->update([
                    "status" => "invoice",
                    'updated_by' => Auth::guard('admin')->user()->id,
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return response()->json([
                "notification" => notification('Sale Invoice Save Successfully', 'success'),
                'saleInvoice' => $saleInvoice->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error Occurred: ' . $e->getMessage());

            $notification = [
                'message' => 'Error Occurred: ' . $e->getMessage(),
                'type' => 'error',
            ];
            return response()->json($notification, 500);
        }
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

    public function SearchQuotation(Request $request)
    {
        // Retrieve the start date, end date, and purchase type from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $type = $request->input('type');

        // Convert the 'MM/DD/YYYY' formatted dates to 'YYYY-MM-DD' format
        $startDateFormatted = date('Y-m-d', strtotime($startDate));
        $endDateFormatted = date('Y-m-d', strtotime($endDate));

        // Query the CustomerPackage model to filter by type and created_at
        $query = CustomerPackage::with('vendor')
            ->selectRaw('*, DATE_FORMAT(created_at, "%d %M %Y") as formatted_created_at')
            ->whereBetween('created_at', [$startDateFormatted, $endDateFormatted]);

        if ($type !== '0') {
            $query->where('channel', $type)->orderBy('id', 'DESC');
        }

        // Execute the query
        $quotations = $query->orderBy('id', 'DESC')->get();

        return response()->json($quotations);
    }


    public function generateInvoiceNumber($customerId, $customerPackageId = null)
    {
        // Retrieve customer name
        $customerName = Vendor::findOrFail($customerId)->name;

        // Convert the customer name to a formatted string (remove special characters, spaces, and dots)
        $formattedName = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '', str_replace('.', '', $customerName)));

        // Get the first four characters of the formatted name
        $prefix = substr($formattedName, 0, 4);

        // Get the current year
        $currentYear = Carbon::now()->format('Y');

        // Initialize the invoice number
        $invoiceNumber = $prefix . '-' . $currentYear . '00100';

        // Check if there are existing invoices for the customer
        $lastInvoice = CustomerPackage::orderByDesc('created_at')->first();

        if ($lastInvoice) {
            if ($customerPackageId != null) {
                $lastPart = Str::after($lastInvoice->invoice_no, '-');
                $invoiceNumber = $prefix . '-' . $lastPart;
            } else {
                $lastPart = Str::after($lastInvoice->invoice_no, '-' . $currentYear . '00');
                $nextSequence = (int)$lastPart + 1;
                $invoiceNumber = $prefix . '-' . $currentYear . '00' . $nextSequence;
            }
        }

        return $invoiceNumber;
    }

    public function CustomerLatestQuotation($id)
    {
        // var_dump(intval($id));

        $customerQuotation = CustomerPackage::where('customer_id', $id)
            ->orderBy('created_at', 'desc')
            ->first();

        return response()->json(["customerPackage" => $customerQuotation]);
    }

    public function UpdateQuotationProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // Extract the property name and value from the request data
        $propertyName = key($request->all());
        $selectedValue = $request->input($propertyName);

        // Update the product dynamically
        $product->update([
            $propertyName => $selectedValue,
            'updated_at' => now(),
            'updated_by' => Auth::guard('admin')->user()->id,
        ]);

        return response()->json(["notification" => notification("Successfully changed $propertyName", "success")]);
    }

    public function UpdateQuotationProductDescription(Request $request, $id)
    {
        Product::findOrFail($id)->update([
            "quotation_short_descp" => $request->quotation_short_descp,
            "updated_at" => now(),
            'updated_by' => Auth::guard('admin')->user()->id,
        ]);

        return response()->json(["notification" => notification('successfully changed quotation product description', 'success')]);
    }
}
