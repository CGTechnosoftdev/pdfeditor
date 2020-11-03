<?php 
$segment2 = request()->segment(2);
$menu_items = config('menu_config.admin_sidebar');
$user = auth()->user();
?>
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<ul class="sidebar-menu tree" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<?php $__currentLoopData = $menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php $permission_status=1;	?>	
			<?php if(!empty($menu['permissions'])): ?>
				<?php $permission_status=0; ?>
				<?php $__currentLoopData = $menu['permissions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php $permission_status+= $user->can($permission); ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
			<?php if(!empty($permission_status)): ?>
			<li class="<?php echo e(in_array($segment2,$menu['active_segments']) ? 'active' : ''); ?> <?php echo e(empty($menu['child']) ? '' : 'treeview'); ?> ">
				<a href="<?php echo e(empty($menu['child']) ? route($menu['route_name']) : '#'); ?>">
					<?php if(!empty($menu['icon_image'])): ?>
					<img src="<?php echo e(asset('public/admin/dist/img/'.$menu['icon_image'])); ?>">
					<?php else: ?>
					<i class="fa fa-<?php echo e($menu['icon'] ?? 'list'); ?>"></i>
					<?php endif; ?>
					<span><?php echo e($menu['label']); ?></span>
					<?php if(!empty($menu['child'])): ?>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
					<?php endif; ?>
				</a>
				<?php if(!empty($menu['child'])): ?>
				<ul class="treeview-menu">
					<?php $__currentLoopData = $menu['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if(empty($submenu['permission']) || $user->can($submenu['permission'])): ?>
					<li class="<?php echo e(in_array($segment2,$submenu['active_segments']) ? 'active' : ''); ?>">
						<a href="<?php echo e(route($submenu['route_name'])); ?>">
							<?php if(!empty($submenu['icon_image'])): ?>
							<img src="<?php echo e(asset('public/admin/dist/img/'.$submenu['icon_image'])); ?>">
							<?php else: ?>
							<i class="fa fa-<?php echo e($submenu['icon'] ?? 'list'); ?>"></i>
							<?php endif; ?>
							<?php echo e($submenu['label']); ?>

						</a>
					</li>
					<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
				<?php endif; ?>
			</li>
			<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside><?php /**PATH /var/www/html/pdf-writer/resources/views/admin/partials/sidebar.blade.php ENDPATH**/ ?>