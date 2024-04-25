<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\SaleController;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\Product;
use App\Models\ShipDivision;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\Price;

class PurchaseController extends Controller
{
    public function Checkout()
    {
        if (Auth::check()) {

            // if (Session::has('coupons')) {
            //     // Get all the applied coupons data from the session
            //    return $couponsData = Session::get('coupons');
            //     // Add the $couponsData to the response array
            //     $responseArray['couponsData'] = $couponsData;
            // }

            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();
                $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
                $divisions = ShipDivision::orderBy('name', 'ASC')->get();

                // $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
                return view('frontend.purchase.checkout', compact('carts', 'divisions', 'cartQty', 'cartTotal', 'currency'));
            } else {
                $notification = [
                    'message' => 'Shopping at least one product',
                    'type' => 'error',
                ];

                return redirect()->to('/')->with($notification);
            }
        } else {
            $notification = [
                'message' => 'you din not login yet',
                'type' => 'error',
            ];

            return redirect()->route('login')->with($notification);
        }
    }

    public function Buy(Request $request, $id)
    {

        $saleController = new SaleController();
        $stock = $saleController->getStock(base64_decode($id));

        if ($stock > 0) {
            if (Session::has('buying_coupons')) {
                Session::forget('buying_coupons');
            }
            if (Session::has('buying_data')) {
                Session::forget('buying_data');
            }
            // return $buyingData = Session::get('buying_data');
            $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
            $divisions = ShipDivision::orderBy('name', 'ASC')->get();
            $product = Product::findOrFail(base64_decode($id));

            $qty = $request->qty;
            $price = $product->selling_price;
            $discount = $product->discount_price;

            // Calculate subtotal based on quantity, price, and discount
            if ($discount !== null) {
                $subtotal = $qty * $discount;
            } else {
                $subtotal = $qty * $price;
            }

            //unset($sessionCoupons[$couponName]);

            //Store the data as an array in the session
            Session::put('buying_data', [
                'product' => $product,
                'qty' => $qty,
                'subtotal' => $subtotal,
                'discount' => 0,
                'total' => $subtotal,
            ]);

            return view('frontend.purchase.buy', compact('product', 'subtotal', 'qty', 'currency', 'divisions'));

        } else {
            $notification = [
                'message' => 'this product is out of stock',
                'type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

    }

    // public function ApplyCouponToBuy(Request $request)
    // {
    //     $total = 0;
    // 	$discount = 0;

    // 	$couponName = $request->coupon;
    // 	$coupon = Coupon::where('coupon_name', $couponName)
    // 		->where('coupon_validity', ">=", Carbon::now()->format('Y-m-d'))
    // 		->first();
    // 	$sessionCoupons = Session::get('buying_coupons') ?? [];
    //     $subtotal = $sessionCoupons['subtotal'];

    //     if (isset($sessionCoupons[$couponName])) {
    // 		return response()->json(notification('Coupon Already Used', 'warning'));
    // 	}

    //     if ($coupon) {

    //         if (empty($sessionCoupons)) {
    // 			$newCoupon = [
    // 				'coupon_name' => $coupon->coupon_name,
    // 				'coupon_discount' => $coupon->coupon_discount,
    // 				'discount_amount' => ($subtotal * $coupon->coupon_discount) / 100,
    // 			];
    // 			$total = $subtotal - (($subtotal * $coupon->coupon_discount) / 100);
    // 			$discount = ($subtotal * $coupon->coupon_discount) / 100;
    // 		} else {
    // 			// Get the previous coupon's results from the session
    // 			// return $sessionCoupons;

    // 			$newCoupon = [
    // 				'coupon_name' => $coupon->coupon_name,
    // 				'coupon_discount' => $coupon->coupon_discount,
    // 				'discount_amount' => ($sessionCoupons['total'] * $coupon->coupon_discount) / 100,
    // 			];
    // 			$totalAmount = $sessionCoupons['total'] - (($sessionCoupons['total'] * $coupon->coupon_discount) / 100);
    // 			$totalDiscount = ($sessionCoupons['total'] ?? 0) + ($sessionCoupons['total'] * $coupon->coupon_discount) / 100;
    // 		}

    //     $sessionCoupons[$couponName] = $newCoupon;
    // 		$sessionCoupons['total'] = $total;
    // 		$sessionCoupons['discount'] = $discount;
    // 		Session::put('buying_coupons', $sessionCoupons);

    // 		return response()->json(notification('Coupon Successfully Applied', 'success'));
    // 	} else {
    // 		return response()->json(notification('Invalid Coupon', 'error'));
    // 	}

    // }

    public function ApplyCouponToBuy(Request $request)
    {
        $couponName = $request->coupon;
        $coupon = Coupon::where('coupon_name', $couponName)
            ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
            ->first();

        if (! $coupon) {
            return response()->json(notification('Invalid Coupon', 'error'));
        }

        $buyingData = Session::get('buying_data') ?? [];
        $subtotal = $buyingData['subtotal'];

        $sessionCoupons = Session::get('buying_coupons') ?? [];

        $total = $subtotal;
        $discount = 0;

        if (! isset($sessionCoupons[$couponName])) {

            if (empty($sessionCoupons)) {
                $newCoupon = [
                    'coupon_id' => $coupon->id,
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => ($subtotal * $coupon->coupon_discount) / 100,
                ];
                $total -= (($subtotal * $coupon->coupon_discount) / 100);
                $discount = ($subtotal * $coupon->coupon_discount) / 100;
            } else {
                // Get the previous coupon's results from the session
                // return $sessionCoupons;

                $newCoupon = [
                    'coupon_id' => $coupon->id,
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => ($sessionCoupons['total'] * $coupon->coupon_discount) / 100,
                ];
                $total = $sessionCoupons['total'] - (($sessionCoupons['total'] * $coupon->coupon_discount) / 100);
                $discount = $sessionCoupons['discount'] + ($sessionCoupons['total'] * $coupon->coupon_discount) / 100;
            }
            $sessionCoupons[$couponName] = $newCoupon;
            $sessionCoupons['total'] = $total;
            $sessionCoupons['discount'] = $discount;
            Session::put('buying_coupons', $sessionCoupons);

            $buyingCouponData = Session::get('buying_coupons') ?? [];

            return response()->json(notification('Coupon Successfully Applied', 'success'));
        } else {
            return response()->json(notification('Coupon Already Used', 'warning'));
        }
    }

    public function getBuyingCouponData()
    {
        $buyingCouponData = Session::get('buying_coupons') ?? [];
        $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();

        return response()->json([
            'currency' => $currency,
            'buyingCouponData' => $buyingCouponData,
        ]);

    }

    public function removeBuyingCouponData(Request $request)
    {
        $couponName = $request->coupon;

        // Get the current coupon data from the session
        $sessionCoupons = Session::get('buying_coupons') ?? [];

        if (isset($sessionCoupons[$couponName])) {
            $discountAmount = $sessionCoupons[$couponName]['discount_amount'];

            // If there are previously applied coupons, update the total amount and total discount
            if (! empty($sessionCoupons)) {
                $total = $sessionCoupons['total'];
                $totalDiscount = $sessionCoupons['discount'];

                // Calculate the new total and total discount after removing the coupon
                $newTotalAmount = $total + $discountAmount;
                $newTotalDiscount = $totalDiscount - $discountAmount;

                // Update the session data with the new totals
                $sessionCoupons['total'] = $newTotalAmount;
                $sessionCoupons['discount'] = $newTotalDiscount;
            }

            // Remove the specific coupon from the session
            unset($sessionCoupons[$couponName]);

            // Check if there are any other keys in $sessionCoupons
            $otherKeys = array_diff(array_keys($sessionCoupons), ['total', 'discount']);
            if (empty($otherKeys)) {
                // Forget the entire $sessionCoupons
                Session::forget('buying_coupons');
            } else {
                // Put the updated coupon data back into the session
                Session::put('buying_coupons', $sessionCoupons);
            }

            return response()->json(['message' => 'Coupon removed successfully'], 200);
        }

        return response()->json(['message' => 'Coupon not found'], 404);
    }
}
