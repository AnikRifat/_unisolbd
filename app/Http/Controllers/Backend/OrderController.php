<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\SaleDetails;
use App\Models\SaleInvoice;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function PendingOrder(){
        $orders=Order::where('status','Pending')->orderBy('id','DESC')->get();
        return view('backend.orders.pending_orders',compact('orders'));
    }

    public function PendingOrderDetails($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
    	$orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
    	return view('backend.orders.pending_orders_details',compact('order','orderItem'));
    }

    public function ConfirmedOrder(){
        $orders=Order::where('status','Confirmed')->orderBy('id','DESC')->get();
        return view('backend.orders.confirmed_orders',compact('orders'));
       
    }

    public function ProcessingOrder(){
        $orders=Order::where('status','Processing')->orderBy('id','DESC')->get();
        return view('backend.orders.processing_orders',compact('orders'));
       
    }

    public function PickedOrder(){
        $orders=Order::where('status','Picked')->orderBy('id','DESC')->get();
        return view('backend.orders.picked_oders',compact('orders'));
       
    }

    public function ShippedOrder(){
        $orders=Order::where('status','Shipped')->orderBy('id','DESC')->get();
        return view('backend.orders.shipped_orders',compact('orders'));
       
    }

    public function DeliveredOrder(){
        $orders=Order::where('status','Delivered')->orderBy('id','DESC')->get();
        return view('backend.orders.delivered_orders',compact('orders'));
       
    }

    public function CancelOrder(){
        $orders=Order::where('status','Cancel')->orderBy('id','DESC')->get();
        return view('backend.orders.cancel_orders',compact('orders'));
       
    }
    public function PendingToConfirm($order_id){
        Order::findOrFail($order_id)->update(['status' => 'Confirmed']);
        $notification= array([
            'message' => 'Order Confirm Successfully',
            'type' => 'success'
        ]);
        return redirect()->route('pending-orders')->with($notification);
    }

    public function ConfirmToProcessing($order_id){
        Order::findOrFail($order_id)->update(['status' => 'Processing']);
        $notification= array([
            'message' => 'Order Processing Successfully',
            'type' => 'success'
        ]);
        return redirect()->route('confirmed-orders')->with($notification);
    }

    public function ProcessingToPicked($order_id){
        Order::findOrFail($order_id)->update(['status' => 'Picked']);
        $notification= array([
            'message' => 'Order Picked Successfully',
            'type' => 'success'
        ]);
        return redirect()->route('processing-orders')->with($notification);
    }

    public function PickedToShipped($order_id){
        Order::findOrFail($order_id)->update(['status' => 'Shipped']);
        $notification= array([
            'message' => 'Order Shipped Successfully',
            'type' => 'success'
        ]);
        return redirect()->route('picked-orders')->with($notification);
    }

    // public function ShippedToDelivered($order_id){

    //     $order = Order::with("orderItems")->find($order_id);
    //     $sale = new SaleController();
    //     $invoice_no = $sale->generateInvoiceNumber();

    //     DB::beginTransaction();
    
    //     try {
    //       $saleInvoiceId = SaleInvoice::insertGetId([
    //         "type" => 3,
    //         'invoice_no' => $invoice_no,
    //         'order_id' => $order_id,
    //         "sale_date" => Carbon::parse($order->created_at)->format('Y-m-d'),
    //         "grand_total" => $order->total_amount,
    //         "total_amount" => $order->total_amount,
    //         "discount" => $order->discount_amount,
    //         "sales_channel" => "online",
    //         "net_payable" => $order->payable_amount,
    //         "total_paid" => $order->paid_amount,
    //         "total_due" => ($order->payable_amount-$order->paid_amount),
    //         "created_by" => Auth::guard('admin')->user()->id,
    //         "created_at" => Carbon::now()
    //       ]);
    
    //       for ($i = 0; $i < count($order->orderItems); $i++) {
    //           SaleDetails::insert([
    //             "sale_invoice_id" => $saleInvoiceId,
    //             "product_id" => $order->orderItems[$i]->product_id,
    //             "unit_id" => 1,
    //             "qty" =>$order->orderItems[$i]->qty,
    //             "price" => $order->orderItems[$i]->price,
    //             "unit_cost" => $order->orderItems[$i]->price,
    //             "total" => $order->orderItems[$i]->subtotal,
    //             "subtotal" => $order->orderItems[$i]->subtotal,
    //             "created_by" => Auth::guard('admin')->user()->id,
    //             "created_at" => Carbon::now()
    //           ]);
    //       }
    
    
    //       if ($order->paid_amount != null) {
    //         Transaction::insert([
    //           "invoice_id" => $saleInvoiceId,
    //           "last_paid" => $order->total_paid,
    //           "type" => 3,
    //           "created_by" => Auth::guard('admin')->user()->id,
    //           "created_at" => Carbon::now()
    //         ]);
    //       }
    
    //       // If the loop completes successfully, commit the transaction and remove session data
    //       DB::commit();
        
    //     } catch (\Exception $e) {
    //       DB::rollBack();
    
    //       $notification = [
    //         'message' => 'Error Occurred: ' . $e->getMessage(),
    //         'type' => 'error',
    //       ];
    //       return redirect()->back()->with($notification);
    //     }
      
    //     Order::findOrFail($order_id)->update(['status' => 'Delivered']);
    //     $notification= array([
    //         'message' => 'Order Delivered Successfully',
    //         'type' => 'success'
    //     ]);
    //     return redirect()->route('shipped-orders')->with($notification);
    // }


    public function ShippedToDelivered(Request $request, $order_id){
        // Ensure the order exists and is in the "Shipped" status.
        $order = Order::with("orderItems")->find($order_id);
    
        if (!$order || $order->status !== 'Shipped') {
            $notification = [
                'message' => 'Invalid order or order is not in "Shipped" status.',
                'type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    
        // Use a try-catch block to handle exceptions and rollback if necessary.
        try {
            DB::beginTransaction();
    
            // Generate an invoice number using your SaleController.
            $sale = new SaleController();
            $invoice_no = $sale->generateInvoiceNumber();
    
            // Create a new SaleInvoice record.
            $saleInvoice = SaleInvoice::create([
                "type" => 3,
                'invoice_no' => $invoice_no,
                'order_id' => $order_id,
                "sale_date" => Carbon::parse($order->created_at)->format('Y-m-d'),
                "grand_total" => $order->total_amount,
                "total_amount" => $order->total_amount,
                "discount" => $order->discount_amount,
                "sales_channel" => "online",
                "net_payable" => $order->payable_amount,
                "total_paid" => $order->paid_amount,
                "total_due" => ($order->payable_amount - $order->paid_amount),
                "created_by" => Auth::guard('admin')->user()->id,
            ]);
    
            // Create SaleDetails records for each order item.
            foreach ($order->orderItems as $item) {
                SaleDetails::create([
                    "sale_invoice_id" => $saleInvoice->id,
                    "product_id" => $item->product_id,
                    "unit_id" => 1,
                    "qty" => $item->qty,
                    "price" => $item->price,
                    "unit_cost" => $item->price,
                    "total" => $item->subtotal,
                    "subtotal" => $item->subtotal,
                    "created_by" => Auth::guard('admin')->user()->id,
                ]);
            }
    
            // Create a Transaction record if a payment was made.
            if ($order->paid_amount !== null) {
                Transaction::create([
                    "invoice_id" => $saleInvoice->id,
                    "last_paid" => $order->total_paid,
                    "type" => 3,
                    "created_by" => Auth::guard('admin')->user()->id,
                ]);
            }
    
            // Update the order status to "Delivered."
            $order->update(['status' => 'Delivered']);
    
            // Commit the transaction.
            DB::commit();
    
            $notification = [
                'message' => 'Order Delivered Successfully',
                'type' => 'success',
            ];
            return redirect()->route('shipped-orders')->with($notification);
    
        } catch (\Exception $e) {
            DB::rollBack();
    
            $notification = [
                'message' => 'Error Occurred: ' . $e->getMessage(),
                'type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function DeliveredToCancel($order_id){
        Order::findOrFail($order_id)->update(['status' => 'Cancel']);
        $notification= array([
            'message' => 'Order Cancel Successfully',
            'type' => 'success'
        ]);
        return redirect()->route('delivered-orders')->with($notification);
    }

    public function InvoiceDownload($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
    	$orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
       // return view('frontend.user.order.order_invoice',compact('order','orderItem'));
        $pdf = Pdf::loadView('frontend.user.order.order_invoice', compact('order','orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
    ]);
        return $pdf->download('invoice.pdf');
    }


    
    }
    
    

    

    

    

