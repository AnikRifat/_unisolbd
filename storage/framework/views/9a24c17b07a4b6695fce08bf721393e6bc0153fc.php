<?php $__env->startSection('content'); ?>
    <script src="<?php echo e(asset('frontendassets/custom-js/dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/custom-js/bootstrap4.min.js')); ?>"></script>


    <style>
        .profile-tab-nav {
            min-width: 250px;
        }

        .img-circle img {
            height: 100px;
            width: 100px;
            border-radius: 100%;
            border: 5px solid #fff;
        }

        #logout {
            text-align: left;
        }

        .upload-img {
            position: relative;
        }

        .upload-img a {
            position: absolute;
            top: 10px;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 1;
        }

        #example thead {
            background: linear-gradient(318deg, rgba(82,195,255,1) 36%, rgba(88,104,162,1) 75%);;
            color: #fff;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .ellipsis {
            display: block;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    </style>

    <?php
        // Retrieve the order details in the controller and pass it to the view
        // $orderDetails = App\Models\Order::select('orders.*')
        //     ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        //     ->where('orders.user_id', Auth::user()->id)
        //     ->get();

        $orderDetails = App\Models\Order::with('orderItems')
            ->where('user_id', Auth::user()->id)
            ->get();

    ?>
    <section class="py-5">
        <div class="container">
            <div class="bg-white shadow rounded-lg d-block">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-tab-nav border-right">
                            <div class="px-4">
                                <div class="img-circle text-center mb-3">
                                    <img src="<?php echo e(!empty(Auth::user()->profile_photo_path) ? asset('storage/' . Auth::user()->profile_photo_path) : asset('upload/no_image.png')); ?>"
                                        alt="Image" class="shadow">
                                </div>
                                <h5 class="text-center"><?php echo e(Auth::user()->name); ?></h5>
                            </div>
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link  active" id="account-tab" data-toggle="pill" href="#account"
                                    role="tab" aria-controls="account" aria-selected="true">
                                    <i class="fa fa-home text-center mr-1"></i>
                                    Account
                                </a>
                                <a class="nav-link" id="invoices-tab" data-toggle="pill" href="#invoicesTab" role="tab"
                                aria-controls="security" aria-selected="false">
                                <i class="fa fa-file-invoice text-center mr-1"></i>
                                My Invoices
                            </a>
                                <a class="nav-link" id="password-tab" data-toggle="pill" href="#passwordTabPane"
                                    role="tab" aria-controls="passwordTabPane" aria-selected="false">
                                    <i class="fa fa-key text-center mr-1"></i>
                                    Change Password
                                </a>
                                <a class="nav-link" id="security-tab" data-toggle="pill" href="#security" role="tab"
                                    aria-controls="security" aria-selected="false">
                                    <i class="fa fa-shopping-cart text-center mr-1"></i>
                                    Orders
                                </a>

                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button id="logout" href="javascript:void(0)" class="btn nav-link">
                                        <i class="fa fa-arrow-circle-down text-center mr-1"></i>
                                        Logout
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">

                            <div class="tab-pane fade show active" id="account" role="tabpanel"
                                aria-labelledby="account-tab">
                                <form action="<?php echo e(route('user-profile-information.update')); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <h3 class="mb-4">Account Settings</h3>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Name<span class="text-danger">*</span></label>
                                                <input type="text" name="name" value="<?php echo e(Auth::user()->name); ?>"
                                                    class="form-control" placeholder="full name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Email<span class="text-danger">*</span></label>
                                                <input type="email" name="email" value="<?php echo e(Auth::user()->email); ?>"
                                                    class="form-control" placeholder="example@gmail.com">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Phone number<span class="text-danger">*</span></label>
                                                <input type="text" name="phone" value="<?php echo e(Auth::user()->phone); ?>"
                                                    class="form-control" placeholder="+88">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Profile Picture</label>
                                                <input name="photo" type="file" class="form-control" id="inputFile">
                                            </div>
                                        </div>
                                    </div>




                                    <div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <button class="btn btn-light">Cancel</button>
                                    </div>

                                </form>
                            </div>


                            <div class="tab-pane fade" id="invoicesTab" role="tabpanel" aria-labelledby="invoicesTab">



                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered"
                                        style="min-width: 1000px">
                                        <thead>
                                            <tr>
                                                <th>#SL</th>
                                                <th>Date</th>
                                                <th>Channel</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $quotations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($index + 1); ?></td>
                                                    <td><?php echo e($item->created_at->format('j F Y')); ?></td>
                                                    <td><?php echo e($item->channel); ?></td>
                                                    <td><?php echo e($item->user->name); ?></td>
                                                    <td><?php echo e($item->user->phone); ?></td>
                                                    <td class="text-center">
                                                        <?php if($item->status == 'quotation'): ?>
                                                            <span
                                                                class="badge badge-pill badge-success rounded-0"><?php echo e($item->status); ?></span>
                                                        <?php else: ?>
                                                            <span
                                                                class="badge badge-pill badge-danger rounded-0"><?php echo e($item->status); ?></span>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td class="d-flex" style="width:80px">
                                                        <a data-print="<?php echo e($item->id); ?>"
                                                            class="btn btn-sm btn-primary btnPrint mr-10" data-toggle="tooltip" data-placement="top" title="Print Quotation"
                                                            href="<?php echo e(route('user.invoice.report',['id' => $item->id, 'type' => 'quotation'])); ?>"><i class="fa fa-print"></i></a>




                                                        <?php if($item->status == 'quotation'): ?>
                                                        <a data-edit="<?php echo e($item->id); ?>"
                                                            class="btn btn-sm btn-success btnEdit mr-10" data-toggle="tooltip" data-placement="top" title="Edit Quotation"
                                                            href="<?php echo e(route('quotation-edit-or-invoice', ['id' => $item->id, 'type' => 'edit'])); ?>"><i
                                                                class="fa fa-edit"></i></a>

                                                            <a data-edit="<?php echo e($item->id); ?>"
                                                                class="btn btn-sm btn-info btnSale mr-10" data-toggle="tooltip" data-placement="top" title="Make Invoice"
                                                                href="<?php echo e(route('quotation-edit-or-invoice', ['id' => $item->id, 'type' => 'invoice'])); ?>"><i
                                                                    class="si-basket-loaded si"></i></a>
                                                        <?php endif; ?>






                                                    </td>

                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>

                                    </table>
                                </div>





                            </div>


                            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">



                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered"
                                        style="min-width: 1000px">
                                        <thead>
                                            <tr>
                                                <th>#SL</th>
                                                <th>Product</th>
                                                <th>Rate & Qty</th>
                                                <th>Amount</th>
                                                <th style="width: 120px">Order Date & time</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            


                                            <?php $itemCounter = 1; ?>

                                            <?php $__currentLoopData = $orderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><span
                                                                class="badge badge-dark p-2"><?php echo e($itemCounter); ?></span>
                                                        </td>
                                                        <td class="font-weight-bold"
                                                            style="max-width: 200px; overflow: hidden;">
                                                            <div style="display: flex; align-items: center;">
                                                                <img src="<?php echo e(asset($item->product->product_thambnail)); ?>"
                                                                    style="height: 50px; width: 50px; margin-right: 10px">
                                                                <a class="text-blue" href="javascript:void(0)">
                                                                    <?php echo e($item->product->product_name); ?>

                                                                </a>
                                                            </div>
                                                        </td>

                                                        <td><?php echo e($item->price); ?>*<?php echo e($item->qty); ?></td>
                                                        <td class="text-danger">
                                                            <?php echo e(number_format($item->subtotal, 0, '.', ',')); ?></td>
                                                        <td style="width: 120px"><span
                                                                class="text-secondary"><?php echo e($order->created_at->format('d M Y, h:ia')); ?></span>
                                                        </td>
                                                        <?php
                                                            $statusBadges = [
                                                                'Pending' => 'badge-secondary',
                                                                'Confirmed' => 'badge-primary',
                                                                'Processing' => 'badge-info',
                                                                'Picked' => 'badge-dark',
                                                                'Shipped' => 'badge-warning',
                                                                'Delivered' => 'badge-success',
                                                                'Cancel' => 'badge-danger',
                                                            ];
                                                        ?>

                                                        <td>
                                                            <span class="badge <?php echo e($statusBadges[$order->status]); ?> p-2"><?php echo e(ucfirst($order->status)); ?></span>
                                                        </td>

                                                        <td><a href="javascript:void(0)"><i
                                                                    class="fa fa-eye text-dark"></i></a></td>
                                                    </tr>
                                                    <?php $itemCounter++; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




                                        </tbody>

                                    </table>
                                </div>





                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script>
        $(document).ready(function() {
            $("#inputFile").on("change", function() {
                var inputFiles = this.files;
                var file = inputFiles[0];

                var validImageTypes = ["image/jpeg", "image/png", "image/gif"];

                if (file) {
                    if (!validImageTypes.includes(file.type)) {
                        alert("Please select a valid image file (JPEG, PNG, GIF).");
                        // Clear input file selection
                        $("#inputFile").val("");
                        return;
                    }

                    var profileImg = $("#profileImg");
                    var removeButton = $("#removeButton");

                    if (!profileImg.length) {
                        var code = `
                            <div id="profileImg" class="img-circle mb-3 upload-img">
                                <img alt="Image" class="shadow">
                                <a id="removeButton" href="javascript:void(0)"><i class="fa fa-trash text-danger mr-1"></i></a>
                            </div>
                        `;

                        $('#inputFile').after(code);
                        profileImg = $("#profileImg");
                        removeButton = $("#removeButton");
                    }

                    var reader = new FileReader();
                    reader.readAsDataURL(file);

                    reader.onload = function(e) {
                        var imgSrc = e.target.result;
                        profileImg.find("img").attr("src", imgSrc);
                        profileImg.show();
                    };
                }
            });

            $(document).on("click", "#removeButton", function() {
                var profileImg = $("#profileImg");
                profileImg.find("img").attr("src", "<?php echo e(asset('frontend/user/img/user2.png')); ?>");
                profileImg.hide();
                // Clear input file selection if needed
                $("#inputFile").val("");
            });
        });
    </script>

    <script src="<?php echo e(asset('frontendassets/custom-js/password_validator.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            $('#password-update-form').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                const form = $(this);
                const formData = form.serialize();
                const url = form.attr('action');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        // Handle success response (if needed)
                        console.log(response);

                        // Display success message or update UI
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;

                            // Clear error messages with the 'error-message' class
                            $('.error-message').empty();

                            // Display the validation errors
                            if (errors.current_password) {
                                $('#current_password_error').text(errors.current_password[0]);
                            }
                            if (errors.password) {
                                $('#password_error').text(errors.password[0]);
                            }
                        }
                        // Handle the case of error if needed
                    }
                });
            });

            $('#cancel-button').click(function() {
                // Implement cancel logic here
            });
        });
    </script>


    <script>
        // password_validator.js

        function perform(form) {
            event.preventDefault(); // Prevent default form submission

            const formData = form.serialize();
            const url = form.attr('action');

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(response) {
                    // Handle success response (if needed)
                    console.log(response);
                    $('.error-message').empty();
                    showToastr(response.type, response.messsage);
                    // location.reload();
                    // Display success message or update UI
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;

                        // Clear error messages with the 'error-message' class
                        $('.error-message').empty();

                        // Display the validation errors
                        if (errors.current_password) {
                            $('#current_password_error').text(errors.current_password[0]);
                        }
                        if (errors.password) {
                            $('#password_error').text(errors.password[0]);
                        }
                    }
                    // Handle the case of error if needed
                }
            });
        }
    </script>

    <script>
        new DataTable('#example');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/dashboard.blade.php ENDPATH**/ ?>