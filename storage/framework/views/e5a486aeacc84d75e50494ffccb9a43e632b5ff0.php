<?php $__env->startSection('admin'); ?>
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">

         <div class="col-12">
          <div class="box">
           <div class="box-header with-border">
             <h3 class="box-title">Edit Customer Group</h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="table-responsive">
              <form  method="POST" action="<?php echo e(route('customer-groups.update', $group->id)); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                  <label class="info-title">Name<span class="text-danger">*</span></label>
                  <input type="text"  name="name" value="<?php echo e($group->name); ?>" class="form-control" >
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

              <div class="form-group">
                <label class="info-title">Rules<span class="text-danger">*</span></label>
                <div id="rules-container">
                    <?php $__currentLoopData = $group->rules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="input-group mb-2">
                        <input type="text" name="rules[key][]" class="form-control form-control-sm" value="<?php echo e($key[0]); ?>" placeholder="Key">
                        <input type="text" name="rules[value][]" class="form-control form-control-sm" value="<?php echo e($value[0]); ?>" placeholder="Value">
                        
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              </div>

              <div class="form-group">
                <label class="info-title">Status<span class="text-danger">*</span></label>
                <input type="number"  name="status" value="<?php echo e($group->status); ?>" class="form-control" >
                <?php $__errorArgs = ['status'];
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

              <div class="form-group">
                <button type="submit" class="btn btn-rounded btn-primary">Update</button>
              </div>

              </form>

             </div>
           </div>
           <!-- /.box-body -->
           </div>
           <!-- /.box -->
         </div>

        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->

    </div>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\unisolbd\resources\views/backend/customer_groups/edit.blade.php ENDPATH**/ ?>