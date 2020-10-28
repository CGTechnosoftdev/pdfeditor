@php
$action_class = $button_data['action_class'] ?? 'change-status';
$all_status_arr = config('custom_config.all_status_arr');
@endphp
<div class="dropdown dropdown-inline">
	@if(!empty($button_data))
		@php ($title = $all_status_arr[$button_data['status']] ?? '')
		@if($button_data['status'] == config('constant.STATUS_ACTIVE'))
			@php ($checked_status = "checked")
		@elseif($button_data['status'] == config('constant.STATUS_INACTIVE'))
			@php ($checked_status = "")
		@endif
		@if(isset($checked_status) && (empty($button_data['permission']) || auth()->user()->can($button_data['permission'])))
		<label class="switch {{ $action_class }}" data-status="{{$button_data['status']}}" data-type="{{ $button_data['type'] }}" data-id="{{ $button_data['id'] }}" title="{{$title}}">
		  <input type="checkbox" class="status_checkbox" {{$checked_status}}>
		  <span class="slider round"></span>
		</label>		
		@else
		<span>{{$title}}</span>
		@endif
	@endif
</div>
