@extends('frontend.main_master')

@section('content')
    <div class="body-content">

        <div class="container">
            <div class="row">
                @include('frontend.common.user_sidebar')

                <div class="col-md-1">

                </div>
                
                @if (!empty($order))
                <div class="col-md-9 table-responsive mt-5 mt-md-0">
                  <table class="table table-bordered text-center mb-0">
                      <thead class="bg-secondary text-dark">
                          <tr>
                              <th>Date</th>
                              <th>Total</th>
                              <th>Payment</th>
                              <th>Invoice</th>
                              <th>Order</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody class="align-middle">
                        @foreach ($orders as $order)
                        <tr>
                            <td class="align-middle">
                                <label for=""> {{ $order->order_date }}</label>
                            </td>

                            <td class="align-middle">
                                <label for=""> ${{ $order->amount }}</label>
                            </td>


                            <td class="align-middle">
                                <label for=""> {{ $order->payment_method }}</label>
                            </td>

                            <td class="align-middle">
                                <label for=""> {{ $order->invoice_no }}</label>
                            </td>

                            <td class="align-middle">
                                <label for="">
                                    <span class="badge badge-pill badge-warning"
                                        style="background: #418DB9;">{{ $order->status }} </span>
                                    <span class="badge badge-pill badge-warning" style="background:red;">Return
                                        Requested </span>

                                </label>
                            </td>

                            <td class="align-middle">
                                <a href="{{ url('user/order-details/' . $order->id) }}"
                                    class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a>

                                <a target="_blank" href="{{ url('user/invoice_download/' . $order->id) }}"
                                    class="btn btn-sm btn-danger"><i class="fa fa-download"
                                        style="color: white;"></i> Invoice </a>

                            </td>

                        </tr>
                    @endforeach
                              
                      </tbody>
                  </table>
              </div>  
                @endif
             


            </div>
        </div>
    </div>
@endsection()
