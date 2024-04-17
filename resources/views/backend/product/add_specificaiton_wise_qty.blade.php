@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="container-full">
        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add Product Form</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('product-store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Brand Select</h5>
                                                    <div class="controls">
                                                        <select name="brand_id" id="select" class="form-control">
                                                            <option selected="true" disabled="disabled" value="">
                                                                Select Category</option>
                                                            
                                                        </select>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="category_id"
                                                            onchange="LoadSelect('category_id','subcategory_id',
                'subcategory_name')"
                                                            required class="form-control">
                                                            <option selected="true" disabled="disabled" value="">
                                                                Select Category</option>
                                                          
                                                        </select>
                                                        @error('category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>SubCategory Select <span class="text-danger"></span></h5>
                                                    <div class="controls">
                                                        <select name="subcategory_id"
                                                            onchange="LoadSelect('subcategory_id','subsubcategory_id')"
                                                            id="select" class="form-control">
                                                            <option selected="true" value="">Select Sub Category
                                                            </option>
                                                        </select>
                                                        @error('subcategory_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>SubCategory Select <span class="text-danger"></span></h5>
                                                    <div class="controls">
                                                        <select name="subsubcategory_id" id="select"
                                                            class="form-control">
                                                            <option selected="true" value="">Select Sub Sub Category
                                                            </option>
                                                        </select>
                                                        @error('subsubcategory_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Name<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_name" class="form-control"
                                                            required>
                                                    </div>
                                                    @error('product_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Code <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input onkeypress="return /[0-9]/i.test(event.key)" type="text"
                                                            name="product_code" class="form-control" required>
                                                    </div>
                                                    @error('product_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>

                                        </div>


                                        <div class="row">



                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Qty <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input onkeypress="return /[0-9]/i.test(event.key)" type="text"
                                                            name="product_qty" class="form-control" required>
                                                    </div>
                                                    @error('product_qty')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Selling Price <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input onkeypress="return /[0-9]/i.test(event.key)" type="text"
                                                            name="selling_price" class="form-control" required>
                                                    </div>
                                                    @error('selling_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Discount Price</h5>
                                                    <div class="controls">
                                                        <input onkeypress="return /[0-9]/i.test(event.key)" type="text"
                                                            name="discount_price" class="form-control">
                                                    </div>
                                                    @error('discount_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            @foreach ($specifications as $specification)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>{{ $specification->name }}</h5>
                                                        <select name="{{ $specification->name }}" class="form-control ">
                                                            <option value="" selected="">Select
                                                                {{ $specification->name }}</option>
                                                            @foreach (explode(',', $specification->details) as $detail)
                                                                <option value="{{ $detail }}">{{ $detail }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>

                                    </div>
                                </div>

                                <hr>
                               

                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-primary mb-5">Add Product</button>
                                </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>






    <script type="text/javascript">
        function LoadSelect(name, loadname) {
            $(document).ready(function() {
                var category_id = $('select[name="' + name + '"]').val();
                if (category_id) {
                    $.ajax({
                        type: "GET",
                        url: name == 'category_id' ? "{{ url('/category/subcategory/ajax') }}/" +
                            category_id : "{{ url('/category/sub-subcategory/ajax') }}/" + category_id,
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subsubcategory_id"]').empty();
                            var d = $('select[name="' + loadname + '"]').empty();
                            if (name == 'category_id') {
                                $('select[name="' + loadname + '"]').append(
                                    '<option value="">Select Sub Category</option>');

                                $.each(data, function(key, value) {
                                    $('select[name="' + loadname + '"]').append(
                                        '<option value="' + value.id + '">' + value
                                        .subcategory_name + '</option>');
                                });



                                var category_id = $('select[name="subcategory_id"] option:first').val();
                                if (category_id) {
                                    $.ajax({
                                        type: "GET",
                                        url: "{{ url('/category/sub-subcategory/ajax') }}/" +
                                            category_id,
                                        dataType: "json",
                                        success: function(data) {

                                            var d = $('select[name="subsubcategory_id"]')
                                                .empty();
                                            $('select[name="' + loadname + '"]').append(
                                                '<option value="">Select Sub Sub Category</option>'
                                                );
                                            $.each(data, function(key, value) {
                                                $('select[name="subsubcategory_id"]')
                                                    .append('<option value="' +
                                                        value.id + '">' + value
                                                        .subsubcategory_name +
                                                        '</option>');
                                            });

                                        }
                                    });

                                }
                            } else {
                                $('select[name="' + loadname + '"]').append(
                                    '<option value="">Select Sub Sub Category</option>');

                                $.each(data, function(key, value) {
                                    $('select[name="' + loadname + '"]').append(
                                        '<option value="' + value.id + '">' + value
                                        .subsubcategory_name + '</option>');
                                });
                            }
                        }
                    });
                } else {
                    alert('danger');
                }

            });
        }
    </script>

    <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


    {{-- ---------------------------Show Multi Image JavaScript Code ------------------------ --}}

    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                            .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(80)
                                        .height(80); //create image element 
                                    $('#preview_img').append(
                                    img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
@endsection
