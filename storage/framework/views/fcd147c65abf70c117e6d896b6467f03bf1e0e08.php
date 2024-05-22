<?php $__env->startSection('content'); ?>
    <style>
        .js-result {
            width: 10px;
        }

        .title {
            background: linear-gradient(318deg, rgba(82,195,255,1) 36%, rgba(88,104,162,1) 75%);;
        }

        .heading {
            color: #5868a2;
        }

        .footer-top-widget {
            display: none
        }
    </style>
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="cart-page">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="m-0 p-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb  flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="<?php echo e(url('/')); ?>"><i class="fa fa-home"></i></a>
                            </li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1" aria-current="page"><a
                                href="<?php echo e(route('view.package')); ?>">Quotation Builder</a>
                            </li>
                            <?php if(count($packageDetails) > 0): ?>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">
                                <a
                                href="<?php echo e(route('view.packageDetails',(encrypt($packageDetails->first()->package->id)))); ?>"><?php echo e($packageDetails->first()->package->name); ?></a>
                            </li>
                            <?php endif; ?>

                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->
        <div class="container">
            
            
            <div class="row justify-content-center align-items-center">
                <?php if(count($packageDetails) > 0): ?>
                    <div class="col-lg-10 mb-10">
                        <div class="d-flex d-flex justify-content-between align-items-center">
                            <div class="d-lg-block d-none d-flex justify-content-center align-items-center">
                                <button type="button" data-toggle="modal" data-target="#calcModal" class="font-size-16 bg-dark rounded rounded-lg  p-2 text-center text-white">
Calculate Storage
                                </button>

