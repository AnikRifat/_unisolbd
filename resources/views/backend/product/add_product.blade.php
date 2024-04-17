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
    </style>




    <div class="container-full">
        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div>
                <div class="box-header with-border py-0">
                    <h4 class="box-title">Add Product Form</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data"
                        id="myForm">
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
                                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
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
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                            <option selected="true" disabled="disabled">Choose Subcategory
                                            </option>
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
                                            <option selected="true" disabled="disabled">Choose Sub-subcategory
                                            </option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Product Name<span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" value="{{ old('product_name') }}" name="product_name"
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
                                        <input type="text" value="{{ old('product_code') }}" name="product_code"
                                            class="form-control form-control-sm">
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Purchase Price <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input value="{{ old('purchase_price') }}" type="text" name="purchase_price"
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
                                        <input value="{{ old('selling_price') }}" type="text" name="selling_price"
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
                                        <input value="{{ old('discount_price') }}" type="text" name="discount_price"
                                            class="form-control form-control-sm decimal-input">
                                    </div>

                                </div>
                            </div>


                            <div class="col-md-6 col-lg-4">

                                <div class="form-group">
                                    <label>Unit<span class="text-danger">*</span></label>
                                    <select name="unit_id" id="unit_id" class="form-control form-control-sm select2" required>
                                        <option selected="true" disabled="disabled" value="">
                                            Select Unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->name }}
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
                                        <input value="{{ old('barcode') }}" id="barcodeVal"
                                            onkeypress="return /[0-9]/i.test(event.key)" type="text" name="barcode"
                                            class="form-control form-control-sm">


                                    </div>

                                </div>

                            </div>

                            {{-- <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Type</label>

                                        <div class="d-flex">
                                            <input type="checkbox" id="both" class="filled-in" checked />
                                            <label for="both" class="mr-3">Both</label>
                                            <input type="checkbox" id="E-Commerce" class="filled-in"/>
                                            <label for="E-Commerce" class="mr-3">E-Commerce</label>
                                            <input type="checkbox" id="POS" class="filled-in"/>
                                            <label for="POS">POS</label>
                                        </div>

                                </div>

                            </div> --}}

                            <div class="col-md-6 col-lg-4">

                                <div class="form-group">
                                    <label>Openning Qty</label>
                                    <div class="controls">
                                        <input value="{{ old('opening_qty') }}"
                                            onkeypress="return /[0-9]/i.test(event.key)" type="text" name="opening_qty"
                                            class="form-control form-control-sm">
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Type</label>
                                    <div class="d-flex">
                                        <input type="radio" id="both" name="type" value="3" class="filled-in" checked />
                                        <label for="both" class="mr-3">Both</label>

                                        <input type="radio"  value="1" id="E-Commerce" name="type" class="filled-in"/>
                                        <label for="E-Commerce" class="mr-3">E-Commerce</label>

                                        <input type="radio"  value="2" id="POS" name="type" class="filled-in"/>
                                        <label for="POS">POS</label>
                                    </div>
                                </div>
                            </div>


                            {{-- <div class="col-md-6 col-lg-4">
                            <div class="form-group">

                                    <label>Product Tags</label>
                                    <div class="controls">
                                        <input type="text" name="product_tags" class="form-control form-control-sm"
                                            value="Nice,Cool,Awesome" data-role="tagsinput">
                                    </div>

                                </div>

                            </div> --}}


                            <div class="col-md-6 col-lg-4">

                                <div class="form-group">
                                    <div class="controls mt-md-3">
                                        <fieldset>
                                            <input  {{ old('is_expireable') ? 'checked' : '' }} class="form-control form-control-sm" type="checkbox"
                                                id="is_expireable" name="is_expireable" value="1" checked>
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

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>




                        <div class="row">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Main thambnail <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input value="{{ old('product_thambnail') }}" type="file"
                                            id="product_thambnail" name="product_thambnail" onchange="mainThamUrl(this)"
                                            class="form-control form-control-sm" required>
                                    </div>
                                    @error('product_thambnail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <img src="" alt="" id="mainThmb">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Multi Image<span class="text-danger">*</span> </label>
                                    <div class="controls">
                                        <input type="file" name="multi_img[]" class="form-control form-control-sm"
                                            multiple="" value="{{ old('multi_img') }}" id="multiImg">
                                    </div>
                                    @error('multi_img')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="row" id="preview_img">

                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <div class="controls">

                                        <textarea id="editor1" name="short_descp" rows="10" cols="80">  {{ old('short_descp') }}</textarea>
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
                                                            {{ old('long_descp') }}
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
                                                            {{ old('specification_descp') }}
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
                                                    <input {{ old('on_sale') ? 'checked' : '' }} type="checkbox" id="checkbox_2" name="on_sale"
                                                        value="1">
                                                    <label for="checkbox_2">On Sale</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input {{ old('featured') ? 'checked' : '' }} type="checkbox" id="checkbox_3" name="featured"
                                                        value="1">
                                                    <label for="checkbox_3">Featured</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input  type="checkbox" id="checkbox_4"  {{ old('special_offer') ? 'checked' : '' }} name="special_offer"
                                                        value="1">
                                                    <label for="checkbox_4">Special offer</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox"  {{ old('top_rated') ? 'checked' : '' }} id="checkbox_5" name="top_rated"
                                                        value="1">
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
                                Specificaiton
                            </a>
                        </div>

                        <!-- Modal -->
                        <div class="modal modal-right fade" id="specificationModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-bold">Add Specification</h5>
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


    {{-- form submit spinner --}}
    {{-- <script>
        $(document).ready(function() {
            var form = document.getElementById('myForm'); // Replace 'myForm' with the ID of your form

            // Function to check if all required fields are filled
            function areRequiredFieldsFilled() {
                var isValid = true;

                // Loop through all form elements with the required attribute
                for (var i = 0; i < form.elements.length; i++) {
                    var element = form.elements[i];

                    // Check if the element is required and if it's valid
                    if (element.required && !element.checkValidity()) {
                        isValid = false;
                        break; // Exit the loop if any required field is not filled
                    }
                }

                return isValid;
            }




            // Function to submit the form if all required fields are filled
            function submitForm() {

                if (areRequiredFieldsFilled()) {

                    var submitButton = document.getElementById('addProductBtn');
                    submitButton.disabled = true;

                    var $loader = $("#loader");
                    var $startBtn = $("button.start");
                    var handleStartClick = function() {
                        $('#g-container').removeClass('d-none');
                        $loader.gSpinner();
                    };
                    $startBtn.click(handleStartClick);
                }
            }
        });
    </script> --}}

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


        $(document).ready(function() {
            loadSubcategory();
            loadSubsubcategory()
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
                    subcategorySelect.append('<option value="' + subcategory.id + '">' + subcategory
                        .subcategory_name + '</option>');
                }
            });
        }

        function loadSubsubcategory() {
            subsubcategorySelect.empty();
            subsubcategorySelect.append('<option value="">Choose Sub-subcategory</option>');
            $.each(subsubcategories, function(index, subsubcategory) {
                if (subsubcategory.subcategory_id == subcategorySelect.val()) {
                    subsubcategorySelect.append('<option value="' + subsubcategory.id + '">' + subsubcategory
                        .subsubcategory_name + '</option>');
                }
            });
        }
    </script>
@endsection
