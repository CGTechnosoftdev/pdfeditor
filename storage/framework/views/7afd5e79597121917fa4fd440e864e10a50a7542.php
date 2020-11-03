<?php $__env->startSection('title',($title ?? '')); ?>
<?php $__env->startSection('heading',($heading ?? '')); ?>
<?php $__env->startSection('breadcrumb',($breadcrumb ?? '')); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
	<!-- Info boxes -->
	<div class="box">
		<div class="box-body">
			<div class="row">
				<?php if(isset($sub_admin)): ?>
				<?php echo e(Form::model($sub_admin,['route' => ['sub-admin.update',$sub_admin->id],'class'=>'form-horizontal','method'=>'put','enctype'=>"multipart/form-data"])); ?>

				<?php else: ?>
				<?php echo e(Form::open(['route' => 'sub-admin.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"])); ?>

				<?php endif; ?>
				<?php echo Form::token(); ?>

				<div class="col-xs-12 col-lg-6 col-md-9">			

					<div class="form-group <?php echo e($errors->has('first_name') ? ' has-error' : ''); ?>">
						<label for="first_name" class="control-label text-left col-sm-4 required">First Name<span class="required-label">*</span></label>	
						<div class="col-sm-8">
							<?php echo e(Form::text('first_name',null,array('placeholder'=>'Enter First Name','class'=>"form-control"))); ?>

							<?php if($errors->has('first_name')): ?>
							<span class="help-block"><strong><?php echo e($errors->first('first_name')); ?></strong></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group <?php echo e($errors->has('last_name') ? ' has-error' : ''); ?>">
						<label for="last_name" class="control-label text-left col-sm-4 required">Last Name<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							<?php echo e(Form::text('last_name',null,array('placeholder'=>'Enter Last Name','class'=>"form-control"))); ?>

							<?php if($errors->has('last_name')): ?>
							<span class="help-block"><strong><?php echo e($errors->first('last_name')); ?></strong></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group <?php echo e($errors->has('role_id') ? ' has-error' : ''); ?>">
						<label for="role_id" class="control-label text-left col-sm-4 required">Role<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							<?php echo Form::select('role_id',[''=>"Select"] + $role_arr, old('role_id'), ['class'=>'form-control required','data-unit'=>'from']); ?>

							<?php if($errors->has('role_id')): ?>
							<span class="help-block"><strong><?php echo e($errors->first('role_id')); ?></strong></span>
							<?php endif; ?>		
						</div>						
					</div>
					<div class="form-group <?php echo e($errors->has('gender') ? ' has-error' : ''); ?>">
						<label for="gender" class="control-label text-left col-sm-4 required">Gender<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							<?php $__currentLoopData = $gender_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="my-radio">
								<?php echo Form::radio('gender', $key, (old('gender') ==  $key), ['id'=>'gender-'.$key]); ?>

								<label for="<?php echo e('gender-'.$key); ?>"><?php echo e($gender); ?></label>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>							
							<?php if($errors->has('gender')): ?>
							<span class="help-block"><strong><?php echo e($errors->first('gender')); ?></strong></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
						<label for="email" class="control-label text-left col-sm-4 required">Email<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							<?php echo e(Form::text('email',null,array('placeholder'=>'Enter Email','class'=>"form-control"))); ?>

							<?php if($errors->has('email')): ?>
							<span class="help-block"><strong><?php echo e($errors->first('email')); ?></strong></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group <?php echo e($errors->has('country_id') || $errors->has('contact_number') ? ' has-error' : ''); ?>">
						<label for="contact_number" class="control-label text-left col-sm-4 required">Contact Number</label>
						<div class="col-sm-8">
							<?php echo e(Form::text('contact_number',null,array('placeholder'=>'Enter Contact Number','class'=>"form-control"))); ?>

							<?php if($errors->has('contact_number')): ?>
							<span class="help-block"><strong><?php echo e($errors->first('contact_number')); ?></strong></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
						<label for="password" class="control-label text-left col-sm-4 required">
							Password
							<i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(config('constant.PASSWORD_REGEX_INSTRUCTION')); ?>"></i>
						</label>
						<div class="col-sm-8" >
							<?php echo e(Form::password('password', ['class' => 'form-control','placeholder' => 'Enter Password ','id'=>'password' ])); ?>   
							<?php if($errors->has('password')): ?>
							<span class="help-block"><strong><?php echo e($errors->first('password')); ?></strong></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group <?php echo e($errors->has('confirm_password') ? ' has-error' : ''); ?>">
						<label for="confirm_password" class="control-label text-left col-sm-4 required">Confirm Password</label>
						<div class="col-sm-8" >
							<?php echo e(Form::password('confirm_password', ['class' => 'form-control','placeholder' => 'Enter Confirm Password ','id'=>'confirm_password' ])); ?> 
							<?php if($errors->has('confirm_password')): ?>
							<span class="help-block"><strong><?php echo e($errors->first('confirm_password')); ?></strong></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group <?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
						<label for="status" class="control-label text-left col-sm-4 required">Status</label>
						<div class="col-sm-8" >
							<?php echo Form::select('status',[''=>"Select Status"] + $status_arr, old('status'), ['class'=>'form-control required','data-unit'=>'from']); ?>

							<?php if($errors->has('status')): ?>
							<span class="help-block"><strong><?php echo e($errors->first('status')); ?></strong></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<?php echo Form::submit((isset($sub_admin)) ? 'Update' : 'Save',['class'=>'btn btn-success']); ?>

							<?php echo Html::link(route('sub-admin.index'),'Cancel',['class'=>'btn btn-default']); ?>

						</div>
					</div>
				</div>
				<!-- /.row -->
				<div class="col-xs-12 col-lg-6 col-md-3">			
					<div class="upload-img form-group <?php echo e($errors->has('profile_picture') ? ' has-error' : ''); ?>">
						<div class="img-preview">
							<img id="blah" src="<?php echo e((isset($sub_admin) && !empty($sub_admin->profile_picture) ? $sub_admin->profile_picture_url : asset('public/admin/dist/img/camera-account.svg'))); ?>" alt="your image" />
						</div>	
						<div class="upload-img-btn">
							<span>Profile Picture</span>
							<?php echo e(Form::file('profile_picture', ['onchange' => 'readURL(this);'])); ?> 
							<?php if($errors->has('profile_picture')): ?>
							<span class="help-block"><strong><?php echo e($errors->first('profile_picture')); ?></strong></span>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<?php echo e(Form::close()); ?>

			</div>
		</div>
	</div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('additionaljs'); ?>
<?php echo JsValidator::formRequest('App\Http\Requests\SubAdminFormRequest'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/pdf-writer/resources/views/admin/sub-admin/form.blade.php ENDPATH**/ ?>