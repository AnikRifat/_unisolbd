<?php $__env->startSection('admin'); ?>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Expense List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                         
                                            <th>Date</th>
                                            <th>Purpose</th>
                                            <th>Amount</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                              
                                                <td><?php echo e($item->date); ?></td>
                                                <td><?php echo e($item->purpose); ?></td>
                                                <td><?php echo e($item->amount); ?></td>
                                                <td>
                                                    <a data-edit="<?php echo e(base64_encode($item)); ?>" href="javascript:void(0)"
                                                        class="btn btn-sm btn-info btnEdit ml-20"><i
                                                            class="fa-solid fa-edit"></i></a>
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



                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Expense</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                           
                                <form id="expenseForm" method="POST" action="<?php echo e(route('expense.store')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('post'); ?>
    
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="info-title">Date of Expense<span class="text-danger">*</span></label>
                                                <input type="date" placeholder="date" name="date" class="form-control form-control-sm">
                                                <?php $__errorArgs = ['date'];
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
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="info-title">Purpose of Expense<span class="text-danger">*</span></label>
                                                <textarea name="purpose" id="purpose" class="form-control form-control-sm" rows="1"></textarea>
                                                <?php $__errorArgs = ['purpose'];
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
                                        
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="info-title">Amount<span class="text-danger">*</span></label>
                                                <input type="text" name="amount" class="form-control">
                                                <?php $__errorArgs = ['amount'];
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
                                        
                                        
                                        
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="info-title">Receipt</label>
                                                <input type="file" name="receipt" class="form-control">
                                               
                                            </div>
                                        </div>
                                       
                                        <div class="col-12 mt-3">
                                            <div class="form-group">
                                                <button id="btnSave" type="submit" class="btn  btn-sm btn-success">Save</button>
                                                <a id="btnClear" class="btn  btn-sm btn-primary">Clear</a>
                                            </div>
        
                                        </div>
                                    </div>
    
                                </form>

                            
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

                $("input[name='date']").val(editData.date);
                $("input[name='amount']").val(editData.amount);
                $("textarea[name='purpose']").val(editData.purpose);
                $("input[name='receipt']").val(editData.symbol);

                $('#btnSave').remove();

                console.log(editData);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#expenseForm').attr('action', "<?php echo e(route('expense.update', ['expense' => ':id'])); ?>"
                    .replace(
                        ':id', editData.id));

                // Change the method override field value to PUT
                $("input[name='_method']").val('PUT');

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();

            $("input[name='date']").val('');
            $("input[name='amount']").val('');
            $("textarea[name='purpose']").val('');
            $("input[name='receipt']").val('');


            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#expenseForm').attr('action', "<?php echo e(route('expense.store')); ?>");

            // Change the method override field value to PUT
            $("input[name='_method']").val('POST');

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/expense/expense.blade.php ENDPATH**/ ?>