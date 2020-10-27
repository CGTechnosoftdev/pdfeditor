@if(empty($add_new_button['permission']) || auth()->user()->can($add_new_button['permission']))
<div class="row">
	<div class="col-md-12 ">
		<a class="btn btn-success pull-right" href="{{ $add_new_button['link'] }}">
			<i class="fa fa-plus"></i> {{ $add_new_button['label'] }}
		</a>
	</div>
</div>
@endif