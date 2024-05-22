<?php $__env->startSection('admin'); ?>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="box-header with-border">
                    <h3 class="box-title">User Edit</h3>
                </div>
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                       <form method="POST" action="<?php echo e(route('customer.update', $user->id)); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('put'); ?>
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Name<span class="text-danger">*</span></label>
                <input type="text" value="<?php echo e(old('name', $user->name)); ?>" placeholder="Name" name="name" class="form-control form-control-sm">
                <?php $__errorArgs = ['name'];
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
        <!-- User Details Fields -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Company Name</label>
                <input type="text" value="<?php echo e(old('company_name', $user->userDetails?->company_name)); ?>" placeholder="Company Name" name="company_name" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Trade License Number</label>
                <input type="text" value="<?php echo e(old('trade_license_number', $user->userDetails?->trade_license_number)); ?>" placeholder="Trade License Number" name="trade_license_number" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">NID Number</label>
                <input type="text" value="<?php echo e(old('nid_no', $user->userDetails?->nid_no)); ?>" placeholder="NID Number" name="nid_no" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Passport Number</label>
                <input type="text" value="<?php echo e(old('passport_number', $user->userDetails?->passport_number)); ?>" placeholder="Passport Number" name="passport_number" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">BIN Number</label>
                <input type="text" value="<?php echo e(old('bin_num', $user->userDetails?->bin_num)); ?>" placeholder="BIN Number" name="bin_num" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">TIN Number</label>
                <input type="text" value="<?php echo e(old('tin_num', $user->userDetails?->tin_num)); ?>" placeholder="TIN Number" name="tin_num" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Address<span class="text-danger">*</span></label>
                <textarea name="address" id="address" class="form-control form-control-sm" rows="1"><?php echo e(old('address', $user->userDetails?->address)); ?></textarea>
                <?php $__errorArgs = ['address'];
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
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">City<span class="text-danger">*</span></label>
                <input type="text" value="<?php echo e(old('city', $user->userDetails?->city)); ?>" placeholder="City" name="city" class="form-control form-control-sm">
                <?php $__errorArgs = ['city'];
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
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Post Code<span class="text-danger">*</span></label>
                <input type="text" value="<?php echo e(old('post_code', $user->userDetails?->post_code)); ?>" placeholder="Post Code" name="post_code" class="form-control form-control-sm">
                <?php $__errorArgs = ['post_code'];
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
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Country<span class="text-danger">*</span></label>
                <input type="text" value="<?php echo e(old('country', $user->userDetails?->country)); ?>" placeholder="Country" name="country" class="form-control form-control-sm">
                <?php $__errorArgs = ['country'];
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
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Phone<span class="text-danger">*</span></label>
                <input type="text" value="<?php echo e(old('phone', $user->phone)); ?>" placeholder="Phone" name="phone" class="form-control form-control-sm">
                <?php $__errorArgs = ['phone'];
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
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">Email<span class="text-danger">*</span></label>
                <input type="email" value="<?php echo e(old('email', $user->email)); ?>" placeholder="Email" name="email" class="form-control form-control-sm">
                <?php $__errorArgs = ['email'];
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
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">NID Front Picture<span class="text-danger">*</span></label>
                <input type="file" name="nid_front" class="form-control">
                <?php $__errorArgs = ['nid_front'];
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
        <div class="col-md-6">
            <div class="form-group">
                <label class="info-title">NID Back Picture<span class="text-danger">*</span></label>
                <input type="file" name="nid_back" class="form-control">
                <?php $__errorArgs = ['nid_back'];
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
        <div class="col-md-6 mt-4">
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-success">Submit</button>
            </div>
        </div>
    </div>

</form>


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

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/user/edit_user.blade.php ENDPATH**/ ?>