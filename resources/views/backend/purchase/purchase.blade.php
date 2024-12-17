@extends('admin.admin_master')

@section('admin')
    <style>
        .border-red {
            border-color: red;
        }

        .error {
            border-color: red;

        }




        /* #saleList input[type="text"]:read-only {
                                                                                                                                                                                                    border: none;
                                                                                                                                                                                                    outline: none;
                                                                                                                                                                                                    padding: 0;
                                                                                                                                                                                                    background-color: transparent;
                                                                                                                                                                                                } */

        /* #saleList input[type="text"],
                                                                                                                                                                                                input[type="date"] {
                                                                                                                                                                                                    border: none;
                                                                                                                                                                                                    
                                                                                                                                                                                                    background-color: transparent;
                                                                                                                                                                                                    
                                                                                                                                                                                                } */
        #saleList th {
            text-align: center;
        }

        #saleList td {
            text-align: center;
        }

        #saleList td input {
            text-align: center;
        }

        .page-break-before {
            page-break-before: always;
        }

        .page-break-after {
            page-break-after: always;
        }

        /* style.css */

        td.column-100 {
            width: 100px;
        }

        td.column-140 {
            max-width: 140px;
        }

        td.column-280 {
            max-width: 280px;
        }

        td.column-80 {
            width: 80px;
        }

        td.column-40 {
            width: 40px;
        }


        /* ::-webkit-input-placeholder {
                                                                                                                                                                                                        text-align: center;
                                                                                                                                                                                                        }

                                                                                                                                                                                                        :-moz-placeholder {
                                                                                                                                                                                                        text-align: center;
                                                                                                                                                                                                        } */

        .table-bordered td th {

            border: 2px solid red;
        }
    </style>
    <div class="container-full">
        <!-- Main content -->

        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box-header with-border py-0">
                        <h4>Add Purchase</h4>
                        <h6>Add/Store Purchase</h6>
                    </div>
                </div>

                <div class="col-md-9 d-flex justify-content-end align-items-center">
                    <div class="box-header with-border py-0">
                        <button href="" class="btn btn-sm btn-primary" data-toggle="modal"
                            data-target=".bs-example-modal-lg">
                            <i class="fas fa-plus mr-5"></i>Add Product</button>
                    </div>
                </div>




            </div>

            <!-- /.box-header -->

            <form id="saleForm" method="post" action="{{ route('store.purchase') }}">
                @csrf
                <div class="box-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Type : </label>
                                        <div class="col-md-8">
                                            <select name="type" id="type" class="form-control form-control-sm">
                                                <option value="1">Purchase</option>
                                                <option value="2">Purchase Return</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Supplier : </label>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <select class="form-control form-control-sm select2"
                                                        id="vendor_id" name="vendor_id">
                                                        <option value="">Choose Supplier</option>
                                                       
                                                            @foreach ($suppliers as $supplier)
                                                                <option value="{{ $supplier->id }}">
                                                                    {{ $supplier->name }}
                                                                </option>
                                                            @endforeach
                                                       
                                                    </select>

                                                    <div class="btn-group ml-2" role="group"
                                                        aria-label="Second group">
                                                        <a data-toggle="modal" data-target="#vendorModal"><i
                                                                class="mdi mdi-account-multiple btn btn-sm btn-success rounded-0"></i></a>
                                                    </div>
                                                </div>
                                                <!-- Error message container -->
                                                <div id="vendorError" class="error-message mt-2 text-danger"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Date : </label>
                                        <div class="col-md-8">
                                            <input class="form-control current-date" type="date" name="date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">SalesPerson : </label>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <div class="input-group">
                                                        <input id="sale_person_id" list="sale_person"
                                                            class="form-control form-control-sm">
                                                        <datalist id="sale_person">
                                                            @foreach ($admin as $item)
                                                                <option value="{{ $item->name }}"
                                                                    data-person-id="{{ $item->id }}"></option>
                                                            @endforeach
                                                        </datalist>
                                                        <span class="input-group-append">
                                                            <a class="btn btn-sm btn-info disabled btnSavePerson"><i
                                                                    class="mdi mdi-account-multiple"></i></a>
                                                        </span>

                                                        <input type="hidden" name="sale_person"
                                                            class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-12 d-flex justify-content-start my-2">
                                    <a type="button" class="btn btn-sm btn-primary" id="addNewBtn" data-toggle="tooltip"
                                        data-placement="top" title="Add Item"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>




                            {{-- table --}}

                            <!-- Table row -->
                            <div class="row" style="min-height: 200px">
                                <div class="table-responsive">
                                    <table id="saleList" class="table table-sm  table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Description</th>
                                                <th>Unit</th>
                                                <th>QTY</th>
                                                <th>P.Price</th>
                                                <th>Disc.</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody id="addRow" class="addRow">
                                        </tbody>


                                        <tfoot id="tFooter" class="d-none">
                                            <tr>
                                                <td colspan="5"></td>
                                                <td class='column-100 px-0 pb-0 font-weight-bold'>Total Amt : </td>
                                                <td class='column-100 px-0 pb-0 font-weight-bold'><input value="0"
                                                        name="grand_total" id="grandTotal" type="text"
                                                        style="border:0px" readonly></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td class='column-100 p-0 font-weight-bold'>Discount : </td>
                                                <td class='column-100 p-0 font-weight-bold'><input
                                                        class="form-control form-control-sm" id="total_discount"
                                                        type="text" name="total_discount"></td>
                                            </tr>

                                            <tr>
                                                <td colspan="5"></td>
                                                <td class='column-100 p-0 font-weight-bold'>Net Payable : </td>
                                                <td class='column-100 p-0 font-weight-bold'><input type="text"
                                                        id="netPayable" name="net_payable" value="0"
                                                        style="border:0px" readonly></td>
                                            </tr>

                                            <tr>
                                                <td colspan="5"></td>
                                                <td class='column-100 p-0 font-weight-bold'>Total Paid : </td>
                                                <td class='column-100 p-0 font-weight-bold'><input type="text"
                                                        class="form-control form-control-sm numeric-input"
                                                        id="totalPaid" name="total_paid"></td>
                                            </tr>


                                            <tr>
                                                <td colspan="5"></td>
                                                <td class='column-100 p-0 font-weight-bold'>Total Due : </td>
                                                <td class='column-100 p-0 font-weight-bold'><input type="text"
                                                        id="totalDue" name="total_due"
                                                        
                                                        style="border:0px" readonly>
                                                </td>
                                            </tr>

                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div id="btnSubmit" class="row justify-content-center  d-none">
                                <button type="submit" id="btnRecordSave" class="btn btn-success btn-sm">Record &
                                    Save</button>
                                <button type="submit" id="btnRecordPreview" class="btn btn-info btn-sm ml-2">Record &
                                    Preview</button>
                            </div>

                            <!-- /.content -->

                        </div>
                    </div>
                </div>
            </form>

            <audio id="confirmationSound">
                <source src="path-to-your-sound-file.mp3" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>


        </section>

          <!-- Modal -->
          <div class="modal center-modal fade" id="vendorModal" tabindex="-1">
            <div class="modal-dialog">
                <form id="vendorForm" method="POST" action="{{ route('vendor.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Supplier</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row jutify-content-center">
                                <input type="hidden" name="type" value="1">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="info-title">Name<span class="text-danger">*</span></label>
                                        <input id="name" type="text" placeholder="name" name="name"
                                            class="form-control form-control-sm">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="info-title">Phone<span class="text-danger">*</span></label>
                                        <input id="phone" type="text" placeholder="phone" name="phone"
                                            class="form-control form-control-sm">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-footer-uniform">
                            <button type="submit" class="btn btn-sm btn-success">Save</button>
                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal -->

        <!-- /.modal -->

        <div id="productModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold" id="myLargeModalLabel">Add Product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form id="productForm" method="post" action="{{ route('product.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Product Name<span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input id="product_name" type="text" name="product_name"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Purchase Price <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input id="purchase_price" type="text" name="purchase_price"
                                                class="form-control form-control-sm decimal-input" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6">

                                    <div class="form-group">
                                        <label>Selling Price <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input id="selling_price" type="text" name="selling_price"
                                                class="form-control form-control-sm decimal-input" required>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Unit<span class="text-danger">*</span></label>
                                        <select name="unit_id" id="unit_id"
                                            class="form-control form-control-sm select2" required>
                                            <option selected="true" disabled="disabled" value="">
                                                Choose Unit</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}">
                                                    {{ $unit->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Openning Qty</label>
                                        <div class="controls">
                                            <input id="opening_qty" onkeypress="return /[0-9]/i.test(event.key)"
                                                type="text" name="opening_qty" class="form-control form-control-sm"
                                                required>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <div class="d-flex">
                                            <input type="radio" value="2" id="POS" name="type"
                                                class="filled-in" checked />
                                            <label for="POS">POS</label>

                                            <input type="radio" value="1" id="E-Commerce" name="type"
                                                class="filled-in" />
                                            <label for="E-Commerce" class="mr-3">E-Commerce</label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <div class="controls">
                                            <textarea id="editor1" name="short_descp" rows="10" cols="80" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" id="addProductBtn"
                                    class="btn btn-success btn-sm mb-5 start">Submit</button>
                            </div>


                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>


    <script src="{{ asset('backend/js/pages/editor.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/ckeditor/ckeditor.js') }}"></script>


    <script>
        // JavaScript code
        $(document).ready(function() {

            var products = {!! json_encode($products) !!};
            var customerPackageId;


            // Function to update the datalist options based on the products array
            function updateDatalist() {
                var datalist = $('#products'); // Assuming you have an element with id 'products'
                datalist.empty(); // Clear existing options

                products.forEach(function(product) {
                    datalist.append('<option data-product-id="' + product.id + '" value="' + product
                        .quotation_product_name + '"></option>');
                });
            }

            // Call the function when the page loads to populate the datalist initially
            updateDatalist();

            function addNewRow(rowData) {
                // Check if a customer is selected
                var customerId = $('#vendor_id').val();
                if (!customerId) {
                    // Display an error message
                    $('#vendorError').text('Please choose a Supplier.').show();

                    // Highlight the select box with a red border
                    $('#vendor_id').css('border', '1px solid red');

                    return;
                }

                // Clear the error message and reset the border
                $('#vendorError').text('').hide();
                $('#vendor_id').css('border', '');

                // Set default values if rowData is null or undefined
                rowData = rowData || {};


                var newRow = $('<tr data-item-id="' + rowData.id + '">' +
                    '<input type="hidden" name="item_id[]" id="item_id" value="' + rowData.id + '">' +
                    '<td class="column-140 product_td">' +
                    '<input type="text" value="' + ((rowData.product && rowData.product
                        .quotation_product_name) || '') +
                    '" list="products" name="product_name[]" class="form-control form-control-sm product-select">' +
                    '<datalist id="products"></datalist>' +
                    '<input type="hidden" name="product_id[]" class="product-id-input" value="' +
                    (rowData.product_id || '') + '">' +
                    '</td>' +
                    '<td class="column-280">' +
                    '<textarea type="text" rows="2" class="form-control form-control-sm description" name="description[]" style="height: 26px;">' +
                    ((rowData.product && rowData.product.quotation_short_descp) || '') + '</textarea>' +
                    '</td>' +
                    "<td class='column-80'>" +
                    "<select class='form-control form-control-sm select2 unit-id' name='unit_id[]'>" +
                    "@foreach ($units as $unit)" +
                    "<option value='{{ $unit->id }}' " + (rowData.unit && rowData.unit.id ==
                        '{{ $unit->id }}' ?
                        'selected' : '') + ">{{ $unit->name }}</option>" +
                    "@endforeach" +
                    "</select>" +
                    "</td>" +
                    '<td class="column-80">' +
                    '<input type="text" class="form-control form-control-sm qty numeric-input" name="qty[]" value="' +
                    (rowData.qty || '') + '" />' +
                    '</td>' +
                    '<td class="column-100">' +
                    '<input type="text" value="' +
                    ((rowData.product && rowData.product.latestPurchase) ? rowData.product.latestPurchase
                        .price : (rowData.product ? rowData.product.purchase_price : '')) +
                    '" class="form-control form-control-sm purchase-price" name="purchase_price[]" ' +
                    '</td>' +
                    '<td class="column-100">' +
                    '<input type="text" class="form-control form-control-sm discount-price" name="discount_price[]" value="' +
                    (rowData.discount || '') + '" />' +
                    '</td>' +
                    '<td class="column-100">' +
                    '<input type="text" class="form-control form-control-sm total" name="total[]" readonly value="' +
                    (rowData.total || '') + '" />' +
                    '</td>' +
                    '<td class="column-40">' +
                    '<button data-item-id="' + rowData.id +
                    '" class="btn btn-danger btn-sm delete-row"> <i class="fa fa-trash"> </i></button>' +
                    '</td>' +
                    '</tr>');



                // Append the new row to the table
                $("#addRow").append(newRow);

                updateDatalist();


                // Reinitialize Select2 on the new select element
                $(".select2").select2();


                newRow.find('.product-select').focus();
            }

            // Handle "Add New" button click
            $(document).on('click', '#addNewBtn', function() {
                // Create a new row
                addNewRow();
                updateVisibility();
                calculateGrantTotal();
                calculateNetPayable();
            });

            var selectedProductId;
            // Set up event listener for the change event on the product select load selling price and descritption 
            $("#saleList").on("change", ".product-select", function() {
                var currentRow = $(this).closest("tr");
                var selectedProductName = $(this).val();

                var selectedOption = $('#products option[value="' + selectedProductName + '"]');

                var selectedProductId = selectedOption.data('product-id') ? selectedOption.data(
                        'product-id') :
                    selectedProductId;
                // Find the product_id input within the current row and set its value

                console.log("selectedProductId from change", selectedProductId);


                var product_id = currentRow.find('.product-id-input').val();
                console.log("currentRow product-id-input", product_id);


                if (selectedProductId != undefined) {
                    if (product_id == "" || product_id != selectedProductId || product_id != undefined) {
                        currentRow.find('.product-id-input').val(selectedProductId);
                        $.ajax({
                            type: "get",
                            url: "{{ route('get.sale.product') }}",
                            data: {
                                id: selectedProductId
                            },
                            dataType: "json",
                            success: function(response) {
                                console.log(response)
                                // $('#sale_price').val(response.product.selling_price);

                                currentRow.find(".unit-id").val(response.product.unit.id)
                                    .trigger(
                                        'change');
                               
                                currentRow.find(".purchase-price").val(response
                                    .latestPurchase !=
                                    null ? response.latestPurchase.price : response.product
                                    .purchase_price);
                                currentRow.find(".description").val(response.product
                                    .quotation_short_descp);
                                calculateAllSales();

                            }
                        });
                    }
                }
                console.log("currentRow product-id-input after ", currentRow.find('.product-id-input')
                    .val())

                if (selectedProductId != undefined) {
                    productInfo(selectedProductId, currentRow);
                } else {
                    productInfo(product_id, currentRow);
                }

            });

            function productInfo(selectedProductId, currentRow) {
                $.ajax({
                    type: "get",
                    url: "{{ route('get.sale.product') }}",
                    data: {
                        id: selectedProductId
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response)
                        // $('#sale_price').val(response.product.selling_price);

                        currentRow.find(".unit-id").val(response.product.unit.id).trigger(
                            'change');
                        
                        currentRow.find(".purchase-price").val(response.latestPurchase !=
                            null ? response.latestPurchase.price : response.product
                            .purchase_price);
                        currentRow.find(".description").val(response.product
                            .quotation_short_descp);
                        calculateAllSales();

                    }
                });
            }


            function handleChange(element, className, propertyName) {
                var currentRow = $(element).closest("tr");
                var product_id = parseInt(currentRow.find(".product-id-input").val());

                if (product_id !== "") {
                    var selectedValue = $(element).val();

                    console.log("selectedValue : ", selectedValue)

                    // Find the product in the original products array where selectedProductId matches
                    var originalProduct = products.find((product) => product.id === product_id);

                    console.log("Product Check Property : ", originalProduct[propertyName]);
                    console.log("Checked : ", originalProduct && originalProduct[propertyName] !== selectedValue)

                    // Compare the original product's property with the current selected value
                    if (originalProduct && String(originalProduct[propertyName]) !== String(selectedValue)) {
                        // Call an AJAX method to save in the database
                        updateQuotationProduct(product_id, selectedValue, propertyName)
                            .then(function(response) {

                                var indexToUpdate = products.findIndex((product) => product.id === product_id);

                                if (indexToUpdate !== -1) {
                                    products[indexToUpdate][propertyName] = selectedValue;
                                    console.log(response);

                                    $(".product_td").each(function() {
                                        var productIdInput = $(this).find(".product-id-input");
                                        var productId = parseInt(productIdInput.val());

                                        console.log("productId : ", productId);


                                        if (productId === parseInt(product_id)) {
                                            console.log("productId === parseInt(product_id : ",
                                                productId);
                                            console.log("element : ", element);
                                            var targetElement = $(this).closest("tr").find(className);
                                            targetElement.val(selectedValue).trigger('change');
                                        }
                                    });

                                    if (propertyName == "quotation_product_name") {
                                        var datalist = $("#products");
                                        var optionToUpdate = datalist.find('[data-product-id="' + product_id +
                                            '"]');
                                        optionToUpdate.attr("value", selectedValue);
                                    }

                                    showToastr(response.notification.type, response.notification.message);
                                    selectedProductId = undefined;
                                }


                            })
                            .catch(function(error) {
                                console.error(
                                    "Error updating quotation product " + propertyName + ":",
                                    error
                                );
                                // Handle the error, show a message, or perform other actions as needed
                            });
                    }
                }
            }

            function updateQuotationProduct(product_id, selectedValue, propertyName) {
                return $.ajax({
                    type: "POST",
                    url: "{{ route('update.quotation.product', ':id') }}".replace(
                        ":id",
                        product_id
                    ),
                    data: {
                        [propertyName]: selectedValue,
                    },
                    dataType: "JSON",
                });
            }

            //cursor move in next filed
            $('#saleList').on('keydown',
                '.product-select, .description,.unit-id, .qty,.purchase-price, .discount-price, #total_discount',
                function(event) {

                    if (event.keyCode === 13) { // Enter key
                        event.preventDefault();
                    }

                    var row = $(this).closest('tr');
                    calculateSales(row);
                    calculateGrantTotal();
                    calculateNetPayable();

                    // Move cursor to the next input field (discount price) after typing quantity or sale price
                    if (event.keyCode === 13) { // Enter key
                        event.preventDefault();
                        if ($(this).hasClass('product-select')) {
                            var descriptionInput = row.find('.description');
                            if (isValidInput($(this))) {
                                handleChange($(this), ".product-select", "quotation_product_name");
                                if (row.find('.product-id-input').val() != "") {
                                    descriptionInput.focus();

                                } else {
                                    isValidInput($(this));

                                    Swal.fire({
                                        icon: "error",
                                        title: "Select a product..!!",
                                    });
                                    // console.log('selectedProductId : ', selectedProductId)
                                }

                            }
                        } else if ($(this).hasClass('description')) {
                            console.log('Entering description block');
                            var unitInput = row.find('.unit-id');
                            if (isValidInput($(this))) {
                                console.log('Triggering select2:open event');
                                handleChange($(this), ".description", "quotation_short_descp");
                                unitInput.focus();

                                // Trigger the select2:open event to open the dropdown
                                // unitInput.select2('open');
                            }
                        } else if ($(this).hasClass('unit-id')) {

                            var qtyInput = row.find('.qty');
                            if (isValidInput($(this))) {
                                console.log('Moving focus to qty');
                                row.find('.unit-id').select2('close');
                                qtyInput.focus();
                            }
                        } else if ($(this).hasClass('qty')) {
                            var purchasePriceInput = row.find('.purchase-price');
                            if (isValidInput($(this))) {
                                purchasePriceInput.focus();
                            }
                        } else if ($(this).hasClass('purchase-price')) {
                            var discountPriceInput = row.find('.discount-price');
                            if (isValidInput($(this))) {
                                discountPriceInput.focus();
                            }
                        } else if ($(this).hasClass('discount-price')) {
                            // Check if all cells in the row are filled except for the discount cell
                            var isValidRow = isRowValid(row);

                            // Optionally, add new row logic here
                            if (isValidRow) {
                                // if(customerPackageId!="undefined"){
                                //     addNewQuotationItem(row);
                                // }
                                addNewRow();
                            }

                        }
                    }
                });


            $('#saleList').on('select2:open', '.unit-id', function(e) {
                console.log("i am form select2:open");

                var productId = $(this).closest('tr').find('.product-id-input').val();

                console.log("productId : ", productId);

                // Get the Select2 dropdown element
                var select2Dropdown = $(this).data('select2').$dropdown;

                // Unbind previous keydown event to avoid accumulation
                select2Dropdown.off('keydown');

                // Event listener for keydown on the Select2 dropdown
                select2Dropdown.on('keydown', function(event) {
                    // Check if the pressed key is Enter (key code 13)
                    if (event.keyCode === 13) {

                        // Find the selected option and get its value (unit_id)
                        var selectedOption = $(e.target).find(':selected');
                        var unitId = selectedOption.val();

                        handleChange(e.target, ".unit-id", "unit_id");

                        console.log("Selected unit_id: ", unitId);

                        var row = $(e.target).closest('tr');
                        var qtyInput = row.find('.qty');

                        // Delay the focus change after a short timeout
                        setTimeout(function() {
                            qtyInput.focus();
                        }, 100);
                    }
                });
            });

            //check cursor move invalid field validation

            function isValidInput(input) {
                // Check if the input value is not empty
                var value = input.val().trim();
                if (value === '') {
                    // Add a border to indicate an issue
                    input.css('border', '1px solid red');
                    return false;
                } else {
                    // Reset the border
                    input.css('border', '');
                    return true;
                }
            }

            function isRowValid(row) {
                // Check if all cells in the row are filled except for the discount cell
                var isValid = true;

                row.find('.product-select,.description,.unit-id, .qty,.purchase-price').each(
                    function() {
                        if ($(this).hasClass('unit-id')) {
                            // Check if the select2 value is not empty
                            if ($(this).next().find('.select2-selection').hasClass(
                                    'select2-selection--single') && !isValidInput($(this))) {
                                isValid = false;
                                // Set border color to red for the empty cell
                                $(this).next().find('.select2-selection').css('border-color', 'red');
                            }
                        } else {
                            // Check if other input values are not empty
                            if (!isValidInput($(this))) {
                                isValid = false;
                                // Set border color to red for the empty cell
                                $(this).css('border-color', 'red');
                            }
                        }
                    });

                return isValid;
            }

            //show and hide table footer. total,discount, net payable 
            function updateVisibility() {
                // Check if there are rows in the table body
                var hasRows = $("#addRow tr").length > 0;

                // Toggle the d-none class on the tfoot and btnSubmit elements
                $("#tFooter").toggleClass("d-none", !hasRows);
                $("#btnSubmit").toggleClass("d-none", !hasRows);
            }

            // Delete the row when the delete button is clicked
            $("#saleList").on("click", ".delete-row", function(event) {
                event.preventDefault();

                var rowToDelete = $(this).closest("tr");
                var itemId = $(this).data("item-id");

                // console.log("itemId: ", itemId);

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, proceed with deletion
                        var updateUrl = "{{ route('quotation-item.destroy', ':quotation-item') }}";
                        updateUrl = updateUrl.replace(':quotation-item', itemId);

                        // Perform an AJAX call to delete the item from the database
                        if (itemId != "undefined") {
                            $.ajax({
                                url: updateUrl,
                                method: 'DELETE',
                                success: function(response) {
                                    // Handle success, e.g., show a success message
                                    // console.log('Item deleted successfully:', response);

                                    showToastr(response.notification.type, response
                                        .notification.message);

                                    $('#grandTotal').val(response.customerPackage
                                        .total);
                                    $('#total_discount').val(response.customerPackage
                                        .discount);
                                    $('#netPayable').val(response.customerPackage
                                        .net_payable);
                                    $('#addRow').empty();

                                    $.each(response.customerPackageItems, function(
                                        index, item) {
                                        // console.log("item : ", item);
                                        addNewRow(item);
                                    });

                                    // Remove the row from the table
                                    rowToDelete.remove();

                                    updateVisibility();
                                },
                                error: function(error) {
                                    // Handle error, e.g., show an error message
                                    console.error('Error deleting item:', error);
                                }
                            });
                        } else {
                            // If itemId is not present, just remove the row from the table
                            rowToDelete.remove();

                            // Perform other calculations and updates
                            var row = rowToDelete;
                            calculateSales(row);
                            calculateGrantTotal();
                            calculateNetPayable();
                            updateVisibility();
                        }

                        var hasRows = $("#addRow tr").length > 0;
                        $('#total_discount').val(0, !hasRows);
                    }
                });
            });

            //save and update in database..............
            function checkQuotationItems() {
                // Select all elements with names starting with "product_id" and "total"
                var productIds = $('input[name="product_id[]"]').map(function() {
                    return $(this).val();
                }).get();

                var totals = $('input[name="total[]"]').map(function() {
                    return $(this).val();
                }).get();

                // Check if both arrays have at least one element
                if (productIds.some(Boolean) && totals.some(Boolean)) {
                    return true;
                } else {
                    showToastr('error', 'No items to create the quotation.');
                }

            }

            // Common function for form submission
            function submitForm(preview) {
                var formData = new FormData($('#saleForm')[0]);
                // Append the customerPackageId to the formData
                

                $.ajax({
                    url: $('#saleForm').attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log("data : ", data);
                        // customerPackageId = data.customerPackage.id

                        // $('#vendor_id').val(data.customerPackage.vendor_id);
                        // $("input[name='date']").val(data.customerPackage.date);
                        // $('#to').val(data.customerPackage.to);
                        // $('#subject').val(data.customerPackage.subject);
                        // $('#grandTotal').val(data.customerPackage.total);
                        // $('#total_discount').val(data.customerPackage.discount);
                        // $('#netPayable').val(data.customerPackage.net_payable);

                        // $('#addRow').empty();
                        // $.each(data.customerPackageItems, function(index, item) {
                        //     // console.log("item : ", item);
                        //     addNewRow(item);
                        // });
                        showToastr(data.notification.type, data.notification.message);
                        if (preview) {
                            var newTabUrl =
                                "{{ route('preview.quotation-or-invoice.report', ['type' => 'quotation', 'id' => '__id__']) }}";
                            newTabUrl = newTabUrl.replace('__id__', customerPackageId);
                            var saleReportWindow = window.open(newTabUrl, "_blank");
                        }


                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred: ', error);
                        showToastr('error', xhr.responseJSON.message);
                    }
                });
            }

            // Event handling for save button
            $('#btnRecordSave').on('click', function(event) {
                event.preventDefault();
                if (checkQuotationItems()) {
                    // console.log("checkQuotationItems : ", checkQuotationItems());
                    submitForm(false); // Pass false to indicate no preview
                }
            });

            // Event handling for save and preview button
            $('#btnRecordPreview').on('click', function(event) {
                event.preventDefault();

                if (checkQuotationItems()) {
                    // console.log("checkQuotationItems : ", checkQuotationItems());
                    submitForm(true); // Pass true to indicate preview
                }
            });

            // Click event for preventing form submission on other buttons
            $('.prevent-submit').on('click', function(event) {
                event.preventDefault(); // Prevent form submission for buttons with class 'prevent-submit'
            });

            updateVisibility();




            //add product button work here .....

            $('#productForm').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission behavior

                // Synchronize CKEditor content with the textarea
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                // Serialize the form data
                var formData = new FormData(this);

                // Make the Ajax request
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'), // Get the form's action attribute
                    data: formData,
                    processData: false, // Don't process the data (needed for file uploads)
                    contentType: false, // Don't set content type (needed for file uploads)
                    dataType: 'json', // Expect JSON response (adjust as needed)

                    success: function(response) {
                        // Handle the success response here
                        console.log(response);

                        // Update the products array with the new product
                        products.push(response.product);

                        // Update the datalist options
                        updateDatalist();


                        showToastr(response.notification.type, response.notification.message)
                        $('#productModal').modal('hide');
                    },

                    error: function(xhr, textStatus, errorThrown) {
                        console.log("xhr : ", xhr);
                        requestValidate(xhr);
                    }
                });
            });

            $('#productModal').on('hidden.bs.modal', function() {
                console.log("This is working ...............");
                $('#productForm .errorMessage').remove();

                // Reset the form using vanilla JavaScript
                $('#productForm')[0].reset();


            });

            function requestValidate(xhr) {
                $('.errorMessage').remove();

                // console.log("xhr.responseJSON.errors : ",xhr.responseJSON.errors)
                // Handle the validation errors if they exist in the response
                if (xhr.responseJSON && xhr.responseJSON.errors) {

                    $.each(xhr.responseJSON.errors, function(fieldName, errorMessages) {
                        var errorMessage = '<span class="text-danger errorMessage">' + errorMessages[0] +
                            '</span>';
                        $('#' + fieldName).after(errorMessage);
                    });
                }
            }
            
        });
    </script>

    <!--calculation part total,discount,netpayable-->
    <script>
        // Assuming your quantity and sale price inputs have the classes 'qty' and 'sale-price'
        $(document).on('keyup', '.qty, .discount-price, #total_discount, #saleList #totalPaid', function(
            event) {

            // console.log("event.keyCode : ", $('#total_discount').val());
            if (event.keyCode === 13) { // Check for Enter key
                event.preventDefault();
                return false; // Stop further processing
            }
            // Check if the keyup event is on #total_discount
            if ($(event.target).is('#total_discount')) {
                // Perform specific action for #total_discount
                $("#addRow tr").each(function() {
                    $(this).find('.discount-price').val(null);
                    calculateSales($(this));
                });
                console.log("i am from .discount-price : ");
            }

            if ($(event.target).is('.discount-price')) {
                $('#total_discount').val("");
                console.log("i am form total_discount : ");
            }


            var row = $(this).closest('tr');
            calculateSales(row);
            calculateGrantTotal();
            calculateNetPayable();
            calculateTotalDue();
        });

        function calculateAllSales() {
            $('#saleList tr').each(function() {
                calculateSales($(this));
            });
            calculateGrantTotal();
            calculateNetPayable();
            calculateTotalDue()
        }

        function calculateGrantTotal() {
            var grantTotal = 0;
            $('#addRow tr').each(function() {
                var subtotal = parseFloat($(this).find('input[name="total[]"]').val()) || 0;
                grantTotal += subtotal;
            });
            $('input[name="grand_total"]').val(Math.round(grantTotal));
        }

        function calculateNetPayable() {
            var totalAmount = parseFloat($('input[name="grand_total"]').val());

            var totalDiscount = $('input[name="total_discount"]').val().trim();
            var netPayable = 0;

            var discountPrice = 0;

            var percentageRegex = /^(\d+(\.\d+)?)%$/; // Regex pattern to match percentage values



            if (percentageRegex.test(totalDiscount)) {
                // If the discount matches the percentage pattern, calculate it as a percentage
                var discountValue = parseFloat(totalDiscount.replace('%', ''));
                discountPrice = (discountValue / 100) * totalAmount;
            } else {
                // If the discount is a direct value, use it as the discount amount
                discountPrice = parseFloat(totalDiscount) || 0;

            }





            netPayable = totalAmount - discountPrice

            $('input[name="net_payable"]').val(Math.round(netPayable));
        }

        function calculateTotalDue() {
            var netPayable = parseFloat($('#netPayable').val());
            var totalPaid = 0;
            if ($('#totalPaid').val() != "") {
                totalPaid = parseFloat($('#totalPaid').val());
            }
            var totalDue = netPayable - totalPaid;
            $('#totalDue').val(Math.round(totalDue));
        }

        function calculateSales(row) {

            var quantity = parseFloat(row.find('input[name="qty[]"]').val()) || 0;
            var price = parseFloat(row.find('input[name="purchase_price[]"]').val()) || 0;
            var discount = row.find('input[name="discount_price[]"]').val();


            var discountPrice = 0;

            var percentageRegex = /^(\d+(\.\d+)?)%$/; // Regex pattern to match percentage values

            if (percentageRegex.test(discount)) {

                // If the discount matches the percentage pattern, calculate it as a percentage
                var discountValue = parseFloat(discount.replace('%', ''));
                discountPrice = (discountValue / 100) * price;
            } else {
                // If the discount is a direct value, use it as the discount amount
                discountPrice = parseFloat(discount) || 0;
            }



            var unitCost = price - discountPrice;
            var total = quantity * unitCost;

            // row.find('input[name="total[]"]').val(Math.round(total));
            row.find('input[name="total[]"]').val(Math.round(total) !== 0 ? Math.round(total) : '');

        }

        // Initial calculation when the page loads
        $(document).ready(function() {
            calculateAllSales();
        });
    </script>

    <!--add Supplier clicking add button-->
    <script>
        $(document).ready(function() {
            $('#vendorForm').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission behavior

                // Serialize the form data
                var formData = new FormData(this);

                // Make the Ajax request
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'), // Get the form's action attribute
                    data: formData,
                    processData: false, // Don't process the data (needed for file uploads)
                    contentType: false, // Don't set content type (needed for file uploads)
                    dataType: 'json', // Expect JSON response (adjust as needed)

                    success: function(response) {
                        // Handle the success response here
                        console.log(response);
                        showToastr(response.notification.type, response.notification.message)
                        var selectElement = $('#supplier_id');
                        selectElement.empty(); // Clear existing options
                        selectElement.append(
                            '<option value="">Choose Supplier</option>'
                            ); // Add the default option

                        // Add options for each supplier from the response
                        $.each(response.vendors, function(index, supplier) {
                            selectElement.append('<option value="' + supplier.id +
                                '">' + supplier.name + '</option>');
                        });

                        // Close the modal (adjust the selector and method based on your modal library)
                        $('#vendorModal').modal('hide');
                        vendorForm();
                    },

                    error: function(xhr, textStatus, errorThrown) {
                        // Handle any errors here
                        console.error(errorThrown);
                        requestValidate(xhr);
                    }
                });
            });


            function requestValidate(xhr) {
                $('.errorMessage').remove();
                // Handle the validation errors if they exist in the response
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(fieldName, errorMessages) {
                        var errorMessage = '<span class="text-danger errorMessage">' + errorMessages[0] +
                            '</span>';
                        $('#' + fieldName).after(errorMessage);
                    });
                }
            }

            $('#vendorModal').on('hidden.bs.modal', function() {
                vendorForm();
            });

            function vendorForm() {
                $('#name').val('') // Clear the select options if needed
                $('#phone').val('')
                $('#vendorForm .errorMessage').remove()
            }

        });
    </script>

    <!--add sales person button work here-->
    <script>
        $(document).ready(function() {
            // Attach an event listener to the input
            $('#sale_person_id').on('input', function() {
                var inputVal = $(this).val().trim().toLowerCase();
                var dataListOptions = $('#sale_person').find('option');

                // Check if the input value is in the datalist options
                var matchingOption = dataListOptions.filter(function() {
                    return $(this).val().toLowerCase() === inputVal;
                });

                if (matchingOption.length > 0 || inputVal === '' || inputVal === null) {
                    // Value exists in datalist
                    var personId = matchingOption.data('person-id');
                    $('input[name="sale_person"]').val(personId);
                    $('.btnSavePerson').addClass('disabled');
                } else {
                    // Value doesn't exist in datalist
                    $('input[name="sale_person"]').val('');
                    $('.btnSavePerson').removeClass('disabled');
                }
            });
            $('.btnSavePerson').on('click', function() {

                var name = $('#sale_person_id').val().trim();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('user-management.store') }}",
                    data: {
                        name: name
                    },
                    dataType: 'json', // Expect JSON response (adjust as needed)

                    success: function(response) {
                        // Handle the success response here
                        console.log(response);

                        // Add a new option to the datalist
                        $('#sale_person').append('<option value="' + name +
                            '" data-person-id="' + response.salePerson.id + '"></option>');

                        $('input[name="sale_person"]').val(response.salePerson.id);
                        $('.btnSavePerson').addClass('disabled');
                        showToastr(response.notification.type, response.notification.message)
                    },

                    error: function(xhr, textStatus, errorThrown) {
                        // Handle any errors here
                        console.error(xhr);
                        showToastr("error", xhr.responseJSON.errors)
                    }
                });


            });

        });
    </script>

     <!--redirect add product form when check type both-->
    <script>
        $(document).ready(function() {
            $('input[name="type"]').change(function() {
                if ($(this).is(':checked')) {
                    console.log('Checked radio value:', $(this).val());

                    if ($(this).val() == 1) {
                        Swal.fire({
                            title: 'Confirmation',
                            text: 'Are you sure you want to proceed?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'OK',
                            cancelButtonText: 'Cancel',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href =
                                    "{{ url(route('product.create')) }}"; // Replace with your target page URL
                            } else {
                                $('#POS').prop('checked', true);
                            }
                        });
                    }
                }
            });
        });
    </script>

   
@endsection
