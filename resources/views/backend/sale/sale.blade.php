@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .border-red {
            border-color: red;
        }

        .error {
            border-color: red;

        }

        #productList input[type="text"]:read-only {
            border: none;
            /* Remove the default border */
            outline: none;
            /* Remove the focus outline */
            padding: 0;
            /* Remove any padding */
            background-color: transparent;
            /* Set background color to transparent if needed */
        }

        #productList input[type="text"],
        input[type="date"] {
            border: none;
            /* Remove the default border */
            /* padding: 0; */
            /* Remove any padding */
            background-color: transparent;
            /* Set background color to transparent if needed */
        }
    </style>
    <div class="container-full">
        <!-- Main content -->

        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box-header with-border py-0">
                        <h4>Add Sale</h4>
                        <h6>Add/Update Sale</h6>
                    </div>
                </div>

                <div class="col-md-9 text-right">
                    <!-- HTML buttons -->
                    <button class="btn btn-dark btn-sm" id="btncounter1" value="1"
                        onclick="counterWisePendingSale(1)">C1</button>
                    <button class="btn btn-dark btn-sm" id="btncounter2" value="2"
                        onclick="counterWisePendingSale(2)">C2</button>
                    <button class="btn btn-dark btn-sm" id="btncounter3" value="3"
                        onclick="counterWisePendingSale(3)">C3</button>
                    <button class="btn btn-dark btn-sm" id="btncounter4" value="4"
                        onclick="counterWisePendingSale(4)">C4</button>
                    <button class="btn btn-dark btn-sm" id="btncounter5" value="5"
                        onclick="counterWisePendingSale(5)">C5</button>
                    <button class="btn btn-dark btn-sm" id="btncounter6" value="6"
                        onclick="counterWisePendingSale(6)">C6</button>




                </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Type<span class="text-danger">*</span></label>
                            <div class="controls">
                                <select class="form-control form-control-sm" id="sale_type" name="sale_type">
                                    <option value="3">Sale</option>
                                    <option value="4">Sale Return</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="row float-right">
                            <a type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#vendorModal">Add
                                Customer</a>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sales Invoice No<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" value="{{ $saleInvoice }}" id="sale_no" name="sale_no"
                                    class="form-control form-control-sm" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sale Date<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="date" class="date form-control current-date" id="sale_date" name="sale_date" />
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
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


                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Product Name<span class="text-danger">*</span></label></h5>
                            <div class="controls">
                                <select class="form-control form-control-sm select2" id="product_id" name="product_id">
                                    <option value="">Choose Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3" id="unitDiv">
                        <div class="form-group">
                            <label>Product Unit<span class="text-danger">*</span></label>
                            <div class="controls">
                                <select class="form-control form-control-sm" id="unit_id" name="unit_id">
                                </select>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Stock</label>
                            <div class="controls">
                                <input type="text" class="form-control form-control-sm" id="stock" value="0" name="stock"
                                    readonly />
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Quantity<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" id="quantity" name="quantity"
                                    class="form-control form-control-sm numeric-input" />

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Purchase Price</label>
                            <div class="controls">
                                <input type="text" id="purchase_price" name="purchase_price"
                                    class="form-control form-control-sm" readonly/>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sale Price<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" id="sale_price" name="sale_price"
                                    class="form-control form-control-sm decimal-input" />

                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 d-none">
                        <div class="form-group">
                            <label>Vat(%)</label>
                            <div class="controls">
                                <input type="text" id="vat" name="vat"
                                    class="form-control form-control-sm numeric-input" />

                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group mt-3">
                            <button class="btn btn-sm btn-dark mt-3 addeventmore"><i class="fa fa-plus"></i>
                                Add</button>
                        </div>
                    </div>


                </div>
            </div>
        </section>

         <!-- Modal -->
         <div class="modal center-modal fade" id="vendorModal" tabindex="-1">
            <div class="modal-dialog">
                <form id="vendorForm" method="POST" action="{{ route('vendor.store') }}"
                    enctype="multipart/form-data">
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


        <form method="post" id="saleForm" action="{{ route('store.sale') }}">
            @csrf
            <section class="invoice printableArea pt-0">
                <!-- Table row -->
                <div class="row">
                    <div class="table-responsive">
                        <table id="productList" class="table table-sm  table-bordered">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Unit</th>
                                    <th>QTY</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Unit Cost</th>
                                    <th>Total Amt.</th>
                                    {{-- <th>Vat(%)</th>
                                    <th>Total Vat</th> --}}
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="addRow" class="addRow">
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row justify-content-end mt-10 mt-md-50">
                    <div class="d-flex justify-content-end">
                        <table id="saleFooter">
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print mt-2">
                    <div class="col-12">
                        <button id="btnSubmit" type="submit" class="btn btn-sm  btn-success pull-right disabled"><i
                                class="fa fa-credit-card"></i> Submit Payment
                        </button>
                    </div>
                </div>

            </section>
        </form>
        <!-- /.content -->
    </div>
    </div>
    <!-- /.content-wrapper -->


    <!-- ... Your existing HTML content ... -->






    <script>
        let gcounter = 1; // Use let instead of var for better scoping

        $(document).ready(() => {
            counterWisePendingSale(gcounter);
            getSessionData(gcounter)
        });

        function counterWisePendingSale(counter) {
            // Remove active class from all buttons
            $(".btn").removeClass("btn-success").addClass("btn-dark");

            // Set the clicked button as active
            $(`#btncounter${counter}`).removeClass("btn-dark").addClass("btn-success");

            gcounter = counter;

            getSessionData(counter)

        }

        //store data in session

        function StoreSessionData() {
            var dataObj = {};
            // Retrieve data from the rows with class "saleList"
            dataObj.product_id = [];
            dataObj.product_name = []; // Add product_name array
            dataObj.unit_id = [];
            dataObj.unit_name = [];
            dataObj.quantity = [];
            dataObj.sale_price = [];
            dataObj.discount_price = [];
            dataObj.unit_cost = [];
            dataObj.total = [];
            dataObj.vat = [];
            dataObj.total_vat = [];
            dataObj.subtotal = [];

            $('.saleList').each(function() {
                var row = $(this);
                
                dataObj.product_id.push(row.find('input[name="product_id[]"]').val());
                dataObj.product_name.push(row.find('td:eq(0)').text()
                    .trim()); // Assuming the product_name is in the first <td> element of each row
                dataObj.unit_id.push(row.find('input[name="unit_id[]"]').val());
                dataObj.unit_name.push(row.find('td:eq(1)').text()
                    .trim()); // Assuming the unit name is in the third <td> element of each row
                dataObj.quantity.push(row.find('input[name="quantity[]"]').val());
                dataObj.sale_price.push(row.find('input[name="sale_price[]"]').val());
                dataObj.discount_price.push(row.find('input[name="discount_price[]"]').val());
                dataObj.unit_cost.push(row.find('input[name="unit_cost[]"]').val());
                dataObj.total.push(row.find('input[name="total[]"]').val());
                dataObj.vat.push(row.find('input[name="vat[]"]').val());
                dataObj.total_vat.push(row.find('input[name="total_vat[]"]').val());
                dataObj.subtotal.push(row.find('input[name="subtotal[]"]').val());
            });

            // Retrieve data from the footer rows
            dataObj.customer_id= $('input[name="customer_id[]"]').val();
            dataObj.sale_date = $('input[name="sale_date"]').val();
            dataObj.type = $('input[name="type"]').val();
            dataObj.grand_total = $('input[name="grand_total"]').val();
            dataObj.vat_on_parcentage = $('input[name="vat_on_parcentage"]').val();
            dataObj.vat_on_taka = $('input[name="vat_on_taka"]').val();
            dataObj.total_amount = $('input[name="total_amount"]').val();
            dataObj.discout_parcentage = $('input[name="discout_parcentage"]').val();
            dataObj.discount_taka = $('input[name="discount_taka"]').val();
            dataObj.net_payable = $('input[name="net_payable"]').val();
            dataObj.total_paid = $('input[name="total_paid"]').val();
            dataObj.total_due = $('input[name="total_due"]').val();
            dataObj.counter = gcounter;

            // Log the final data object to the console
            console.log(dataObj);

            $.ajax({
                type: "POST",
                url: "{{ route('store.sale-data-session') }}", // Replace this with the URL to your Laravel route to store the sale data
                data: dataObj,
                dataType: "json",
                success: function(response) {
                    console.log("Sale data successfully stored in the session.");
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                }
            });
        }


        //get session data in session

        function getSessionData(counter) {
            console.log('adddd');
            $.ajax({
                type: "get",
                data: {
                    counter: counter
                },
                url: "{{ route('get.sale-data-session') }}",
                dataType: "json",
                success: function(response) {
                    console.log(response);

                    // Clear existing rows in the table body and footer
                    $("#addRow").empty();
                    $("#saleFooter").empty();
                    if (Object.keys(response).length > 0) {
                        // Loop through each item in the response and create rows for each item
                        for (let i = 0; i < response.product_id.length; i++) {
                            const productId = response.product_id[i] || "";
                            const productName = response.product_name[i] || "";
                            const unitId = response.unit_id[i] || "";
                            const unitName = response.unit_name[i] || "";
                            const quantity = response.quantity[i] || "";
                            const salePrice = response.sale_price[i] || "";
                            const discountPrice = response.discount_price[i] || "";
                            const unitCost = response.unit_cost[i] || "";
                            const total = response.total[i] || "";
                            const vat = response.vat[i] || "";
                            const totalVat = response.total_vat[i] || "";
                            const subtotal = response.subtotal[i] || "";
                            var newRow = `
                    <tr class="saleList">
                        <input type="hidden" name="product_id[]" value="${productId}">
                        <td>${productName}</td>
                        <td>
                            <input type="hidden" name="unit_id[]" value="${unitId}">
                            ${unitName}
                        </td>
                        <td>
                            <input class="numeric-input" type="text" name="quantity[]" value="${quantity}" style="width:60px">
                        </td>
                        <td>
                            <input type="text" name="sale_price[]" value="${salePrice}" readonly style="width:100px">
                        </td>
                        <td>
                            <input type="text" class="discount-input" name="discount_price[]" value="${discountPrice}" style="width:80px">
                        </td>
                        <td>
                            <input type="text" name="unit_cost[]" value="${unitCost}" readonly style="width:80px">
                        </td>
                        <td>
                            <input type="text" name="total[]" value="${total}" readonly style="width:80px">
                        </td>
                        <td class="d-none">
                            <input type="text" class="numeric-input" name="vat[]" value="${vat}" style="width:60px">
                        </td>
                        <td class="d-none">
                            <input type="text" name="total_vat[]" value="${totalVat}" readonly style="width:60px">
                        </td>
                        <td>
                            <input type="text" name="subtotal[]" value="${subtotal}" readonly style="width:60px">
                        </td>
                        <td><a href="javascript:void(0)"><i class="fa-regular fa-trash-can text-danger"></i></a></td>
                    </tr>`;

                            $("#addRow").append(newRow);

                        }

                        // Create the footer rows with the appropriate data
                        var footerRows = `
                        <tr>
                        <td id="customerType">
                            <input type="hidden" name="customer_id" value="${response.customer_id}">
                        </td>
                    </tr>
                <tr>
                    <td id="typeCell"><input type="hidden" name="type" value="${response.type}"></td>
                </tr>

                <tr>
                    <td id="saleDateCell"><input type="hidden" name="sale_date" value="${response.sale_date}"></td>
                </tr>

                <tr>
                    <td><input type="hidden" name="counter" value="${response.counter}"></td>
                </tr>
                
                <tr>
                    <td class="font-size-14 font-weight-600">Grand Total</td>
                    <td>:</td>
                    <td class="text-left"><input name="grand_total" value="${response.grand_total}" type="text" readonly></td>
                </tr>
                <tr class="d-none">
                    <td class="font-size-14 font-weight-600">Vat On Invoice</td>
                    <td>:</td>
                    <td>
                        <input class="numeric-input" value="${response.vat_on_parcentage || ""}" name="vat_on_parcentage" placeholder="%" type="text" style="width: 90px; margin-right:7px">
                        <input class="numeric-input" value="${response.vat_on_taka || ""}" placeholder="taka" name="vat_on_taka" type="text" style="width: 90px">
                    </td>
                </tr>
                <tr class="d-none">
                    <td class="font-size-14 font-weight-600">Total</td>
                    <td>:</td>
                    <td class="text-left"><input name="total_amount" value="${response.total_amount}" type="text" readonly></td>
                </tr>
                <tr>
                    <td class="font-size-14 font-weight-600">Discount</td>
                    <td>:</td>
                    <td>
                        <input class="numeric-input" value="${response.discout_parcentage || ""}" name="discout_parcentage" placeholder="%" type="text" style="width: 90px; margin-right:7px">
                        <input class="numeric-input" value="${response.discount_taka || ""}" placeholder="taka" name="discount_taka" type="text" style="width: 90px">
                    </td>
                </tr>
                <tr>
                    <td class="font-size-14 font-weight-600">Net Payable</td>
                    <td>:</td>
                    <td><input name="net_payable" value="${response.net_payable}" type="text" readonly></td>
                </tr>
                <tr>
                    <td class="font-size-14 font-weight-600">Total Paid</td>
                    <td>:</td>
                    <td><input class="numeric-input" name="total_paid" value="${response.total_paid || ""}" type="text"></td>
                </tr>
                <tr>
                    <td class="font-size-14 font-weight-600">Total Due</td>
                    <td>:</td>
                    <td><input name="total_due" value="${response.total_due}" type="text" readonly></td>
                </tr>`;

                        $('#saleFooter').append(footerRows);
                        $("#btnSubmit").removeClass("disabled")

                    } else {
                        $("#btnSubmit").addClass("disabled")
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the AJAX error here
                    console.log("AJAX Error: " + error);
                }
            });
        }

        var footerAppended = false;



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
                            var stock = response.product.stock;
                            $('#stock').val(stock);

                            $('#unit_id').empty();
                            var unitId = response.product.unit_id;
                            var unitName = response.product.unit.name;
                            $('#unit_id').append('<option value="' + unitId + '">' + unitName +
                                '</option>');



                            if (response.latestSale != null) {
                                $('#sale_price').val(response.latestSale.price);
                                //$('#vat').val(response.latestSale.vat);
                            }
                            else{
                                $('#sale_price').val(response.product.selling_price);
                            }

                            if (response.latestPurchase != null) {
                                $('#purchase_price').val(response.latestPurchase.price);
                            }
                            else{
                                $('#purchase_price').val('');
                            }

                            // Call the function to update stock value
                            updateStockValue(selectedId, stock);
                            lowStock();
                        }
                    });
                } else {
                    $('#stock').val(0);
                    $("#addRow").empty();
                }
            });
        });



        //update stock value when product_id change
        function updateStockValue(selectedId, stock) {
            $("#addRow tr.saleList").each(function() {
                var productId = $(this).find("input[name='product_id[]']").val();
                if (productId == selectedId) {
                    var quantity = parseFloat($(this).find("input[name='quantity[]']").val());
                    var difference = stock - quantity;
                    $('#stock').val(difference);
                }
            });
        }

        //check low stock
        function lowStock() {
            var value = $('#stock').val().trim();

            // Convert the value to a number for comparison
            value = parseFloat(value);

            if (value <= 10) { // Use <= for less than or equal comparison
                isValid = false;
                var formGroup = $("#stock").closest(".form-group");
                var errorMessage = formGroup.find(".errorMessage");

                if (errorMessage.length === 0) {
                    errorMessage = $("<div>").addClass("text-danger errorMessage").text(
                        "Attention! Stock is extremely low.");
                    formGroup.append(errorMessage);
                }

                $("#stock").addClass('error');
            } else {
                $("#stock").removeClass("error");
                $("#stock").closest(".form-group").find(".errorMessage").remove();
            }
        }

        $(document).on("click", ".addeventmore", function() {
            var saleType = $('#sale_type').find('option:selected').val();
            var sale_date = $('#sale_date').val();
            var customer_id = $('#customer_id').find('option:selected').val();

            console.log('customer_id ',customer_id);

            var unit_id = $('#unit_id').find('option:selected').val();
            var unit_name = $('#unit_id').find('option:selected').text();
            var product_id = $('#product_id').find('option:selected').val();
            var product_name = $('#product_id').find('option:selected').text();
            var stock = $('#stock').val();
            var quantity = $('#quantity').val();
            var sale_price = $('#sale_price').val();
            var vat = $('#vat').val();


            var total = Math.round(quantity * sale_price);
            var totalVat = Math.round((quantity * sale_price) * (vat / 100));
            var subtotal = Math.round(total + totalVat);

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
                    var totalVat = Math.round((totalQuantity * sale_price) * (vat / 100));
                    var subtotal = Math.round(total + totalVat);



                    existingRow.find('input[name="quantity[]"]').val(totalQuantity)
                    existingRow.find('input[name="sale_price[]"]').val(sale_price)
                    existingRow.find('input[name="vat[]"]').val(vat)
                    existingRow.find('input[name="total_vat[]"]').val(Math.round(totalVat))



                    updateStock = stock - quantity;
                    $('#stock').val(updateStock);

                    calculateAllSale();
                    calculateGrantTotal();
                    calculateTotalAmount();
                    calculateNetPayable();
                    calculateTotalDue();
                    lowStock();
                    StoreSessionData();
                    return;
                }



                var newRow = `
                <tr class="saleList">
                   
                
                    <td>
                        <input type="hidden" name="product_id[]" value="${product_id}">
                        ${product_name}
                    </td>

					<td>
                        <input type="hidden" name="unit_id[]" value="${unit_id}">
                        ${unit_name}
                    </td>
                    
                    <td>
                        <input class="numeric-input" type="text" name="quantity[]" value="${quantity}" style="width:60px">
                    </td>

                    <td>
                        <input type="text"  name="sale_price[]" value="${sale_price}" readonly style="width:100px">
                    </td>

                    <td>
                        <input type="text" class="discount-input" name="discount_price[]" value="0" style="width:80px">
                    </td>


                    <td>
                        <input type="text" name="unit_cost[]" value="${sale_price}" readonly style="width:80px">
                    </td>

					<td>
                        <input type="text" name="total[]" value="${total}" readonly style="width:80px">
                    </td>

                    <td class="d-none">
						<input type="text" class="numeric-input" name="vat[]" value="${vat}" style="width:60px">
            
                    </td>

					<td class="d-none">
						<input type="text" name="total_vat[]" value="${totalVat}" readonly style="width:60px">
                    </td>
					
					<td>
						<input type="text" name="subtotal[]" value="${subtotal}" readonly style="width:60px">
                    </td>


                    <td>
                        <a href="javascript:void(0)"><i class="fa-regular fa-trash-can text-danger"></i></a>
                    </td>
                </tr>`;

                $("#addRow").append(newRow);
                // Check if footer rows already exist
                if ($('#saleFooter tr').length === 0) {
                    // Append the footer rows
                    var footerRows = `

                    <tr>
                        <td id="customerType">
                            <input type="hidden" name="customer_id" value="${customer_id}">
                        </td>
                    </tr>

                    <tr>
                        <td id="typeCell">
                            <input type="hidden" name="type" value="${saleType}">
                        </td>
                    </tr>

                    <tr>
                        <td id="saleDateCell">
                            <input type="hidden" name="sale_date" value="${sale_date}">
                        </td>
                    </tr>
                    <tr>
                        <td id="gcounter">
                            <input type="hidden" name="counter" value="${gcounter}">
                        </td>
                    </tr>
                    
                                <tr>
					<td class="font-size-14 font-weight-600">Grand Total</td>
					<td>:</td>
					<td class="text-left"><input name="grand_total" type="text" readonly></td>
				</tr>
				
				<tr class="d-none">
					<td class="font-size-14 font-weight-600">Vat On Invoice</td>
					<td>:</td>
					<td>
					<input class="numeric-input" name="vat_on_parcentage" placeholder="%" type="text" style="width: 90px; margin-right:7px">
					<input class="numeric-input" placeholder="taka" name="vat_on_taka" type="text" style="width: 90px">
					</td>
				</tr>
				<tr class="d-none">
					<td class="font-size-14 font-weight-600">Total</td>
					<td>:</td>
					<td class="text-left"><input name="total_amount" type="text" readonly></td>
				</tr>

				<tr>
					<td class="font-size-14 font-weight-600">Discount</td>
					<td>:</td>
					<td>
					<input class="numeric-input" name="discout_parcentage" placeholder="%" type="text" style="width: 90px; margin-right:7px">
					<input class="numeric-input" placeholder="taka" name="discount_taka" type="text" style="width: 90px">
					</td>
				</tr>
				<tr>
					<td class="font-size-14 font-weight-600">Net Payable</td>
					<td>:</td>
					<td><input name="net_payable" type="text" readonly></td>
				</tr>
				<tr>
					<td class="font-size-14 font-weight-600">Total Paid</td>
					<td>:</td>
					<td><input class="numeric-input" name="total_paid" type="text"></td>
				</tr>
				<tr>
					<td class="font-size-14 font-weight-600">Total Due</td>
					<td>:</td>
					<td><input name="total_due" type="text" readonly></td>
				</tr>
				`;

                    $('#saleFooter').append(footerRows);
                    $("#btnSubmit").removeClass("disabled")


                }
                calculateGrantTotal();
                calculateTotalAmount();
                calculateNetPayable();
                calculateTotalDue();
                StoreSessionData();
                updateStock = stock - quantity;
                $('#stock').val(updateStock);
                lowStock();

                $('#customerType').html(`<input type="hidden" name="customer_id" value="${customer_id}">`);
                $('#typeCell').html(`<input type="hidden" name="type" value="${saleType}">`);
                $('#saleDateCell').html(`<input type="hidden" name="sale_date" value="${sale_date}">`);

                $('.numeric-input').on('input', function() {
                    var inputValue = $(this).val();
                    $(this).val(inputValue.replace(/[^0-9]/g, ''));
                });
            }


        });

        //check empty input

        function checkEmptyPurchaseInput() {
            var fields = [{
                    id: 'sale_date',
                    message: 'Sale date cannot be empty'
                },
                {
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
                    message: 'Sale price cannot be empty'
                }
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

            if (isValid) {
                // If all fields are not empty, call validateQuantity function
                isValid = validateQuantity();
                if (!isValid) {
                    // If validateQuantity returns false (quantity is greater than stock), show an error message
                    var formGroup = $("#quantity").closest(".form-group");
                    var errorMessage = formGroup.find(".errorMessage");
                    if (errorMessage.length === 0) {
                        errorMessage = $("<div>").addClass("text-danger errorMessage").text(
                            "Quantity cannot be greater than stock.");
                        formGroup.append(errorMessage);
                    }
                    $("#quantity").addClass('error');
                }
            }

            return isValid;
        }

        //check stock and quantity 
        function validateQuantity() {
            var quantityInput = parseFloat($('#quantity').val());
            var stockInput = parseFloat($('#stock').val());

            if (isNaN(quantityInput)) {
                $('#quantity').val(0); // If quantity is not a number, set it to 0
                return false;
            }

            return quantityInput <= stockInput;
        }


        //delete data from table 

        $(document).on('click', '.saleList .fa-trash-can', function() {
            $(this).closest('.saleList').remove();

            // Update calculations
            calculateGrantTotal();
            calculateTotalAmount();
            calculateNetPayable();
            calculateTotalDue();
            // Check if there are no table rows
            if ($('.saleList').length === 0) {

                $('#saleFooter').empty(); // Empty the table
                $("#btnSubmit").addClass("disabled");
            }

            StoreSessionData();
        });
    </script>

    <script>
        //calculate quantity,unit price, discount,vat,subtotal

        function calculateSale(row) {
            var $row = row || $(this).closest('.saleList');
            var quantity = parseFloat(row.find('input[name="quantity[]"]').val()) || 0;
            var purchasePrice = parseFloat(row.find('input[name="sale_price[]"]').val()) || 0;
            var discount = row.find('input[name="discount_price[]"]').val();
            var vatPercentage = parseFloat(row.find('input[name="vat[]"]').val()) || 0;

            var discountPrice = 0;

            var percentageRegex = /^(\d+(\.\d+)?)%$/; // Regex pattern to match percentage values

            if (percentageRegex.test(discount)) {
                // If the discount matches the percentage pattern, calculate it as a percentage
                var discountValue = parseFloat(discount.replace('%', ''));
                discountPrice = (discountValue / 100) * purchasePrice;
            } else {
                // If the discount is a direct value, use it as the discount amount
                discountPrice = parseFloat(discount) || 0;
            }

            var unitCost = purchasePrice - discountPrice;
            var total = quantity * unitCost;
            var totalVat = (quantity * purchasePrice) * (vatPercentage / 100);
            var subtotal = total + totalVat;

            row.find('input[name="unit_cost[]"]').val(unitCost);
            row.find('input[name="total_vat[]"]').val(Math.round(totalVat));
            row.find('input[name="total[]"]').val(Math.round(total));
            row.find('input[name="subtotal[]"]').val(Math.round(subtotal));


            StoreSessionData();
        }

        $(document).on('keypress',
            '.saleList input[name="quantity[]"], .saleList input[name="discount_price[]"], .saleList input[name="vat[]"]',
            function(event) {
                var row = $(this).closest('.saleList');
                var product_id = row.find('input[name="product_id[]"]').val();
                var quantityInput = row.find('input[name="quantity[]"]');
                var quantity = parseInt(quantityInput.val()) || 0;



                // Set quantity to 1 if it is null or not a number
                if (isNaN(quantity) || quantity === 0) {
                    quantityInput.val(1);
                    quantity = 1;
                }

                $.ajax({
                    type: "get",
                    url: "{{ route('get.sale.product') }}",
                    data: {
                        id: product_id
                    },
                    dataType: "json",
                    success: function(response) {
                        var stock = response.stock;
                        var quantity = parseFloat(row.find('input[name="quantity[]"]').val()) || 0;

                        if (stock < quantity) {
                            // Reduce the quantity to the available stock
                            alert('available quantity is ' + stock)
                            quantityInput.val(stock);


                        }
                        calculateSale(row);
                        calculateGrantTotal();
                        calculateTotalAmount();
                        calculateNetPayable();
                        calculateTotalDue();
                        StoreSessionData();

                    }
                });
            });




        $(document).on('keypress',
            '.saleList input[name="quantity[]"], .saleList input[name="discount_price[]"], .saleList input[name="vat[]"]',
            function(event) {
                if (event.which === 13) {
                    event.preventDefault();
                    var row = $(this).closest('.saleList');
                    calculateSale(row);
                    calculateGrantTotal()
                    calculateTotalAmount();
                    calculateNetPayable();
                    calculateTotalDue();
                }
            });

        $(document).on('focusout', '.saleList input[name="quantity[]"]', function() {
            var row = $(this).closest('.saleList');
            var product_id = row.find('input[name="product_id[]"]').val();
            var quantityInput = row.find('input[name="quantity[]"]');
            var quantity = parseFloat(quantityInput.val()) || 0;

            // Set quantity to 1 if it is null or not a number
            if (isNaN(quantity) || quantity === 0) {
                quantityInput.val(1);
            }

            // Rest of your AJAX and calculations code
            calculateSale(row);
            calculateGrantTotal();
            calculateTotalAmount();
            calculateNetPayable();
            calculateTotalDue();

            StoreSessionData();
        });


        function calculateAllSale() {
            $('.saleList').each(function() {
                calculateSale($(this));
            });
        }


        //calculate grant total

        function calculateGrantTotal() {
            var grantTotal = 0;
            $('.saleList').each(function() {
                var subtotal = parseFloat($(this).find('input[name="subtotal[]"]').val());
                grantTotal += subtotal;
            });
            $('input[name="grand_total"]').val(Math.round(grantTotal));
        }

        //calculate total amount

        $(document).on('keyup', 'input[name="vat_on_parcentage"]', function() {
            var grandTotal = parseFloat($('input[name="grand_total"]').val());
            var vatOnPercentage = $('input[name="vat_on_parcentage"]').val();
            var vatOnTaka = parseFloat($('input[name="vat_on_taka"]').val());
            var total;


            if (vatOnPercentage !== "") {
                var vat = (parseFloat(vatOnPercentage) / 100) * grandTotal;
                $('input[name="vat_on_taka"]').val(Math.round(vat));
                total = grandTotal + vat;
            } else {
                $('input[name="vat_on_taka"]').val("");
                total = grandTotal;
            }
            $('input[name="total_amount"]').val(Math.round(total));

            calculateNetPayable();
            calculateTotalDue();

            StoreSessionData();
        });

        $(document).on('keyup', 'input[name="vat_on_taka"]', function() {
            var grandTotal = parseFloat($('input[name="grand_total"]').val());
            var vatOnPercentage = $('input[name="vat_on_parcentage"]').val();
            var vatOnTaka = parseFloat($('input[name="vat_on_taka"]').val());
            var total;

            if (!isNaN(vatOnTaka)) {
                var vat = (parseFloat(vatOnTaka) / grandTotal) * 100;
                total = grandTotal + vatOnTaka;
                $('input[name="vat_on_parcentage"]').val(vat);
            } else {
                $('input[name="vat_on_parcentage"]').val("");
                total = grandTotal;
            }
            $('input[name="total_amount"]').val(Math.round(total));

            calculateNetPayable();
            calculateTotalDue();

            StoreSessionData();
        });

        function calculateTotalAmount() {
            var grandTotal = parseFloat($('input[name="grand_total"]').val());
            var vatOnPercentage = $('input[name="vat_on_parcentage"]').val() || 0;
            var vatOnTaka = parseFloat($('input[name="vat_on_taka"]').val()) || 0;
            var total;

            if (!vatOnPercentage && !vatOnTaka) {
                total = grandTotal
            } else {
                var vat = (parseFloat(vatOnPercentage) / 100) * grandTotal;
                $('input[name="vat_on_taka"]').val(Math.round(vat));
                total = (grandTotal + vat);
            }

            $('input[name="total_amount"]').val(Math.round(total));

        }


        //calculate net payable here 

        function calculateNetPayable() {
            var totalAmount = parseFloat($('input[name="total_amount"]').val());
            var discoutParcentage = $('input[name="discout_parcentage"]').val();
            var discoutTaka = parseFloat($('input[name="discount_taka"]').val());
            var netPayable;

            if (!discoutParcentage && !discoutTaka) {
                netPayable = totalAmount;
            } else {
                var discount = (parseFloat(discoutParcentage) / 100) * totalAmount;
                $('input[name="discount_taka"]').val(Math.round(discount));
                netPayable = (totalAmount - discount);
            }
            $('input[name="net_payable"]').val(Math.round(netPayable));
        }

        $(document).on('keyup', 'input[name="discout_parcentage"]', function() {
            var discoutParcentage = $('input[name="discout_parcentage"]').val();
            var totalAmount = parseFloat($('input[name="total_amount"]').val());
            var netPayable;


            if (discoutParcentage !== "") {
                var discount = (parseFloat(discoutParcentage) / 100) * totalAmount;
                $('input[name="discount_taka"]').val(Math.round(discount));
                netPayable = (totalAmount - discount);
            } else {
                $('input[name="discount_taka"]').val("");
                netPayable = totalAmount;

            }
            $('input[name="net_payable"]').val(Math.round(netPayable));

            calculateTotalDue();
            StoreSessionData();
        });

        $(document).on('keyup', 'input[name="discount_taka"]', function() {

            var discoutTaka = parseFloat($('input[name="discount_taka"]').val());
            var totalAmount = parseFloat($('input[name="total_amount"]').val());
            var netPayable;

            if (!isNaN(discoutTaka)) {
                var discountPercentage = (discoutTaka / totalAmount) * 100;
                netPayable = (totalAmount - discoutTaka);
                $('input[name="discout_parcentage"]').val(discountPercentage);
            } else {
                $('input[name="discout_parcentage"]').val("");
                netPayable = totalAmount;
            }
            $('input[name="net_payable"]').val(Math.round(netPayable));

            calculateTotalDue();
            StoreSessionData();
        });


        //calculate total due here

        function calculateTotalDue() {
            var netPayable = parseFloat($('input[name="net_payable"]').val());
            var totalPaid = 0;
            if ($('input[name="total_paid"]').val() != "") {
                totalPaid = parseFloat($('input[name="total_paid"]').val());
            }

            var totalDue = netPayable - totalPaid;
            $('input[name="total_due"]').val(Math.round(totalDue));
        }

        $(document).on('keyup', 'input[name="total_paid"]', function() {
            calculateTotalDue();
            StoreSessionData();
        });
    </script>

    <script>
        $('#saleForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission
            // Create a FormData object from the form
            var formData = new FormData(this);
            // Make a POST request using jQuery AJAX
            $.ajax({
                url: '{{ route('store.sale') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log("data : ",data);

                   
                    if (data) {
                        var newTabUrl = "{{ route('sales.report') }}" + "?sale_invoice_id=" + encodeURIComponent(data.sale_invoice_id);
                        var saleReportWindow = window.open(newTabUrl, "_blank");
                        showToastr(data.notification.type, data.notification.message);
                        // Reload the current page
                        location.reload();
                    }
                },
                error: function() {
                    console.error('An error occurred.');
                }
            });
        });
    </script>

{{-- <script>
    window.onload = function() {
        var saleData = @json(session('sale_data'));

        // Open a new tab with additional data
        var newTabUrl = "{{ route('sales.report') }}" + "?sale_date=" + encodeURIComponent(saleData.sale_date) + "&grand_total=" + encodeURIComponent(saleData.grand_total);
        var saleReportWindow = window.open(newTabUrl, "_blank");

        // Focus on the main window
        window.focus();
    };
</script> --}}


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
