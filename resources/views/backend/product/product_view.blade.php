@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Product List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>

                                            <th>Image</th>
                                            <th>Product Name</th>

                                            <th>Discount</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Products as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset($item->product_thambnail) }}" alt=""
                                                        style="width: 60px; height:50px;">
                                                </td>
                                                <td>{{ $item->product_name }}</td>

                                                <td>
                                                    @if ($item->discount_price == null)
                                                        <span class="bedge badge-fills bedge-danger">No Discount</span>
                                                    @else
                                                        @php
                                                            $amount = $item->selling_price - $item->discount_price;
                                                            $discount = ($amount / $item->selling_price) * 100;
                                                        @endphp
                                                        <span
                                                            class="badge badge-fills badge-danger">{{ round($discount) }}%</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge badge-fills badge-success"> Active </span>
                                                    @else
                                                        <span class="badge badge-fills badge-danger"> Inactive </span>
                                                    @endif
                                                </td>
                                                <td class="d-flex justify-content-center ">
                                                  <a href="{{ route('product.edit',$item->id) }}"  data-toggle="tooltip"
                                                      title="Edit Product"
                                                      class="btn btn-sm btn-info btnEdit mr-10"><i
                                                          class="fa-solid fa-pen-to-square"></i></a>

                                                  @if ($item->status == 1)
                                                      <form method="POST"
                                                          action="{{ route('inactive.product', $item->id) }}">
                                                          @csrf

                                                          <button data-toggle="tooltip" title="Inactive Specification"
                                                              class="btn btn-sm btn-danger mr-10"
                                                              href="javascript:void(0)"><i
                                                                  class="fa fa-arrow-up"></i></button>
                                                      </form>
                                                  @else
                                                      <form method="POST"
                                                          action="{{ route('active.product', $item->id) }}">
                                                          @csrf
                                                          <button data-toggle="tooltip" title="Active Specification"
                                                              class="btn btn-sm btn-success mr-10"
                                                              href="javascript:void(0)"><i
                                                                  class="fa fa-arrow-down"></i></button>
                                                      </form>
                                                  @endif
                                                  <form method="POST" class="ml-2"
                                                  action="{{ route('destroy.product', $item->id) }}">
                                                  @csrf
                                                  <button class="btn btn-sm btn-danger"
                                                  href="javascript:void(0)"><i
                                                      class="fa fa-trash"></i></button>
                                              </form>
                                              </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>






@endsection
