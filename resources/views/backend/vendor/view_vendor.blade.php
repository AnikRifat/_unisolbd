@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">


                <div class="box">
                    <div class="d-flex justify-content-between">
                        <div class="box-header with-border">
                            <h3 class="box-title">Vendor List</h3>
                        </div>
                        <div class="box-header with-border">
                            <a href="{{ route('vendor.create') }}" class="btn btn-sm btn-dark">Add Vendor</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendors as $vendor)
                                            <tr>
                                                <td>{{ $vendor->type==1?"supplier":"customer" }}</td>
                                                <td>{{ $vendor->name }}</td>
                                                <td>{{ $vendor->address }}</td>
                                                <td>{{ $vendor->phone }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('vendor.edit', $vendor->id) }}"
                                                        class="btn btn-sm btn-info"><i class="fa-solid fa-pen"></i></a>
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
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
@endsection
