@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">



                <div class="box-header with-border">
                    <h3 class="box-title">Create Vendor</h3>
                </div>
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        
                            <form method="POST" action="{{ route('vendor.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="info-title">Type</label>
                                            <select name="type" id="type" class="form-control form-control-sm">
                                                <option value="1">Supplier</option>
                                                <option value="2">Customer</option>
                                            </select>
                                            @error('type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="info-title">Name<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="name" name="name" class="form-control form-control-sm">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="info-title">Address<span class="text-danger">*</span></label>
                                            <textarea name="address" id="address" class="form-control form-control-sm" rows="1"></textarea>
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="info-title">Details<span class="text-danger">*</span></label>
                                            <textarea name="details" id="details" class="form-control form-control-sm" rows="1"></textarea>
                                            @error('details')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="info-title">Opening Balance<span class="text-danger">*</span></label>
                                            <input type="text" name="opening_balance" class="form-control">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="info-title">Email<span class="text-danger">*</span></label>
                                            <input type="Email" name="email" class="form-control">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="info-title">Phone<span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="info-title">NID<span class="text-danger">*</span></label>
                                            <input type="text" name="nid" class="form-control">
                                            @error('nid')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="info-title">NID Front Picture<span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="nid_front" class="form-control">
                                            @error('nid_front')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="info-title">NID Back Picture<span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="nid_back" class="form-control">
                                            @error('nid_back')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>

                            </form>

                       
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