<!-- The Modal -->
<div class="modal" id="calcModal">
    <div class="modal-dialog modal-block">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          Modal body..
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>


                                <span class="font-size-16 bg-dark rounded rounded-lg  p-2 text-center text-white">Total :
                                    <span
                                        id="txtTotal"><?php echo e(Session::has($packageDetails->first()->package->name) ? number_format(Session::get($packageDetails->first()->package->name)['total_price'] , 0, '.', ','): 0); ?></span><span

                                        class="font-size-22"><?php echo e($currency->symbol); ?></span></span>

                                        <?php if(Session::has($packageDetails->first()->package->name)): ?>
                                            <?php
                                                $totalPrice = Session::get($packageDetails->first()->package->name)['total_price'];
                                            ?>

                                            <?php if($totalPrice > 0): ?>
                                            <a href="<?php echo e(route('frontend.create.package',encrypt($packageDetails->first()->package->id))); ?>"  class="ml-2 btn btn-soft-dark border border-dark ">NEXT</a>
                                            <?php endif; ?>
                                        <?php endif; ?>



                                
                            </div>
                            <div class="center-text-side">
                                <h4 class="fw-bold mb-0" style="color: rgba(238,34,82,1)">
                                    <?php echo e($packageDetails->first()->package->name); ?>

                                </h4>
                                <p class="mb-1 text-center">Select Your Components</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-0">
                                <h5 class="title bg-success text-white mb-0 p-2">
                                    Items for <?php echo e($packageDetails->first()->package->name); ?>

                                </h5>
                            </div>
                        </div>
                        <?php $__currentLoopData = $packageDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $dynamicKey = $item->subsubcategory ? $item->subsubcategory->subsubcategory_name : ($item->subcategory ? $item->subcategory->subcategory_name : $item->category->category_name);
                            ?>
                            <?php if(isset(session($packageDetails->first()->package->name)[$dynamicKey])): ?>
                                <div class="row align-items-center border border-gray-18 border-top-0  p-3">
                                    <div class="col-md-1 col-2 ps-4">
                                        <div class="d-flex align-items-center">
                                            
                                            <img src="<?php echo e(asset(Session::get($packageDetails->first()->package->name)[$dynamicKey]['product_thambnail'])); ?>"
                                                alt="" style="height:40px; width:40px">
                                        </div>
                                    </div>
                                    <div class="col-md-11 col-10">
                                        <div class="ms-2">
                                            <div
                                                class="d-flex align-items-center justify-content-between font-size-16 font-weight-bold">

                                                <?php echo e($dynamicKey); ?>

                                            </div>
                                            <div class="mt-1"><a href="#"
                                                    class="text-gray-90"><?php echo e(Session::get($packageDetails->first()->package->name)[$dynamicKey]['product_name']); ?>

                                                </a>
                                            </div>
                                            <div
                                                class="quotation-builder row d-flex align-items-center justify-content-md-end mt-1">
                                                <div
                                                    class="border rounded-pill justify-content-start ml-2 ml-md-0 mt-2 mt-md-0   border-color-1 col-md-3 col-lg-2">
                                                    <div class="js-quantity row align-items-center">
                                                        <div class="col">
                                                            <input id="qty<?php echo e($index); ?>"
                                                                data-qutation="<?php echo e(encrypt($packageDetails->first()->package->name)); ?>"
                                                                data-key="<?php echo e(encrypt($dynamicKey)); ?>"
                                                                class="qty form-control h-auto border-0 rounded p-0 shadow-none"
                                                                type="text" value="<?php echo e(Session::get($packageDetails->first()->package->name)[$dynamicKey]['qty']); ?>">
                                                        </div>
                                                        <div class="col-auto pr-1">
                                                            <a data-action="decrease"
                                                                data-qutation="<?php echo e(encrypt($packageDetails->first()->package->name)); ?>"
                                                                data-key="<?php echo e(encrypt($dynamicKey)); ?>"
                                                                class="js-change-quantity js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                                href="javascript:;">
                                                                <small class="fas fa-minus btn-icon__inner"></small>
                                                            </a>
                                                            <a data-action="increase"
                                                                data-qutation="<?php echo e(encrypt($packageDetails->first()->package->name)); ?>"
                                                                data-key="<?php echo e(encrypt($dynamicKey)); ?>"
                                                                class="js-change-quantity js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                                href="javascript:;">
                                                                <small class="fas fa-plus btn-icon__inner"></small>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2  mt-2 mt-md-0">
                                                    <span>
                                                        <?php echo e(number_format(Session::get($packageDetails->first()->package->name)[$dynamicKey]['discount_price'] != null ? Session::get($packageDetails->first()->package->name)[$dynamicKey]['discount_price'] : Session::get($packageDetails->first()->package->name)[$dynamicKey]['selling_price'], 0, '.', ',')); ?><span
                                                            class="font-size-18"><?php echo e($currency->symbol); ?></span></span>
                                                </div>
                                                <div
                                                    class="col-md-3  mt-2 mt-md-0 d-flex justify-content-between justify-content-md-around">
                                                    <span><span
                                                            class="subtotal"><?php echo e(number_format(Session::get($packageDetails->first()->package->name)[$dynamicKey]['subTotal'], 0, '.', ',')); ?></span><span
                                                            class="font-size-18"><?php echo e($currency->symbol); ?></span></span>
                                                    <a data-qutation="<?php echo e(encrypt($packageDetails->first()->package->name)); ?>"
                                                        data-key="<?php echo e(encrypt($dynamicKey)); ?>"
                                                        data-package_id="<?php echo e(encrypt($packageDetails->first()->package->id)); ?>"
                                                        onclick="removePackageProduct(this)" href="javaScript:void(0)"
                                                        class="btn btn-sm  p-0"><i class="fas fa-times"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="row align-items-center border border-gray-18 border-top-0  p-3">
                                    <div class="col-md-1 col-2 ps-4">
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-microchip fa-3x text-dark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-11 col-10">
                                        <div class="ms-2">
                                            <form action="<?php echo e(route('view.packageDetailsProducts')); ?>" method="get">
                                                <?php echo csrf_field(); ?>
                                                <div class="d-flex align-items-center justify-content-between">


                                                    <button type="submit" class="text-gray-90"
                                                        style="border: none; background-color: transparent; cursor: pointer;">
                                                        <?php if($item->subcategory != null): ?>
                                                            <?php if($item->subsubcategory != null): ?>
                                                                <?php echo e($item['subsubcategory']['subsubcategory_name']); ?>

                                                            <?php else: ?>
                                                                <?php echo e($item['subcategory']['subcategory_name']); ?>

                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <?php echo e($item['category']['category_name']); ?>

                                                        <?php endif; ?>
                                                    </button>


                                                    <div>
                                                        <form action="<?php echo e(route('view.packageDetailsProducts')); ?>"
                                                            method="get">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="quotation_builder"
                                                                value="<?php echo e($packageDetails->first()->package->id); ?>">
                                                            <?php if($item->subcategory != null): ?>
                                                                <?php if($item->subsubcategory != null): ?>
                                                                    <input type="hidden" name="name"
                                                                        value="<?php echo e($item['subsubcategory']['subsubcategory_name']); ?>">
                                                                    <input type="hidden" name="subsubcategory_id"
                                                                        value="<?php echo e($item->subsubcategory_id); ?>">
                                                                <?php else: ?>
                                                                    <input type="hidden" name="name"
                                                                        value="<?php echo e($item['subcategory']['subcategory_name']); ?>">
                                                                    <input type="hidden" name="subcategory_id"
                                                                        value="<?php echo e($item->subcategory_id); ?>">
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <input type="hidden" name="name"
                                                                    value="<?php echo e($item['category']['category_name']); ?>">
                                                                <input type="hidden" name="category_id"
                                                                    value="<?php echo e($item->category_id); ?>">
                                                            <?php endif; ?>
                                                            <button type="submit"
                                                                class="btn btn-soft-secondary border border-secondary  font-weight-normal">Choose</button>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <h3 class="text-center text-danger">No items found in this package</h3>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
    <script>
        $(document).ready(function() {
            $("#footer-top-widget").removeClass("d-lg-block");
        });
    </script>


    <script>
        $(document).ready(function() {
            $(document).on("click", ".js-change-quantity", function(event) {
                event.preventDefault();

                const action = $(this).data("action");
                const container = $(this).closest(".js-quantity");
                const input = container.find(".qty");

                let value = parseInt(input.val());
                value = isNaN(value) ? 0 : value;

                if (action === "decrease" && value > 1) {
                    input.val(value - 1);
                    increaseDecreaseQuotationQty(input.val(), $(this).data("qutation"), $(this).data(
                        "key"));
                } else if (action === "increase") {
                    input.val(value + 1);
                    increaseDecreaseQuotationQty(input.val(), $(this).data("qutation"), $(this).data(
                        "key"));
                }
            });

            $(document).on("focusout", ".qty", function() {
                let value = parseInt($(this).val());
                // If the value is null or NaN, set to 1
                value = isNaN(value) ? 1 : value;
                // If the value is less than or equal to 0, set to 1
                if (value <= 0) {
                    value = 1;
                }
                $(this).val(value);

                const qutation = $(this).data("qutation");
                const key = $(this).data("key");

                // console.log("Value after focusout: " + value);
                // console.log("Qutation: " + qutation);
                // console.log("Key: " + key);

                increaseDecreaseQuotationQty(value, qutation, key);
            });


            $(document).on("keydown", ".qty", function(e) {
                // Allow only numbers and navigation keys
                if (!(e.key === "ArrowUp" || e.key === "ArrowDown" || e.key === "Backspace" ||
                        e.key === "Delete" || e.key === "Tab" || e.key === "Enter" ||
                        (e.key >= "0" && e.key <= "9"))) {
                    e.preventDefault();
                }
            });
        });

        function increaseDecreaseQuotationQty(quantity, quotation, key) {
            // console.log("Quantity:", quantity);
            // console.log("Quotation:", quotation);
            // console.log("Key:", key);

            $.ajax({
                type: "get",
                url: "<?php echo e(route('increase-decrease-package-qty')); ?>",
                data: {
                    quotation: quotation,
                    key: key,
                    qty: quantity
                },
                dataType: "json",
                success: function(response) {
                    // Update the subtotal and total on the page
                    const container = $('[data-qutation="' + quotation + '"][data-key="' + key +
                        '"]').closest(".quotation-builder");
                    container.find(".subtotal").text(response.subTotal.toLocaleString());
                    $('#txtTotal').text(response.total.toLocaleString());
                    // console.log(response);
                    // console.log(response)
                }
            });
        }
    </script>


    
    <script>
        function removePackageProduct(element) {
            const qutation = $(element).data("qutation");
            const key = $(element).data("key");
            const package_id = $(element).data("package_id"); // Add this line

            // Now you can use qutation and key in your logic
            // console.log("Quotation:", qutation);
            // console.log("Key:", key);

            $.ajax({
                type: "post",
                url: "<?php echo e(route('remove-package-product')); ?>",
                data: {
                    package_id: package_id,
                    qutation: qutation,
                    key: key,
                },
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    const extractedContent = response.extractedContent;

                    if (extractedContent !== undefined) {
                        // Update the content of the main element
                        $('main.cart-page').html(extractedContent);
                    } else {
                        console.log("Extracted content is undefined.");
                    }

                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/frontend/quotationbuilder/view_packagedetails.blade.php ENDPATH**/ ?>