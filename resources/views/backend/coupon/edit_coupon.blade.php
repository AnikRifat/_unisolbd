@extends('admin.admin_master')

@section('admin') 
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        
         <div class="col-12">
          <div class="box">
           <div class="box-header with-border">
             <h3 class="box-title">Edit Coupon</h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="table-responsive">
              <form  method="POST" action="{{ route('coupon.update',$coupon->id) }}">
                @csrf
                <div class="form-group">
                  <label class="info-title">Coupon Name<span class="text-danger">*</span></label>
                  <input type="text"  name="coupon_name" value="{{ $coupon->coupon_name }}" class="form-control" >
                  @error('coupon_name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>

              <div class="form-group">
                <label class="info-title">Coupon Discount(%)<span class="text-danger">*</span></label>
                <input type="text"  name="coupon_discount" value="{{ $coupon->coupon_discount }}"  class="form-control">
                @error('coupon_discount')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
              <label class="info-title">Coupon Validity<span class="text-danger">*</span></label>
              <input type="date"  name="coupon_validity" value="{{ $coupon->coupon_validity }}" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
              @error('coupon_validity')
              <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-rounded btn-primary">Update</button>
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
  @endsection