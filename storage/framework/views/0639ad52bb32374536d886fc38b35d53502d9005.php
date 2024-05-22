<?php $__env->startSection('content'); ?>
<style>
    .js-result {
        width: 10px;
    }
    .title{
        background:  linear-gradient(318deg, rgba(82,195,255,1) 36%, rgba(88,104,162,1) 75%);;
    }
    .heading{
        color:rgba(238,34,82,1);
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
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><a
                                href="<?php echo e(route('view.package')); ?>">Quotation Builder</a>
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

                <?php if(count($packages)>0): ?>
                <div class="col-lg-8 col-md-10 mb-10">

                    <div class="row">
                        <div class="col-12 p-0">
                            <h5 class="title bg-success text-white mb-0 p-2">
                                Your Quotation Build
                            </h5>
                        </div>

                    </div>

                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row align-items-center border border-gray-18 border-top-0  p-3">
                        <div class="col-md-1 col-2 ps-4">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-microchip fa-3x text-dark"></i>
                            </div>
                        </div>
                        <div class="col-md-11 col-10">
                            <div class="ms-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <form action="<?php echo e(route('view.packageDetails',urlencode(encrypt($package->id)))); ?>" method="GET">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="text-gray-90" style="border: none; background-color: transparent; cursor: pointer;">
                                            <?php echo e($package->name); ?>

                                        </button>
                                        
                                    </form>

                                   


                                    <div>
                                        <form action="<?php echo e(route('view.packageDetails',(encrypt($package->id)))); ?>" method="GET">
                                            <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-soft-secondary border border-secondary font-weight-blod">View</button>
                                    </form>
                                     </div>



                                </div>
                                

                              
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php else: ?>
                <h4 class="text-danger"> Quotation Builder is comming soon...................</h4>
                <?php endif; ?>




            </div>

        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    <script>
       $(document).ready(function() {
        console.log('this is working')
  $("#footer-top-widget").removeClass("d-lg-block");
});
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/frontend/quotationbuilder/view_package.blade.php ENDPATH**/ ?>