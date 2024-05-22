<?php $__env->startSection('admin'); ?>
    <style>
        .form-control.danger {
            border: 1px solid red;
        }

        #mainThmb {
            margin: 10px 0px;
            width: 60px;
            height: 60px;
        }

        .icon {
            height: 40px;
            width: 40px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Role List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th class="text-center">status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($item->name); ?></td>

                                                <td class="text-center">
                                                    <?php if($item->status == 1): ?>
                                                        <span class="badge bade-fills badge-success">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge bade-fills badge-danger">Inactive</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="d-flex justify-content-center ">
                                                    <a data-edit-role="<?php echo e(base64_encode($item)); ?>" data-toggle="tooltip" title="edit role"
                                                        class="btn btn-sm btn-info editRole mr-10" href="javascript:void(0)"
                                                        ><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <?php if($item->status == 1): ?>
                                                    <form method="POST" action="<?php echo e(route('inactive.role',$item->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        
                                                            <button data-toggle="tooltip" title="Inactive Status" class="btn btn-sm btn-danger mr-10" href="javascript:void(0)"><i
                                                                class="fa fa-arrow-up"></i></button>
                                                    </form>
                                                    <?php else: ?>
                                                    <form method="POST" action="<?php echo e(route('active.role',$item->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <button data-toggle="tooltip" title="Active Status" class="btn btn-sm btn-success mr-10" href="javascript:void(0)"><i
                                                            class="fa fa-arrow-down"></i></button>
                                                    </form>          
                                                    <?php endif; ?>

                                                    <form method="POST" action="<?php echo e(route('role-permission.update',$item->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <button class="btn btn-sm btn-primary" data-toggle="tooltip" title="assign permission"><i class="fa-solid fa-shield"></i></button>
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



                <div class="col-lg-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Role</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form id="roleForm" method="POST" action="<?php echo e(route('role.store')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>


                                <div class="form-group">
                                    <label class="info-title">Name<span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name"
                                        class="form-control form-control-sm">
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
                                    <button id="btnSave" type="submit" class="btn  btn-sm btn-success">Save</button>
                                    <a id="btnClear"  class="btn  btn-sm btn-primary">Clear</a>
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
            $('.editRole').click(function() {
                var base64EncodedValue = $(this).data('edit-role');
                var roleData = JSON.parse(atob(base64EncodedValue));

                console.log(roleData.id)

                $("input[name='name']").val(roleData.name);
               

                $('#btnSave').remove();

                console.log(roleData);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#roleForm').attr('action', "<?php echo e(route('role.update', ['role' => ':id'])); ?>"
                    .replace(
                        ':id', roleData.id));

                // Change the method override field value to PUT
                $("#roleForm input[name='_method']").val('PUT');

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();

            $("input[name='name']").val('');
    
            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#roleForm').attr('action', "<?php echo e(route('role.store')); ?>");

            // Change the method override field value to PUT
            $("#roleForm input[name='_method']").val('POST');

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/administration/role.blade.php ENDPATH**/ ?>