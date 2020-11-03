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
				<?php if(isset($form)): ?>
				<?php echo e(Form::model($form,['route' => ['top100form.faq.update',$form->id],'class'=>'form-horizontal','method'=>'put','enctype'=>"multipart/form-data"])); ?>

				<?php echo e(Form::hidden('id',$form->id,array())); ?>

				<?php else: ?>
				<?php echo e(Form::open(['route' => 'top100form.faq.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"])); ?>

				<?php endif; ?>
				<?php echo Form::token(); ?>

			
				<?php echo e(Form::hidden('type_id',$frm_id,array())); ?>

				<?php echo e(Form::hidden('faq_type',$top_100_form,array())); ?>

				
				
			

				<div class="form-group <?php echo e($errors->has('question') ? ' has-error' : ''); ?>">
					<label for="question" class="control-label text-left col-sm-4 required">Question<span class="required-label">*</span></label>	
					<div class="col-sm-8">
						<?php echo e(Form::text('question',null,array('placeholder'=>'Enter Question','class'=>"form-control"))); ?>

						<?php if($errors->has('question')): ?>
						<span class="help-block"><strong><?php echo e($errors->first('question')); ?></strong></span>
						<?php endif; ?>
					</div>
				</div>
			
				
				<div class="form-group <?php echo e($errors->has('answer') ? ' has-error' : ''); ?>">
					<label for="answer" class="control-label text-left col-sm-4 required">Answer<span class="required-label">*</span></label>	
					<div class="col-sm-8">
						<?php echo e(Form::textarea('answer',null,array('placeholder'=>'Enter Answer','class'=>"form-control ckeditor"))); ?>

						<?php if($errors->has('answer ')): ?>
						<span class="help-block"><strong><?php echo e($errors->first('answer')); ?></strong></span>
						<?php endif; ?>
					</div>
					
				</div>

				
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<?php echo Form::submit((isset($form)) ? 'Update' : 'Save',['class'=>'btn btn-success']); ?>

						<?php echo Html::link(route('top100form.faq.list'),'Cancel',['class'=>'btn btn-default']); ?>

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
<?php echo JsValidator::formRequest('App\Http\Requests\FaqFormRequest'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/pdf-writer/resources/views/admin/top100form/faq/form.blade.php ENDPATH**/ ?>