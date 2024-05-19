<?php
    $setting = App\Models\SiteSetting::limit(1)
        ->get()
        ->first();
?>

<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="author" content="">
    
    <link rel="icon" href="<?php echo e(asset($setting->logo)); ?>">

    <title><?php echo e($setting->company_name); ?> - Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Vendors Style-->
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/vendors_css.css')); ?>">

  
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
crossorigin="anonymous" referrerpolicy="no-referrer" />


	  
	<!-- Style-->  
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/style.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/skin_color.css')); ?>">
   <!-- notification cdn-->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
  
  </head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">

  <?php echo $__env->make('admin.body.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  
  <!-- Left side column. contains the logo and sidebar -->
  <?php echo $__env->make('admin.body.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <?php echo $__env->yieldContent('admin'); ?>
  </div>
  <!-- /.content-wrapper -->
 <?php echo $__env->make('admin.body.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
</div>
<!-- ./wrapper -->



	<!-- Vendor JS -->
	<script src="<?php echo e(asset('backend/js/vendors.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/icons/feather-icons/feather.min.js')); ?>"></script>	
	<script src="<?php echo e(asset('assets/vendor_components/easypiechart/dist/jquery.easypiechart.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/vendor_components/apexcharts-bundle/irregular-data-series.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor_components/datatable/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/js/pages/data-table.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor_components/moment/min/moment.min.js')); ?>"></script>
 
<script src="<?php echo e(asset('assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor_components/select2/dist/js/select2.full.js')); ?>"></script>

<script src="<?php echo e(asset('assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>


<script src="<?php echo e(asset('/backend/js/pages/advanced-form-element.js')); ?>"></script>



<script src="<?php echo e(asset('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')); ?>"></script>

<script src="<?php echo e(asset('backend/js/code.js')); ?>"></script>



<!-- Sunny Admin App -->
	<script src="<?php echo e(asset('backend/js/template.js')); ?>"></script>
	
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?php echo e(asset('backend/custom/helper.js')); ?>"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
  <?php if(Session::has('message')): ?>
  var type = "<?php echo e(Session::get('type','info')); ?>"
  switch(type){
     case 'info':
     toastr.info(" <?php echo e(Session::get('message')); ?> ");
     break;
     case 'success':
     toastr.success(" <?php echo e(Session::get('message')); ?> ");
     break;
     case 'warning':
     toastr.warning(" <?php echo e(Session::get('message')); ?> ");
     break;
     case 'error':
     toastr.error(" <?php echo e(Session::get('message')); ?> ");
     break; 
  }
  <?php endif; ?> 
  </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\unisolbd\resources\views/admin/admin_master.blade.php ENDPATH**/ ?>