@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="box-header with-border">
                    <h3 class="box-title">User Edit</h3>
                </div>
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                       <form method="POST" action="{{ route('customer.update', $user->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Name<span class="text-danger">*</span></label>
                <input type="text" value="{{ old('name', $user->name) }}" placeholder="Name" name="name" class="form-control form-control-sm">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- User Details Fields -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Company Name</label>
                <input type="text" value="{{ old('company_name', $user->userDetails?->company_name) }}" placeholder="Company Name" name="company_name" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Trade License Number</label>
                <input type="text" value="{{ old('trade_license_number', $user->userDetails?->trade_license_number) }}" placeholder="Trade License Number" name="trade_license_number" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">NID Number</label>
                <input type="text" value="{{ old('nid_no', $user->userDetails?->nid_no) }}" placeholder="NID Number" name="nid_no" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Passport Number</label>
                <input type="text" value="{{ old('passport_number', $user->userDetails?->passport_number) }}" placeholder="Passport Number" name="passport_number" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">BIN Number</label>
                <input type="text" value="{{ old('bin_num', $user->userDetails?->bin_num) }}" placeholder="BIN Number" name="bin_num" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">TIN Number</label>
                <input type="text" value="{{ old('tin_num', $user->userDetails?->tin_num) }}" placeholder="TIN Number" name="tin_num" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Address<span class="text-danger">*</span></label>
                <textarea name="address" id="address" class="form-control form-control-sm" rows="1">{{ old('address', $user->userDetails?->address) }}</textarea>
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">City<span class="text-danger">*</span></label>
                <input type="text" value="{{ old('city', $user->userDetails?->city) }}" placeholder="City" name="city" class="form-control form-control-sm">
                @error('city')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Post Code<span class="text-danger">*</span></label>
                <input type="text" value="{{ old('post_code', $user->userDetails?->post_code) }}" placeholder="Post Code" name="post_code" class="form-control form-control-sm">
                @error('post_code')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Country<span class="text-danger">*</span></label>
                <input type="text" value="{{ old('country', $user->userDetails?->country) }}" placeholder="Country" name="country" class="form-control form-control-sm">
                @error('country')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Phone<span class="text-danger">*</span></label>
                <input type="text" value="{{ old('phone', $user->phone) }}" placeholder="Phone" name="phone" class="form-control form-control-sm">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Email<span class="text-danger">*</span></label>
                <input type="email" value="{{ old('email', $user->email) }}" placeholder="Email" name="email" class="form-control form-control-sm">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">NID Front Picture<span class="text-danger">*</span></label>
                <input type="file" name="nid_front" class="form-control">
                @error('nid_front')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">NID Back Picture<span class="text-danger">*</span></label>
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
