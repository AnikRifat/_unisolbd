<?php $__env->startSection('admin'); ?>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Customer Group List</h3>
                        </div>
                        <!-- /.box-header -->
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
                                                    <?php $__currentLoopData = $group->rules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="badge badge-primary"><?php echo e($key[0]); ?>: <?php echo e($value[0]); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>
                                                <td><?php echo e($group->status); ?></td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="<?php echo e(route('customer-groups.edit', $group->id)); ?>"
                                                        class="btn btn-sm btn-info mr-1"><i
                                                            class="fa-solid fa-edit"></i></a>
                                                    <form action="<?php echo e(route('customer-groups.destroy', $group->id)); ?>"
                                                        method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger mr-1"><i
                                                                class="fa-sharp fa-solid fa-trash"></i></button>
                                                    </form>
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


            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Customer Group</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
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
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

    <script>
        $(document).ready(function() {
            $('.btnEdit').click(function() {
                var base64EncodedValue = $(this).data('edit');
                var editData = JSON.parse(atob(base64EncodedValue));

                console.log(editData.id)

                $("input[name='coupon_name']").val(editData.coupon_name);
                $("input[name='coupon_discount']").val(editData.coupon_discount);
                $("input[name='coupon_validity']").val(editData.coupon_validity);

                $('#btnSave').remove();

                console.log(editData);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#couponForm').attr('action', "<?php echo e(route('coupon.update', ['coupon' => ':id'])); ?>"
                    .replace(
                        ':id', editData.id));

                // Change the method override field value to PUT
                $("input[name='_method']").val('PUT');

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();
            $("input[name='coupon_name']").val('');
            $("input[name='coupon_discount']").val('');
            $("input[name='coupon_validity']").val('');

            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#couponForm').attr('action', "<?php echo e(route('coupon.store')); ?>");

            // Change the method override field value to PUT
            $("input[name='_method']").val('POST');

        });
    </script>

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

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\unisolbd\resources\views/backend/customer_groups/index.blade.php ENDPATH**/ ?>