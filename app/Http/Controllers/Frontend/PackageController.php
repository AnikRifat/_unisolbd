<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\SaleController;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\CustomerPackage;
use App\Models\CustomerPackageItem;
use App\Models\Package;
use App\Models\PackageDetails;
use App\Models\PackageItem;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\Vendor;
use DOMDocument;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Stripe\Customer;

class PackageController extends Controller
{
    public function ViewPackage()
    {
        $packages = Package::where('status', 1)->orderBy('id', 'DESC')->get();

        return view('frontend.quotationbuilder.view_package', compact('packages'));
    }

    public function ViewPackageDetails($id)
    {
        $decryptId = decrypt($id);
        $packageDetails = PackageItem::with('package', 'category', 'subcategory', 'subsubcategory')->where('package_id', $decryptId)->get();
        $currency = Currency::limit(1)->get()->first();
        return view('frontend.quotationbuilder.view_packagedetails', compact('packageDetails', 'currency'));
    }

    public function ViewPackageDetailsProducts(Request $request)
    {
        //return $request->all();
        $key = $request->name;
        $query = Product::where('status', 1);

        if ($request->subsubcategory_id) {
            $query->where('subsubcategory_id', $request->subsubcategory_id)->with('subsubcategory');
        }

        if ($request->subcategory_id) {
            $query->where('subcategory_id', $request->subcategory_id)->with('subcategory');
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id)->with('category');
        }

        // Execute the query and retrieve the products
        $products = $query->get();

        $package = Package::where('id', $request->quotation_builder)->first();

        // return $package;
        $currency = Currency::limit(1)->get()->first();

