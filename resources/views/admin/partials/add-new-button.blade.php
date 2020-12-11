@if(!empty($add_new_button))
@if(empty($add_new_button['permission']) || auth()->user()->can($add_new_button['permission']))
<a class="btn btn-success pull-right" href="{{ $add_new_button['link'] }}">
	{{ $add_new_button['label'] }}
</a>
@endif
@endif