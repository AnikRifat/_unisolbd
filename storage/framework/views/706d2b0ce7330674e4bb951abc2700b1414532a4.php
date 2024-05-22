<?php $__env->startSection('admin'); ?>
    <style>
        .border-red {
            border-color: red;
        }

        .error {
            border-color: red;

        }




        /* #item-list input[type="text"]:read-only {
                                                                                                                                                                                                                                                            border: none;
                                                                                                                                                                                                                                                            outline: none;
                                                                                                                                                                                                                                                            padding: 0;
                                                                                                                                                                                                                                                            background-color: transparent;
                                                                                                                                                                                                                                                        } */

        /* #item-list input[type="text"],
                                                                                                                                                                                                                                                        input[type="date"] {
                                                                                                                                                                                                                                                            border: none;
                                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                                            background-color: transparent;
                                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                                        } */
        #item-list th {
            text-align: center;
        }

        #item-list td {
            text-align: center;
        }

        #item-list td input {
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
                        <?php
                            $actions = [
                                'sale' => 'Sale',
                                'quotation' => 'Quotation',
                                'invoice' => 'Invoice',
                                'edit' => 'Edit',
                                'purchase' => 'Purchase',
                            ];

                            $action = $actions[$type] ?? '';
                        ?>

                        <h4><?php echo e($action === 'edit' ? 'Edit ' : 'Add ' . $action); ?></h4>
                        <h6><?php echo e($action === 'edit' ? 'Edit/Update ' : 'Add/Store ' . $action); ?></h6>

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

            <form id="saleForm" method="post" action="<?php echo e(route($route)); ?>">
                <?php echo csrf_field(); ?>
                <div class="box-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12">

                            <div class="row">
                                <?php if($type === 'quotation' || $type === 'edit' || $type === 'invoice'): ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quote Customer<span class="text-danger">*</span></label>
                                            <div class="d-flex">
                                                <select class="form-control form-control-sm select2" id="vendor_id"
                                                    name="vendor_id">
                                                    <option value="">Choose Customer</option>
                                                    <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($customer->id); ?>"
                                                            <?php echo e(isset($customerPackage) && $customerPackage->customer_id == $customer->id ? 'selected' : ''); ?>>
                                                            <?php echo e($customer->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>


                                                <div class="btn-group mx-2" role="group" aria-label="Second group">
                                                    <a data-toggle="modal" data-target="#vendorModal"><i
                                                            class="mdi mdi-account-multiple btn btn-sm btn-success"></i></a>
                                                </div>
                                            </div>
                                            <!-- Error message container -->
                                            <div id="customerError" class="error-message mt-2 text-danger"></div>

                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-4">Type : </label>
                                            <div class="col-md-8">
                                                <select name="type" id="type" class="form-control form-control-sm">
                                                    <?php if($type === 'sale'): ?>
                                                        <option value="3">Sale</option>
                                                        <option value="4">Sale Return</option>
                                                    <?php else: ?>
                                                        <option value="1">Purchase</option>
                                                        <option value="2">Purchase Return</option>
                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-form-label col-md-4"><?php echo e($type === 'sale' ? 'Customers' : 'Suppliers'); ?>

                                                : </label>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="d-flex">
                                                        <select class="form-control form-control-sm select2" id="vendor_id"
                                                            name="vendor_id">
                                                            <option value="">Choose
                                                                <?php echo e($type === 'sale' ? 'Customer' : 'Supplier'); ?></option>
                                                            <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->name); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>

                                                        <div class="btn-group ml-2" role="group"
                                                            aria-label="Second group">
                                                            <a data-toggle="modal" data-target="#vendorModal"><i
                                                                    class="mdi mdi-account-multiple btn btn-sm btn-success rounded-0"></i></a>
                                                        </div>
                                                    </div>
                                                    <!-- Error message container -->
                                                    <div id="customerError" class="error-message mt-2 text-danger"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>



                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Date : </label>
                                        <div class="col-md-8">
                                            <input class="form-control current-date" type="date"
                                                value="<?php echo e(isset($customerPackage) && $customerPackage->date != null ? $customerPackage->date : ''); ?>"
                                                name="date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">SalesPerson : </label>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <div class="input-group">
                                                        <input id="sale_person_id" list="sale_person"
                                                            value="<?php echo e(isset($customerPackage) && $customerPackage->admin != null ? $customerPackage->admin->name : ''); ?>"
                                                            class="form-control form-control-sm">
                                                        <datalist id="sale_person">
                                                            <?php $__currentLoopData = $admin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($item->name); ?>"
                                                                    data-person-id="<?php echo e($item->id); ?>"></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </datalist>
                                                        <span class="input-group-append">
                                                            <a class="btn btn-sm btn-info disabled btnSavePerson"><i
                                                                    class="mdi mdi-account-multiple"></i></a>
                                                        </span>

                                                        <input type="hidden" name="sale_person"
                                                            value="<?php echo e(isset($customerPackage) && $customerPackage->admin != null ? $customerPackage->admin->id : ''); ?>"
                                                            class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>


                            <?php if($type === 'quotation' || $type === 'edit' || $type === 'invoice'): ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>To : </label>
                                            <div class="controls">
                                                <textarea rows="3" name="to" id="to" class="form-control" placeholder="To" aria-invalid="false"><?php echo e(isset($customerPackage) ? $customerPackage->subject : ''); ?></textarea>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Subject : </label>
                                            <div class="controls">
                                                <textarea rows="3" name="subject" id="subject" class="form-control" placeholder="Subject"
                                                    aria-invalid="false"><?php echo e(isset($customerPackage) ? $customerPackage->subject : ''); ?></textarea>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php endif; ?>


                            <div class="row ">
                                <div class="col-12 d-flex justify-content-start my-2">
                                    <a type="button" class="btn btn-sm btn-primary" id="addNewBtn"
                                        data-toggle="tooltip" data-placement="top" title="Add Item"><i
                                            class="fa fa-plus"></i></a>
                                </div>
                            </div>




                            

                            <!-- Table row -->
                            <div class="row" style="min-height: 200px; min-width:700px">
                                <div class="table-responsive">
                                    <table id="item-list" class="table table-sm  table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Description</th>
                                                <th>Unit</th>
                                                <th>QTY</th>
                                                <th>P.Price</th>
                                                <th>S.Price</th>
                                                <th>Disc.</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody id="addRow" class="addRow">
                                            <?php if(isset($customerPackage)): ?>
                                                <?php $__currentLoopData = $customerPackage->customerPackageItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr data-item-id='<?php echo e($item->id); ?>'>
                                                        <input type='hidden' name='item_id[]' id='item_id'
                                                            value='<?php echo e($item->id); ?>'>
                                                        <td class='column-140 product_td'>
                                                            <input type='text'
                                                                value='<?php echo e(isset($item->product) && $item->product->quotation_product_name ? $item->product->quotation_product_name : ''); ?>'
                                                                list='products' name='product_name[]'
                                                                class='form-control form-control-sm product-select'>
                                                            <datalist id='products'>
                                                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option data-product-id='<?php echo e($product->id); ?>'
                                                                        value='<?php echo e($product->quotation_product_name); ?>'>
                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </datalist>
                                                            <input type='hidden' name='product_id[]'
                                                                class='product-id-input'
                                                                value='<?php echo e($item->product_id ?? ''); ?>'>
                                                        </td>
                                                        <td class='column-280'>
                                                            <textarea type='text' rows='2' class='form-control form-control-sm description' name='description[]'
                                                                style='height: 26px;'>
                                                <?php echo e($item->product->quotation_short_descp ?? ''); ?>

                                                        </textarea>
                                                        </td>
                                                        <td class="column-80">
                                                            <select class='form-control form-control-sm select2 unit-id'
                                                                name='unit_id[]'>
                                                                <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($unit->id); ?>"
                                                                        <?php echo e(isset($item->unit) && $item->unit->id == $unit->id ? 'selected' : ''); ?>>
                                                                        <?php echo e($unit->name); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </td>
                                                        <td class='column-80'>
                                                            <input type='text'
                                                                class='form-control form-control-sm qty numeric-input'
                                                                name='qty[]' value='<?php echo e($item->qty ?? ''); ?>' />
                                                        </td>
                                                        <td class='column-100'>
                                                            <input type='text'
                                                                class='form-control form-control-sm decimal-input purchase-price'
                                                                name='purchase_price[]'
                                                                value='<?php echo e(isset($item->product) && isset($item->product->latestPurchase) ? $item->product->latestPurchase->price : (isset($item->product) ? $item->product->purchase_price : '')); ?>' />
                                                        </td>
                                                        <td class='column-100'>
                                                            <input type='text'
                                                                class='form-control form-control-sm decimal-input rate'
                                                                name='price[]' value='<?php echo e($item->price ?? ''); ?>' />
                                                        </td>
                                                        <td class='column-100'>
                                                            <input type='text'
                                                                class='form-control form-control-sm discount-price'
                                                                name='discount_price[]'
                                                                value='<?php echo e($item->discount ?? ''); ?>' />
                                                        </td>
                                                        <td class='column-100'>
                                                            <input type='text'
                                                                class='form-control form-control-sm total' name='total[]'
                                                                readonly value='<?php echo e($item->total ?? ''); ?>' />
                                                        </td>
                                                        <td class='column-40'>
                                                            <button data-item-id='<?php echo e($item->id); ?>'
                                                                class='btn btn-danger btn-sm delete-row'>
                                                                <i class='fa fa-trash'></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tbody>


                                        <tfoot id="tFooter" class="d-none">
                                            <tr>
                                                <td colspan="6"></td>
                                                <td class='column-100 px-0 pb-0 font-weight-bold'>Total Amt : </td>
                                                <td class='column-100 px-0 pb-0 font-weight-bold'><input
                                                        value="<?php echo e(isset($customerPackage) && $customerPackage->total != null ? $customerPackage->total : ''); ?>"
                                                        name="grand_total" id="grandTotal" type="text"
                                                        style="border:0px" readonly></td>
                                            </tr>

                                            <tr>
                                                <td colspan="6"></td>
                                                <td class='column-100 p-0 font-weight-bold'>Discount : </td>
                                                <td class='column-100 p-0 font-weight-bold'><input
                                                        class="form-control form-control-sm" id="total_discount"
                                                        value="<?php echo e(isset($customerPackage) && $customerPackage->discount != null ? $customerPackage->discount : ''); ?>"
                                                        type="text" name="total_discount"></td>
                                            </tr>

                                            <tr>
                                                <td colspan="6"></td>
                                                <td class='column-100 px-0 pt-0 font-weight-bold'>Net Payable : </td>
                                                <td class='column-100 px-0 pt-0 font-weight-bold'><input type="text"
                                                        value="<?php echo e(isset($customerPackage) && $customerPackage->net_payable != null ? $customerPackage->net_payable : ''); ?>"
                                                        id="netPayable" name="net_payable" value="0"
                                                        style="border:0px" readonly></td>
                                            </tr>

                                            <?php if($type === 'invoice' || $type === 'sale' || $type === 'purchase'): ?>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class='column-100 p-0 font-weight-bold'>Total Paid : </td>
                                                    <td class='column-100 p-0 font-weight-bold'><input type="text"
                                                            class="form-control form-control-sm numeric-input"
                                                            id="totalPaid" name="total_paid"></td>
                                                </tr>


                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class='column-100 p-0 font-weight-bold'>Total Due : </td>
                                                    <td class='column-100 p-0 font-weight-bold'><input type="text"
                                                            id="totalDue" name="total_due"
                                                            value="<?php echo e(isset($customerPackage) && $type === 'invoice' && $customerPackage->net_payable != null ? $customerPackage->net_payable : ''); ?>"
                                                            style="border:0px" readonly>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>

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
                <form id="vendorForm" method="POST" action="<?php echo e(route('vendor.store')); ?>"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Customer</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row jutify-content-center">
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
                        <form id="productForm" method="post" action="<?php echo e(route('product.store')); ?>">
                            <?php echo csrf_field(); ?>
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
                                            <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($unit->id); ?>">
                                                    <?php echo e($unit->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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


    <script src="<?php echo e(asset('backend/js/pages/editor.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor_components/ckeditor/ckeditor.js')); ?>"></script>


    <script>
        var userManagementStoreRoute = "<?php echo e(route('user-management.store')); ?>";
        var productCreate = "<?php echo e(route('product.create')); ?>";
        var latestQuotation = "<?php echo e(route('customer-latest-quotation', ':id')); ?>";
        var updateProduct = "<?php echo e(route('update.quotation.product', ':id')); ?>";
        var latestProductInfo = "<?php echo e(route('get.sale.product')); ?>";
        var type = <?php echo json_encode($type); ?>;

        console.log("type : ",type);
        var products = <?php echo json_encode($products); ?>;
        var units = <?php echo json_encode($units); ?>;
        var customerPackageId = <?php echo e(isset($customerPackage) ? $customerPackage->id : 'undefined'); ?>;

        <?php if(isset($customerPackage)): ?>
        invoiceNo = <?php echo json_encode($customerPackage->invoice_no); ?>

        <?php endif; ?>
        

    </script>

    <script src="<?php echo e(asset('backend/custom/assets/js/add_sales_person.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/custom/assets/js/add_vendor.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/custom/assets/js/common.js')); ?>"></script>


    <script>
        // JavaScript code


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
                var message = type === "purchase" ? "supplier" : "customer";
                $('#customerError').text('Please choose a ' + message + '.').show();

                // Highlight the select box with a red border
                $('#vendor_id').css('border', '1px solid red');

                return;
            }

            // Clear the error message and reset the border
            $('#customerError').text('').hide();
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
                '<input type="hidden" name="product_id[]" class="product-id-input" value="' + (rowData
                    .product_id || '') + '">' +
                '</td>' +
                '<td class="column-280">' +
                '<textarea type="text" rows="2" class="form-control form-control-sm description" name="description[]" style="height: 26px;">' +
                ((rowData.product && rowData.product.quotation_short_descp) || '') + '</textarea>' +
                '</td>' +
                '<td class="column-80">' +
                '<select class="form-control form-control-sm select2 unit-id" name="unit_id[]">' +
                units.map(function(unit) {
                    return '<option value="' + unit.id + '" ' + (rowData.unit && rowData.unit.id == unit.id ?
                        'selected' : '') + '>' + unit.name + '</option>';
                }).join('') +
                '</select>' +
                '</td>' +
                '<td class="column-80">' +
                '<input type="text" class="form-control form-control-sm qty numeric-input" name="qty[]" value="' +
                (rowData.qty || '') + '" />' +
                '</td>' +
                (type !== 'purchase' ?
                    '<td class="column-100">' +
                    '<input type="text" value="' +
                    ((rowData.product && rowData.product.latestPurchase) ? rowData.product.latestPurchase
                        .price :
                        (rowData.product ? rowData.product.purchase_price : '')) +
                    '" class="form-control form-control-sm purchase-price" name="purchase_price[]" />' +
                    '</td>' : '') +
                '<td class="column-100">' +
                '<input type="text" class="form-control form-control-sm decimal-input rate" name="price[]" value="' +
                (rowData.price || '') + '" />' +
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


        $(document).ready(function() {

            // Handle "Add New" button click
            $(document).on('click', '#addNewBtn', function() {
                // Create a new row
                addNewRow();
                updateVisibility();
                calculateGrantTotal();
                calculateNetPayable();
            });

            // Delete the row when the delete button is clicked
            $("#item-list").on("click", ".delete-row", function(event) {
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
                        var updateUrl = "<?php echo e(route('quotation-item.destroy', ':quotation-item')); ?>";
                        updateUrl = updateUrl.replace(':quotation-item', itemId);

                        // Perform an AJAX call to delete the item from the database
                        if (itemId != "undefined" && (type === 'quotation' || type === 'edit')) {
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
                            calculateTotalDue();
                        }

                        var hasRows = $("#addRow tr").length > 0;
                        $('#total_discount').val(0, !hasRows);
                    }
                });
            });

            // Common function for form submission
            function submitForm(preview) {
                var formData = new FormData($('#saleForm')[0]);
                // Append the customerPackageId to the formData
                formData.append('customerPackageId', customerPackageId);
                if (type === 'sale') {
                    formData.append('saleType', 'sale');
                }
                if (type === 'invoice') {
                    formData.append('saleType', 'invoice');
                    formData.append("invoiceNo",invoiceNo)
                }

                $.ajax({
                    url: $('#saleForm').attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log("data : ", data);
                        showToastr(data.notification.type, data.notification.message);
                        if (type === 'quotation' || type === 'edit') {
                            customerPackageId = data.customerPackage.id

                            $('#vendor_id').val(data.customerPackage.customer_id);
                            $("input[name='date']").val(data.customerPackage.date);
                            $('#to').val(data.customerPackage.to);
                            $('#subject').val(data.customerPackage.subject);
                            $('#grandTotal').val(data.customerPackage.total);
                            $('#total_discount').val(data.customerPackage.discount);
                            $('#netPayable').val(data.customerPackage.net_payable);

                            $('#addRow').empty();
                            $.each(data.customerPackageItems, function(index, item) {
                                // console.log("item : ", item);
                                addNewRow(item);
                            });

                            if (preview) {
                                var newTabUrl =
                                    "<?php echo e(route('preview.quotation-or-invoice.report', ['type' => 'quotation', 'id' => '__id__'])); ?>";
                                newTabUrl = newTabUrl.replace('__id__', customerPackageId);
                                var saleReportWindow = window.open(newTabUrl, "_blank");
                            }
                        } else {

                            console.log('i am form type ')
                            if (type === 'invoice') {
                                if (preview) {
                                    var newTabUrl =
                                        "<?php echo e(route('preview.quotation-or-invoice.report', ['type' => 'quotation-invoice', 'id' => '__id__'])); ?>";
                                    newTabUrl = newTabUrl.replace('__id__', data.saleInvoice);
                                    var saleReportWindow = window.open(newTabUrl, "_blank");

                                }

                                // Focus on the main window (current window)
                                window.focus();

                                // Redirect to the view.sale route
                                window.location.href = "<?php echo e(route('quotation.index')); ?>";
                            }
                            if (type === 'sale') {
                                if (preview) {
                                    var newTabUrl =
                                        "<?php echo e(route('preview.quotation-or-invoice.report', ['type' => 'sale', 'id' => '__id__'])); ?>";
                                    newTabUrl = newTabUrl.replace('__id__', data.saleInvoice);
                                    var saleReportWindow = window.open(newTabUrl, "_blank");

                                }
                                 // Focus on the main window (current window)
                                window.focus();

                                // Redirect to the view.sale route
                                window.location.href = "<?php echo e(route('view.sale')); ?>";
                               
                            }
                            if (type === 'purchase') {

                                if (preview) {


                                }
                            }
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

    <script src="<?php echo e(asset('backend/custom/assets/js/add_product.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/custom/assets/js/calculation.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/custom/assets/js/latest_quotation.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/quotation/create_quotation.blade.php ENDPATH**/ ?>