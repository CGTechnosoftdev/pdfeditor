<?php $__env->startSection('title',($title ?? '')); ?>
<?php $__env->startSection('heading',($heading ?? '')); ?>
<?php $__env->startSection('breadcrumb',($breadcrumb ?? '')); ?>
<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">
	<!-- Info boxes -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">			
				<div class="box-body">
					<!-- begin:: Content -->
					<?php echo $__env->make('admin.datatable.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<!-- end:: Content -->

				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>

	</div>
	<!-- /.row -->

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/pdf-writer/resources/views/admin/top100form/index.blade.php ENDPATH**/ ?>