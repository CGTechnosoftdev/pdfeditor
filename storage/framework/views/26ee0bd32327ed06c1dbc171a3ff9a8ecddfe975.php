<?php $__env->startSection('content'); ?>
<div class="login-box">
	<!-- /.login-logo -->
	<div class="login-box-body">
		<div class="login-logo">
			<a href="#"><b><?php echo e(config('app.name')); ?></b></a>
		</div>
		<p class="login-box-msg">Sign In</p>
		<form method="POST" action="<?php echo e(route('login')); ?>">
			<?php echo csrf_field(); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group has-feedback">
						<label for="email" class="col-form-label"><?php echo e(__('Email Address')); ?></label>
						<input type="text" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" placeholder="Enter Email Address" name="email" value="<?php echo e(old('email')); ?>" autocomplete="email" autofocus>
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
						<?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
						<span class="invalid-feedback" role="alert">
							<strong><?php echo e($message); ?></strong>
						</span>
						<?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group has-feedback">
						<label for="password" class="col-form-label text-md-right"><?php echo e(__('Password')); ?></label>
						<input type="password" class="form-control  <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password" placeholder="Enter Password">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						<?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
						<span class="invalid-feedback" role="alert">
							<strong><?php echo e($message); ?></strong>
						</span>
						<?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="checkbox">
						<input class="styled-checkbox" id="remember-me" type="checkbox" value="1">
						<label for="remember-me">Remember Me</label>
					</div>
				</div>
				<!-- /.col -->
				<div class="col-md-4">
					<button type="submit" class="btn btn-success  btn-block btn-flat"><?php echo e(__('Login')); ?></button>
				</div>
				<div class="col-md-8 text-right">
					<a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
						<?php echo e(__('Forgot Password?')); ?>

					</a>
				</div>
				<!-- /.col -->
			</div>
		</form>
		
	</div> 
	<!-- /.login-box-body -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/pdf-writer/resources/views/auth/login.blade.php ENDPATH**/ ?>