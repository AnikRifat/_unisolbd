<?php $__env->startSection('admin'); ?>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">


                <div class="box">
                    <div class="d-flex justify-content-between">
                        <div class="box-header with-border">
                            <h3 class="box-title">Vendor List</h3>
                        </div>
                        <div class="box-header with-border">
                            <a href="<?php echo e(route('vendor.create')); ?>" class="btn btn-sm btn-dark">Add Vendor</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($vendor->type==1?"supplier":"customer"); ?></td>
                                                <td><?php echo e($vendor->name); ?></td>
                                                <td><?php echo e($vendor->address); ?></td>
                                                <td><?php echo e($vendor->phone); ?></td>
                                                <td class="text-center">
                                                    <a href="<?php echo e(route('vendor.edit', $vendor->id)); ?>"
                                                        class="btn btn-sm btn-info"><i class="fa-solid fa-pen"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/vendor/view_vendor.blade.php ENDPATH**/ ?>