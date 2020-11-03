<?php $__env->startSection('title',($title ?? '')); ?>
<?php $__env->startSection('heading',($heading ?? '')); ?>
<?php $__env->startSection('breadcrumb',($breadcrumb ?? '')); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
	<!-- Info boxes -->
	<div class="box">
		<div class="box-body">
			<div class="row">
				<?php if(isset($user)): ?>
				<?php echo Form::model($user,['route' => ['update-profile'],'id'=>'profile_form','class'=>'form-horizontal','method' => 'put','enctype'=>"multipart/form-data"]); ?>

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
					<div class="form-group <?php echo e($errors->has('contact_number') ? ' has-error' : ''); ?>">
						<label for="contact_number" class="control-label text-left col-sm-4 required">Contact Number</label>
						<div class="col-sm-8">
							<?php echo e(Form::text('contact_number',null,array('placeholder'=>'Enter Contact Number','class'=>"form-control"))); ?>

							<?php if($errors->has('contact_number')): ?>
							<span class="help-block"><strong><?php echo e($errors->first('contact_number')); ?></strong></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group <?php echo e($errors->has('profile_picture') ? ' has-error' : ''); ?>">
						<div class="col-sm-offset-4 col-sm-8" >
							<?php echo e(Form::checkbox('change_password',1,old('change_password'),['id'=>'change-password-checkbox','class'=>'styled-checkbox'])); ?>

							<label for="change-password-checkbox">Change Password</label>
						</div>
					</div>

					<div class="form-group <?php echo e($errors->has('current_password') ? ' has-error' : ''); ?>">
						<label for="current_password" class="control-label text-left col-sm-4 required">Current Password</label>
						<div class="col-sm-8" >
							<?php echo Form::password('current_password',['class'=>'form-control change-password-elements '.($errors->has("current_password") ? "is-invalid" : ""),'id'=>'current_password','disabled'=>(empty(old('change_password')) ? true : false)]); ?>

							<div class="<?php echo e(($errors->has('current_password') ? 'invalid-feedback' : '')); ?>">
								<?php echo e($errors->first('current_password')); ?>

							</div>
						</div>
					</div>
					<div class="form-group <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
						<label for="password" class="control-label text-left col-sm-4 required">Password <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(config('constant.PASSWORD_REGEX_INSTRUCTION')); ?>"></i></label>
						<div class="col-sm-8" >
							<?php echo Form::password('password',['class'=>'form-control change-password-elements '.($errors->has("password") ? "is-invalid" : ""),'id'=>'password','disabled'=>(empty(old('change_password')) ? true : false)]); ?>

							<div class="<?php echo e(($errors->has('password') ? 'invalid-feedback' : '')); ?>">
								<?php echo e($errors->first('password')); ?>

							</div>
						</div>
					</div>
					<div class="form-group <?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
						<label for="password_confirmation" class="control-label text-left col-sm-4 required">Confirm Password</label>
						<div class="col-sm-8" >
							<?php echo Form::password('password_confirmation',['class'=>'form-control change-password-elements '.($errors->has("password_confirmation") ? "is-invalid" : ""),'id'=>'password_confirmation','disabled'=>(empty(old('change_password')) ? true : false)]); ?>

							<div class="<?php echo e(($errors->has('password_confirmation') ? 'invalid-feedback' : '')); ?>">
								<?php echo e($errors->first('password_confirmation')); ?>

							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<?php echo Form::submit((isset($user)) ? 'Update' : 'Save',['class'=>'btn btn-success']); ?>

							<?php echo Html::link(route('sub-admin.index'),'Cancel',['class'=>'btn btn-default']); ?>

						</div>
					</div>
					

				</div>
				<div class="col-xs-12 col-lg-6 col-md-3">			
					<div class="upload-img form-group <?php echo e($errors->has('profile_picture') ? ' has-error' : ''); ?>">
						<div class="img-preview">
							<img id="blah" src="<?php echo e((isset($user) && !empty($user->profile_picture) ? $user->profile_picture_url : asset('public/admin/dist/img/camera-account.svg'))); ?>" alt="your image" />
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

				<!-- /.row -->
			</div>
		</div>
	</div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('additionaljs'); ?>
<?php echo JsValidator::formRequest('App\Http\Requests\ProfileFormRequest','#profile_form'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/pdf-writer/resources/views/admin/profile/index.blade.php ENDPATH**/ ?>