@extends('admin.admin_master')

@section('admin')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">

         <div class="col-12">
          <div class="box">
           <div class="box-header with-border">
             <h3 class="box-title">Edit Customer Group</h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="table-responsive">
              <form  method="POST" action="{{ route('customer-groups.update', $group->id) }}">
                @csrf
                <div class="form-group">
                  <label class="info-title">Name<span class="text-danger">*</span></label>
                  <input type="text"  name="name" value="{{ $group->name }}" class="form-control" >
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>

              <div class="form-group">
                <label class="info-title">Rules<span class="text-danger">*</span></label>
                <div id="rules-container">
                    @foreach($group->rules as $key => $value)
                    <div class="input-group mb-2">
                        <input type="text" name="rules[key][]" class="form-control form-control-sm" value="{{ $key[0] }}" placeholder="Key">
                        <input type="text" name="rules[value][]" class="form-control form-control-sm" value="{{ $value[0] }}" placeholder="Value">
                        {{-- <div class="input-group-append">
                            <button type="button" class="btn btn-danger btn-remove-rule">-</button>
                        </div> --}}
                    </div>
                    @endforeach
                </div>
              </div>

              <div class="form-group">
                <label class="info-title">Status<span class="text-danger">*</span></label>
                <input type="number"  name="status" value="{{ $group->status }}" class="form-control" >
                @error('status')
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
