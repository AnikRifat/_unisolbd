@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Specification List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                          <th>Category</th>
                                            <th>Specification</th>
                                            <th>name</th>
                                            <th>Details</th>
                                            <th>Status</th>
                                            <th class="text-center d-flex">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($specification_details as $item)
                                            <tr>
                                              <td>{{ $item->category->category_name }}</td>
                                              <td>{{ $item->specification->name }}</td>
                                                <td>
                                                    {{ $item->name }}
                                                </td>

                                                <td>
                                                    {{ $item->details }}
                                                </td>

                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bade-fills badge-success">Active</span>
                                                    @else
                                                        <span class="badge bade-fills badge-danger">Inactive</span>
                                                    @endif
                                                </td>


                                                <td>
                                                    <a href="{{ route('edit.specificationdetails', $item->id) }}"
                                                        class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i></a>

                                                    @if ($item->status == 1)
                                                        <a href="{{ route('inactive.specificationdetails', $item->id) }}"
                                                            class="btn btn-danger btn-sm" title=""><i
                                                                class="fa fa-arrow-down"></i></a>
                                                    @else
                                                        <a href="{{ route('active.specificationdetails', $item->id) }}"
                                                            class="btn btn-success btn-sm" title=""><i
                                                                class="fa fa-arrow-up"></i></a>
                                                    @endif
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



                <div class="col-md-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Product Specification</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('store.specificationdetails') }}">
                                    @csrf


                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control">
                                                <option selected="true" disabled="disabled" value="">Select Category
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <h5>Select Specification<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="specification_id" class="form-control form-control-sm select2" data-live-search="true">
                                                <option selected="true" disabled="disabled" value="">Select
                                                    Specification</option>
                                                @foreach ($specifications as $specification)
                                                    <option value="{{ $specification->id }}">{{ $specification->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('specification_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Details<span
                                                class="text-danger">*</span></label>
                                        <textarea type="text" name="details" class="form-control"></textarea>
                                        @error('details')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-rounded btn-primary">Add New</button>
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

    {{-- <script>
   $('select[name=category_id]').on('change', function () {
  var category = $(this).val();

  $.ajax({
    type: "GET",
    url: "/product/get-category-wise-specification",
    data: { category_id: category },
    dataType: "json",
    success: function (response) {
      var d=$('select[name="specification_id"]').empty();
    $.each(response, function(key,value){
      $('select[name="specification_id"]').append('<option value="'+value.id+'">'+ value.name +'</option>');
    });
    },
    error: function (xhr, status, error) {
      console.log("AJAX request failed:", status, error);
    }
  });
});

  </script> --}}
 
@endsection
