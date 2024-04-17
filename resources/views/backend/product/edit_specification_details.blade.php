@extends('admin.admin_master')

@section('admin') 
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        
         <div class="col-12">
          <div class="box">
           <div class="box-header with-border">
             <h3 class="box-title">Edit Specification Details</h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="table-responsive">
              <form  method="POST" action="{{ route('update.specificationdetails',$specification_details->id) }}">
                @csrf

                <div class="form-group">
                  <h5>Category Select <span class="text-danger">*</span></h5>
                  <div class="controls">
                    <select name="category_id" class="form-control">
                      <option selected="true" disabled="disabled" value="">Select Category</option>
                      @foreach ($categories as $category)
                      <option value="{{ $category->id }}" {{ ($category->id==$specification_details->category_id)? "selected":'' }}>{{ $category->category_name}}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>


                <div class="form-group">
                  <h5>Select Specification <span class="text-danger">*</span></h5>
                  <div class="controls">
                    <select name="specification_id" class="form-control">
                      <option selected="true" disabled="disabled" value="">Select Specification</option>
                      @foreach ($specifications as $specification)
                      <option value="{{ $specification->id }}" {{ ($specification->id==$specification_details->specification_id)? "selected": " " }}>{{ $specification->name }}</option>

                      @endforeach
                    </select>
                    @error('specification_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="form-group">
                  <label class="info-title" for="exampleInputEmail1">name<span class="text-danger">*</span></label>
                  <input type="text" value="{{ $specification_details->name }}" name="name" class="form-control">
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>


                <div class="form-group">
                  <label class="info-title" for="exampleInputEmail1">Details<span class="text-danger">*</span></label>
                  <input type="text" name="details" value="{{ $specification_details->details }}" class="form-control">
                  @error('details')
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


<!-- <script>
  $('select[name=category_id]').on('change', function() {
    var category = $(this).val();

    $.ajax({
      type: "GET",
      url: "/product/get-category-wise-specification",
      data: {
        category_id: category
      },
      dataType: "json",
      success: function(response) {
        var d = $('select[name="specification_id"]').empty();
        $.each(response, function(key, value) {
          $('select[name="specification_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
        });
      },
      error: function(xhr, status, error) {
        console.log("AJAX request failed:", status, error);
      }
    });
  });
</script> -->


@endsection
