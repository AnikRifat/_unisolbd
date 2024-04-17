<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Symfony\Contracts\Service\Attribute\Required;

class StripeController extends Controller
{
  public function StripeOrder(Request $request)
  {

    $request->validate([
      'address' => 'Required'
    ]);


     $order_id=Order::insertGetId([
    'user_id' => Auth::id(),
    'name' => $request->name,
    'email' => $request->email,
    'phone' => $request->phone,
    'address' => $request->address,
    'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
    'order_date' => Carbon::now()->format('d F Y'),
    'order_month' => Carbon::now()->format('F'),
    'order_year' => Carbon::now()->format('Y'),
    'status' => 'Pending',
    'created_at' => Carbon::now(),
  ]);

  $carts = Cart::content();
  foreach($carts as $cart) {
    OrderItem::insert([
      'order_id' => $order_id,
      'product_id' => $cart->id,
      'color' => $cart->options->color,
      'size' => $cart->options->size,
      'flavour' => $cart->options->flavour,
      'qty' => $cart->qty,
      'price' => $cart->price,
      'created_at' => Carbon::now(),
    ]);

  }

Cart::destroy();

  $notification=array(
        'message' => 'Your order place Successfully',
        'type' => 'success',
      );
      return redirect()->route('dashboard')->with($notification);
  }
}






  

      // 'division_id' => $request->division_id,
      // 'district_id' => $request->district_id,
      // 'state_id' => $request->state_id,
      // 'post_code' => $request->post_code,
      // 'payment_type' => 'stripe',
      // 'payment_method' => 'stripe',
      // 'payment_type' => $charge->payment_method,
      // 'transaction_id' => $charge->balance_transaction,
      // 'currency' => $charge->currency,
      // 'amount' => $total_amount,
      // 'order_number' => $charge->metadata->order_id,


     
  