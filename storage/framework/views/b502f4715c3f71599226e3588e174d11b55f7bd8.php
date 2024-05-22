<?php $__env->startSection('admin'); ?>
    <div class="container-full">
        <!-- Main content -->

        <section class="content">
            <div class="box-header with-border py-0">
                <h4>Purchase Due Collection</h4>
                <h6>Update Purchase Due</h6>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row" id="searchInvoiceForm">

                    



                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Purchase Invoice<span class="text-danger">*</span></label>
                            <div class="controls">
                                <select class="form-control form-control-sm select2" id="invoice_no" name="invoice_no">
                                    <option value="" selected>Choose Invoice</option>
                                    <?php $__currentLoopData = $invoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($inv->invoice_no); ?>"><?php echo e($inv->invoice_no); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['invoice_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label></label>
                        <div class="form-group mt-2">
                            <button type="submit" id="searchButton" class="btn btn-success btn-sm"> Search</button>
                        </div>
                    </div>

                </div>

                <div class="d-none" id="paymentHistoryContainer">


                    <!-- Table row -->
                    <div class="row mt-3" id="paymentHistoryTable">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>#SL No</th>
                                        <th>Invoice No</th>
                                        <th>Total</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody id="addRow" class="addRow">

                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->


                    <div class="row justify-content-end mt-10 mt-md-20" id="duePaymentForm">
                        <div class="d-flex justify-content-end">
                            <table id="purchaseFooter">
                                <tr>
                                    <td class="font-size-14 font-weight-600">Due</td>
                                    <td>:</td>
                                    <td><input name="due" id="due" type="text" readonly></td>
                                </tr>

                                <tr>
                                    <td class="font-size-14 font-weight-600">Paid</td>
                                    <td>:</td>
                                    <td><input class="numeric-input" name="paid" type="text"></td>
                                </tr>




                            </table>

                        </div>
                        <!-- /.col -->


                    </div>

                    <div class="row no-print mt-2">

                        <div id="errorMessage" class="col-12 text-right mb-3">
                           
                        </div> 

                        <div class="col-12 ">
                            <button id="btnMakePayment" type="submit" class="btn btn-sm  btn-success pull-right"><i
                                    class="fa fa-credit-card"></i> Submit Payment
                            </button>
                        </div>
                    </div>

                </div>


            </div>


        </section>




    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    



    <script>
        var selectedInvoiceNumber;
        var total;
      
            $('#searchButton').click(function() {
                searchInvoice();
            });


            function searchInvoice()
            {
                selectedInvoiceNumber = $('#invoice_no').val();
                console.log("Selected invoice number:", selectedInvoiceNumber);

                if (selectedInvoiceNumber != "") {
                    $.ajax({
                        type: "get",
                        url: "<?php echo e(route('purchase-payment-history')); ?>",
                        data: {
                            invoice_no: selectedInvoiceNumber
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);

                            var firstItem = response[0]; // Get the first item in the response array
                            total = firstItem.net_payable;

                            $("#paymentHistoryContainer").removeClass('d-none')

                            $("#addRow").empty();
                            var addRow = $("#addRow");
                            // Assuming response is an array of objects
                            response.forEach(function(item, index) {

                                var createdAt = new Date(item.created_at);
                                var formattedDay = createdAt.getDate().toString()
                                    .padStart(2, '0');
                                var formattedMonth = (createdAt.getMonth() + 1)
                                    .toString().padStart(2, '0');
                                var formattedYear = createdAt.getFullYear();

                                var formattedDate =
                                    `${formattedDay}/${formattedMonth}/${formattedYear}`;

                               
                                var formattedTotalPaid = parseFloat(item.total_paid ||
                                    0).toLocaleString('en');
                                


                                var newRow = $("<tr>");

                                if (formattedTotalPaid == 0) {
                                    newRow.html(`
                                <td>${index + 1}</td>
                                <td>${item.invoice_no}</td>
                                <td>${parseFloat(item.net_payable).toLocaleString('en')}</td>
                                <td>${parseFloat(item.total_paid || 0).toLocaleString('en')}</td>
                                <td>${parseFloat(item.total_due).toLocaleString('en')}</td>
                                <td>${formattedDate}</td>
                            `);
                                }

                                else{
                                    
                                    newRow.html(`
                                <td>${index + 1}</td>
                                <td>${item.invoice_no}</td>
                                <td>${parseFloat(total).toLocaleString('en')}</td>
                                <td>${parseFloat(item.last_paid).toLocaleString('en')}</td>
                                <td>${ parseFloat(total-item.last_paid).toLocaleString('en')}</td>
                                <td>${formattedDate}</td>
                            `);

                                    total = total-item.last_paid
                                }

                                addRow.append(newRow);
                                if (index === response.length - 1) {
                                    $("#due").val(total);
                                }
                            });


                        }
                    });
                } else {
                    $("#paymentHistoryContainer").addClass('d-none')
                }

            }



            $('#btnMakePayment').click(function(event) {
                event.preventDefault(); // Prevent form submission for demonstration purposes

                var paidValue = $('input[name="paid"]').val();
                console.log('Paid Value:', paidValue);


                if (paidValue) {
                if (paidValue > total) {
                        $('#errorMessage').html(`
                    <span class="text-danger float-end">Paid cannot be greater than Due</span>`);
                       
                    } else {

                    $.ajax({
                        type: "post",
                        url: "<?php echo e(route('purchase-due-payment')); ?>",
                        data: {
                            invoice_no: selectedInvoiceNumber,
                            paid: paidValue
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response)
                            showToastr(response.type, response.message)
                            searchInvoice();
                            $('input[name="paid"]').val('');
                            
                        }
                    });
                    }
                } 
                else {
                            $('#errorMessage').html(`
                            <span class="text-danger float-end">Paid cannot be null</span>`);
                        
                        }


            });


      



        $(document).ready(function () {
            $('.numeric-input').on('input', function () {
                // Remove non-numeric characters using a regular expression
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/purchase/due_collection.blade.php ENDPATH**/ ?>