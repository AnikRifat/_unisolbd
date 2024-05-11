@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Customer Group List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Rules</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customerGroups as $group)
                                            <tr>
                                                <td>{{ $group->name }}</td>
                                                <td>{{ $group->rules }}</td>
                                                <td>{{ $group->status }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('customer-groups.show', $group->id) }}"
                                                        class="btn btn-sm btn-info mr-1"><i
                                                            class="fa-solid fa-edit"></i></a>
                                                    <form action="{{ route('customer-groups.destroy', $group->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger mr-1"><i
                                                                class="fa-sharp fa-solid fa-trash"></i></button>
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

                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Customer Group</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form id="groupForm" method="POST" action="{{ route('customer-groups.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="info-title">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control form-control-sm">
                                    </div>

                                    <div class="form-group">
                                        <label class="info-title">Rules<span class="text-danger">*</span></label>
                                        <input type="text" name="rules" class="form-control form-control-sm">
                                    </div>

                                    <div class="form-group">
                                        <label class="info-title">Status<span class="text-danger">*</span></label>
                                        <input type="number" name="status" class="form-control form-control-sm">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn  btn-sm btn-success">Save</button>
                                        <button type="reset" class="btn  btn-sm btn-primary">Clear</button>
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
