@extends('admin.admin_master')

@section('admin') 
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        
         <div class="col-12">
          <div class="box">
           <div class="box-header with-border">
             <h3 class="box-title">Edit Division</h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="table-responsive">
              <form  method="POST" action="{{ route('division.update',$divisions->id) }}">
                @csrf
                <div class="form-group">
                  <label class="info-title">Division Name<span class="text-danger">*</span></label>
                  <input type="text"  name="division_name" value="{{ $divisions->division_name }}" class="form-control">
                  @error('division_name')
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