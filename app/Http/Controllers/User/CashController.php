<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CashController extends Controller
{
    public function CashOrder(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {

            $total_amount = round(Cart::total());
        }

        $order_id = Order::insertGetId([

            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,
            'payment_type' => 'cash on delivery',
            'payment_method' => 'cash on delivery',
            'currency' => 'usd',
            'amount' => $total_amount,
            'invoice_no' => 'EOS'.mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),
        ]);

        //Start send mail
        // $invoice = Order::findOrFail($order_id);
        // $data=[
        //   'invoice_no' => $invoice->invoice_no,
        //   'amount' => $total_amount,
        //   'name' => $invoice->name,
        //   'email' => $invoice->email,
        // ];

        // Mail::to($request->email)->send(new OrderMail($data));
        //end send mail
        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);

        }
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        $notification = [
            'message' => 'Your order place Successfully',
            'type' => 'success',
        ];

        return redirect()->route('dashboard')->with($notification);
    }
}
