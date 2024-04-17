<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\CartPageController;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\Product;
use App\Models\ShipDivision;
use App\Models\Wishlist;
use Carbon\Carbon;
use Faker\Core\Number;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Type\Integer;

class CartController extends Controller
{


	public function AddToCart(Request $request)
	{
		$product = Product::findOrFail($request->id);
		Cart::add([
			'id' => $request->id,
			'name' => $product->product_name,
			'qty' => $request->qty,
			'price' => $product->discount_price != null ? $product->discount_price : $product->selling_price,

			'weight' => 0, // Add the 'weight' key with a value of 0 or an appropriate value
			'options' => [
				'image' => $product->product_thambnail,
				'discount' => $product->discount_price,
				'price' => $product->selling_price,
			],
		]);

		$coupon = new CartPageController;
		$coupon->UpdateCouponData();

		$notification = [
			'message' => 'Successfully Added on Your Cart',
			'type' => 'success',
		];

		return response()->json([
			'notification' => $notification,
		]);
	}


	// Mini Cart Section
	public function getCartData()
	{
		$currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
		
		$carts = Cart::content();
		$cartQty = Cart::count();
		$cartTotal = Cart::total();

		$responseArray = [
			'currency' => $currency,
			'carts' => $carts,
			'cartQty' => $cartQty,
			'cartTotal' => round($cartTotal),
		];

		if (Session::has('coupons')) {
			// Get all the applied coupons data from the session
			$couponsData = Session::get('coupons');
			// Add the $couponsData to the response array
			$responseArray['couponsData'] = $couponsData;
		}

		return response()->json($responseArray);
	}


	public function RemoveCart(Request $request)
	{

		Cart::remove($request->rowId);
		
		if (Cart::count() == 0) {
			Session::forget('coupons');
		} else {
			$coupon = new CartPageController;
			$coupon->UpdateCouponData();
		}

		$notification = [
			'message' => 'Remove cart form cart List',
			'type' => 'warning',
		];


		return response()->json([
			'notification' => $notification,
		]);
	}


	// public function ApplyCoupon(Request $request)
	// {

	// 	// return $request;
	// 	$coupon = Coupon::where('coupon_name', $request->coupon)->where('coupon_validity', ">=", Carbon::now()->format('Y-m-d'))->first();

	// 	$cartTotal = round(Cart::total());
	// 	if ($coupon) {
	// 		Session::put('coupon', [

	// 			'coupon_name' => $coupon->coupon_name,
	// 			'coupon_discount' => $coupon->coupon_discount,
	// 			'discount_amount' => ($cartTotal * $coupon->coupon_discount) / 100,
	// 			'total_amount' => $cartTotal - (($cartTotal * $coupon->coupon_discount) / 100),


	// 		]);
	// 		return response()->json(notification("Coupon Successful Applied", "success"));
	// 	} else {
	// 		return response()->json(notification("Invalid Coupon", "error"));
	// 	}
	// }

	// public function ApplyCoupon(Request $request)
	// {
	// 	$couponName = $request->coupon;
	// 	$coupon = Coupon::where('coupon_name', $couponName)
	// 		->where('coupon_validity', ">=", Carbon::now()->format('Y-m-d'))
	// 		->first();

	// 	$cartTotal = round(Cart::total());
	// 	$sessionCoupons = Session::get('coupons') ?? [];

	// 	// Check if the coupon is already used in the session
	// 	foreach ($sessionCoupons as $sessionCoupon) {
	// 		if ($sessionCoupon[$couponName] === $couponName) {
	// 			return response()->json(notification('Coupon Already Used', 'warning'));
	// 		}
	// 	}

	// 	if ($coupon) {
	// 		$newCoupon = [
	// 			'coupon_name' => $coupon->coupon_name,
	// 			'coupon_discount' => $coupon->coupon_discount,
	// 			'discount_amount' => ($cartTotal * $coupon->coupon_discount) / 100,
	// 			'total_amount' => $cartTotal - (($cartTotal * $coupon->coupon_discount) / 100),
	// 		];

	// 		// Add the new coupon to the session array
	// 		$sessionCoupons[] = $newCoupon;
	// 		Session::put('coupons', $sessionCoupons);

	// 		return response()->json(notification('Coupon Successfully Applied', 'success'));
	// 	} else {
	// 		return response()->json(notification('Invalid Coupon', 'error'));
	// 	}
	// }

	// 	public function ApplyCoupon(Request $request)
	// {

	// 	$totalAmount=0;
	// 	$totalDiscount=0;

	//     $couponName = $request->coupon;
	//     $coupon = Coupon::where('coupon_name', $couponName)
	//                     ->where('coupon_validity', ">=", Carbon::now()->format('Y-m-d'))
	//                     ->first();

	//     $cartTotal = round(Cart::total());
	//     $sessionCoupons = Session::get('coupons') ?? [];

	//     // Check if the coupon is already used in the session
	//     if (isset($sessionCoupons[$couponName])) {
	//         return response()->json(notification('Coupon Already Used', 'warning'));
	//     }

