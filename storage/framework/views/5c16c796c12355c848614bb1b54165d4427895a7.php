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
				<?php echo e(Form::model($form,['route' => ['top100form.form.update',$form->id],'class'=>'form-horizontal','method'=>'put','enctype'=>"multipart/form-data"])); ?>

				<?php echo e(Form::hidden('id',$form->id,array())); ?>

				<?php else: ?>
				<?php echo e(Form::open(['route' => 'top100form.form.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"])); ?>

				<?php endif; ?>
				<?php echo Form::token(); ?>

			
				<?php echo e(Form::hidden('type_id',$frm_id,array())); ?>

				<?php echo e(Form::hidden('form_type',$top_100_form,array())); ?>

				
			

				<div class="form-group <?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
					<label for="name" class="control-label text-left control-label col-sm-4 required">Name<span class="required-label">*</span></label>	
					<div class="col-sm-8">
						<?php echo e(Form::text('name',null,array('placeholder'=>'Enter Name','class'=>"form-control"))); ?>

						<?php if($errors->has('name ')): ?>
						  <span class="help-block"><strong><?php echo e($errors->first('name ')); ?></strong></span>
						<?php endif; ?>
					</div>
				</div>
			
				<div class="form-group <?php echo e($errors->has('form_file') ? ' has-error' : ''); ?>">
					<label for="name" class="control-label text-left control-label col-sm-4 required">Form File
						<?php if(empty($form)): ?>
						<span class="required-label">*</span>	
						<?php endif; ?>
						</label>
					<div class="col-sm-8">
						<?php echo e(Form::file('form_file',null,array('class'=>"form-control"))); ?>

						<?php if($errors->has('form_file') && empty($form)): ?>
						  <span class="help-block"><strong><?php echo e($errors->first('form_file')); ?></strong></span>
						  
						  else
						<?php endif; ?>
						<?php if(isset($form) && !empty($form_file_url)): ?>
						   <a href="<?php echo e($form_file_url); ?>" target="_new" title="Click here to open!"><img src="<?php echo e(URL::to('/').$placeholder); ?>" width="50px" /><br/></a>						  					
						<?php endif; ?>
					</div>
				</div>

				   <div class="form-group <?php echo e($errors->has('fillable_printable_status') ? ' has-error' : ''); ?>">
						<label for="fillable_printable_status" class="control-label text-left col-sm-4 required">Fillable Printable Status</label>
						<div class="col-sm-8" >
							<?php echo Form::select('fillable_printable_status',[''=>"Select"] + $yes_no_arr, old('fillable_printable_status'), ['class'=>'form-control required','data-unit'=>'from']); ?>

							<?php if($errors->has('fillable_printable_status')): ?>
							 <span class="help-block"><strong><?php echo e($errors->first('fillable_printable_status')); ?></strong></span>
							<?php endif; ?>		
						</div>						
					</div>

					<div class="form-group <?php echo e($errors->has('fillable_printable_status') ? ' has-error' : ''); ?>">
						<label for="fillable_printable_status" class="control-label text-left col-sm-4 required">Is latest version?</label>
						<div class="col-sm-8" >							
							<?php echo Form::checkbox('lastest_version_id',$frm_id,(!empty($is_latest_version)?1:false)); ?>

							<?php if($errors->has('fillable_printable_status')): ?>
							 <span class="help-block"><strong><?php echo e($errors->first('fillable_printable_status')); ?></strong></span>
							<?php endif; ?>		
						</div>						
					</div>
           
				
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<?php echo Form::submit((isset($form)) ? 'Update' : 'Save',['class'=>'btn btn-success']); ?>

						<?php echo Html::link(route('top100form.form.list',"frm_id=".$frm_id),'Cancel',['class'=>'btn btn-default']); ?>

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

<?php echo JsValidator::formRequest('App\Http\Requests\FormFormRequest'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/pdf-writer/resources/views/admin/top100form/form/form.blade.php ENDPATH**/ ?>