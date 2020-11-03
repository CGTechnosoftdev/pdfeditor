<?php $__env->startSection('title',($title ?? '')); ?>
<?php $__env->startSection('heading',($heading ?? '')); ?>
<?php $__env->startSection('breadcrumb',($breadcrumb ?? '')); ?>
<?php $__env->startSection('content'); ?>
<section class="content">

	<!-- Info boxes -->
<div class="box">
	<div class="box-body">
		<div class="row">
		  <div class="col-xs-12 col-lg-6 col-md-9">
				<?php if(isset($top100Form)): ?>
				<?php echo e(Form::model($top100Form,['route' => ['top-100-form.update',$top100Form->id],'class'=>'form-horizontal','method'=>'put','enctype'=>"multipart/form-data"])); ?>

				<?php else: ?>
				<?php echo e(Form::open(['route' => 'top-100-form.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"])); ?>

				<?php endif; ?>
				<?php echo Form::token(); ?>


				<div class="form-group <?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
					<label for="name" class="control-label text-left col-sm-4 required">Name<span class="required-label">*</span></label>	
					<div class="col-sm-8">
						<?php echo e(Form::text('name',null,array('placeholder'=>'Enter  Name','class'=>"form-control","id" => "name","onKeyup" => "createSlug('#name','#slug')"))); ?>

						<?php if($errors->has('name')): ?>
						<span class="help-block"><strong><?php echo e($errors->first('name')); ?></strong></span>
						<?php endif; ?>
					</div>
				</div>
				<div class="form-group <?php echo e($errors->has('slug') ? ' has-error' : ''); ?>">
					<label for="slug" class="control-label text-left col-sm-4 required">Slug<span class="required-label">*</span></label>
					<div class="col-sm-8" >
						<?php echo e(Form::text('slug',null,array('placeholder'=>'Enter Slug','id' => 'slug','class'=>"form-control"))); ?>

						<?php if($errors->has('slug')): ?>
						<span class="help-block"><strong><?php echo e($errors->first('slug')); ?></strong></span>
						<?php endif; ?>
					</div>
				</div>
				<div class="form-group <?php echo e($errors->has('relevent_keywords') ? ' has-error' : ''); ?>">
					<label for="relevent_keywords" class="control-label text-left col-sm-4 required">Relevent Keywords<span class="required-label">*</span></label>
					<div class="col-sm-8" >
						<?php echo e(Form::text('relevent_keywords',null,array('placeholder'=>'Enter Relevent Keywords','class'=>"form-control"))); ?>

						<?php if($errors->has('relevent_keywords')): ?>
						<span class="help-block"><strong><?php echo e($errors->first('relevent_keywords')); ?></strong></span>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group <?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
					<label for="description" class="control-label text-left col-sm-4 required">Description</label>
					<div class="col-sm-8" >
						<?php echo e(Form::textarea('description',old('description'),['placeholder'=>'Enter Description','class'=>"form-control ckeditor"])); ?>

						<?php if($errors->has('description')): ?>
						<span class="help-block"><strong><?php echo e($errors->first('description')); ?></strong></span>
						<?php endif; ?>
					</div>
				</div>

				
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<?php echo Form::submit((isset($top100Form)) ? 'Update' : 'Save',['class'=>'btn btn-success']); ?>

						<?php echo Html::link(route('top-100-form.index'),'Cancel',['class'=>'btn btn-default']); ?>

					</div>
				</div>
				<?php echo e(Form::close()); ?>


			</div>
			<div class="col-xs-4 col-md-4">			
			
			</div>
			<!-- /.row -->
		</div>
	</div>
	</div>	

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('additionaljs'); ?>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<?php echo JsValidator::formRequest('App\Http\Requests\Top100formFormRequest'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/pdf-writer/resources/views/admin/top100form/form.blade.php ENDPATH**/ ?>