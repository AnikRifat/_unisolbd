<?php
    function hasPermission($activeRoute, $permissionId, $hierarchicalData) {
    foreach ($hierarchicalData as $module => $moduleData) {
        foreach ($moduleData['menu'] as $menu => $menuData) {
            if ($menuData['route'] === $activeRoute) {
                // Check if the permission ID is in the permissions array
                return in_array($permissionId, $menuData['permissions']);
            }

            if (isset($menuData['submenu'])) {
                foreach ($menuData['submenu'] as $submenu => $submenuData) {
                    if ($submenuData['route'] === $activeRoute) {
                        // Check if the permission ID is in the permissions array
                        return in_array($permissionId, $submenuData['permissions']);
                    }
                }
            }
        }
    }

    return false;
}

// Example usage
$activeRoute = Route::current()->getName(); // Replace with your active route
$permissionId =2; // Replace with your permission ID

// Assuming $hierarchicalData contains your hierarchical menu data
$hierarchicalData = session('hierarchicalData'); // Your provided data structure;

$hasPermission = hasPermission($activeRoute, $permissionId, $hierarchicalData);


?>










<?php $__env->startSection('admin'); ?>


<?php if($hasPermission): ?>
<?php echo e("User has permission for the active route."); ?>

<?php else: ?>
<?php echo e("User does not have permission for the active route."); ?>

<?php endif; ?>


    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Slider List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Slider Image</th>
                                            <th>Title </th>
                                            <th>Discription</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><img src="<?php echo e(asset($item->slider_img)); ?>" alt=""
                                                        style="width:70px; height:40px"> </td>
                                                <td>
                                                    <?php if($item->title == null): ?>
                                                        <span class="badge badge-fills badge-danger">No Title</span>
                                                    <?php else: ?>
                                                        <?php echo e($item->title); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($item->description); ?></td>
                                                <td>
                                                    <?php if($item->status == 1): ?>
                                                        <span class="badge bade-fills badge-success">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge bade-fills badge-danger">Inactive</span>
                                                    <?php endif; ?>
                                                </td>
                                                
                                                <td class="d-flex justify-content-center ">
                                                    <a data-edit-slider="<?php echo e(base64_encode($item)); ?>"
                                                        class="btn btn-sm btn-info editSlider mr-10"
                                                        href="javascript:void(0)"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    <?php if($item->status == 1): ?>
                                                        <form method="POST"
                                                            action="<?php echo e(route('inactive.slider', $item->id)); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <button class="btn btn-sm btn-danger"
                                                                href="javascript:void(0)"><i
                                                                    class="fa fa-arrow-up"></i></button>
                                                           
                                                        </form>
                                                    <?php else: ?>
                                                        <form method="POST"
                                                            action="<?php echo e(route('active.slider', $item->id)); ?>">
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
                            <h3 class="box-title">Add Slider</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form id="sliderForm" method="POST" action="<?php echo e(route('slider.store')); ?>"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('POST'); ?>

                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Title</label>
                                        <input type="text" name="title" class="form-control form-control-sm">
                                    </div>

                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Description</label>
                                        <textarea type="text" name="description" class="form-control form-control-sm"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Slider Image<span
                                                class="text-danger">*</span></label>
                                        <input type="file" name="slider_img" id="slider_img" onchange="mainThamUrl(this)"
                                            class="form-control form-control-sm">
                                        <?php $__errorArgs = ['slider_img'];
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
            $('.editSlider').click(function() {
                var base64EncodedValue = $(this).data('edit-slider');
                var sliderData = JSON.parse(atob(base64EncodedValue));

                console.log(sliderData.id)
                $('#mainThmb').remove();
                $("input[name='title']").val(sliderData.title);
                $("textarea[name='description']").val(sliderData.description);
                var imgElement = $('<img>').attr({
                    'src': "/" + sliderData.slider_img,
                    'alt': '',
                    'id': 'mainThmb',
                    'height': '60px',
                    'width': '60px',

                });
                $('#slider_img').after(imgElement);
                $('#btnSave').remove();

                console.log(sliderData);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#sliderForm').attr('action',
                    "<?php echo e(route('slider.update', ['slider' => ':id'])); ?>"
                    .replace(
                        ':id', sliderData.id));

                // Change the method override field value to PUT
                $("input[name='_method']").val('PUT');

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();
            $('#mainThmb').remove();
            $("input[name='slider_img']").val('');

            $("input[name='title']").val('');
            $("textarea[name='description']").val('');

            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#sliderForm').attr('action', "<?php echo e(route('landing-page-slider.store')); ?>");

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
                    $('#slider_img').after(imgElement);
                    $('#slider_img').closest('.form-group').find('.errorMessage.text-danger').remove();
                    $('#slider_img').removeClass('danger');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/slider/slider.blade.php ENDPATH**/ ?>