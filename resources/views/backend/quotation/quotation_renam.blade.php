@extends('admin.admin_master')

@section('admin')
    <style>
        .border-red {
            border-color: red;
        }

        .error {
            border-color: red;

        }

        #saleList input[type="text"]:read-only {
            border: none;
            /* Remove the default border */
            outline: none;
            /* Remove the focus outline */
            padding: 0;
            /* Remove any padding */
            background-color: transparent;
            /* Set background color to transparent if needed */
        }

        #saleList input[type="text"],
        input[type="date"] {
            border: none;
            /* Remove the default border */
            /* padding: 0; */
            /* Remove any padding */
            background-color: transparent;
            /* Set background color to transparent if needed */
        }
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
        
        /* ::-webkit-input-placeholder {
        text-align: center;
        }

        :-moz-placeholder {
        text-align: center;
        } */
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

            <form id="saleForm" method="post" action="{{ route('quotation.store') }}" >
                @csrf
            <div class="box-body">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-md-8 order-md-2">
                                <div class="row float-right">
                                    <a type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#vendorModal">Add Customer</a>
                                </div>
                            </div>
                        
                            <div class="col-md-4 order-md-1">
                                <div class="form-group">
                                    <label>Customer Name<span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <select class="form-control form-control-sm select2" id="customer_id" name="customer_id">
                                            <option value="">Choose Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>To</label>
                                    <div class="controls">
                                        <textarea rows="1" name="to" id="to" class="form-control"  placeholder="To" aria-invalid="false"></textarea>
                                   
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subject</label>
                                    <div class="controls">
                                        <textarea rows="1" name="subject" id="subject" class="form-control"  placeholder="Subject" aria-invalid="false"></textarea>
                                   
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Product<span class="text-danger">*</span></label></h5>
                                    <div class="controls">
                                        <select class="form-control form-control-sm select2" id="product_id">
                                            <option value="">Choose Product</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Qty<span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" id="quantity"
                                            class="form-control form-control-sm numeric-input" />

                                    </div>
                                </div>
                            </div>
                       
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Price<span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" id="sale_price" name="sale_price"
                                            class="form-control form-control-sm decimal-input" />

                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-3">
                                <div class="form-group mt-3">
                                    <button class="btn btn-sm btn-success mt-3 addeventmore prevent-submit"><i class="fa fa-plus"></i>
                                        Add</button>
                                </div>
                            </div>
                        </div>



                        {{-- table --}}
                       
                                <!-- Table row -->
                                <div class="row" style="min-height: 200px">
                                    <div class="table-responsive">
                                        <table id="saleList" class="table table-sm  table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>QTY</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="addRow" class="addRow">
                                            </tbody>
                                            <tfoot id="tFooter">

                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row justify-content-center">
                                    <button type="submit" id="btnSubmit" class="btn btn-success btn-sm d-none">Submit</button>
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
        function calculateGrantTotal() {
            var grantTotal = 0;
            $('.saleList').each(function() {
                var subtotal = parseFloat($(this).find('input[name="total[]"]').val());
                grantTotal += subtotal;
            });
            $('input[name="grand_total"]').val(Math.round(grantTotal));
        }

        function calculateSales(row) {
            var $row = row || $(this).closest('.saleList');
            var quantity = parseFloat(row.find('input[name="quantity[]"]').val()) || 0;
            var salePrice = parseFloat(row.find('input[name="sale_price[]"]').val()) || 0;

            var total = quantity * salePrice;
            row.find('input[name="total[]"]').val(Math.round(total));
        }

        $(document).on('change',
            '.saleList input[name="quantity[]"], .saleList input[name="sale_price[]"]',
            function() {
                var row = $(this).closest('.saleList');
                calculateSales(row);
                calculateGrantTotal()
            });

            $(document).on('keypress',
            '.saleList input[name="quantity[]"], .saleList input[name="sale_price[]"]',
            function(event) {
                if (event.which === 13) {
                    event.preventDefault();
                    var row = $(this).closest('.saleList');
                    calculateSales(row);
                    calculateGrantTotal()
                }
            });


        function calculateAllSales() {
            $('.saleList').each(function() {
                calculateSales($(this));
            });
        }


        $(document).ready(function() {
            $('#saleForm').on('keypress', function(e) {
                // Check if the key pressed is 'Enter' (key code 13)
                if (e.which === 13) {
                    e.preventDefault(); // Prevent the default form submission
                    // You can add any other actions you want to perform when Enter is pressed
                }
            });
        });
    </script>

    <script>
        //get stock and unit using product id

        $(document).ready(function() {
            $(document).on("change", "#product_id", function() {
                var selectedId = $(this).val();
                if (selectedId != "") {
                    $.ajax({
                        type: "get",
                        url: "{{ route('get.sale.product') }}",
                        data: {
                            id: selectedId
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response)
                            $('#sale_price').val(response.product.selling_price);
                        }
                    });
                } else {
                    $('#sale_price').val("");
                }
            });
        });



        //check empty input

        $(document).on("click", ".addeventmore", function() {
            var product_id = $('#product_id').find('option:selected').val();
            var product_name = $('#product_id').find('option:selected').text();
            var quantity = $('#quantity').val();
            var sale_price = $('#sale_price').val();
            var total = Math.round(quantity * sale_price);


            if (checkEmptyPurchaseInput()) {

                var existingProductIds = $('input[name="product_id[]"]').map(function() {
                    return $(this).val();
                }).get();



                if (existingProductIds.includes(product_id)) {
                    var existingRow = $(".saleList").filter(function() {
                        return $(this).find('input[name="product_id[]"]').val() === product_id;
                    });

                    var existingQuantity = parseInt(existingRow.find('input[name="quantity[]"]').val()) || 0;
                    var totalQuantity = existingQuantity + parseInt(quantity);

                    console.log("total quantity" + totalQuantity);

                    var total = Math.round(totalQuantity * sale_price);
                    existingRow.find('input[name="quantity[]"]').val(totalQuantity)
                    existingRow.find('input[name="sale_price[]"]').val(sale_price)
                    existingRow.find('input[name="total[]"]').val(total)
                  
                    calculateGrantTotal();
                    return;
                }



                var newRow = `
                <tr class="saleList">
                    <td>
                        <input type="hidden" name="product_id[]" value="${product_id}">
                        ${product_name}
                    </td>
                    
                    <td>
                        <input class="numeric-input" type="text" name="quantity[]" value="${quantity}" style="width:60px">
                    </td>

                    <td>
                        <input class="decimal-input" type="text"  name="sale_price[]" value="${sale_price}" style="width:100px">
                    </td>

					<td>
                        <input type="text" name="total[]" value="${total}" readonly style="width:80px">
                    </td>
                    <td>
                        <a href="javascript:void(0)"><i class="fa-regular fa-trash-can text-danger"></i></a>
                    </td>


                </tr>
                <tr>
                `;

                $("#addRow").append(newRow);


                if ($('#grandTotalRow').length === 0) {
                    // Append the footer rowssaleForm
                    var footerRows = `
                    <tr id="grandTotalRow">
                        <td colspan="2"></td>
                        <td class="text-right text-danger font-weight-bold">Total Amount</td>
                        <td>
                            <input id="grandTotal" type="text" name="grand_total" readonly>
                        </td>
                    </tr>`;

                    $("#tFooter").append(footerRows);
                }

                $("#btnSubmit").removeClass("d-none");

                calculateGrantTotal();

                $('.numeric-input').on('input', function() {
                    var inputValue = $(this).val();
                    $(this).val(inputValue.replace(/[^0-9]/g, ''));
                });
            }


        });


        $(document).on('click', '.saleList .fa-trash-can', function() {
            $(this).closest('.saleList').remove();
            // Check if there are no table rows
            if ($('.saleList').length === 0) {
                $("#btnSubmit").addClass("d-none");
                $("#tFooter").empty();
                $("#addRow").empty();
            }

        });


        function checkEmptyPurchaseInput() {
            var fields = [{
                    id: 'customer_id',
                    message: 'Customer cannot be empty'
                },
                {
                    id: 'product_id',
                    message: 'Product cannot be empty'
                },
                {
                    id: 'quantity',
                    message: 'Quantity cannot be empty'
                },
                {
                    id: 'sale_price',
                    message: 'price cannot be empty'
                },
            ];

            var isValid = true;

            fields.forEach(function(field) {
                var value = $('#' + field.id).val().trim();

                if (value === '') {
                    isValid = false;
                    var formGroup = $("#" + field.id).closest(".form-group");
                    var errorMessage = formGroup.find(".errorMessage");

                    if (errorMessage.length === 0) {
                        errorMessage = $("<div>").addClass("text-danger errorMessage").text(field.message);
                        formGroup.append(errorMessage);
                    }

                    $("#" + field.id).addClass('error');
                } else {
                    $("#" + field.id).removeClass("error");
                    $("#" + field.id).closest(".form-group").find(".errorMessage").remove();
                }
            });

            return isValid;
        }
    </script>



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


