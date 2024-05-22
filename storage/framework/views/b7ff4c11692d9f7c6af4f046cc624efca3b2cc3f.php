<?php $__env->startSection('admin'); ?>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">District List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Division Name</th>
                                            <th>District Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($district['division']['name']); ?></td>
                                                <td><?php echo e($district->name); ?></td>
                                                <td class="w-20 text-center">
                                                    <a data-district="<?php echo e($district); ?>" class="editDistrict">
                                                        <i class="fa-solid fa-edit text-primary m-2"></i>
                                                    </a>
                                                    <a id="deleteButton" data-district="<?php echo e($district->id); ?>">
                                                        <i class="fa-sharp fa-solid fa-trash text-danger"></i>
                                                    </a>
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



                <div class="col-lg-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add District</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form id="districtForm" method="POST" action="<?php echo e(route('district.store')); ?>">
                                    <?php echo csrf_field(); ?>

                                    <div class="form-group">
                                        <label>Select Division <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <select name="division_id" class="form-control select2">
                                                <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($division->id); ?>"><?php echo e($division->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['division_id'];
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





                                    <div class="form-group">
                                        <label class="info-title">District Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control form-control-sm"
                                            value="<?php echo e(old('name')); ?>">
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


                                    <div class="form-group" id="actionDiv">
                                        <button type="submit" id="btnSave" class="btn btn-sm btn-success">Save</button>
                                        <a href="javascript:void(0)" id="btnClear" class="btn btn-sm btn-primary">Clear</a>
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
            $('.editDistrict').click(function() {
                var districtData = $(this).data('district');
                $("input[name='name']").val(districtData.name);
                $("select[name='division_id']").val(districtData.division_id).change()
                $('#btnSave').remove();

                console.log(districtData);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#districtForm').attr('action', "<?php echo e(route('district.update', ['id' => ':id'])); ?>"
                    .replace(
                        ':id', districtData.id));
            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();
            $("input[name='name']").val("");



            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#districtForm').attr('action', "<?php echo e(route('district.store')); ?>");

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#deleteButton').click(function() {
                var districtId = $(this).data('district');

                // Display a confirmation alert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If user confirms, redirect to the delete route
                        window.location.href = "<?php echo e(route('district.delete', ['id' => ':id'])); ?>"
                            .replace(':id', districtId);
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/ship/district/view_district.blade.php ENDPATH**/ ?>