<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\OrderItem;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        //  return $request;
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['name'] = $request->name;
        $post_data['email'] = $request->email;
        $post_data['address'] = $request->address;
        $post_data['phone'] = $request->phone;
        $post_data['division_id'] = $request->division_id;
        $post_data['district_id'] = $request->district_id;
        $post_data['state_id'] = $request->state_id;
        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['name'],
                'email' => $post_data['email'],
                'phone' => $post_data['phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['address'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);



        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function payViaAjax(Request $request)
    {

        $cartJson = $request->input('cart_json');
        $cartData = json_decode($cartJson, true);
        // return $cartData;


        if($cartData['route_name']=="buy")
        {
            $product = $cartData['product'];
            $qty = $cartData['qty'];
            $total_amount = $product['discount_price'] != null ? ($product['discount_price'] * $qty) : ($product['selling_price'] * $qty);
    

            if (Session::has('buying_coupons')) {
                $sessionCoupons = Session::get('buying_coupons') ?? [];
                $discount_amount = $sessionCoupons['discount']; // Assign the discount amount
                $payable_amount = $total_amount - $discount_amount; // Calculate payable amoun
    
                // Initialize an array to store keys other than 'total' and 'discount'
                $otherKeys = [];
                foreach ($sessionCoupons as $key => $value) {
                    // Exclude 'total' and 'discount' keys
                    if ($key !== 'total' && $key !== 'discount') {
                        $otherKeys[] = $key;
                    }
                }
                // Convert $otherKeys to a comma-separated string
                $otherKeysString = implode(',', $otherKeys);
                $coupon_code = $otherKeysString; // Assign the coupon code
            } else {
                $payable_amount = $total_amount; // If no coupon, payable amount remains the same
            }

            Session::forget('buying_coupons');
        }

        elseif($cartData['route_name']=="checkout")
        {
            $total_amount =Cart::total();
            if (Session::has('coupons')) {
                $sessionCoupons = Session::get('coupons') ?? [];
                $discount_amount = $sessionCoupons['total_discount']; // Assign the discount amount
                $payable_amount = $sessionCoupons['total_amount']; // Calculate payable amoun
    
                // Initialize an array to store keys other than 'total' and 'discount'
                $otherKeys = [];
                foreach ($sessionCoupons as $key => $value) {
                    // Exclude 'total' and 'discount' keys
                    if ($key !== 'total_amount' && $key !== 'total_discount') {
                        $otherKeys[] = $key;
                    }
                }
                // Convert $otherKeys to a comma-separated string
                $otherKeysString = implode(',', $otherKeys);
                $coupon_code = $otherKeysString; // Assign the coupon code
            } else {
                $payable_amount = $total_amount; // If no coupon, payable amount remains the same
            }

            Session::forget('coupons');
        }

        
        

       
        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.


        $post_data = array();

        //change here
        $post_data['total_amount'] = $total_amount; # You cant not pay less than 10

        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['name'] = $cartData['name'];
        $post_data['email'] = $cartData['email'];
        $post_data['address'] = $cartData['address'];
        $post_data['phone'] = $cartData['phone'];
        $post_data['division_id'] = $cartData['division_id'];
        $post_data['district_id'] = $cartData['district_id'];
        $post_data['state_id'] = $cartData['state_id'];
        $post_data['invoice_no'] = 'T3-' . mt_rand(10000000, 99999999);
        $post_data['order_number'] = 'ORD-' . mt_rand(10000000, 99999999);
        $post_data['payment_method'] = 'creditcard'; // Replace with the actual payment method
        $post_data['payment_type'] = 'card';
        $post_data['order_date'] = Carbon::now()->format('d F Y');
        $post_data['order_month'] = Carbon::now()->format('F');
        $post_data['order_year'] = Carbon::now()->format('Y');
        $post_data['user_id'] = Auth::guard('web')->user()->id;
        $post_data['created_at'] = Carbon::now();


        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        // First, check if the order with the given transaction_id exists
        $order = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->first();

        if (!$order) {
            // If the order doesn't exist, insert a new order
            $order_id = DB::table('orders')->insertGetId([
                'user_id' => $post_data['user_id'],
                'division_id' => $post_data['division_id'],
                'district_id' => $post_data['district_id'],
                'state_id' => $post_data['state_id'],
                'name' => $post_data['name'],
                'email' => $post_data['email'],
                'phone' => $post_data['phone'],
                'address' => $post_data['address'],
                'total_amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'discount_amount' => isset($discount_amount) ? $discount_amount : 0, // Assign discount amount
                'payable_amount' => $payable_amount, // Assign payable amount
                'coupon_code' => isset($coupon_code) ? $coupon_code : null, // Assign coupon code
                'invoice_no' => $post_data['invoice_no'],
                'order_number' => $post_data['order_number'],
                'payment_method' => $post_data['payment_method'],
                'payment_type' => $post_data['payment_type'],
                'order_date' => $post_data['order_date'],
                'order_month' => $post_data['order_month'],
                'order_year' => $post_data['order_year'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
                'created_at' => $post_data['created_at'],
            ]);
        } else {
            // If the order exists, update its status and retrieve the order ID
            DB::table('orders')
                ->where('transaction_id', $post_data['tran_id'])
                ->update(['status' => 'Pending']);

            $order_id = $order->id;
        }

        // Prepare the basic data for insertion

        if($cartData['route_name']=="buy"){
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $product['id'],
                'qty' => $qty,
                'price' => $product['discount_price'] != null ? $product['discount_price'] : $product['selling_price'],
                'subtotal' => $total_amount,
                'created_at' => Carbon::now(),
            ]);
        }

        elseif($cartData['route_name']=="checkout"){
            $carts = Cart::content();
            foreach($carts as $cart) {
              OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'subtotal' => $cart->subtotal,
                'created_at' => Carbon::now(),
              ]);
          
            }
          Cart::destroy();
        }
       
       


        $sslc = new SslCommerzNotification();



        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        return  $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    // public function payViaAjax(Request $request)
    // {
    //     return $routeName = Route::currentRouteName();

    // }

    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();
        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                echo "<br >Transaction is successfully Completed";
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            /*
            That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
            */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
