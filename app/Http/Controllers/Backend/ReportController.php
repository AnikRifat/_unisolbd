<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\CustomerPackage;
use App\Models\Expense;
use App\Models\PurchaseDetails;
use App\Models\PurchaseInvoice;
use App\Models\SaleInvoice;
use App\Models\SiteSetting;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class ReportController extends Controller
{
    public function CreateSaleReport()
    {
        return view('backend.report.create.sale_report');
    }

    public function CreatePurchaseReport()
    {
        return view('backend.report.create.purchase_report');
    }

    public function CreateInventoryReport()
    {
        return view('backend.report.create.inventory_report');
    }

    public function CreateSupplierReport()
    {
        $suppliers = Vendor::where('type', '1')->get();

        return view('backend.report.create.supplier_report', compact('suppliers'));
    }

    public function CreateCustomerReport()
    {
        $customers = Vendor::where('type', '2')->get();

        return view('backend.report.create.customer_report', compact('customers'));
    }

    public function CreateExpenseReport()
    {
        return view('backend.report.create.expense_report');
    }

    // public function PreviewPurchaseReport(Request $request)
    // {
    //     // Retrieve the start date, end date, and purchase type from the request
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');
    //     $purchaseType = $request->input('type');

    //     // Convert the 'MM/DD/YYYY' formatted dates to 'YYYY-MM-DD' format
    //     $startDateFormatted = date('Y-m-d', strtotime($startDate));
    //     $endDateFormatted = date('Y-m-d', strtotime($endDate));

    //     // Query the PurchaseInvoice model to filter by type and purchase_date
    //     return $invoice = PurchaseInvoice::with('purchaseDetails.product', 'purchaseDetails.unit')
    //         ->where('type', $purchaseType)
    //         ->whereBetween('purchase_date', [$startDateFormatted, $endDateFormatted])
    //         ->get();

    //     $setting = SiteSetting::first();

    //     // You can return the filtered data to your view or manipulate it as needed.
    //     // For example, you can pass it to a view:
    //     return view('backend.report.preview.purchase_report', compact('setting', 'invoice'));
    // }

    public function PreviewPurchaseReport(Request $request)
    {
        //return $request;
        // Retrieve the start date, end date, and purchase type from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $purchaseType = $request->input('type');

        // Convert the 'MM/DD/YYYY' formatted dates to 'YYYY-MM-DD' format
        $startDateFormatted = date('Y-m-d', strtotime($startDate));
        $endDateFormatted = date('Y-m-d', strtotime($endDate));

        // Query the PurchaseInvoice model to filter by type and purchase_date
        $invoice = PurchaseInvoice::with('purchaseDetails.product', 'purchaseDetails.unit')
            ->where('type', $purchaseType)
            ->whereBetween('purchase_date', [$startDateFormatted, $endDateFormatted])
            ->get();
        $setting = SiteSetting::first();

        // Return a view and pass the data to it
        return view('backend.report.preview.purchase_report', compact('invoice', 'setting', 'startDate', 'endDate'));
    }

    public function PreviewSaleReport(Request $request)
    {
        //return $request;
        // Retrieve the start date, end date, and purchase type from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $saleType = $request->input('type');

        // Convert the 'MM/DD/YYYY' formatted dates to 'YYYY-MM-DD' format
        $startDateFormatted = date('Y-m-d', strtotime($startDate));
        $endDateFormatted = date('Y-m-d', strtotime($endDate));

        // Query the PurchaseInvoice model to filter by type and purchase_date
        $invoice = SaleInvoice::with('saleDetails.product', 'saleDetails.unit')
            ->where('type', $saleType)
            ->whereBetween('sale_date', [$startDateFormatted, $endDateFormatted])
            ->get();
        $setting = SiteSetting::first();

        // Return a view and pass the data to it
        return view('backend.report.preview.sale_report', compact('invoice', 'setting', 'startDate', 'endDate'));
    }

    public function PreviewCustomerReport(Request $request)
    {
        //return $request;
        // Retrieve the start date, end date, and purchase type from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $customerId = $request->input('customer_id');
        $type = $request->input('type');

        // Convert the 'MM/DD/YYYY' formatted dates to 'YYYY-MM-DD' format
        $startDateFormatted = date('Y-m-d', strtotime($startDate));
        $endDateFormatted = date('Y-m-d', strtotime($endDate));

        // Initialize the query
        $query = SaleInvoice::with('saleDetails.product', 'saleDetails.unit')
            ->where('customer_id', $customerId)
            ->whereBetween('sale_date', [$startDateFormatted, $endDateFormatted]);

        // Add the 'type' condition only if $type is not equal to 0
        if ($type != 0) {
            $query->where('type', $type);
        }

        // Execute the query
        $invoice = $query->get();

        $setting = SiteSetting::first();
        $customer = Vendor::find($customerId);

        // Return a view and pass the data to it
        return view('backend.report.preview.customer_report', compact('invoice', 'customer', 'setting', 'startDate', 'endDate'));
    }

    public function PreviewSupplierReport(Request $request)
    {
        //return $request;
        // Retrieve the start date, end date, and purchase type from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $supplierId = $request->input('supplier_id');
        $type = $request->input('type');

        // Convert the 'MM/DD/YYYY' formatted dates to 'YYYY-MM-DD' format
        $startDateFormatted = date('Y-m-d', strtotime($startDate));
        $endDateFormatted = date('Y-m-d', strtotime($endDate));

        // Initialize the query
        $query = PurchaseInvoice::with('purchaseDetails.product', 'purchaseDetails.unit', 'purchaseDetails.supplier')
            ->whereBetween('purchase_date', [$startDateFormatted, $endDateFormatted]);

        // Add the 'type' condition only if $type is not equal to 0
        if ($type != 0) {
            $query->where('type', $type);
        }

        // Add a condition to filter by supplier_id in purchaseDetails
        if ($supplierId != 0) {
            $query->whereHas('purchaseDetails', function ($subquery) use ($supplierId) {
                $subquery->where('supplier_id', $supplierId);
            });
        }

        // Execute the query
        $invoice = $query->get();

        $setting = SiteSetting::first();
        $supplier = Vendor::find($supplierId);

        // Return a view and pass the data to it
        return view('backend.report.preview.supplier_report', compact('invoice', 'setting', 'startDate', 'endDate'));
    }

    public function PreviewInventoryReport(Request $request)
    {

        // Retrieve the start date, end date, and purchase type from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Convert the 'MM/DD/YYYY' formatted dates to 'YYYY-MM-DD' format
        $startDateFormatted = date('Y-m-d', strtotime($startDate));
        $endDateFormatted = date('Y-m-d', strtotime($endDate));

        // return $results = DB::table('products as p')
        //     ->select(
        //         'p.id',
        //         'p.product_name',
        //         DB::raw('(COALESCE(p.opening_qty, 0) +
        //          COALESCE((SELECT SUM(qty) FROM purchase_details WHERE product_id = p.id AND purchase_date < ? AND type = 1), 0) +
        //          COALESCE((SELECT SUM(qty) FROM sale_details WHERE product_id = p.id AND sale_date < ? AND type = 4), 0)) -
        //          (COALESCE((SELECT SUM(qty) FROM purchase_details WHERE product_id = p.id AND purchase_date < ? AND type = 2), 0) +
        //          COALESCE((SELECT SUM(qty) FROM sale_details WHERE product_id = p.id AND sale_date < ? AND type = 3), 0)) AS opening'),
        //         DB::raw('(COALESCE((SELECT SUM(qty) FROM purchase_details WHERE product_id = p.id AND purchase_date BETWEEN ? AND ? AND type = 1), 0)) AS purchase'),
        //         DB::raw('(COALESCE((SELECT SUM(qty) FROM purchase_details WHERE product_id = p.id AND purchase_date BETWEEN ? AND ? AND type = 2), 0)) AS purchasereturn'),
        //         DB::raw('(COALESCE((SELECT SUM(qty) FROM sale_details WHERE product_id = p.id AND sale_date BETWEEN ? AND ? AND type = 3), 0)) AS sales'),
        //         DB::raw('(COALESCE((SELECT SUM(qty) FROM sale_details WHERE product_id = p.id AND sale_date BETWEEN ? AND ? AND type = 4), 0)) AS salesreturn')
        //     )
        //     ->setBindings([$startDateFormatted, $startDateFormatted, $startDateFormatted, $startDateFormatted, $startDateFormatted, $endDateFormatted, $startDateFormatted, $endDateFormatted, $startDateFormatted, $endDateFormatted, $startDateFormatted, $endDateFormatted])
        //     ->get();

        $results = DB::table('products as p')
            ->select(
                'p.id',
                'p.product_name',
                DB::raw('(COALESCE(p.opening_qty, 0) +
                    COALESCE((SELECT SUM(pd.qty) FROM purchase_details pd
                        JOIN purchase_invoices pi ON pd.purchase_invoice_id = pi.id
                        WHERE pd.product_id = p.id AND pi.purchase_date < ? AND pi.type = 1), 0) +
                    COALESCE((SELECT SUM(sd.qty) FROM sale_details sd
                        JOIN sale_invoices si ON sd.sale_invoice_id = si.id
                        WHERE sd.product_id = p.id AND si.sale_date < ? AND si.type = 4), 0)) -
                    (COALESCE((SELECT SUM(pd.qty) FROM purchase_details pd
                        JOIN purchase_invoices pi ON pd.purchase_invoice_id = pi.id
                        WHERE pd.product_id = p.id AND pi.purchase_date < ? AND pi.type = 2), 0) +
                    COALESCE((SELECT SUM(sd.qty) FROM sale_details sd
                        JOIN sale_invoices si ON sd.sale_invoice_id = si.id
                        WHERE sd.product_id = p.id AND si.sale_date < ? AND si.type = 3), 0)) AS opening'),
                DB::raw('(COALESCE((SELECT SUM(pd.qty) FROM purchase_details pd
                        JOIN purchase_invoices pi ON pd.purchase_invoice_id = pi.id
                        WHERE pd.product_id = p.id AND pi.purchase_date BETWEEN ? AND ? AND pi.type = 1), 0)) AS purchase'),
                DB::raw('(COALESCE((SELECT SUM(pd.qty) FROM purchase_details pd
                        JOIN purchase_invoices pi ON pd.purchase_invoice_id = pi.id
                        WHERE pd.product_id = p.id AND pi.purchase_date BETWEEN ? AND ? AND pi.type = 2), 0)) AS purchasereturn'),
                DB::raw('(COALESCE((SELECT SUM(sd.qty) FROM sale_details sd
                        JOIN sale_invoices si ON sd.sale_invoice_id = si.id
                        WHERE sd.product_id = p.id AND si.sale_date BETWEEN ? AND ? AND si.type = 3), 0)) AS sales'),
                DB::raw('(COALESCE((SELECT SUM(sd.qty) FROM sale_details sd
                        JOIN sale_invoices si ON sd.sale_invoice_id = si.id
                        WHERE sd.product_id = p.id AND si.sale_date BETWEEN ? AND ? AND si.type = 4), 0)) AS salesreturn')
            )
            ->setBindings([$startDateFormatted, $startDateFormatted, $startDateFormatted, $startDateFormatted, $startDateFormatted, $endDateFormatted, $startDateFormatted, $endDateFormatted, $startDateFormatted, $endDateFormatted, $startDateFormatted, $endDateFormatted])
            ->get();

        $setting = SiteSetting::first();

        // Return a view and pass the data to it
        return view('backend.report.preview.inventory_report', compact('results', 'setting', 'startDate', 'endDate'));
    }

    public function PreviewExpenseReport(Request $request)
    {

        // Retrieve the start date, end date, and purchase type from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Convert the 'MM/DD/YYYY' formatted dates to 'YYYY-MM-DD' format
        $startDateFormatted = date('Y-m-d', strtotime($startDate));
        $endDateFormatted = date('Y-m-d', strtotime($endDate));

        $expenses = Expense::whereBetween('date', [$startDateFormatted, $endDateFormatted])
            ->get();

        $setting = SiteSetting::first();
        $currency = Currency::first();

        // Return a view and pass the data to it
        return view('backend.report.preview.expense_report', compact('expenses', 'setting', 'startDate', 'endDate', 'currency'));
    }

    // public function QuotationReport(Request $request)
    // {
    //     $id = $request->query('id');
    //     // $customerPackage = CustomerPackage::with('customerPackageItems.product','customerPackageItems.unit', 'package', 'vendor','admin')->findOrFail($id);

    //     $customerPackage = CustomerPackage::with([
    //         'customerPackageItems' => function ($query) {
    //             // Add a condition to retrieve only items where delete is equal to 0
    //             $query->where('delete', 0)->with(['product', 'unit']);
    //         },
    //         'package',
    //         'vendor',
    //         'admin',
    //     ])->findOrFail($id);

    //     $currency = Currency::limit(1)->get()->first();
    //     $setting = SiteSetting::first();

    //     if($customerPackage->channel=="offline"){
    //         return view('backend.quotation.quotation_report', compact('setting', 'currency', 'customerPackage'));
    //     }
    //     else{
    //         return view('frontend.quotationbuilder.quotation_report', compact('setting', 'currency', 'customerPackage'));
    //     }

    // }

    public function QuotationAndSaleInvoiceReport($type, $id)
    {
        //return $type;

        if ($type == 'quotation') {
            $invoice = CustomerPackage::with([
                'customerPackageItems' => function ($query) {
                    // Add a condition to retrieve only items where delete is equal to 0
                    $query->where('delete', 0)->with(['product', 'unit']);
                },
                'package',
                'vendor',
                'admin',
            ])->findOrFail($id);
            $currency = Currency::limit(1)->get()->first();
            $setting = SiteSetting::first();
            $customerPackage = CustomerPackage::with('customerPackageItems.product', 'package', 'vendor')->findOrFail($id);
            if ($invoice->channel == 'offline') {
                return view('backend.quotation.quotation_report', compact('setting', 'currency', 'invoice', 'type'));
            } else {
                return view('frontend.quotationbuilder.quotation_report', compact('setting', 'currency', 'customerPackage'));
            }
        } elseif ($type == 'quotation-invoice' || $type == 'sale') {

            //return $type;
            $invoice = SaleInvoice::with([
                'saleDetails' => function ($query) {
                    // Add a condition to retrieve only items where delete is equal to 0
                    $query->with(['product', 'unit']);
                },
                'package',
                'vendor',
                'admin',
            ])->findOrFail($id);

            $currency = Currency::limit(1)->get()->first();
            $setting = SiteSetting::first();

            return view('backend.quotation.quotation_report', compact('setting', 'currency', 'invoice', 'type'));
        }
    }
}