{{-- <script>
    $('#saleForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
        // Create a FormData object from the form
        var formData = new FormData(this);
        // Make a POST request using jQuery AJAX
        $.ajax({
            url: '{{ route('quotation.store') }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log("data : ", data);
                if (data.customerPackageId) {
                    var newTabUrl = "{{ route('preview.quotation-report') }}" + "?id=" + data.customerPackageId;
                    var saleReportWindow = window.open(newTabUrl, "_blank");
                    showToastr(data.notification.type, data.notification.message);
                    // Reload the current page
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error('An error occurred: ', error);
                showToastr('error', xhr.responseJSON.message);
            }
        });
    });
</script> --}}


{{-- <script>
  $(document).ready(function() {
    // Click event for the form submission button
    $('#btnSubmit').on('click', function() {
        $('#saleForm').submit(); // Submit the form
    });

    // Click event for preventing form submission on other buttons
    $('.prevent-submit').on('click', function(event) {
        event.preventDefault(); // Prevent form submission for buttons with class 'prevent-submit'
    });
});

</script> --}}


<script>
    $(document).ready(function() {
        $('#saleForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission
            // Create a FormData object from the form
            var formData = new FormData(this);
            // Make a POST request using jQuery AJAX
            $.ajax({
                url: $(this).attr('action'), // Use the form's action URL
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log("data : ", data);
                    if (data.customerPackageId) {
                        var newTabUrl = "{{ route('preview.quotation-report') }}" + "?id=" + data.customerPackageId;
                        var saleReportWindow = window.open(newTabUrl, "_blank");
                        showToastr(data.notification.type, data.notification.message);
                        // Reload the current page
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('An error occurred: ', error);
                    showToastr('error', xhr.responseJSON.message);
                }
            });
        });
       
    // Click event for preventing form submission on other buttons
    $('.prevent-submit').on('click', function(event) {
        event.preventDefault(); // Prevent form submission for buttons with class 'prevent-submit'
    });
});

</script>

@endsection
