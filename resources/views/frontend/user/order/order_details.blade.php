@extends('frontend.main_master')

@section('content')

<div class="body-content">

<div class="container">
    <div class="row">
       @include('frontend.common.user_sidebar')
      <div class="col-md-5 mt-5 mt-md-0">
        <div class="card">
          <div class="card-header"><h4>Shipping Details</h4></div>
         <hr>
         <div class="card-body" style="background: #E9EBEC;">
           <table class="table">
            <tr>
              <th> Shipping Name : </th>
               <th> {{ $order->name }} </th>
            </tr>

             <tr>
              <th> Shipping Phone : </th>
               <th> {{ $order->phone }} </th>
            </tr>

             <tr>
              <th> Shipping Email : </th>
               <th> {{ $order->email }} </th>
            </tr>


            <tr>
              <th> Order Date : </th>
               <th> {{ $order->order_date }} </th>
            </tr>

           </table>


         </div> 

        </div>
      </div> <!-- // end col md -5 -->

      <div class="col-md-5">
        <div class="card">
          <div class="card-header"><h4>Order Details
        <span class="text-danger"> Invoice : {{ $order->invoice_no }}</span></h4>
          </div>
         <hr>
         <div class="card-body" style="background: #E9EBEC;">
           <table class="table">
            <tr>
              <th>  Name : </th>
               <th> {{ $order->user->name }} </th>
            </tr>

             <tr>
              <th>  Phone : </th>
               <th> {{ $order->user->phone }} </th>
            </tr>


             <tr>
              <th> Invoice  : </th>
               <th class="text-danger"> {{ $order->invoice_no }} </th>
            </tr>


            <tr>
              <th> Order : </th>
               <th>   
                <span class="badge badge-pill badge-warning" style="background: #418DB9;">{{ $order->status }} </span> </th>
            </tr>



           </table>


         </div> 

        </div>

      </div> <!-- // 2ND end col md -5 -->


    <div class="row">



      <div class="col-md-12">

                <div class="table-responsive">
                  <table class="table">
                    <tbody>

                      <tr style="background: #e2e2e2;">
                        <td class="col-md-1">
                          <label for=""> Image</label>
                        </td>

                        <td class="col-md-3">
                          <label for=""> Product Name </label>
                        </td>

                        <td class="col-md-3">
                          <label for=""> Product Code</label>
                        </td>


                        <td class="col-md-2">
                          <label for=""> Color </label>
                        </td>

                        <td class="col-md-2">
                          <label for=""> Size </label>
                        </td>

                        <td class="col-md-1">
                          <label for=""> Quantity </label>
                        </td>

                        <td class="col-md-1">
                          <label for=""> Price </label>
                        </td>

                      </tr>


                      @foreach($orderItem as $item)
              <tr>
                        <td class="col-md-1">
                          <label for=""><img src="{{ asset($item->product->product_thambnail) }}" height="50px;" width="50px;"> </label>
                        </td>

                        <td class="col-md-3">
                          <label for=""> {{ $item->product->product_name }}</label>
                        </td>


                        <td class="col-md-3">
                          <label for=""> {{ $item->product->product_code }}</label>
                        </td>

                        <td class="col-md-2">
                          <label for=""> {{ $item->color }}</label>
                        </td>

                        <td class="col-md-2">
                          <label for=""> {{ $item->size }}</label>
                        </td>

                        <td class="col-md-2">
                          <label for=""> {{ $item->qty }}</label>
                        </td>

                  <td class="col-md-2">
                          <label for=""> ${{ $item->price }}  ( $ {{ $item->price * $item->qty}} ) </label>
                        </td>

                      </tr>
                      @endforeach





                    </tbody>

                  </table>

        </div>
      </div> <!-- / end col md 8 -->
     
     
      </div>

      @if ($order->status=='Delivered')
        @if ($order->return_reason==NULL)
        <form action="{{ route('return.order',$order->id) }}" method="POST">
          @csrf
        <div class="form-group">
          <label for="">  Order Return Reason : </label>
          <textarea name="return_reason" id="" class="form-control" cols="30" rows="5" placeholder="describe your reason"></textarea>
        </div>  
        <button type="submit" class="btn btn-danger">Submit</button>
      </form>

        @else
        <span class="badge badge-pill" style="background: red">Your have sent return request for this product </span>

        @endif
      @endif
     <br>
</div>
</div>

@endsection()