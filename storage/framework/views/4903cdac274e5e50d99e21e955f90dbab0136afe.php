<?php $__env->startSection('admin'); ?>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">


                <div class="box">
                    <div class="d-flex justify-content-between">
                        <div class="box-header with-border">
                            <h3 class="box-title">User List</h3>
                        </div>
                        <div class="box-header with-border">
                            <a href="<?php echo e(route('user.create')); ?>" class="btn btn-sm btn-dark">Add User</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Company Name</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($user->id); ?></td>
                                            <td><?php echo e($user->name); ?></td>
                                            <td><?php echo e($user->phone); ?></td>
                                            <td><?php echo e($user->userDetails?->company_name); ?></td>
                                            <td><?php echo e($user->userDetails?->country); ?></td>
                                            <td><?php echo e($user->status); ?></td>
                                            <td><?php echo e($user->created_at); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('user.edit', $user->id)); ?>" class="btn btn-sm btn-info"><i class="fa-solid fa-pen"></i></a>
                                                <!-- Add more actions here if needed -->
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

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\unisolbd\resources\views/backend/user/view_user.blade.php ENDPATH**/ ?>