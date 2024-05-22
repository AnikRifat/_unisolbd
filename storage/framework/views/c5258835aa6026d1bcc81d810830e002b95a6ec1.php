<?php $__env->startSection('admin'); ?>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">
                    <!-- Customer Group List -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Customer Group List</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Rules</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $customerGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($group->name); ?></td>
                                                <td>
                                                    <ul>
                                                        <?php $__currentLoopData = json_decode($group->rules, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li><?php echo e($key); ?>: <?php echo e($value); ?></li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </td>
                                                <td><?php echo e($group->status); ?></td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="<?php echo e(route('customer-groups.assign', $group->id)); ?>"
                                                        class="btn btn-sm btn-info mr-1">assign</a>
                                                    <a href="<?php echo e(route('customer-groups.edit', $group->id)); ?>"
                                                        class="btn btn-sm btn-info mr-1"><i class="fa-solid fa-edit"></i></a>
                                                    <form action="<?php echo e(route('customer-groups.destroy', $group->id)); ?>"
                                                        method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-sm btn-danger mr-1"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <!-- Add Customer Group Form -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Customer Group</h3>
                        </div>
                        <div class="box-body">
                            <form id="groupForm" method="POST" action="<?php echo e(route('customer-groups.store')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label class="info-title">Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control form-control-sm">
                                </div>
                                <div class="form-group" id="rules-container">
                                    <label class="info-title">Rules<span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="rules[key][]" class="form-control form-control-sm" placeholder="Key">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="rules[value][]" class="form-control form-control-sm" placeholder="Value">
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-success btn-add-rule">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="info-title">Status<span class="text-danger">*</span></label>
                                    <input type="number" name="status" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-success">Save</button>
                                    <button type="reset" class="btn btn-sm btn-primary">Clear</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JavaScript for dynamic rule inputs -->
    <script>
        $(document).ready(function () {
            // Add new rule input field
            $(document).on('click', '.btn-add-rule', function () {
                var ruleInput = `<div class="row mt-2">
                                    <div class="col">
                                        <input type="text" name="rules[key][]" class="form-control form-control-sm" placeholder="Key">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="rules[value][]" class="form-control form-control-sm" placeholder="Value">
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-danger btn-remove-rule">-</button>
                                    </div>
                                </div>`;
                $('#rules-container').append(ruleInput);
            });

            // Remove rule input field
            $(document).on('click', '.btn-remove-rule', function () {
                $(this).closest('.row').remove();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/customer_groups/index.blade.php ENDPATH**/ ?>