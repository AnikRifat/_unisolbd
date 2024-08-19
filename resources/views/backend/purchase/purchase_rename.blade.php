@extends('admin.admin_master')
@section('admin')
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
            <div class="row d-flex justify-content-between">
                <div class="box-header with-border py-0">
                    <h4>Add Purchase</h4>
                    <h6>Add/Update Purchase</h6>
                </div>
                <div class="d-flex align-items-center mr-30">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#vendorModal">Add
                        Supplier</button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Type<span class="text-danger">*</span></label>
                            <div class="controls">
                                <select class="form-control form-control-sm" id="purchaseType" name="purchaseType">
                                    <option value="1">Purchase</option>
                                    <option value="2">Purchase Return</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Bill No<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" id="purchase_no" name="purchase_no"
                                    class="form-control form-control-sm" />
                                @error('purchase_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Purchase Date<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="date" class="date form-control current-date" id="purchase_date"
                                    name="purchase_date" />
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Supplier Name<span class="text-danger">*</span></label>
                            <div class="controls">
                                <select class="form-control form-control-sm select2" id="supplier_id" name="supplier_id">
                                    <option value="">Choose Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                                @error('product_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3" id="unitDiv">
                        <div class="form-group">
                            <label>Product Unit<span class="text-danger">*</span></label>
                            <div class="controls">
                                <select class="form-control form-control-sm" id="unit_id" name="unit_id">
                                </select>
                                @error('unit_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Quantity<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" id="quantity" name="quantity"
                                    class="form-control form-control-sm numeric-input" />
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Purchase Price<span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" id="purchase_price" name="purchase_price"
                                    class="form-control form-control-sm decimal-input" />
                                @error('unit_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 d-none">
                        <div class="form-group">
                            <label>Vat(%)</label>
                            <div class="controls">
                                <input type="text" id="vat" name="vat"
                                    class="form-control form-control-sm numeric-input" value="0" />
                                @error('vat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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


        <form id="purchaseForm" method="post" action="{{ route('store.purchase') }}">
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
                                    <th>Expiry Date</th>
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
                        <table id="purchaseFooter">
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



    <script>
        $(document).ready(function() {
            getSessionData();
        });

        function StoreSessionData() {
            var dataObj = {};
            // Retrieve data from the rows with class "saleList"
            dataObj.purchase_no = [];
            dataObj.supplier_id = [];
            dataObj.product_id = [];
            dataObj.product_name = []; // Add product_name array
            dataObj.unit_id = [];
            dataObj.unit_name = [];
            dataObj.expired_date = [];
            dataObj.quantity = [];
            dataObj.purchase_price = [];
            dataObj.discount_price = [];
            dataObj.unit_cost = [];
            dataObj.total = [];
            dataObj.vat = [];
            dataObj.total_vat = [];
            dataObj.subtotal = [];


            $('.purchaseList').each(function() {
                var row = $(this);
                dataObj.purchase_no.push(row.find('input[name="purchase_no[]"]').val());
                dataObj.supplier_id.push(row.find('input[name="supplier_id[]"]').val());
                dataObj.product_id.push(row.find('input[name="product_id[]"]').val());
                dataObj.product_name.push(row.find('td:eq(0)').text()
                    .trim()); // Assuming the product_name is in the first <td> element of each row
                dataObj.unit_id.push(row.find('input[name="unit_id[]"]').val());
                dataObj.unit_name.push(row.find('td:eq(1)').text()
                    .trim()); // Assuming the unit name is in the third <td> element of each row
                dataObj.quantity.push(row.find('input[name="quantity[]"]').val());
                dataObj.expired_date.push(row.find('input[name="expired_date[]"]').val());
                dataObj.purchase_price.push(row.find('input[name="purchase_price[]"]').val());
                dataObj.discount_price.push(row.find('input[name="discount_price[]"]').val());
                dataObj.unit_cost.push(row.find('input[name="unit_cost[]"]').val());
                dataObj.total.push(row.find('input[name="total[]"]').val());
                dataObj.vat.push(row.find('input[name="vat[]"]').val());
                dataObj.total_vat.push(row.find('input[name="total_vat[]"]').val());
                dataObj.subtotal.push(row.find('input[name="subtotal[]"]').val());
            });

            // Retrieve data from the footer rows
            dataObj.purchase_date = $('input[name="purchase_date"]').val();
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

            // Log the final data object to the console
            console.log(dataObj);

            $.ajax({
                type: "POST",
                url: "{{ route('store.purchase-data-session') }}", // Replace this with the URL to your Laravel route to store the sale data
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

        function getSessionData() {
            $.ajax({
                type: "get",
                url: "{{ route('get.purchase-data-session') }}",
                dataType: "json",
                success: function(response) {
                    console.log(response);

                    // Clear existing rows in the table body and footer
                    $("#addRow").empty();
                    $("#purchaseFooter").empty();

                    if (Object.keys(response).length > 0) {
                        // Loop through each item in the response and create rows for each item
                        for (let i = 0; i < response.product_id.length; i++) {
                            const purchaseNo = response.purchase_no[i] || "";
                            const supplierId = response.supplier_id[i] || "";
                            const productId = response.product_id[i] || "";
                            const productName = response.product_name[i] || "";
                            const unitId = response.unit_id[i] || "";
                            const unitName = response.unit_name[i] || "";
                            const expiredDate = response.expired_date[i] || "";
                            const quantity = response.quantity[i] || "";
                            const purchasePrice = response.purchase_price[i] || "";
                            const discountPrice = response.discount_price[i] || "";
                            const unitCost = response.unit_cost[i] || "";
                            const total = response.total[i] || "";
                            const vat = response.vat[i] || "";
                            const totalVat = response.total_vat[i] || "";
                            const subtotal = response.subtotal[i] || "";

                            var newRow = `
                    <tr class="purchaseList">
                        <input type="hidden" name="purchase_no[]" value="${purchaseNo}">
                        <input type="hidden" name="supplier_id[]" value="${supplierId}">
                        <input type="hidden" name="product_id[]" value="${productId}">
                        <td>${productName}</td>
                        <td>
                            <input type="hidden" name="unit_id[]" value="${unitId}">
                            ${unitName}
                        </td>
                        <td>
                            ${expiredDate !="" ? `<input type="date" name="expired_date[]" value="${expiredDate}">` : `<input type="hidden" name="expired_date[]">`}
                        </td>

                        <td>
                            <input class="numeric-input" type="text" name="quantity[]" value="${quantity}" style="width:60px">
                        </td>
                        <td>
                            <input type="text" name="purchase_price[]" value="${purchasePrice}" readonly style="width:100px">
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
                    <td id="typeCell"><input type="hidden" name="type" value="${response.type}"></td>
                </tr>

                <tr>
                    <td id="purchaseDateCell"><input type="hidden" name="purchase_date" value="${response.purchase_date}"></td>
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

                        $('#purchaseFooter').append(footerRows);
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
    </script>


    <script>
        var footerAppended = false;
        $(document).on("click", ".addeventmore", function() {
            var purchaseType = $('#purchaseType').find('option:selected').val();
            var purchase_no = $('#purchase_no').val();
            var purchase_date = $('#purchase_date').val();
            var expired_date = $('#expired_date').val();
            var supplier_id = $('#supplier_id').find('option:selected').val();
            var unit_id = $('#unit_id').find('option:selected').val();
            var unit_name = $('#unit_id').find('option:selected').text();
            var product_id = $('#product_id').find('option:selected').val();
            var product_name = $('#product_id').find('option:selected').text();
            // var unit_id = $('#unit_id').find('option:selected').val();
            var quantity = $('#quantity').val();
            var purchase_price = $('#purchase_price').val();
            var vat = $('#vat').val();


            var total = quantity * purchase_price;
            var totalVat = (quantity * purchase_price) * (vat / 100);
            var subtotal = Math.round(total + totalVat);

            if (checkEmptyPurchaseInput()) {
                var expiredDateExists = $('#expired_date').length > 0;

                console.log("expiredDateExists ",expiredDateExists);

                if (expiredDateExists) {
                   
                    var existingProductIdsAndDates = $('input[name="product_id[]"]').map(function() {
                        var productId = $(this).val();
                        var expireDate = $(this).closest('tr').find('input[name="expired_date[]"]').val();
                        return {
                            product_id: productId,
                            expired_date: expireDate
                        };
                    }).get();

                     // Both product_id and expire_date are available
                     console.log("existingProductIdsAndDates ",existingProductIdsAndDates);


                    // Check if a product with the same product_id and expire_date exists
                    var existingProduct = existingProductIdsAndDates.find(function(product) {
                        return product.product_id === product_id && product.expired_date ===
                        expired_date;
                    });

                    console.log("existingProduct ",existingProduct);

                    if (existingProduct) {
                        // Product with the same product_id and expire_date exists, handle it here

                        var existingRow = $(".purchaseList").filter(function() {
                            var productId = $(this).find('input[name="product_id[]"]').val();
                            var expireDate = $(this).find('input[name="expired_date[]"]').val();
                            return productId === product_id && expireDate === expired_date;
                        });

                        console.log("existingRow ",existingRow)

                        if (existingRow.length > 0) {
                            var existingQuantity = parseInt(existingRow.find('input[name="quantity[]"]').val()) ||
                            0;
                            var totalQuantity = existingQuantity + parseInt(quantity);

                            console.log("total quantity" + totalQuantity);

                            var total = totalQuantity * purchase_price;
                            var totalVat = (totalQuantity * purchase_price) * (vat / 100);
                            var subtotal = total + totalVat;

                            existingRow.find('input[name="quantity[]"]').val(totalQuantity);
                            existingRow.find('input[name="purchase_price[]"]').val(purchase_price);
                            existingRow.find('input[name="vat[]"]').val(vat);
                            existingRow.find('input[name="total_vat[]"]').val(totalVat);

                            calculateAllPurchases();
                            calculateGrantTotal();
                            calculateTotalAmount();
                            calculateNetPayable();
                            calculateTotalDue();
                            StoreSessionData();

                            return;
                        }
                    }
                } else {
                    // Only product_id is available
                    var existingProductIds = $('input[name="product_id[]"]').map(function() {
                        return $(this).val();
                    }).get();

                    console.log("existingProductIds ",existingProductIds)

                    // Check if a product with the same product_id exists
                    if (existingProductIds.includes(product_id)) {

                        var existingRow = $(".purchaseList").filter(function() {
                            return $(this).find('input[name="product_id[]"]').val() === product_id;
                        });

                        console.log("existingRow ",existingRow)

                        var existingQuantity = parseInt(existingRow.find('input[name="quantity[]"]').val()) || 0;


                        var totalQuantity = existingQuantity + parseInt(quantity);

                        console.log("total quantity" + totalQuantity);

                        var total = totalQuantity * purchase_price;
                        var totalVat = (totalQuantity * purchase_price) * (vat / 100);
                        var subtotal = total + totalVat;



                        existingRow.find('input[name="quantity[]"]').val(totalQuantity)
                        existingRow.find('input[name="purchase_price[]"]').val(purchase_price)
                        existingRow.find('input[name="vat[]"]').val(vat)
                        existingRow.find('input[name="total_vat[]"]').val(totalVat)

                        calculateAllPurchases();
                        calculateGrantTotal();
                        calculateTotalAmount();
                        calculateNetPayable();
                        calculateTotalDue();
                        StoreSessionData()

                        return;
                    }
                }





                var newRow = `
                <tr class="purchaseList">
                    <input type="hidden" name="purchase_no[]" value="${purchase_no}">
                    <input type="hidden" name="supplier_id[]" value="${supplier_id}">
                    <td>
                        <input type="hidden" name="product_id[]" value="${product_id}">
                        ${product_name}
                    </td>

					<td>
                        <input type="hidden" name="unit_id[]" value="${unit_id}">
                        ${unit_name}
                    </td>


					<td>
						${$('#expired_date').length ? `<input type="date" name="expired_date[]" value="${expired_date}">` : '<input type="hidden" name="expired_date[]">'}
					</td>
                    
                    <td>
                        <input class="numeric-input" type="text" name="quantity[]" value="${quantity}" style="width:60px">
                    </td>

                    <td>
                        <input type="text"  name="purchase_price[]" value="${purchase_price}" readonly style="width:100px">
                    </td>

                    <td>
                        <input type="text" class="discount-input" name="discount_price[]" value="0" style="width:80px">
                    </td>


                    <td>
                        <input type="text" name="unit_cost[]" value="${purchase_price}" readonly style="width:80px">
                    </td>

					<td>
                        <input type="text" name="total[]" value="${total}" readonly style="width:80px">
                    </td>

                    <td class="d-none">
						<input type="hidden" class="numeric-input" name="vat[]" value="${vat}" style="width:60px">
            
                    </td>

					<td class="d-none">
						<input type="hidden" name="total_vat[]" value="${totalVat}" readonly style="width:60px">
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
                if ($('#purchaseFooter tr').length === 0) {
                    // Append the footer rows
                    var footerRows = `
                    
                    <tr>
                        <td id="typeCell">
                            <input type="hidden" name="type" value="${purchaseType}">
                        </td>
                    </tr>
                    <tr>
                        <td id="purchaseDateCell">
                            <input type="hidden" name="purchase_date" value="${purchase_date}">
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
				<tr  class="d-none">
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

                    $('#purchaseFooter').append(footerRows);
                }
                calculateGrantTotal();
                calculateTotalAmount();
                calculateNetPayable();
                calculateTotalDue();




                $('#typeCell').html(`<input type="hidden" name="type" value="${purchaseType}">`);
                $('#purchaseDateCell').html(`<input type="hidden" name="purchase_date" value="${purchase_date}">`);


                StoreSessionData();

                $("#btnSubmit").removeClass("disabled")
                $('.numeric-input').on('input', function() {
                    var inputValue = $(this).val();
                    $(this).val(inputValue.replace(/[^0-9]/g, ''));
                });
            }


        });




        function checkEmptyPurchaseInput() {
            var fields = [{
                    id: 'purchase_no',
                    message: 'Purchase Invoice No cannot be empty'
                }, {
                    id: 'purchase_date',
                    message: 'Purchase date cannot be empty'
                },
                {
                    id: 'supplier_id',
                    message: 'Supplier cannot be empty'
                },
                {
                    id: 'product_id',
                    message: 'Product cannot be empty'
                },
                // {
                // 	id: 'unit_id',
                // 	message: 'Unit cannot be empty'
                // },

                {
                    id: 'quantity',
                    message: 'Quantity cannot be empty'
                },
                {
                    id: 'purchase_price',
                    message: 'Purchase price cannot be empty'
                }

            ];

            var expiredDateField = {
                id: 'expired_date', // Update the field id to match the 'expired_date' input field
                message: 'Expired date cannot be empty' // Update the error message
            };

            if ($('#expired_date').length) {
                fields.push(expiredDateField);
            }

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



        $(document).on('click', '.purchaseList .fa-trash-can', function() {
            $(this).closest('.purchaseList').remove();

            // Update calculations
            calculateGrantTotal();
            calculateTotalAmount();
            calculateNetPayable();
            calculateTotalDue();

            // Check if there are no table rows
            if ($('.purchaseList').length === 0) {
                $('#purchaseFooter').empty(); // Empty the table
                $("#btnSubmit").addClass("disabled")
            }

            StoreSessionData();
        });
    </script>

    <script>
        //get unit and expired date using product id

        $(document).ready(function() {
            $(document).on("change", "#product_id", function() {
                var selectedId = $(this).val();
                if (selectedId != "") {
                    $.ajax({
                        type: "get",
                        url: "{{ route('get.purchase.product') }}",
                        data: {
                            id: selectedId
                        },
                        dataType: "json",
                        success: function(response) {

                            var unitId = response.product.unit_id;
                            var unitName = response.product.unit.name;

                            var option =
                                `<option value="${unitId}" selected disabled>${unitName}</option>`;
                            $("#unit_id").empty().append(option);


                            var expriedDiv = `<div class="col-md-3">
										<div class="form-group">
											<label>Expired Date<span class="text-danger">*</span></label>
											<div class="controls">
												<input type="date" class="date form-control" id="expired_date" name="expired_date" />
												@error('expired_date')
												<span class="text-danger">{{ $message }}</span>
												@enderror
											</div>
										</div>
									</div>`;

                            $('#expired_date').parent().parent().parent()
                                .remove(); // Remove the existing element if it exists
                            if (response.product.is_expireable == 1) {
                                $(expriedDiv).insertAfter('#unitDiv');
                            }

                            if (response.latestPurchase != null) {
                                $('#purchase_price').val(response.latestPurchase.price);
                                $('#vat').val(response.latestPurchase.vat);
                            } else {
                                $('#purchase_price').val('');
                                $('#vat').val('');
                            }

                        }
                    });
                }

                // Output the selected ID to the console or perform any desired actions
            });
        });



        //calculate quantity,unit price, discount,vat,subtotal

        function calculatePurchase(row) {
            var $row = row || $(this).closest('.purchaseList');
            var quantity = parseFloat(row.find('input[name="quantity[]"]').val()) || 0;
            var purchasePrice = parseFloat(row.find('input[name="purchase_price[]"]').val()) || 0;
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
            row.find('input[name="total_vat[]"]').val(totalVat);
            row.find('input[name="total[]"]').val(total);
            row.find('input[name="subtotal[]"]').val(Math.round(subtotal));
        }

        $(document).on('change',
            '.purchaseList input[name="quantity[]"], .purchaseList input[name="discount_price[]"], .purchaseList input[name="vat[]"]',
            function() {
                var row = $(this).closest('.purchaseList');
                calculatePurchase(row);
                calculateGrantTotal()
                calculateTotalAmount();
                calculateNetPayable();
                calculateTotalDue();
                StoreSessionData();
            });


        $(document).on('keypress',
            '.purchaseList input[name="quantity[]"], .purchaseList input[name="discount_price[]"], .purchaseList input[name="vat[]"]',
            function(event) {
                if (event.which === 13) {
                    event.preventDefault();
                    var row = $(this).closest('.purchaseList');
                    calculatePurchase(row);
                    calculateGrantTotal()
                    calculateTotalAmount();
                    calculateNetPayable();
                    calculateTotalDue();
                    StoreSessionData();
                }
            });

        function calculateAllPurchases() {
            $('.purchaseList').each(function() {
                calculatePurchase($(this));
            });
        }





        //calculate grant total

        function calculateGrantTotal() {
            var grantTotal = 0;
            $('.purchaseList').each(function() {
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


        //calculate netpayable here 

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
        $('#purchaseForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission
            // Create a FormData object from the form
            var formData = new FormData(this);
            // Make a POST request using jQuery AJAX
            $.ajax({
                url: '{{ route('store.purchase') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log("data : ", data);






                    if (data) {
                        var newTabUrl = "{{ route('purchases.report') }}" + "?purchase_invoice_id=" +
                            encodeURIComponent(data.purchase_invoice_id);
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
@endsection
