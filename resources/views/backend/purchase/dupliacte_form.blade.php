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
                        <h4>Add Quotation</h4>
                        <h6>Add/Update Quotation</h6>
                    </div>
                </div>


            </div>

            <!-- /.box-header -->

            <form id="saleForm" method="post" action="{{ route('quotation.store') }}">
                @csrf
                <div class="box-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quote Customer<span class="text-danger">*</span></label>
                                        <div class="d-flex">
                                            <select class="form-control form-control-sm select2" id="customer_id"
                                                name="customer_id">
                                                <option value="">Choose Customer</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                @endforeach
                                            </select>


                                            <div class="btn-group mx-2" role="group" aria-label="Second group">
                                                <a data-toggle="modal" data-target="#vendorModal"><i
                                                        class="mdi mdi-account-multiple btn btn-sm btn-success"></i></a>
                                            </div>

                                            {{-- <div class="btn-group" role="group" aria-label="Second group">
                                            <a><i class="mdi mdi-account-edit btn btn-sm btn-info"></i></a>
                                        </div> --}}



                                        </div>
                                        <!-- Error message container -->
                                        <div id="customerError" class="error-message mt-2 text-danger"></div>

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
                                            <select class="form-control form-control-sm select2">
                                                <option value="">Choose Person</option>

                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bill To : </label>
                                        <div class="controls">
                                            <textarea rows="1" name="to" id="to" class="form-control" placeholder="Bill To" aria-invalid="false"></textarea>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ship To : </label>
                                        <div class="controls">
                                            <textarea rows="1" name="subject" id="subject" class="form-control" placeholder="Ship To" aria-invalid="false"></textarea>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row ">
                                <div class="col-12 d-flex justify-content-start my-2">
                                    <a type="button" class="btn btn-sm btn-primary" id="addNewBtn"><i
                                            class="fa fa-plus"></i></a>
                                </div>
                            </div>




                            {{-- table --}}

                            <!-- Table row -->
                            <div class="row" style="min-height: 200px; min-width:800px">
                                <div class="table-responsive">
                                    <table id="saleList" class="table table-sm  table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Description</th>
                                                <th>Unit</th>
                                                <th>QTY</th>
                                                <th>Price</th>
                                                <th>Dis.</th>
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
                                                        name="grand_total" id="grandTotal" type="text" style="border:0px"
                                                        readonly></td>
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
                                                <td class='column-100 px-0 pt-0 font-weight-bold'>Net Payable : </td>
                                                <td class='column-100 px-0 pt-0 font-weight-bold'><input type="text"
                                                        id="netPayable" name="net_payable" value="0"
                                                        style="border:0px" readonly></td>
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
        </section>

        <!-- Modal -->
        <div class="modal center-modal fade" id="vendorModal" tabindex="-1">
            <div class="modal-dialog">
                <form id="vendorForm" method="POST" action="{{ route('vendor.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Customer</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row jutify-content-center">
                                <input type="hidden" name="type" value="2">
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
    </div>


    <script>
        // JavaScript code
        $(document).ready(function() {
            var customerPackageId;


            function addNewRow(rowData) {
                // Check if a customer is selected
                var customerId = $('#customer_id').val();
                if (!customerId) {
                    // Display an error message
                    $('#customerError').text('Please choose a customer.').show();

                    // Highlight the select box with a red border
                    $('#customer_id').css('border', '1px solid red');

                    return;
                }

                // Clear the error message and reset the border
                $('#customerError').text('').hide();
                $('#customer_id').css('border', '');

                // Set default values if rowData is null or undefined
                rowData = rowData || {};

                // Create a new row using the provided data or with default values
                var newRow = $("<tr data-item-id='" + rowData.id + "'>" +
                    "<input type='hidden' name='item_id[]' id='item_id' value='" + rowData.id + "'>" +
                    "<td class='column-140'>" +
                    "<select class='form-control form-control-sm select2 product-select' name='product_id[]'>" +
                    "<option value=''>Choose Product</option>" +
                    "@foreach ($products as $product)" +
                    "<option value='{{ $product->id }}' " + (rowData.product_id == '{{ $product->id }}' ?
                        'selected' : '') + ">{{ $product->product_name }}</option>" +
                    "@endforeach" +
                    "</select>" +
                    "</td>" +
                    "<td class='column-280'>" +
                    "<textarea type='text' rows='2' class='form-control form-control-sm description' name='description[]' style='height: 26px;'>" +
                    (rowData.description || '') + "</textarea>" +
                    "</td>" +
                    "<td class='column-80'>" +
                    "<input type='text' class='form-control form-control-sm unit-name' name='unit_name[]' readonly value='" +
                    ((rowData.unit && rowData.unit.name) || '') + "' />" +
                    "</td>" +
                    "<td class='column-80 d-none'>" +
                    "<input type='hidden' class='form-control form-control-sm unit-id' name='unit_id[]' readonly value='" +
                    ((rowData.unit && rowData.unit.id) || '') + "' />" +
                    "</td>" +
                    "<td class='column-80'>" +
                    "<input type='text' class='form-control form-control-sm qty numeric-input' name='qty[]' value='" +
                    (rowData.qty || '') + "' />" +
                    "</td>" +
                    "<td class='column-100'>" +
                    "<input type='text' class='form-control form-control-sm decimal-input sale-price' name='sale_price[]' value='" +
                    (rowData.price || '') + "' />" +
                    "</td>" +
                    "<td class='column-100'>" +
                    "<input type='text' class='form-control form-control-sm discount-price' name='discount_price[]' value='" +
                    (rowData.discount || '') + "' />" +
                    "</td>" +
                    "<td class='column-100'>" +
                    "<input type='text' class='form-control form-control-sm total' name='total[]' readonly value='" +
                    (rowData.total || '') + "' />" +
                    "</td>" +
                    "<td class='column-40'>" +
                    "<button data-item-id='" + rowData.id +
                    "' class='btn btn-danger btn-sm delete-row'> <i class='fa fa-trash'> </i></button>" +
                    "</td>" +
                    "</tr>");

                // Append the new row to the tbody
                $("#addRow").append(newRow);

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





            // Set up event listener for the change event on the product select load selling price and descritption 
            $("#saleList").on("change", ".product-select", function() {
                var selectedProductId = $(this).val();
                var currentRow = $(this).closest("tr");

                // Make an AJAX call with the selected product ID
                if (selectedProductId != "") {
                    $.ajax({
                        type: "get",
                        url: "{{ route('get.sale.product') }}",
                        data: {
                            id: selectedProductId
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response)
                            $('#sale_price').val(response.product.selling_price);

                            currentRow.find(".unit-id").val(response.product.unit.id);
                            currentRow.find(".unit-name").val(response.product.unit.name);
                            currentRow.find(".sale-price").val(response.product.selling_price);

                            calculateAllSales();

                            var description = response.product.short_descp;

                            // Remove <h2> and <ul> tags, extract text content of <li> elements
                            var result = $(description).find('h2, ul').remove().end().find('li')
                                .map(function() {
                                    return $(this).text();
                                }).get().join(', ');

                            currentRow.find(".description").val(result);

                            console.log(result);
                        }
                    });
                } else {
                    currentRow.find(".unit-id").val("");
                    currentRow.find(".sale-price").val("");
                    currentRow.find(".description").val("");
                }
            });

            //cursor move in qty filed
            $('#saleList').on('change', '.product-select', function() {
                var row = $(this).closest('tr');
                // Use setTimeout to delay the focus
                setTimeout(function() {
                    // Move cursor to the next input field (quantity) after selecting a product
                    row.find('.description').focus();
                }, 0);
            });

            //cursor move in next filed
            $('#saleList').on('keydown', '.description, .qty, .sale-price, .discount-price, #total_discount',
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
                        if ($(this).hasClass('description')) {
                            var qtyInput = row.find('.qty');
                            if (isValidInput($(this))) {
                                qtyInput.focus();
                            }
                        } else if ($(this).hasClass('qty')) {
                            var salePriceInput = row.find('.sale-price');
                            if (isValidInput($(this))) {
                                salePriceInput.focus();
                            }
                        } else if ($(this).hasClass('sale-price')) {
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

                row.find('.product-select, .qty, .sale-price').each(function() {
                    if ($(this).hasClass('product-select')) {
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


            // function addNewQuotationItem(row) {
            //     // Get values from the row
            //     var product_id = row.find('.product-select').val();
            //     var description = row.find('.description').val();
            //     var unit_id = row.find('.unit-id').val();
            //     var qty = row.find('.qty').val();
            //     var price = row.find('.sale-price').val();
            //     var discount = row.find('.discount-price').val();
            //     var total = row.find('.total').val();

            //     // Create an object with the values
            //     var quotationItemData = {
            //         customer_package_id : customerPackageId,
            //         product_id: product_id,
            //         description: description,
            //         unit_id: unit_id,
            //         qty: qty,
            //         price: price,
            //         discount: discount,
            //         total: total
            //     };

            //     // Use this object as the data for the AJAX request
            //     var updateUrl = "{{ route('quotation-item.store') }}";
            //     $.ajax({
            //         type: "post",
            //         url: updateUrl,
            //         data: quotationItemData, // Pass the object as data
            //         dataType: "JSON",
            //         success: function(response) {
            //             console.log("quotation item added:", response);
            //             showToastr(response.notification.type,response.notification.message);
            //         },
            //         error: function(error) {
            //             console.error('Error adding quotation item:', error);
            //         }
            //     });
            // }








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

                console.log("itemId: ", itemId);

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
                                    console.log('Item deleted successfully:', response);

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
                                        console.log("item : ", item);
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
                var productIds = $('select[name="product_id[]"]').map(function() {
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
                formData.append('customerPackageId', customerPackageId);

                $.ajax({
                    url: $('#saleForm').attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log("data : ", data);
                        customerPackageId = data.customerPackage.id

                        $('#customer_id').val(data.customerPackage.customer_id);
                        $("input[name='date']").val(data.customerPackage.date);
                        $('#to').val(data.customerPackage.to);
                        $('#subject').val(data.customerPackage.subject);
                        $('#grandTotal').val(data.customerPackage.total);
                        $('#total_discount').val(data.customerPackage.discount);
                        $('#netPayable').val(data.customerPackage.net_payable);

                        $('#addRow').empty();
                        $.each(data.customerPackageItems, function(index, item) {
                            console.log("item : ", item);
                            addNewRow(item);
                        });
                        showToastr(data.notification.type, data.notification.message);
                        if (preview) {
                            var newTabUrl = "{{ route('preview.quotation-report') }}" + "?id=" +
                                customerPackageId;
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
        });
    </script>

    <script>
        // Assuming your quantity and sale price inputs have the classes 'qty' and 'sale-price'
        $('#saleList').on('keyup', '.qty, .sale-price, .discount-price, #total_discount', function(event) {

            console.log("event.keyCode : ", $('#total_discount').val());
            if (event.keyCode === 13) { // Check for Enter key
                event.preventDefault();
                return false; // Stop further processing
            }

            var row = $(this).closest('tr');
            calculateSales(row);
            calculateGrantTotal();
            calculateNetPayable();
        });

        function calculateAllSales() {
            $('#saleList tr').each(function() {
                calculateSales($(this));
            });
            calculateGrantTotal();
            calculateNetPayable();
        }

        function calculateGrantTotal() {
            var grantTotal = 0;
            $('#addRow tr').each(function() {
                var subtotal = parseFloat($(this).find('input[name="total[]"]').val()) || 0;
                grantTotal += subtotal;
            });

            console.log("grantTotal : ", grantTotal);
            $('input[name="grand_total"]').val(Math.round(grantTotal));
        }

        function calculateNetPayable() {

            console.log("calculateNetPayable");
            var totalAmount = parseFloat($('input[name="grand_total"]').val());

            var totalDiscount = $('input[name="total_discount"]').val();

            console.log("totalDiscount ", totalDiscount)
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

        function calculateSales(row) {
            console.log('Calculating sales for row:', row);

            var quantity = parseFloat(row.find('input[name="qty[]"]').val()) || 0;
            var salePrice = parseFloat(row.find('input[name="sale_price[]"]').val()) || 0;
            var discount = row.find('input[name="discount_price[]"]').val();

            var discountPrice = 0;

            var percentageRegex = /^(\d+(\.\d+)?)%$/; // Regex pattern to match percentage values

            if (percentageRegex.test(discount)) {
                // If the discount matches the percentage pattern, calculate it as a percentage
                var discountValue = parseFloat(discount.replace('%', ''));
                discountPrice = (discountValue / 100) * salePrice;
            } else {
                // If the discount is a direct value, use it as the discount amount
                discountPrice = parseFloat(discount) || 0;
            }

            var unitCost = salePrice - discountPrice;
            var total = quantity * unitCost;

            // row.find('input[name="total[]"]').val(Math.round(total));
            row.find('input[name="total[]"]').val(Math.round(total) !== 0 ? Math.round(total) : '');

        }

        // Initial calculation when the page loads
        $(document).ready(function() {
            calculateAllSales();
            $('input[name="total_discount"]').val("");
        });
    </script>

    {{-- add customer clicking add button --}}
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
                        var selectElement = $('#customer_id');
                        selectElement.empty(); // Clear existing options
                        selectElement.append(
                            '<option value="">Choose Customer</option>'
                        ); // Add the default option

                        // Add options for each supplier from the response
                        $.each(response.suppliers, function(index, supplier) {
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
@endsection
