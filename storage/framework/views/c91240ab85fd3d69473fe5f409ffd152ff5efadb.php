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
              <form method="POST" action="<?php echo e(route('customer-groups.update', $group->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="form-group">
                  <label class="info-title">Name<span class="text-danger">*</span></label>
                  <input type="text" name="name" value="<?php echo e(old('name', $group->name)); ?>" class="form-control">
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
                      <?php $__currentLoopData = json_decode($group->rules, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="input-group mb-2">
                          <input type="text" name="rules[key][]" class="form-control form-control-sm" value="<?php echo e($key); ?>" placeholder="Key">
                          <input type="text" name="rules[value][]" class="form-control form-control-sm" value="<?php echo e($value); ?>" placeholder="Value">
                          <div class="input-group-append">
                              <button type="button" class="btn btn-danger btn-remove-rule">-</button>
                          </div>
                      </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <button type="button" class="btn btn-success btn-add-rule">Add Rule</button>
                </div>

                <div class="form-group">
                  <label class="info-title">Status<span class="text-danger">*</span></label>
                  <input type="number" name="status" value="<?php echo e(old('status', $group->status)); ?>" class="form-control">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('.btn-add-rule').addEventListener('click', function () {
            var container = document.getElementById('rules-container');
            var row = document.createElement('div');
            row.classList.add('input-group', 'mb-2');
            row.innerHTML = `
                <input type="text" name="rules[key][]" class="form-control form-control-sm" placeholder="Key">
                <input type="text" name="rules[value][]" class="form-control form-control-sm" placeholder="Value">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger btn-remove-rule">-</button>
                </div>
            `;
            container.appendChild(row);
            row.querySelector('.btn-remove-rule').addEventListener('click', function () {
                container.removeChild(row);
            });
        });

        document.querySelectorAll('.btn-remove-rule').forEach(function (button) {
            button.addEventListener('click', function () {
                var row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/customer_groups/edit.blade.php ENDPATH**/ ?>