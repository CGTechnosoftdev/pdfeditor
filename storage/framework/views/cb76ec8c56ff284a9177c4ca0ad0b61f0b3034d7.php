<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo e(config('app.name', 'Laravel')); ?> | <?php echo $__env->yieldContent('title'); ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php echo $__env->make('admin.partials.commoncss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
	<?php echo $__env->yieldContent('additionalcss'); ?>
	<script type="text/javascript">
		var base_url = "<?php echo e(url('')); ?>";
		var admin_url = '<?php echo url("/admin"); ?>';
		var csrf_token = "<?php echo e(csrf_token()); ?>";
		var blankOption = "<option value=''><?php echo e(lang_trans('label.select')); ?></option>";
	</script>
</head>
<body class="hold-transition skin-green-light sidebar-mini">
	<div class="wrapper">
		<?php echo $__env->make('admin.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
		<!-- Left side column. contains the logo and sidebar -->
		<?php echo $__env->make('admin.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<!-- <section class="content-header">
				<h1>
					<?php echo $__env->yieldContent('heading'); ?>
					<small><?php echo $__env->yieldContent('sub_heading'); ?></small>
				</h1>
				<?php echo $__env->yieldContent('breadcrumb'); ?>
			</section> -->
			<section class="content-header">
				<div class="head-title">
					<h1 class="pull-left"><?php echo $__env->yieldContent('heading'); ?></h1>
					<?php echo $__env->make('admin.partials.add-new-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
			</section>
			<!-- Main content -->
			<section class="content">
				<?php echo $__env->make('admin.partials.flash-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<!-- Content Wrapper. Contains page content -->
				<?php echo $__env->yieldContent('content'); ?>
				<!-- /.content-wrapper -->
			</section>
		</div>
		<?php echo $__env->make('admin.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	

	</div>
	<!-- ./wrapper -->
	<?php echo $__env->make('admin.partials.commonjs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
	<?php echo $__env->yieldContent('additionaljs'); ?>
	
</body>
</html>

<?php /**PATH /var/www/html/pdf-writer/resources/views/layouts/admin.blade.php ENDPATH**/ ?>