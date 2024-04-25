<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllUserController extends Controller
{
    public function MyOrders()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();

        return view('frontend.user.order.order_view', compact('orders'));

    }

    public function OrderDetails($order_id)
    {

        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('frontend.user.order.order_details', compact('order', 'orderItem'));

    } // end mehtod

    public function InvoiceDownload($order_id)
    {
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        // return view('frontend.user.order.order_invoice',compact('order','orderItem'));
        $pdf = Pdf::loadView('frontend.user.order.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);

        return $pdf->download('invoice.pdf');
    }

    public function ReturnOrder(Request $request, $order_id)
    {
        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,

        ]);
        $notification = [
            'message' => 'Return Request Sent Sucessfully',
            'type' => 'success',
        ];

        return redirect()->route('my.orders')->with($notification);
    }

    public function ReturnOrderList()
    {
        $orders = Order::where('user_id', Auth::id())->where('return_reason', '!=', null)->orderBy('id', 'DESC')->get();

        return view('frontend.user.order.return_order_view', compact('orders'));
        $notification = [[
            'message' => 'Return Request Sent Sucessfully',
            'type' => 'success',
        ]];

        return redirect()->route('my.orders')->with($notification);
    }

    public function CancelOrders()
    {

        $orders = Order::where('user_id', Auth::id())->where('status', 'cancel')->orderBy('id', 'DESC')->get();

        return view('frontend.user.order.cancel_order_view', compact('orders'));

    } // end method

    public function OrderTracking(Request $request)
    {
        $invoice = $request->code;
        $track = Order::where('invoice_no', $invoice)->first();
        if ($track) {
            return view('frontend.tracking.tracking_order', compact('track'));
        } else {
            $notification = [
                'message' => 'Invoice Code is Invalid',
                'type' => 'error',
            ];

            return redirect()->back()->with($notification);

        }

    }
}
