<?php if(!empty($add_new_button)): ?>
<?php if(empty($add_new_button['permission']) || auth()->user()->can($add_new_button['permission'])): ?>
<a class="btn btn-success pull-right" href="<?php echo e($add_new_button['link']); ?>">
	<?php echo e($add_new_button['label']); ?>

</a>
<?php endif; ?>
<?php endif; ?><?php /**PATH /var/www/html/pdf-writer/resources/views/admin/partials/add-new-button.blade.php ENDPATH**/ ?>