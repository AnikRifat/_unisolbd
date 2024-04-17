@extends('admin.admin_master')

@section('admin') 
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        
         <div class="col-6">
          <div class="box">
           <div class="box-header with-border">
             <h3 class="box-title">Edit Division</h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="table-responsive">
              <form  method="POST" action="{{ route('district.update',$districts->id) }}">
                @csrf

                <div class="form-group">
                    <h5>Division Select <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="division_id"  class="form-control">
                            <option selected="true" disabled="disabled" value="">Select Division</option>
                            @foreach ($divisions as $division)
                            <option {{ $districts->division_id==$division->id? 'Selected': ''}} value="{{ $division->id }}">{{ $division->division_name }}</option>
                            @endforeach
                        </select>
                        @error('division_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="form-group">
                  <label class="info-title">District Name<span class="text-danger">*</span></label>
                  <input type="text"  name="district_name" value="{{ $districts->district_name }}" class="form-control">
                  @error('district_name')
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