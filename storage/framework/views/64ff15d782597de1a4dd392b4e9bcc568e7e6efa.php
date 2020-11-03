 <div class="row">
 	<div class="col-lg-12">
 		<?php if($message = Session::get('success')): ?>
 		<div class="alert alert-success alert-block"> 			
 			<strong><?php echo $message; ?></strong>
 			<button type="button" class="close" data-dismiss="alert">×</button>
 		</div>
 		<?php endif; ?>


 		<?php if($message = Session::get('error')): ?>
 		<div class="alert alert-danger alert-block">
 			<strong><?php echo $message; ?></strong>
 			<button type="button" class="close" data-dismiss="alert">×</button> 
 		</div>
 		<?php endif; ?>


 		<?php if($message = Session::get('warning')): ?>
 		<div class="alert alert-warning alert-block">
 			<strong><?php echo $message; ?></strong>
 			<button type="button" class="close" data-dismiss="alert">×</button> 
 		</div>
 		<?php endif; ?>


 		<?php if($message = Session::get('info')): ?>
 		<div class="alert alert-info alert-block">
 			<strong><?php echo $message; ?></strong>
 			<button type="button" class="close" data-dismiss="alert">×</button> 
 		</div>
 		<?php endif; ?>

 	</div>
 </div><?php /**PATH /var/www/html/pdf-writer/resources/views/admin/partials/flash-messages.blade.php ENDPATH**/ ?>