	//     if ($coupon) {
	//         // If there are no previously applied coupons, calculate based on cart total
	//         if (empty($sessionCoupons)) {
	//             $newCoupon = [
	//                 'coupon_name' => $coupon->coupon_name,
	//                 'coupon_discount' => $coupon->coupon_discount,
	//                 'discount_amount' => ($cartTotal * $coupon->coupon_discount) / 100,
	//             ];
	// 			$totalAmount = $cartTotal - (($cartTotal * $coupon->coupon_discount) / 100);
	// 			$totalDiscount = ($cartTotal * $coupon->coupon_discount) / 100;

	//         } else {
	//             // Get the previous coupon's results from the session
	//             $previousCoupon = end($sessionCoupons);

	//             $newCoupon = [
	//                 'coupon_name' => $coupon->coupon_name,
	//                 'coupon_discount' => $coupon->coupon_discount,
	//                 'discount_amount' => ($previousCoupon['total_amount'] * $coupon->coupon_discount) / 100,

	// 			];
	// 			$totalAmount = $previousCoupon['total_amount'] - (($previousCoupon['total_amount'] * $coupon->coupon_discount) / 100);
	// 			$totalDiscount = ($previousCoupon['total_discount'] + ($cartTotal * $coupon->coupon_discount) / 100);
	//         }

	//         // Add the new coupon to the session array with coupon_name as the key
	//         $sessionCoupons[$couponName] = $newCoupon;
	// 		$sessionCoupon['total_amount'] = $totalAmount;
	// 		$sessionCoupon['total_discount'] = $totalDiscount;
	//         Session::put('coupons', $sessionCoupons);

	//         return response()->json(notification('Coupon Successfully Applied', 'success'));
	//     } else {
	//         return response()->json(notification('Invalid Coupon', 'error'));
	//     }
	// }


	public function ApplyCoupon(Request $request)
	{

		$totalAmount = 0;
		$totalDiscount = 0;

		$couponName = $request->coupon;
		$coupon = Coupon::where('coupon_name', $couponName)
			->where('coupon_validity', ">=", Carbon::now()->format('Y-m-d'))
			->first();

		$cartTotal = round(Cart::total());
		$sessionCoupons = Session::get('coupons') ?? [];

		// Check if the coupon is already used in the session
		if (isset($sessionCoupons[$couponName])) {
			return response()->json(notification('Coupon Already Used', 'warning'));
		}

		if ($coupon) {
			// If there are no previously applied coupons, calculate based on cart total
			if (empty($sessionCoupons)) {
				$newCoupon = [
					'coupon_name' => $coupon->coupon_name,
					'coupon_discount' => $coupon->coupon_discount,
					'discount_amount' => ($cartTotal * $coupon->coupon_discount) / 100,
				];
				$totalAmount = $cartTotal - (($cartTotal * $coupon->coupon_discount) / 100);
				$totalDiscount = ($cartTotal * $coupon->coupon_discount) / 100;
			} else {
				// Get the previous coupon's results from the session
				// return $sessionCoupons;

				$newCoupon = [
					'coupon_name' => $coupon->coupon_name,
					'coupon_discount' => $coupon->coupon_discount,
					'discount_amount' => ($sessionCoupons['total_amount'] * $coupon->coupon_discount) / 100,
				];
				$totalAmount = $sessionCoupons['total_amount'] - (($sessionCoupons['total_amount'] * $coupon->coupon_discount) / 100);
				$totalDiscount = ($sessionCoupons['total_discount'] ?? 0) + ($sessionCoupons['total_amount'] * $coupon->coupon_discount) / 100;
			}

			// Add the new coupon to the session array with coupon_name as the key
			$sessionCoupons[$couponName] = $newCoupon;
			$sessionCoupons['total_amount'] = $totalAmount;
			$sessionCoupons['total_discount'] = $totalDiscount;
			Session::put('coupons', $sessionCoupons);

			return response()->json(notification('Coupon Successfully Applied', 'success'));
		} else {
			return response()->json(notification('Invalid Coupon', 'error'));
		}
	}

	public function AddToWishlist($product_id)
	{
		if (Auth::check()) {
			$exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();
			if (!$exists) {
				Wishlist::insert([
					'user_id' => Auth::id(),
					'product_id' => $product_id,
					'created_at' => Carbon::now(),
				]);
				return response()->json(['success' => 'Successfully Added On Your Wishlist']);
			} else {
				return response()->json(['error' => 'This product already add to your Wishlist']);
			}
		} else {
			return response()->json(['error' => 'At First Login Your Account']);
		}
	}


	// public function CouponApply(Request $request)
	// {


	// 	$coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', ">=", Carbon::now()->format('Y-m-d'))->first();

	// 	$cartTotal = round(Cart::total());
	// 	if ($coupon) {
	// 		Session::put('coupon', [

	// 			'coupon_name' => $coupon->coupon_name,
	// 			'coupon_discount' => $coupon->coupon_discount,
	// 			'discount_amount' => ($cartTotal * $coupon->coupon_discount) / 100,
	// 			'total_amount' => $cartTotal - (($cartTotal * $coupon->coupon_discount) / 100),


