<?php $__env->startSection('admin'); ?>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Product List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>

                                            <th>Image</th>
                                            <th>Product Name</th>

                                            <th>Discount</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $Products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <img src="<?php echo e(asset($item->product_thambnail)); ?>" alt=""
                                                        style="width: 60px; height:50px;">
                                                </td>
                                                <td><?php echo e($item->product_name); ?></td>

                                                <td>
                                                    <?php if($item->discount_price == null): ?>
                                                        <span class="bedge badge-fills bedge-danger">No Discount</span>
                                                    <?php else: ?>
                                                        <?php
                                                            $amount = $item->selling_price - $item->discount_price;
                                                            $discount = ($amount / $item->selling_price) * 100;
                                                        ?>
                                                        <span
                                                            class="badge badge-fills badge-danger"><?php echo e(round($discount)); ?>%</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($item->status == 1): ?>
                                                        <span class="badge badge-fills badge-success"> Active </span>
                                                    <?php else: ?>
                                                        <span class="badge badge-fills badge-danger"> Inactive </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="d-flex justify-content-center ">
                                                  <a href="<?php echo e(route('product.edit',$item->id)); ?>"  data-toggle="tooltip" 
                                                      title="Edit Product"
                                                      class="btn btn-sm btn-info btnEdit mr-10"><i
                                                          class="fa-solid fa-pen-to-square"></i></a>

                                                  <?php if($item->status == 1): ?>
                                                      <form method="POST"
                                                          action="<?php echo e(route('inactive.product', $item->id)); ?>">
                                                          <?php echo csrf_field(); ?>

                                                          <button data-toggle="tooltip" title="Inactive Specification"
                                                              class="btn btn-sm btn-danger mr-10"
                                                              href="javascript:void(0)"><i
                                                                  class="fa fa-arrow-up"></i></button>
                                                      </form>
                                                  <?php else: ?>
                                                      <form method="POST"
                                                          action="<?php echo e(route('active.product', $item->id)); ?>">
                                                          <?php echo csrf_field(); ?>
                                                          <button data-toggle="tooltip" title="Active Specification"
                                                              class="btn btn-sm btn-success mr-10"
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

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>



 


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/product/product_view.blade.php ENDPATH**/ ?>