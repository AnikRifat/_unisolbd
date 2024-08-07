<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function LoadDistrict($id)
    {
        $districts = ShipDistrict::where('division_id', $id)->orderBy('district_name', 'ASC')->get();

        return json_decode($districts);
    }

    public function LoadState($id)
    {
        $states = ShipState::where('district_id', $id)->orderBy('state_name', 'ASC')->get();

        return json_decode($states);
    }

    public function CheckoutStore(Request $request)
    {
        $data = [];
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;
        $data['notes'] = $request->notes;
        $cartTotal = Cart::total();

        if ($request->payment_method == 'stripe') {

            return view('frontend.payment.stripe', compact('data', 'cartTotal'));
        } elseif ($request->payment_method == 'card') {
            return 'data';
        } else {
            return view('frontend.payment.cash', compact('data', 'cartTotal'));
        }

    }
}