	// 		]);
	// 		return response()->json(array('success' => 'Coupon Successful Applied'));
	// 	} else {
	// 		return response()->json(['error' => 'invalid']);
	// 	}
	// }


	// public function CouponApply(Request $request)
	// {
	// 	$couponName = $request->coupon;
	// 	$coupon = Coupon::where('coupon_name', $couponName)
	// 		->where('coupon_validity', ">=", Carbon::now()->format('Y-m-d'))
	// 		->first();

	// 	$cartTotal = round(Cart::total());
	// 	$sessionCoupons = Session::get('coupons') ?? [];

	// 	if ($coupon) {
	// 		// Check if the coupon is already used in the session
	// 		foreach ($sessionCoupons as $sessionCoupon) {
	// 			if ($sessionCoupon['coupon_name'] === $couponName) {
	// 				return response()->json(['error' => 'Coupon Already Used']);
	// 			}
	// 		}

	// 		$newCoupon = [
	// 			'coupon_name' => $coupon->coupon_name,
	// 			'coupon_discount' => $coupon->coupon_discount,
	// 			'discount_amount' => ($cartTotal * $coupon->coupon_discount) / 100,
	// 			'total_amount' => $cartTotal - (($cartTotal * $coupon->coupon_discount) / 100),
	// 		];

	// 		// Add the new coupon to the session array
	// 		$sessionCoupons[] = $newCoupon;
	// 		Session::put('coupons', $sessionCoupons);

	// 		return response()->json(['success' => 'Coupon Successfully Applied', 'coupon' => $newCoupon]);
	// 	} else {
	// 		return response()->json(['error' => 'Invalid Coupon']);
	// 	}
	// }



	function CouponCalculation()
	{

		if (Session::has('coupon')) {
			return response()->json(array(
				'subTotal' => Cart::total(),
				'coupon_name' => session::get('coupon')['coupon_name'],
				'coupon_discount' => session::get('coupon')['coupon_discount'],
				'discount_amount' => session::get('coupon')['discount_amount'],
				'total_amount' => session::get('coupon')['total_amount'],
			));
		} else {
			return response()->json(array(
				'total' => Cart::total(),
			));
		}
	}

	// public function RemoveCoupon(Request $request)
	// {
	// 	$couponName = $request->coupon;

	// 	// Get the current coupon data from the session
	// 	$sessionCoupons = Session::get('coupons') ?? [];

	// 	if (isset($sessionCoupons[$couponName])) {
	// 		$discountAmount = $sessionCoupons[$couponName]['discount_amount'];
	// 		$total =  $sessionCoupons['total_amount'];
	// 		$totalDiscount =  $sessionCoupons['total_discount'];

	// 		// Calculate the new total and total discount after removing the coupon
	// 		$newTotalAmount = $total + $discountAmount;
	// 		$newTotalDiscount = $totalDiscount - $discountAmount;

	// 		// Update the session data with the new totals
	// 		$sessionCoupons['total_amount'] = $newTotalAmount;
	// 		$sessionCoupons['total_discount'] = $newTotalDiscount;

	// 		// Remove the specific coupon from the session
	// 		unset($sessionCoupons[$couponName]);

	// 		// Put the updated coupon data back into the session
	// 		Session::put('coupons', $sessionCoupons);


	// 	}



	// 	return response()->json(['message' => 'Coupon removed successfully'], 200);

	// 	return response()->json(['message' => 'Coupon not found'], 404);
	// }


	public function RemoveCoupon(Request $request)
	{
		$couponName = $request->coupon;

		// Get the current coupon data from the session
		$sessionCoupons = Session::get('coupons') ?? [];

		if (isset($sessionCoupons[$couponName])) {
			$discountAmount = $sessionCoupons[$couponName]['discount_amount'];

			// If there are previously applied coupons, update the total amount and total discount
			if (!empty($sessionCoupons)) {
				$total = $sessionCoupons['total_amount'];
				$totalDiscount = $sessionCoupons['total_discount'];

				// Calculate the new total and total discount after removing the coupon
				$newTotalAmount = $total + $discountAmount;
				$newTotalDiscount = $totalDiscount - $discountAmount;

				// Update the session data with the new totals
				$sessionCoupons['total_amount'] = $newTotalAmount;
				$sessionCoupons['total_discount'] = $newTotalDiscount;
			}

			// Remove the specific coupon from the session
			unset($sessionCoupons[$couponName]);

			// Check if there are any other keys in $sessionCoupons
			$otherKeys = array_diff(array_keys($sessionCoupons), ['total_amount', 'total_discount']);
			if (empty($otherKeys)) {
				// Forget the entire $sessionCoupons
				Session::forget('coupons');
			} else {
				// Put the updated coupon data back into the session
				Session::put('coupons', $sessionCoupons);
			}

			return response()->json(['message' => 'Coupon removed successfully'], 200);
		}

		return response()->json(['message' => 'Coupon not found'], 404);
	}






}