        return view('frontend.quotationbuilder.view_packagedetails_products', compact('products', 'currency', 'package', 'key'));
    }

    public function PackageDetailsAddProduct($product_id, $package_id, $key)
    {

        $productId = decrypt($product_id);
        $packageId = decrypt($package_id);
        $keyName = decrypt($key);

        //  return ['product'=>$product_id,'package'=>$package_id,'key'=>$key];

        $package = Package::where('id', $packageId)->first();
        $product = Product::with('category')->where('id', $productId)->where('status', 1)->first();

        // return $product;

        $product->qty = 1;
        $product->subTotal = $product->discount_price != null ? $product->discount_price : $product->selling_price;

        if (! session()->has($package->name)) {
            session()->put($package->name, [
                $keyName => $product,
                'total_price' => $product->discount_price != null ? $product->discount_price : $product->selling_price,
            ]);
        } else {
            $totalPrice = Session::get($package->name)['total_price'];

            if ($product->discount_price != null) {
                $totalPrice += $product->discount_price;
            } else {
                $totalPrice += $product->selling_price;
            }

            $existingArray = Session::get($package->name, []);
            $newArray = [
                $keyName => $product,
                'total_price' => $totalPrice,
            ];

            $mergedArray = array_merge($existingArray, $newArray);
            Session::put($package->name, $mergedArray);
        }

        //   return Session::get($product->packagedetails->name);

        $encryptedPackageId = $package->id ? urlencode(Crypt::encrypt($package->id)) : null;

        return redirect()->route('view.packageDetails', ['id' => $encryptedPackageId]);
    }

    public function IncreaseDecreasePackageQty(Request $request)
    {

        $quotation = decrypt($request->quotation);
        $key = decrypt($request->key);
        $qty = $request->qty;

        // return response()->json([$qutation,$key,$qty]);

        $sessionData = Session::get($quotation, []);
        $product = $sessionData[$key] ?? null;
        $total = $sessionData['total_price'] ?? null;

        $price = $product->discount_price != null ? $product->discount_price : $product->selling_price;

        $total_price = $total - $product->subTotal;

        $product->qty = $qty;
        $product->subTotal = $price * $qty;

        $sessionData[$key] = $product;
        $sessionData['total_price'] = $total_price + $product->subTotal;

        // Store the modified session data back into the session
        Session::put($quotation, $sessionData);

        return response()->json([
            'total' => $sessionData['total_price'],
            'qty' => $product->qty,
            'subTotal' => $product->subTotal,
        ]);
    }

    public function RemovePackageProduct(Request $request)
    {


        $quotation = decrypt($request->qutation);
        $key = decrypt($request->key);
        // $package_id = decrypt($request->package_id);

        $sessionData = Session::get($quotation, []);
        $product = $sessionData[$key] ?? null;
        $total = $sessionData['total_price'] ?? 0; // Initialize to 0 if not set

        $total_price = $total - ($product->subTotal ?? 0); // Subtract subTotal if set

        $sessionData['total_price'] = $total_price;

        // Remove the specified key from the session data
        unset($sessionData[$key]);

        // Update session data
        Session::put($quotation, $sessionData);

        // $packageDetails = PackageItem::with('package', 'category', 'subcategory', 'subsubcategory')->where('package_id', $package_id)->get();
        // $currency = Currency::limit(1)->get()->first();
        // $updatedContent = view('frontend.quotationbuilder.view_packagedetails', compact('packageDetails', 'currency'))->render();

        $updatedContent = $this->ViewPackageDetails($request->package_id)->render();

        // Extract the content of the '.cart-page' element using DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($updatedContent);
        $extractedContent = '';
        $mainElements = $dom->getElementsByTagName('main');
        foreach ($mainElements as $mainElement) {
            if ($mainElement->getAttribute('class') === 'cart-page') {
                $extractedContent = $dom->saveHTML($mainElement);
                break;
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Package product removed successfully.',
            'extractedContent' => $extractedContent, // Send the extracted content
        ]);
    }

    public function CreatePackage($id)
    {

        $saleController = resolve(SaleController::class);
        $invoice_no = $saleController->generateInvoiceNumber();

        $decryptId = decrypt($id);

        $package = Package::findOrFail($decryptId);

        if (Session::has($package->name)) {
            $sessionData = Session::get($package->name);

    $customer_package = CustomerPackage::create([
        'invoice_no' => $invoice_no,
        'package_id' => $decryptId,
        'customer_id' => auth()->user()->id,
        'channel' => 'online',
        'created_by' =>  auth()->user()->i,
        'created_at' => now(),
    ]);

//     $existingCustomer = Vendor::where('type', 2)
//     ->where('name', auth()->user()->name)
//     ->where('phone', auth()->user()->phone)
//     ->first();

// $customer = $existingCustomer ?? Vendor::create([
//     'type' => 2,
//     'name' => auth()->user()->name,
//     'email' => auth()->user()->email,
//     'phone' => auth()->user()->phone,
//     'details' => auth()->user()->userDetails->company_name,
//     'created_at' => now(),
// ]);
// $customer_package = CustomerPackage::create([
//     'invoice_no' => $invoice_no,
//     'package_id' => $decryptId,
//     'customer_id' => $customer->id,
//     'channel' => 'online',
//     'created_by' => Auth::guard('admin')->user()?->id,
//     'created_at' => now(),
// ]);



            foreach ($sessionData as $key => $value) {
                if ($key !== 'total_price') {
                    $total = $value['qty'] * (isset($value['discount_price']) ? $value['discount_price'] : $value['selling_price']);
                    CustomerPackageItem::create([
                        'customer_package_id' => $customer_package->id,
                        'component' => $key,
                        'product_id' => $value['id'],
                        'qty' => $value['qty'],
                        'price' => isset($value['discount_price']) ? $value['discount_price'] : $value['selling_price'],
                        'total' => $total,
                        'created_at' => now(),
                    ]);
                }
            }

            $customerPackageId = $customer_package->id;


            $currency = Currency::limit(1)->get()->first();
            $setting = SiteSetting::first();

            return view('frontend.quotationbuilder.quotation_report_web', compact('setting', 'currency', 'customer_package'))->with([
                     'notification' => notification('Quotation Save Successfully', 'success'),
                     'customerPackageId' => $customerPackageId,
                 ]);


            // return redirect()->back()->with([
            //     'notification' => notification('Quotation Save Successfully', 'success'),
            //     'customerPackageId' => $customerPackageId,
            // ]);
        }

        return redirect()->back()->with(notification('some problem occurs', 'error'));

    }

    // public function StorePackage(Request $request, $id)
    // {
    //     //return $request;

    //     $decryptId = decrypt($id);

    //     $request->validate([
    //         'name' => 'required',
    //         //'email' => 'required',
    //         'phone' => 'required',
    //         'company_name' => 'required',
    //     ]);

    //     $package = Package::findOrFail($decryptId);
    //     $existingCustomer = Vendor::where("type",2)->where('name', $request->name)->where('phone', $request->phone)->first();

    //     if (Session::has($package->name)) {

    //         $sessionData = Session::get($package->name);

    //         if ($existingCustomer) {

    //             $customer_package = CustomerPackage::create([
    //                 'package_id' => $decryptId,
    //                 'customer_id' => $existingCustomer->id,
    //                 'channel' => "online",
    //                 'created_at' => now(),
    //             ]);

    //             foreach ($sessionData as $key => $value) {
    //                 if ($key !== 'total_price') { // Exclude the 'total_price' key
    //                     CustomerPackageItem::create([
    //                         'customer_package_id' => $customer_package->id,
    //                         'component' => $key,
    //                         'product_id' => $value['id'],
    //                         'qty' => $value['qty'],
    //                         'price' => isset($value['discount_price']) ? $value['discount_price'] : $value['selling_price'],
    //                         'total' => 'qty' * 'price',
    //                         'created_at' => now(),
    //                     ]);
    //                 }
    //             }

    //         }
    //         else{
    //             $customer = Vendor::create([
    //                 'name' => $request->name,
    //                 'email' => $request->email,
    //                 'phone' => $request->phone,
    //                 'details' => $request->company_name,
    //                 'created_at' => now(),
    //             ]);

    //             $customer_package = CustomerPackage::create([
    //                 'package_id' => $decryptId,
    //                 'customer_id' => $customer->id,
    //                 'channel' => "online",
    //                 'created_at' => now(),
    //             ]);

    //             foreach ($sessionData as $key => $value) {
    //                 if ($key !== 'total_price') { // Exclude the 'total_price' key
    //                     CustomerPackageItem::create([
    //                         'customer_package_id' => $customer_package->id,
    //                         'component' => $key,
    //                         'product_id' => $value['id'],
    //                         'qty' => $value['qty'],
    //                         'price' => isset($value['discount_price']) ? $value['discount_price'] : $value['selling_price'],
    //                         'total' => 'qty' * 'price',
    //                         'created_at' => now(),
    //                     ]);
    //                 }
    //             }

    //         }

    //
    //     }

    //     return redirect()->back()->with('customerPackageId', $customer->id);
    // }

    public function storePackage(Request $request, $id)
    {

        //return $request;
        // Resolve an instance of the SaleController
        $saleController = resolve(SaleController::class);
        // Call the generateInvoiceNumber method from SaleController
        $invoice_no = $saleController->generateInvoiceNumber();

        $decryptId = decrypt($id);

        $request->validate([
            'name' => 'required',
            //'email' => 'required',
            'phone' => 'required',
            'company_name' => 'required',
        ]);

        $package = Package::findOrFail($decryptId);

        if (Session::has($package->name)) {
            $sessionData = Session::get($package->name);
            $existingCustomer = Vendor::where('type', 2)
                ->where('name', $request->name)
                ->where('phone', $request->phone)
                ->first();

            $customer = $existingCustomer ?? Vendor::create([
                'type' => 2,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'details' => $request->company_name,
                'created_at' => now(),
            ]);
            $customer_package = CustomerPackage::create([
                'invoice_no' => $invoice_no,
                'package_id' => $decryptId,
                'customer_id' => $customer->id,
                'channel' => 'online',
                'created_by' => Auth::guard('admin')->user()?->id,
                'created_at' => now(),
            ]);
            foreach ($sessionData as $key => $value) {
                if ($key !== 'total_price') {
                    $total = $value['qty'] * (isset($value['discount_price']) ? $value['discount_price'] : $value['selling_price']);
                    CustomerPackageItem::create([
                        'customer_package_id' => $customer_package->id,
                        'component' => $key,
                        'product_id' => $value['id'],
                        'qty' => $value['qty'],
                        'price' => isset($value['discount_price']) ? $value['discount_price'] : $value['selling_price'],
                        'total' => $total,
                        'created_at' => now(),
                    ]);
                }
            }

            $customerPackageId = $customer_package->id;

            return redirect()->back()->with([
                'notification' => notification('Quotation Save Successfully', 'success'),
                'customerPackageId' => $customerPackageId,
            ]);
        }

        return redirect()->back()->with(notification('some problem occurs', 'error'));

        // Clear the session data if needed
        // Session::forget($packageDetails->first()->package->name);
    }

    public function PackageReport(Request $request)
    {
        $id = $request->query('id');
        $customerPackage = CustomerPackage::with('customerPackageItems.product', 'package', 'vendor')->findOrFail($id);
        $currency = Currency::limit(1)->get()->first();
        $setting = SiteSetting::first();

        return view('frontend.quotationbuilder.quotation_report', compact('setting', 'currency', 'customerPackage'));
    }
}
