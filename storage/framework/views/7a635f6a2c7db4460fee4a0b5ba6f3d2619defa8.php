<?php if(!empty($buttons)): ?>
<?php if(array_key_exists('view',$buttons)): ?>
<a class="dropdown-item" href="<?php echo e(route($buttons['view']['route_url'],$buttons['view']['route_param'])); ?>" title="View">
	<i class="fa fa-eye"></i>
</a>
<?php endif; ?>
<?php if(array_key_exists('edit',$buttons) && (empty($buttons['edit']['permission']) || auth()->user()->can($buttons['edit']['permission']))): ?>
<a class="dropdown-item" href="<?php echo e(route($buttons['edit']['route_url'],$buttons['edit']['route_param'])); ?>" title="Edit">
	<i class="fa fa-edit"></i>
</a>
<?php endif; ?>
<?php if(array_key_exists('manage',$buttons) && (empty($buttons['manage']['permission']) || auth()->user()->can($buttons['manage']['permission']))): ?>
<a class="dropdown-item" href="<?php echo e(route($buttons['manage']['route_url'],$buttons['manage']['route_param'])); ?>" title="Manage Version">
	<i class="<?php echo e(($buttons['manage']['icon'] ?? 'fa fa-gear')); ?>"></i><?php echo e(lang_trans(($buttons['manage']['label'] ?? 'label.manage'))); ?>

</a>
<?php endif; ?>
<?php if(array_key_exists('manage2',$buttons) && (empty($buttons['manage2']['permission']) || auth()->user()->can($buttons['manage2']['permission']))): ?>
<a class="dropdown-item" href="<?php echo e(route($buttons['manage2']['route_url'],$buttons['manage2']['route_param'])); ?>" title="Manage Faq">
	<i class="<?php echo e(($buttons['manage2']['icon'] ?? 'fa fa-question-circle')); ?>"></i><?php echo e(lang_trans(($buttons['manage']['label'] ?? 'label.manage'))); ?>

</a>
<?php endif; ?>
<?php if(array_key_exists('view',$buttons)): ?>
<a class="dropdown-item" href="<?php echo e(route($buttons['view']['route_url'],$buttons['view']['route_param'])); ?>" title="View">
	<i class="fa fa-eye"></i>
</a>
<?php endif; ?>
<?php if(array_key_exists('delete',$buttons) && (empty($buttons['delete']['permission']) || auth()->user()->can($buttons['delete']['permission']))): ?>
<?php echo Form::open(['url' => route($buttons['delete']['route_url'],$buttons['delete']['route_param']),'method' => 'post','class'=>'delete-form',"onSubmit"=>"return confirm('Are you sure you want to delete?') "]); ?>

<?php echo e(method_field('DELETE')); ?>

<?php echo Form::token(); ?>

<?php echo Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'delete_button','title'=>'Delete'] ); ?>

<?php echo Form::close(); ?>

<?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/html/pdf-writer/resources/views/admin/datatable/actions.blade.php ENDPATH**/ ?>