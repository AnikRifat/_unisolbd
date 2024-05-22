<?php $__env->startSection('admin'); ?>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Currency List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Country</th>
                                            <th>Code</th>
                                            <th>Symbol</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($item->country); ?></td>
                                                <td><?php echo e($item->code); ?></td>
                                                <td><?php echo e($item->symbol); ?></td>
                                                <td>
                                                    <?php if($item->status != null): ?>
                                                        <span class="bedge bg-success rounded px-2 py-1">active</span>
                                                    <?php else: ?>
                                                        <span class="bedge bg-danger rounded px-2 py-1">inactive</span>
                                                    <?php endif; ?>
                                                </td>

                                                <?php if($item->status == 0): ?>
                                                    <td class="d-flex justify-content-center">
                                                        <a data-edit="<?php echo e(base64_encode($item)); ?>" href="javascript:void(0)"
                                                            class="btn btn-sm btn-info btnEdit mr-10"><i
                                                                class="fa-solid fa-edit"></i></a>
                                                        



                                                        <form method="POST"
                                                            action="<?php echo e(route('active.currency', $item->id)); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <button class="btn btn-sm btn-danger"
                                                                href="javascript:void(0)"><i
                                                                    class="fa fa-arrow-up"></i></button>
                                                        </form>
                                                    </td>
                                                <?php else: ?>
                                                    <td>
                                                        <a data-edit="<?php echo e(base64_encode($item)); ?>" href="javascript:void(0)"
                                                            class="btn btn-sm btn-info btnEdit ml-20"><i
                                                                class="fa-solid fa-edit"></i></a>
                                                    </td>
                                                <?php endif; ?>

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



                <div class="col-md-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Currency</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form id="currencyForm" method="POST" action="<?php echo e(route('currency.store')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('post'); ?>
                                    <div class="form-group">
                                        <label class="info-title" for="country">Country<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="country" class="form-control form-control-sm">
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

                                    <div class="form-group">
                                        <label class="info-title" for="currency">Currency<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="currency" class="form-control form-control-sm">
                                        <?php $__errorArgs = ['currency'];
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
                                        <label class="info-title" for="code">Code<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="code" class="form-control form-control-sm">
                                        <?php $__errorArgs = ['code'];
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
                                        <label class="info-title" for="symbol">Symbol<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="symbol" class="form-control form-control-sm">
                                        <?php $__errorArgs = ['symbol'];
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
                                        <button id="btnSave" type="submit" class="btn  btn-sm btn-success">Save</button>
                                        <a id="btnClear" class="btn  btn-sm btn-primary">Clear</a>
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
        $(document).ready(function() {
            $('.btnEdit').click(function() {
                var base64EncodedValue = $(this).data('edit');
                var editData = JSON.parse(atob(base64EncodedValue));

                console.log(editData.id)

                $("input[name='country']").val(editData.country);
                $("input[name='currency']").val(editData.currency);
                $("input[name='code']").val(editData.code);
                $("input[name='symbol']").val(editData.symbol);

                $('#btnSave').remove();

                console.log(editData);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#currencyForm').attr('action', "<?php echo e(route('currency.update', ['currency' => ':id'])); ?>"
                    .replace(
                        ':id', editData.id));

                // Change the method override field value to PUT
                $("input[name='_method']").val('PUT');

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();

            $("input[name='country']").val('');
            $("input[name='currency']").val('');
            $("input[name='code']").val('');
            $("input[name='symbol']").val('');


            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#currencyForm').attr('action', "<?php echo e(route('currency.store')); ?>");

            // Change the method override field value to PUT
            $("input[name='_method']").val('POST');

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/currency/currency.blade.php ENDPATH**/ ?>