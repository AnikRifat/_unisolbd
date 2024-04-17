@extends('admin.admin_master')

@section('admin') 
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        
         <div class="col-md-6">
          <div class="box">
           <div class="box-header with-border">
             <h3 class="box-title">Update Specification</h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="table-responsive">
              <form  method="POST" action="{{ route('update.specification',$specification->id)}}">
                @csrf

                {{-- <div class="form-group">
                  <h5>Category Select <span class="text-danger">*</span></h5>
                  <div class="controls">
                      <select name="category_id"  class="form-control">
                          <option selected="true" disabled="disabled" value="">Select Category</option>
                          @foreach ($categories as $category)
                          <option value="{{ $category->id }}" {{ ($category->id==$specification->category_id)? "selected": " " }}>{{ $category->category_name }}</option>
                          @endforeach
                      </select>
                      @error('category_id')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
              </div> --}}

              

                <div class="form-group">
                  <label class="info-title" for="exampleInputEmail1">Name<span class="text-danger">*</span></label>
                  <input type="text"  name="name" value="{{ $specification->name}}" class="form-control">
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>

              <div class="demo-checkbox">
                				
                <input {{ $specification->filter == 1 ? 'checked' : '' }} type="checkbox" id="md_checkbox_23" class="filled-in chk-col-success" name="filter"  value="1"/>
                <label for="md_checkbox_23">check for product filter</label>
                					
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