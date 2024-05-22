<?php $__env->startSection('admin'); ?>
    <div class="container-full">

        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Seo Setting Page </h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="<?php echo e(route('seo-setting.update', $seo->id)); ?>">
                                <?php echo csrf_field(); ?>
								<?php echo method_field('put'); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Meta Title <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="meta_title" class="form-control"
                                                    value="<?php echo e($seo->meta_title); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>Meta Author <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="meta_author" class="form-control"
                                                    value="<?php echo e($seo->meta_author); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>Meta Keyword <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="meta_keyword" class="form-control"
                                                    value="<?php echo e($seo->meta_keyword); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>Meta Description <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea name="meta_description" id="meta_description" class="form-control form-control-sm"><?php echo e($seo->meta_description); ?></textarea>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <h5>Google Analytics <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea name="google_analytics" id="google_analytics" class="form-control form-control-sm"><?php echo e($seo->google_analytics); ?></textarea>
                                            </div>
                                        </div>

										<button type="submit" class="btn btn-sm btn-success mt-2">Submit</button>

                                    </div>
									
                                    
                                </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->

				<div class="box">
					<div class="box-body ml-15">
						<div class="row">
							<div class="form-group">
								<label class="font-weight-bold">Meta Title</label>
								<div class="controls">
									<p><?php echo e($seo->meta_title); ?></p>
	
								</div>
							</div>
						</div>
	
						<div class="row">
							<div class="form-group">
								<label class="font-weight-bold">Meta Author</label>
								<div class="controls">
									<p><?php echo e($seo->meta_author); ?></p>
								</div>
							</div>
						</div>
	
						<div class="row">
							<div class="form-group">
								<label class="font-weight-bold">Meta Keyword</label>
								<div class="controls">
									<p><?php echo e($seo->meta_keyword); ?></p>
								</div>
							</div>
						</div>
	
						<div class="row">
							<div class="form-group">
								<label class="font-weight-bold">Meta Description</label>
								<div class="controls">
									<p><?php echo e($seo->meta_description); ?></p>
								</div>
							</div>
						</div>
	
						<div class="row">
							<div class="form-group">
								<label class="font-weight-bold">Google Analytics</label>
								<div class="controls">
									<p><?php echo e($seo->google_analytics); ?></p>
								</div>
							</div>
						</div>

					</div>
				</div>
            </div>
            <!-- /.box -->
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/setting/seo.blade.php ENDPATH**/ ?>