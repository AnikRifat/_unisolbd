@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Coupon List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Discount</th>
                                            <th>Validity</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $item)
                                            <tr>
                                                <td>{{ $item->coupon_name }}</td>
                                                <td>{{ $item->coupon_discount }}%</td>
                                                <td>{{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y') }}
                                                </td>
                                                <td>
                                                    @if ($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d') && $item->status)
                                                        <span class="badge badge-fills badge-success">Valid</span>
                                                    @else
                                                        <span class="badge badge-fills badge-danger">Invalid</span>
                                                    @endif
                                                </td>

                                                <td class="d-flex justify-content-center">
                                                    <a data-edit="{{ base64_encode($item) }}" href="javascript:void(0)"
                                                        class="btn btn-sm btn-info btnEdit mr-10"><i
                                                            class="fa-solid fa-edit"></i></a>
                                                    {{-- <a href="{{ route('brand.destroy', $item->id) }}"class="btn btn-sm btn-danger mr-10"
                                                      id="delete"><i class="fa-sharp fa-solid fa-trash"></i></a> --}}


                                                    @if ($item->status == 1)
                                                        <form method="POST"
                                                            action="{{ route('inactive.coupon', $item->id) }}">
                                                            @csrf


                                                            <button class="btn btn-sm btn-danger"
                                                                href="javascript:void(0)"><i
                                                                    class="fa fa-arrow-up"></i></button>
                                                        </form>
                                                    @else
                                                        <form method="POST"
                                                            action="{{ route('active.coupon', $item->id) }}">
                                                            @csrf
                                                            <button class="btn btn-sm btn-success"
                                                                href="javascript:void(0)"><i
                                                                    class="fa fa-arrow-down"></i></button>
                                                        </form>
                                                    @endif
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



                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Coupon</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form id="couponForm" method="POST" action="{{ route('coupon.store') }}">
                                    @csrf
                                    @method('post')
                                    <div class="form-group">
                                        <label class="info-title">Coupon Code<span class="text-danger">*</span></label>
                                        <input type="text" name="coupon_name" class="form-control form-control-sm">
                                        @error('coupon_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="info-title">Coupon Discount(%)<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="coupon_discount" class="form-control form-control-sm">
                                        @error('coupon_discount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="info-title">Coupon Validity Date<span
                                                class="text-danger">*</span></label>
                                        <input type="date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                            name="coupon_validity" class="form-control form-control-sm">
                                        @error('coupon_validity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button id="btnSave" type="submit" class="btn  btn-sm btn-success">Save</button>
                                        <a id="btnClear" class="btn  btn-sm btn-primary">Clear</a>
                                    </div>

                                </form>

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



    <script>
        $(document).ready(function() {
            $('.btnEdit').click(function() {
                var base64EncodedValue = $(this).data('edit');
                var editData = JSON.parse(atob(base64EncodedValue));

                console.log(editData.id)

                $("input[name='coupon_name']").val(editData.coupon_name);
                $("input[name='coupon_discount']").val(editData.coupon_discount);
                $("input[name='coupon_validity']").val(editData.coupon_validity);

                $('#btnSave').remove();

                console.log(editData);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#couponForm').attr('action', "{{ route('coupon.update', ['coupon' => ':id']) }}"
                    .replace(
                        ':id', editData.id));

                // Change the method override field value to PUT
                $("input[name='_method']").val('PUT');

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();
            $("input[name='coupon_name']").val('');
            $("input[name='coupon_discount']").val('');
            $("input[name='coupon_validity']").val('');

            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#couponForm').attr('action', "{{ route('coupon.store') }}");

            // Change the method override field value to PUT
            $("input[name='_method']").val('POST');

        });
    </script>
@endsection
