<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Currency;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartPageController extends Controller
{
    public function MyCart()
    {
        // if (Cart::count() > 0) {
        //    $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
        //    $carts = Cart::content();
        //    $cartQty = Cart::count();
        //    $cartTotal = Cart::total();
        //    return view('frontend.wishlist.cart', compact('currency', 'carts', 'cartQty', 'cartTotal'));
        // } else {
        //    $notification = array(
        //       'message' => 'There are no cart in your cart list',
        //       'type' => 'warning',
        //    );
        //    return redirect()->route('home')->with($notification);
        // }

        $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return view('frontend.wishlist.cart', compact('currency', 'carts', 'cartQty', 'cartTotal'));
    }

    // public function cartQtyIncreaseDecrease(Request $request)
    // {

    //     $rowId = $request->input('rowId');
    //     $qty = $request->input('qty');

    //     Cart::update($rowId, $qty);

    //     $sessionCoupons = Session::get('coupons') ?? [];
    //     if (Cart::update($rowId, $qty)) {
    //       // Update the coupon data for each applied coupon
    //       foreach ($sessionCoupons as $couponName => $couponData) {
    //           // Skip 'total_amount' and 'total_discount'
    //           if ($couponName !== 'total_amount' && $couponName !== 'total_discount') {
    //               $coupon = Coupon::where('coupon_name', $couponName)
    //                   ->where('coupon_validity', ">=", Carbon::now()->format('Y-m-d'))
    //                   ->first();

    //               if ($coupon) {

    //               }

    //             }

    //          }

    //       }

    //     return response()->json(['message' => 'Cart quantity updated successfully'], 200);
    // }

    // public function cartQtyIncreaseDecrease(Request $request)
    // {

    //    $totalAmount = 0;
    //    $totalDiscount = 0;

    //    $rowId = $request->input('rowId');
    //    $qty = $request->input('qty');

    //    // Get the current coupon data from the session
    //    $sessionCoupons = Session::get('coupons') ?? [];
    //    Cart::update($rowId, $qty)
    //    if (Session::has('coupons')) {
    //       $sessionCoupons['total_amount'] = round(Cart::total());
    //       $sessionCoupons['total_discount'] = 0;
    //       Session::put('coupons', $sessionCoupons);

    //       // Update the coupon data for each applied coupon
    //       foreach ($sessionCoupons as $couponName => $couponData) {
    //          $total = $sessionCoupons['total_amount'];
    //          $discount= $sessionCoupons['total_discount'];

    //          // Skip 'total_amount' and 'total_discount'
    //          if ($couponName !== 'total_amount' && $couponName !== 'total_discount') {
    //             $coupon = Coupon::where('coupon_name', $couponName)
    //                ->where('coupon_validity', ">=", Carbon::now()->format('Y-m-d'))
    //                ->first();

    //             if ($coupon) {
    //                // Update the coupon data based on the cart total
    //                $couponData = [
    //                   'coupon_name' => $coupon->coupon_name,
    //                   'coupon_discount' => $coupon->coupon_discount,
    //                   'discount_amount' => ($total * $coupon->coupon_discount) / 100,
    //                ];

    //                $totalAmount = ($total - ($total * $coupon->coupon_discount) / 100);
    //                $totalDiscount = ($discount ?? 0) + ($total * $coupon->coupon_discount) / 100;

    //                $sessionCoupons[$couponName] = $couponData;
    //                $sessionCoupons['total_amount'] = $totalAmount;
    //                $sessionCoupons['total_discount'] = $totalDiscount;
    //                Session::put('coupons', $sessionCoupons);
    //             }
    //          }
    //       }

    //    }

    //    return response()->json(['message' => 'Cart quantity updated successfully'], 200);
    // }

    public function cartQtyIncreaseDecrease(Request $request)
    {
        $rowId = $request->input('rowId');
        $qty = $request->input('qty');
        Cart::update($rowId, $qty);

        $this->UpdateCouponData();

        return response()->json(['message' => 'Cart quantity updated successfully'], 200);
    }

    public function UpdateCouponData()
    {
        // Get the current coupon data from the session
        $sessionCoupons = Session::get('coupons') ?? [];

        if (Session::has('coupons')) {
            $sessionCoupons['total_amount'] = round(Cart::total());
            $sessionCoupons['total_discount'] = 0;
            Session::put('coupons', $sessionCoupons);

            // Update the coupon data for each applied coupon
            foreach ($sessionCoupons as $couponName => $couponData) {
                $total = $sessionCoupons['total_amount'];
                $discount = $sessionCoupons['total_discount'];

                // Skip 'total_amount' and 'total_discount'
                if ($couponName !== 'total_amount' && $couponName !== 'total_discount') {
                    $coupon = Coupon::where('coupon_name', $couponName)
                        ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
                        ->first();

                    if ($coupon) {
                        // Update the coupon data based on the cart total
                        $couponData = [
                            'coupon_name' => $coupon->coupon_name,
                            'coupon_discount' => $coupon->coupon_discount,
                            'discount_amount' => ($total * $coupon->coupon_discount) / 100,
                        ];

                        $totalAmount = ($total - ($total * $coupon->coupon_discount) / 100);
                        $totalDiscount = ($discount ?? 0) + ($total * $coupon->coupon_discount) / 100;

                        $sessionCoupons[$couponName] = $couponData;
                        $sessionCoupons['total_amount'] = $totalAmount;
                        $sessionCoupons['total_discount'] = $totalDiscount;
                        Session::put('coupons', $sessionCoupons);
                    }
                }
            }
        }
    }

    public function GetCartProduct()
    {
        $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'currency' => $currency,
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),

        ]);
    }

    public function RemoveCart($rowId)
    {
        Cart::remove($rowId);
        // if (Session::has('coupon')) {
        //    $coupon_name = Session::get('coupon')['coupon_name'];
        //    $coupon = Coupon::where('coupon_name', $coupon_name)->first();
        //    $cartTotal = round(Cart::total());

        //    Session::put('coupon', [

        //       'coupon_name' => $coupon->coupon_name,
        //       'coupon_discount' => $coupon->coupon_discount,
        //       'discount_amount' => ($cartTotal * $coupon->coupon_discount) / 100,
        //       'total_amount' => $cartTotal - (($cartTotal * $coupon->coupon_discount) / 100),
        //    ]);
        //    if (Cart::count() == 0) {
        //       Session::forget('coupon');
        //    }
        // }

        $notification = [
            'message' => 'cart remove successfully',
            'type' => 'warning',
        ];

        return response()->json($notification);
    }

    public function CartIncrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();
            $cartTotal = round(Cart::total());

            Session::put('coupon', [

                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => ($cartTotal * $coupon->coupon_discount) / 100,
                'total_amount' => $cartTotal - (($cartTotal * $coupon->coupon_discount) / 100),
            ]);
        }

        return response()->json(['Successfully Increment']);
    }

    public function CartDecrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();
            $cartTotal = round(Cart::total());

            Session::put('coupon', [

                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => ($cartTotal * $coupon->coupon_discount) / 100,
                'total_amount' => $cartTotal - (($cartTotal * $coupon->coupon_discount) / 100),
            ]);
        }

        return response()->json(['Successfully Decrement']);
    }
}
