 

<?php $__env->startSection('admin'); ?> 

<div class="container-full">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-primary-light rounded w-60 h-60">
                            <i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Today's Sales</p>
                            <h3 class="text-white mb-0 font-weight-500"><small class="text-success"><i class="fa fa-caret-up"></i>Usd</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-warning-light rounded w-60 h-60">
                            <i class="text-warning mr-0 font-size-24 mdi mdi-car"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Monthly Sales</p>
                            <h3 class="text-white mb-0 font-weight-500"><small class="text-success"><i class="fa fa-caret-up"></i> Usd</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-info-light rounded w-60 h-60">
                            <i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Yearly Sales</p>
                            <h3 class="text-white mb-0 font-weight-500"><small class="text-danger"><i class="fa fa-caret-down"></i> Usd</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            
            


            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-light rounded w-60 h-60">
                            <i class="text-white mr-0 font-size-24 mdi mdi-chart-line"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Pending Orders</p>
                            <h3 class="text-white mb-0 font-weight-500"><small class="text-success"><i class="fa fa-caret-up"></i> Orders</small></h3>
                        </div>
                    </div>
                </div>
            </div>
      

            
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title align-items-start flex-column">
                            Recent All Orders
                            <small class="subtitle"></small>
                        </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <thead>
                      <tr class="text-uppercase bg-lightest">
                                        <th style="min-width: 250px"><span class="text-white">Date</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">Invoice</span></th>
                                        
                                        <th style="min-width: 120px"></th>
                                    </tr>
                                </thead>
                                <tbody>

 <tr>										
    <td>
        <span class="text-fade font-weight-600 d-block font-size-16">
         
        </span>
    </td>
    <td>
        <span class="text-fade font-weight-600 d-block font-size-16">
           
        </span>
        
    </td>
   
    
    
    <td class="text-right">
        <a href="#" class="waves-effect waves-light btn btn-info btn-circle mx-5"><span class="mdi mdi-bookmark-plus"></span></a>
        <a href="#" class="waves-effect waves-light btn btn-info btn-circle mx-5"><span class="mdi mdi-arrow-right"></span></a>
    </td>
</tr>

                                                  
                                  
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\unisolbd\resources\views/admin/index.blade.php ENDPATH**/ ?>