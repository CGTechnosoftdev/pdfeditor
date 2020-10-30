@php 
$segment2 = request()->segment(2);
$menu_items = config('menu_config.admin_sidebar');
$user = auth()->user();
@endphp
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<ul class="sidebar-menu tree" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			@foreach ($menu_items as $key => $menu)
			@php $permission_status=1;	@endphp	
			@if(!empty($menu['permissions']))
				@php $permission_status=0; @endphp
				@foreach($menu['permissions'] as $permission)
					@php $permission_status+= $user->can($permission); @endphp
				@endforeach
			@endif
			@if(!empty($permission_status))
			<li class="{{in_array($segment2,$menu['active_segments']) ? 'active' : ''}} {{empty($menu['child']) ? '' : 'treeview'}} ">
				<a href="{{ empty($menu['child']) ? route($menu['route_name']) : '#'  }}">
					@if(!empty($menu['icon_image']))
					<img src="{{ asset('public/admin/dist/img/'.$menu['icon_image']) }}">
					@else
					<i class="fa fa-{{ $menu['icon'] ?? 'list' }}"></i>
					@endif
					<span>{{ $menu['label'] }}</span>
					@if(!empty($menu['child']))
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
					@endif
				</a>
				@if(!empty($menu['child']))
				<ul class="treeview-menu">
					@foreach($menu['child'] as $submenu)
					@if(empty($submenu['permission']) || $user->can($submenu['permission']))
					<li class="{{in_array($segment2,$submenu['active_segments']) ? 'active' : ''}}">
						<a href="{{ route($submenu['route_name']) }}">
							@if(!empty($submenu['icon_image']))
							<img src="{{ asset('public/admin/dist/img/'.$submenu['icon_image']) }}">
							@else
							<i class="fa fa-{{ $submenu['icon'] ?? 'list' }}"></i>
							@endif
							{{$submenu['label']}}
						</a>
					</li>
					@endif
					@endforeach
				</ul>
				@endif
			</li>
			@endif
			@endforeach
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>