<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function ViewWishlist()
    {
        if (Auth::check()) {
            $currency = Currency::where('status', 1)->orderBy('id', 'DESC')->first();
            $wishlists = Wishlist::with('product')->where('user_id', Auth::id())->latest()->orderBy('id', 'DESC')->get();

            return view('frontend.wishlist.wishlist', compact('wishlists', 'currency'));
        } else {
            return redirect()->back()->with(notification('Please log in to view your wishlist', 'error'));
        }
    }

    public function RemoveWishlist(Request $request)
    {
        Wishlist::where('user_id', Auth::id())->where('id', $request->id)->delete();

        return response()->json(notification('Remove from wishlist successfully', 'success'));
    }

    public function AddToWishlist(Request $request)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $request->id)->first();
            if (! $exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $request->id,
                    'created_at' => Carbon::now(),
                ]);

                return response()->json(notification('Successfully Added On Your Wishlist', 'success'));
            } else {
                return response()->json(notification('This product already add to your Wishlist', 'error'));
            }
        } else {
            return response()->json(notification('At First Login Your Account', 'error'));
        }
    }
}
