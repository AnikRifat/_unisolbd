@extends('admin.admin_master')

@section('admin')
    <link rel="stylesheet" href="{{ asset('backend/custom/g-spinner/dist/css/gspinner.min.css') }}">


    <style>
        a {
            text-decoration: none;
        }

        .floating_btn {
            position: fixed;
            top: 350px;
            right: -35px;
            /* width: 100px; */
            /* height: 100px; */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1000;

            transform: rotate(90deg);

        }

        @keyframes pulsing {
            to {
                box-shadow: 0 0 0 30px rgba(232, 76, 61, 0);
            }
        }

        .contact_icon {
            padding: 10px;
            background: #5868a2 !important;
            color: #fff;
            text-align: center;
            border-radius: 10px;
            box-shadow: 2px 2px 3px #999;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translatey(0px);
            animation: pulse 1.5s infinite;
            box-shadow: 0 0 0 0 linear-gradient(90deg, rgba(20, 40, 74, 1) 34%, rgba(238, 174, 229, 1) 100%);
            ;
            -webkit-animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
            -moz-animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
            -ms-animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
            animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
            font-weight: normal;
            font-family: sans-serif;
            text-decoration: none !important;
            transition: all 300ms ease-in-out;
        }

        .delete {
            position: absolute;
            top: -4px;
            right: -8px;
            color: red;
            background: #f1f2f6;
            padding: 5px;
            border-radius: 50%;
        }

        .edit {
            position: absolute;
            bottom: -4px;
            right: -8px;
            color: rgb(46, 115, 183);
            background: #f1f2f6;
            padding: 5px;
            border-radius: 50%;
        }

        .multiImagecard {
            padding: 10px;
            box-shadow: 0 19px 38px rgba(0, 0, 0, 0.30), 0 15px 12px rgba(0, 0, 0, 0.22);
        }
    </style>

    <div class="container-full">
        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div>
                <div class="box-header with-border py-0">
                    <h4 class="box-title">Edit Product Form</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data"
                        id="myForm">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Brand</label>
                                    <div class="controls">
                                        <select name="brand_id" class="form-control form-control-sm select2">
                                            <option selected="true" disabled="disabled" value="">
                                                Choose Brand</option>
                                            @foreach ($brands as $brand)
                                                <option {{ $brand->id == $product->brand_id ? 'selected' : '' }}
                                                    value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Category<span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <select id="category_id" name="category_id"
                                            class="form-control form-control-sm select2" required>

                                            @forelse ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}</option>
                                            @empty
                                                <option selected="true" disabled="disabled">Choose Category
                                                </option>
                                            @endforelse


                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Subcategory</label>
                                    <div class="controls">
                                        <select id="subcategory_id" name="subcategory_id"
                                            class="form-control form-control-sm select2">

                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Sub-subcategory</label>
                                    <div class="controls">
                                        <select id="subsubcategory_id" name="subsubcategory_id" id="select"
                                            class="form-control form-control-sm select2">

                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Product Name<span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" value="{{ $product->product_name }}" name="product_name"
                                            class="form-control form-control-sm" required>
                                    </div>
                                    @error('product_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Product Code</label>
                                    <div class="controls">
                                        <input type="text" value="{{ $product->product_code }}" name="product_code"
                                            class="form-control form-control-sm">
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Purchase Price <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input value="{{ $product->purchase_price }}" type="text" name="purchase_price"
                                            class="form-control form-control-sm decimal-input" required>
                                    </div>
                                    @error('purchase_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Selling Price <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input value="{{ $product->selling_price }}" type="text" name="selling_price"
                                            class="form-control form-control-sm decimal-input" required>
                                    </div>
                                    @error('selling_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Discount Price</label>
                                    <div class="controls">
                                        <input value="{{ $product->discount_price }}" type="text" name="discount_price"
                                            class="form-control form-control-sm decimal-input">
                                    </div>

                                </div>
                            </div>






                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Unit<span class="text-danger">*</span></label>
                                    <select name="unit_id" id="unit_id" class="form-control form-control-sm" required>
                                        <option selected="true" disabled="disabled" value="">
                                            Select Unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}"
                                                {{ $unit->id == $product->unit_id ? 'selected' : '' }}>{{ $unit->name }}

                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Barcode Length</label>
                                    <div class="d-flex">
                                        <input value="{{ old('barcode_length') }}" type="number"
                                            onkeypress="return /[0-9]/i.test(event.key)" min="5" max="15"
                                            value="5" class="form-control form-control-sm" name="barcode_length">

                                        <a href="javascript:void(0)" id="btnBarcode" class="btn btn-info btn-sm ml-2">
                                            <i class="fa-solid fa-arrows-rotate"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">

                                <div class="form-group">
                                    <label>Barcode</label>
                                    <div class="d-flex randomBar mb-2">
                                        <input value="{{ $product->barcode }}" id="barcodeVal"
                                            onkeypress="return /[0-9]/i.test(event.key)" type="text" name="barcode"
                                            class="form-control form-control-sm">


                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Openning Qty</label>
                                    <div class="controls">
                                        <input value="{{ $product->opening_qty }}"
                                            onkeypress="return /[0-9]/i.test(event.key)" type="text" name="opening_qty"
                                            class="form-control form-control-sm">
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Type</label>
                                    <div class="d-flex">
                                        <input {{ $product->type==3? 'checked': '' }} type="radio" id="both" name="type" value="3" class="filled-in" />
                                        <label for="both" class="mr-3">Both</label>

                                        <input {{ $product->type==1? 'checked': '' }} type="radio"  value="1" id="E-Commerce" name="type" class="filled-in"/>
                                        <label for="E-Commerce" class="mr-3">E-Commerce</label>

                                        <input {{ $product->type==2? 'checked': '' }} type="radio"  value="2" id="POS" name="type" class="filled-in"/>
                                        <label for="POS">POS</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <div class="controls mt-md-3">
                                        <fieldset>
                                            <input {{ $product->is_expireable == 1 ? 'checked' : '' }}
                                                class="form-control form-control-sm" type="checkbox" id="is_expireable"
                                                name="is_expireable" value="1" checked>
                                            <label for="is_expireable" class="text-danger">Is Expireable</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div id="specification">

                            <div class="row">

                                <!--Slided up box!-->
                                <div class="col-12">
                                    <div class="box">
                                        <div class="box-header with-border pb-0">
                                            <h4 class="box-title">Product <strong>Specification</strong></h4>
                                            <ul class="box-controls pull-right">
                                                {{-- <li><a class="box-btn-close" href="#"></a></li> --}}
                                                <li><a class="box-btn-slide" href="#"></a></li>
                                                <li><a class="box-btn-fullscreen" href="#"></a></li>
                                            </ul>
                                        </div>

                                        <div class="box-body pt-0">
                                            <div class="row" id="dynamicSpc">

                                                @forelse ($productSpecification as $ps)
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="hidden" name="specification_id[]"
                                                                value="{{ $ps->id }}">
                                                            <label>{{ $ps->specification->name }}</label>
                                                            <div class="controls">
                                                                <select name="specification_details_id[]"
                                                                    class="form-control form-control-sm select2">
                                                                    @foreach ($ps->specification->specificationdetails as $psDetail)
                                                                        <option value="{{ $psDetail->id }}"
                                                                            {{ $ps->specification_details_id == $psDetail->id ? 'selected' : '' }}>
                                                                            {{ $psDetail->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>




                        <div class="row">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Main Thambnail <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="file" id="product_thambnail" name="product_thambnail"
                                            onchange="mainThamUrl(this)" class="form-control form-control-sm mb-3">
                                    </div>
                                    @error('product_thambnail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="multiImagecard " style="max-width: 80px">
                                        <img src="{{ asset($product->product_thambnail) }}" alt=""
                                            id="mainThmb" style="width:70px;height:55px">
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Multi Image<span class="text-danger">*</span> </label>
                                    <div class="controls">
                                        <div class="input-group mb-3">

                                            <input type="file" multiple="" id="multiImg"
                                                class="form-control form-control-sm" name="multi_img[]">
                                            <a class="btn btn-success btn-sm text-uppercase" href='JavaScript:void(0);'
                                                onclick="btnStoreMultiImg()">Upload</a>


                                        </div>
                                    </div>
                                    @error('multi_img')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="row" id="productMultiImg">

                                        @foreach ($multiImgs as $img)
                                            <div class="col-4 col-sm-2 col-md-3 mb-4">
                                                <div class="multiImagecard position-relative ">
                                                    <a href="JavaScript:void(0);"
                                                        onclick="btnRemoveImage({{ $img->id }})"><i
                                                            class="delete fa fa-close"></i></a>
                                                    <img class="thumb" src="{{ asset($img->photo_name) }}" />
                                                    <a href="JavaScript:void(0);" data-toggle="modal"
                                                        data-multiImg-id={{ $img->id }} class="edit-image"
                                                        data-target="#exampleModalCenter"><i
                                                            class="edit fa fa-pencil"></i></a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <div class="controls">

                                        <textarea id="editor1" name="short_descp" rows="10" cols="80">  {{ $product->short_descp }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Long Description</label>
                                    <div class="controls">
                                        {{-- <textarea name="long_descp" id="textarea" class="form-control form-control-sm" required placeholder="Write your Description Here"></textarea> --}}
                                        <textarea id="editor2" name="long_descp" rows="10" cols="80">
                                                            {{ $product->long_descp }}
                                                    </textarea>
                                    </div>
                                </div>
                            </div>

                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between mb-2">
                                        <label>Spectication Details</label>
                                        <a onclick="convert()" class="btn btn-sm btn-success">Change Style</a>
                                    </div>

                                    <div class="controls">
                                        <textarea id="editor3" name="specification_descp" rows="10" cols="80">
                                                            {{ $product->specification_descp }}
                                                    </textarea>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input {{ $product->on_sale == 1 ? 'checked' : '' }} type="checkbox"
                                                        id="checkbox_2" name="on_sale" value="1">
                                                    <label for="checkbox_2">On Sale</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input {{ $product->featured == 1 ? 'checked' : '' }} type="checkbox"
                                                        id="checkbox_3" name="featured" value="1">
                                                    <label for="checkbox_3">Featured</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input {{ $product->special_offer == 1 ? 'checked' : '' }}
                                                        type="checkbox" id="checkbox_4" name="special_offer"
                                                        value="1">
                                                    <label for="checkbox_4">Special offer</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input {{ $product->top_rated == 1 ? 'checked' : '' }} type="checkbox"
                                                        id="checkbox_5" name="top_rated" value="1">
                                                    <label for="checkbox_5">Top Rated</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="floating_btn">
                            <a type="button" class="contact_icon text-white text-uppercase font-weight-bold"
                                data-toggle="modal" data-target="#specificationModal">
                                SPECIFICATION
                            </a>
                        </div>

                        <!-- Modal -->
                        <div class="modal modal-right fade" id="specificationModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <label class="modal-title font-weight-bold">Add Specification</label>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="overflow: auto;">
                                        <div id="pspec" class="row ">
                                        </div>
                                    </div>
                                    <div class="modal-footer modal-footer-uniform">
                                        <button type="button" class="btn btn-sm btn-primary"
                                            data-dismiss="modal">Close</button>
                                        <button type="button" onclick="addSpecification()"
                                            class="btn btn-sm btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal -->


                        {{-- multi image edit modal --}}
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <label class="modal-title" id="exampleModalLongTitle">Update Image</label>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div>
                                            <img id="modalImage" src="" alt=""
                                                style="width:200px; height:200px">
                                        </div>

                                        <div class="controls">
                                            <div class="input-group mt-3">

                                                <input type="file" id="updatedImg"
                                                    class="form-control form-control-sm">
                                                <a onclick="updateMultiImg()"
                                                    class="btn btn-success btn-sm text-uppercase" class="input-group-text"
                                                    href='JavaScript:void(0);'>Upload</a>


                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="text-center">
                            <button id="addProductBtn" class="btn btn-success btn-sm mb-5 start">Submit</button>
                        </div>


                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->

        <div id="g-container" class="d-none">
            <div id="loader"></div>
        </div>

    </div>




    <script src="{{ asset('backend/custom/g-spinner/dist/js/g-spinner.min.js') }}"></script>
    <script src="{{ asset('backend/custom/g-spinner/example/demo.js') }}"></script>



    <script src="{{ asset('backend/js/pages/editor.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/ckeditor/ckeditor.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data
                    $('#preview_img').empty();
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

    <script>
        var specification = {!! $specifications !!}
        var specificationDetails = {!! $specificationDetails !!}

        function addSpecification() {
            var specification = ``;
            var selectedSpecifications = [];
            $('.specification-checkbox:checked').each(function() {
                var id = $(this).attr('id');
                var name = $(this).attr('name');
                var value = $(this).attr('value');
                selectedSpecifications.push({
                    id: id,
                    name: name,
                    value: value,
                });
            });

            var dynamicSpc = ``;

            if (selectedSpecifications.length > 0) {
                selectedSpecifications.forEach(function(item) {
                    dynamicSpc += '<div class="col-md-4">' +
                        '<div class="form-group">' +
                        '<input type="hidden" name="specification_id[]" value="' + item.value + '">' +
                        '<label>' + item.name + '</label>' +
                        '<div class="controls">' +
                        '<select name="specification_details_id[]" class="form-control form-control-sm select2">';

                    // Loop through specificationDetails and add options based on the condition
                    specificationDetails.forEach(function(detail) {

                        console.log("detail ", detail)

                        if (item.value == parseInt(detail.specification_id)) {

                            console.log("detail ", detail);
                            dynamicSpc += '<option value="' + detail.id + '">' + detail.name + '</option>';
                        }
                    });

                    dynamicSpc += '</select>' +
                        '</div>' +
                        '</div>' +
                        '</div>';


                });

                $('#dynamicSpc').html(dynamicSpc);

                // Initialize Select2 after adding the elements
                $('.select2').select2();

                $('#specificationModal').modal('hide');
            } else {
                $('#dynamicSpc').empty();
                $('#specificationModal').modal('hide');
            }

            console.log("selectedSpecifications ", selectedSpecifications)
        }
    </script>

    {{-- add specification in modal  --}}
    <script>
        $(document).ready(function() {
            var specification = {!! $specifications !!}
            var specificationDetails = {!! $specificationDetails !!}

            $('#category_id').on('change', function() {
                $("#dynamicSpc").html('');
                loadSpecification();
            });

            function loadSpecification() {
                var categoryId = parseInt($('#category_id').val(), 10);

                console.log("category_id ", categoryId)

                // Filter specificationDetails based on category_id
                var filteredSpecDetails = specificationDetails.filter(function(detail) {
                    return parseInt(detail.category_id) === categoryId;
                });

                console.log("filteredSpecDetails ", filteredSpecDetails)

                // Extract an array of unique specification_ids from the filtered specificationDetails
                var specificationIds = Array.from(new Set(filteredSpecDetails.map(function(detail) {
                    return parseInt(detail.specification_id);
                })));

                console.log("specificationIds ", specificationIds)

                // Filter the specification array based on the extracted specification_ids
                var filteredSpecifications = specification.filter(function(spec) {
                    return specificationIds.includes(spec.id);
                });

                console.log("filteredSpecDetails ", filteredSpecifications)


                var psc = ``;
                $.each(filteredSpecifications, function(index, value) {
                    console.log(value.id);
                    var uniqueId = 'specification_' + value.id; // Append a unique identifier
                    psc += '<div class="col-md-6">' +
                        '<div class="controls">' +
                        '<fieldset>' +
                        '<input class="specification-checkbox" type="checkbox" ' +
                        'id="' + uniqueId + '" ' + // Use the unique ID
                        'name="' + value.name + '" value="' + value.id + '">' + // Use the unique ID as name
                        '<label for="' + uniqueId + '">' + value.name + '</label>' +
                        '</fieldset>' +
                        '</div>' +
                        '</div>';
                });
                $('#pspec').html(psc);
            }

            loadSpecification();
        });
    </script>


    {{-- multi image --}}
    <script>
        var product_id = "{{ $product->id }}";

        console.log("product_id : ", product_id);

        var UpdateId;

        function btnStoreMultiImg() {
            var formData = new FormData();
            // Add product_id to the formData
            formData.append('product_id', product_id);

            var files = $('#multiImg').prop('files');
            for (var i = 0; i < files.length; i++) {
                formData.append('multi_img[]', files[i]);
            }
            console.log(formData);
            if (files.length != 0) {
                $.ajax({
                    url: "{{ route('multi-image.store') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#multiImg').css('border-color', '');
                        $('#multiImg').val('');
                        // console.log(response);

                        showToastr(response.type, response.message)
                        viewMultiImg()

                    }
                });
            } else {
                $('#multiImg').css('border-color', 'red');
                Swal.fire({
                    text: "select at least one image",
                    icon: 'warning',
                })
            }

        }

        function viewMultiImg() {
            console.log("product_id ", product_id);
            $.ajax({
                method: "get",
                url: "{{ route('multi-image.index') }}",
                data: {
                    id: product_id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#productMultiImg').empty();
                    console.log("response : ", response)
                    response.forEach(function(multiImg) {
                        var html = `
                <div class="col-4 col-sm-2 col-md-3 mb-4">
                    <div class="multiImagecard position-relative">
                        <a href="JavaScript:void(0);" onclick="btnRemoveImage(${multiImg.id})">
                            <i class="delete fa fa-close"></i>
                        </a>
                        <img class="thumb" src="/${multiImg.photo_name}" />
                        <a href="JavaScript:void(0);" data-toggle="modal" data-multiImg-id=${multiImg.id}  class="edit-image"
                                                                    data-target="#exampleModalCenter"><i
                                                                        class="edit fa fa-pencil"></i></a>
                    </div>
                </div>
            `;
                        $('#productMultiImg').append(html);
                    });
                }
            });
        }




        $(document).on('click', '.edit-image', function() {
            var multiImgId = $(this).data('multiimg-id');
            UpdateId = multiImgId;
            console.log(UpdateId);
            var imageSrc = $(this).closest('.multiImagecard').find('.thumb').attr('src');
            $('#exampleModalCenter').find('img#modalImage').attr('src', imageSrc);
            $('#exampleModalCenter').modal('show');
        });

        function updateMultiImg() {
            let formData = new FormData();
            let fileData = $('#updatedImg').prop('files')[0];

            if (!fileData) {
                Swal.fire({
                    text: "select at least one image",
                    icon: 'warning',
                })
                return;
            }

            formData.append('product_id', product_id);
            formData.append('multi_img', fileData);
            formData.append('_method', 'PUT'); // Method spoofing for PUT

            console.log('formData:', formData);

            var updateUrl = "{{ route('multi-image.update', ':id') }}";
            updateUrl = updateUrl.replace(':id', UpdateId);

            $.ajax({
                url: updateUrl,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#updatedImg').val('');
                    $('#exampleModalCenter').modal('hide');
                    showToastr(response.type, response.message);
                    console.log(response);
                    viewMultiImg();
                },
                error: function(xhr, status, error) {
                    console.log('AJAX error:', error);
                }
            });
        }


        function btnRemoveImage(id) {

            var updateUrl = "{{ route('multi-image.destroy', ':id') }}";
            updateUrl = updateUrl.replace(':id', id);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: "delete",
                        url: updateUrl,
                        dataType: "JSON",
                        success: function(response) {
                            $('#multiImg').css('border-color', '');

                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            viewMultiImg();
                        }
                    });
                }
            })
        }
    </script>


    {{-- discount price cannot be grater than selling price --}}
    <script>
        $(document).ready(function() {
            // Get references to the input fields
            var sellingPriceInput = $("input[name='selling_price']");
            var discountPriceInput = $("input[name='discount_price']");
            var errorMessage = $(
                "<span class='text-danger'>discount price should be less than or equal to selling price</span>");

            // Add an event listener for the input event on both fields
            sellingPriceInput.on('input', function() {
                validatePrices();
            });

            discountPriceInput.on('input', function() {
                validatePrices();
            });

            // Function to validate prices
            function validatePrices() {
                var sellingPrice = parseFloat(sellingPriceInput.val());
                var discountPrice = parseFloat(discountPriceInput.val());

                // Check if selling price is greater than discount price
                if (!isNaN(sellingPrice) && !isNaN(discountPrice) && sellingPrice < discountPrice) {
                    // Show the error message
                    errorMessage.appendTo(discountPriceInput.parent());
                } else {
                    // Remove the error message if it's displayed
                    errorMessage.remove();
                }
            }
        });
    </script>


    {{-- specification details design change  --}}
    <script>
        function convert() {
            var editorData = CKEDITOR.instances.editor3.getData();
            console.log("data : ", editorData);
            var $table = $(editorData);
            $table.addClass('table table-striped');
            $table.attr('cellpadding', '1');
            $table.attr('cellspacing', '1');
            // Add classes and headers to the table elements
            $table.find('td[colspan]').each(function() {
                var $td = $(this);
                var colspan = $td.attr('colspan');
                $td.removeAttr('colspan');
                $td.attr('colspan', colspan);
                $td.wrapInner('<h6></h6>');
            });

            $table.find('thead td[colspan]').each(function() {
                var $td = $(this);
                var colspan = $td.attr('colspan');
                $td.removeAttr('colspan');
                $td.attr('colspan', colspan);
                $td.wrapInner('<h6><span style="color:#2980b9"><strong></strong></span></h6>');
            });

            $table.find('thead tr').each(function() {
                $(this).find('td').eq(0).attr('colspan', 2);
            });

            $table.find('tbody tr').each(function() {
                $(this).find('td').eq(0).wrapInner('<h6></h6>');
                $(this).find('td').eq(1).wrapInner('<h6></h6>');
            });

            var modifiedHTML = $table.prop('outerHTML');


            CKEDITOR.instances.editor3.setData(modifiedHTML);

        }




        //remove commo
        function split(name) {
            var name = $("#" + name);
            var amount = name.val();
            amount = amount.replace(/[^0-9]/g, ""); // Remove all non-numeric characters
            name.val(amount);
        }

        // document.addEventListener("DOMContentLoaded", function() {
        //     // document.getElementById("amount").addEventListener("focusout", split);
        //     document.getElementById("amount").addEventListener("mouseout", split);
        //     document.getElementById("amount").addEventListener("keydown", function(event) {
        //         if (event.keyCode === 13) { // Enter key
        //             split();
        //         }
        //     });
        //     document.getElementById("amount").addEventListener("keyup", function(event) {
        //         if (event.keyCode === 9) { // Tab key
        //             split();
        //         }
        //     });
        // });
    </script>

    {{-- generate barcode --}}
    <script>
        $(document).ready(function() {

            if ($("#barcodeVal").val() != "") {
                var inputVal = $("#barcodeVal").val();
                if (inputVal.length > 0) {
                    data = {
                        input: inputVal
                    }
                    generateBarcode(data);
                }
            }

            $('#barcodeVal').on('input', function() {
                var inputVal = $("#barcodeVal").val();
                if (inputVal.length > 0) {
                    data = {
                        input: inputVal
                    }
                    generateBarcode(data);
                } else {
                    $('#barcode').remove();
                }

            });

            $('#btnBarcode').on('click', function() {
                var barcode_length = $("input[name='barcode_length']").val();
                data = {
                    length: barcode_length
                }
                generateBarcode(data);
            });
        });


        function generateBarcode(data) {
            $.ajax({
                type: "get",
                url: "{{ route('barcode.index') }}",
                data: data,
                dataType: "json",
                success: function(response) {
                    //console.log(response);
                    $('#barcode').remove();
                    $("input[name='barcode']").val(response.randomNumber)
                    var barcodeElement = $('<img>', {
                        id: 'barcode',
                        src: "data:image/png;base64," + response.barcode,
                        alt: 'barcode'
                    });

                    var errorElement = $('.randomBar');
                    errorElement.after(barcodeElement);
                }
            });
        }
    </script>

    {{-- subcategory,subsubcategory --}}
    <script>
        var category_id = $('#category_id');
        var subcategorySelect = $('#subcategory_id');
        var subsubcategorySelect = $('#subsubcategory_id');
        var subcategories = {!! $subcategories !!}
        var subsubcategories = {!! $subsubcategories !!}
        var product = {!! $product !!}

        // console.log("subcategory_id ",product.subcategory_id);

        $(document).ready(function() {
            loadSubcategory();
            loadSubsubcategory();
            $(document).on("change", "#category_id", function() {
                loadSubcategory();
                loadSubsubcategory();
            });
            $(document).on("change", "#subcategory_id", function() {
                loadSubsubcategory();
            });
        });



        function loadSubcategory() {
            subcategorySelect.empty();
            subcategorySelect.append('<option value="">Choose Subcategory</option>');
            $.each(subcategories, function(index, subcategory) {
                if (subcategory.category_id == category_id.val()) {
                    subcategorySelect.append('<option ' + (product.subcategory_id == subcategory.id ? 'selected' :
                            '') + ' value="' + subcategory.id + '">' + subcategory.subcategory_name +
                        '</option>');
                }
            });
        }

        function loadSubsubcategory() {
            subsubcategorySelect.empty();
            subsubcategorySelect.append('<option value="">Choose Sub-subcategory</option>');
            $.each(subsubcategories, function(index, subsubcategory) {
                if (subsubcategory.subcategory_id == subcategorySelect.val()) {
                    subsubcategorySelect.append('<option ' + (product.subsubcategory_id == subsubcategory.id ?
                            'selected' : '') + ' value="' + subsubcategory.id + '">' + subsubcategory
                        .subsubcategory_name + '</option>');
                }
            });
        }
    </script>
@endsection
