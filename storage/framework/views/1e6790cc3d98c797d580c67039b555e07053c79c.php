<?php $__env->startSection('admin'); ?>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Brands List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Brand</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($item->brand_name); ?></td>
                                                <td><img src="<?php echo e(asset($item->brand_image)); ?>"
                                                        style="width:70px; height:40px"></td>

                                                <td>
                                                    <?php if($item->status == 1): ?>
                                                        <span class="badge bade-fills badge-success">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge bade-fills badge-danger">Inactive</span>
                                                    <?php endif; ?>
                                                </td>

                                                <td class="d-flex justify-content-center">
                                                    <a data-edit-brand="<?php echo e(base64_encode($item)); ?>"
                                                        href="javascript:void(0)"
                                                        class="btn btn-sm btn-info editBrand mr-10"><i
                                                            class="fa-solid fa-edit"></i></a>
                                                    


                                                    <?php if($item->status == 1): ?>
                                                        <form method="POST"
                                                            action="<?php echo e(route('inactive.brand', $item->id)); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            

                                                                    <button class="btn btn-sm btn-danger"
                                                                    href="javascript:void(0)"><i
                                                                        class="fa fa-arrow-up"></i></button>
                                                        </form>
                                                    <?php else: ?>
                                                        <form method="POST"
                                                            action="<?php echo e(route('active.brand', $item->id)); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <button class="btn btn-sm btn-success"
                                                            href="javascript:void(0)"><i
                                                                class="fa fa-arrow-down"></i></button>
                                                        </form>
                                                    <?php endif; ?>
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
                            <h3 class="box-title">Add Brand</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <form id="brandForm" method="POST" action="<?php echo e(route('brand.store')); ?>"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('post'); ?>
                                <div class="form-group">
                                    <label class="info-title" for="brand_name">Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="brand_name" class="form-control form-control-sm">
                                    <?php $__errorArgs = ['brand_name'];
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
                                    <label class="info-title" for="brand_image">Image<span
                                            class="text-danger">*</span></label>
                                    <input type="file" id="brand_image" name="brand_image"
                                        class="form-control form-control-sm" onchange="mainThamUrl(this)">
                                    <?php $__errorArgs = ['brand_image'];
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
            $('.editBrand').click(function() {
                var base64EncodedValue = $(this).data('edit-brand');
                var data = JSON.parse(atob(base64EncodedValue));

                console.log(data.id)
                $('#mainThmb').remove();
                $("input[name='brand_name']").val(data.brand_name);
                var imgElement = $('<img>').attr({
                    'src': "/" + data.brand_image,
                    'alt': '',
                    'id': 'mainThmb',
                    'height': '60px',
                    'width': '60px',

                });
                $('#brand_image').after(imgElement);
                $('#btnSave').remove();

                console.log(data);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#brandForm').attr('action',
                    "<?php echo e(route('brand.update', ['brand' => ':id'])); ?>"
                    .replace(
                        ':id', data.id));

                // Change the method override field value to PUT
                $("input[name='_method']").val('PUT');

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();
            $('#mainThmb').remove();
            $("input[name='brand_image']").val('');

            $("input[name='brand_name']").val('');

            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#brandForm').attr('action', "<?php echo e(route('brand.store')); ?>");

            // Change the method override field value to PUT
            $("input[name='_method']").val('POST');

        });
    </script>


    <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                $('#mainThmb').remove();
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgElement = $('<img>').attr({
                        'src': e.target.result,
                        'alt': '',
                        'id': 'mainThmb',
                        'height': '60px',
                        'width': '60px',

                    });
                    $('#brand_image').after(imgElement);
                    $('#brand_image').closest('.form-group').find('.errorMessage.text-danger').remove();
                    $('#brand_image').removeClass('danger');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/brand/brand.blade.php ENDPATH**/ ?>