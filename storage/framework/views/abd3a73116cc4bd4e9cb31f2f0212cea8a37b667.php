<?php
$action_class = $button_data['action_class'] ?? 'change-status';
$all_status_arr = config('custom_config.all_status_arr');
?>
<div class="dropdown dropdown-inline">
	<?php if(!empty($button_data)): ?>
		<?php ($title = $all_status_arr[$button_data['status']] ?? ''); ?>
		<?php if($button_data['status'] == config('constant.STATUS_ACTIVE')): ?>
			<?php ($checked_status = "checked"); ?>
		<?php elseif($button_data['status'] == config('constant.STATUS_INACTIVE')): ?>
			<?php ($checked_status = ""); ?>
		<?php endif; ?>
		<?php if(isset($checked_status) && (empty($button_data['permission']) || auth()->user()->can($button_data['permission']))): ?>
		<label class="switch <?php echo e($action_class); ?>" data-status="<?php echo e($button_data['status']); ?>" data-type="<?php echo e($button_data['type']); ?>" data-id="<?php echo e($button_data['id']); ?>" title="<?php echo e($title); ?>">
		  <input type="checkbox" class="status_checkbox" <?php echo e($checked_status); ?>>
		  <span class="slider round"></span>
		</label>		
		<?php else: ?>
		<span><?php echo e($title); ?></span>
		<?php endif; ?>
	<?php endif; ?>
</div>
<?php /**PATH /var/www/html/pdf-writer/resources/views/admin/datatable/status.blade.php ENDPATH**/ ?>