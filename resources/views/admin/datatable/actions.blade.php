@if(!empty($buttons))
@if(array_key_exists('view',$buttons))
<a class="dropdown-item" href="{{ route($buttons['view']['route_url'],$buttons['view']['route_param']) }}" title="View">
	<i class="fa fa-eye"></i>
</a>
@endif
@if(array_key_exists('billing-history',$buttons))
<a class="dropdown-item" href="{{ route($buttons['billing-history']['route_url'],$buttons['billing-history']['route_param']) }}" title="Billing History">
	<i class="fa fa-money"></i>
</a>
@endif
@if(array_key_exists('edit',$buttons) && (empty($buttons['edit']['permission']) || auth()->user()->can($buttons['edit']['permission'])))
<a class="dropdown-item" href="{{ route($buttons['edit']['route_url'],$buttons['edit']['route_param']) }}" title="Edit">
	<i class="fa fa-edit"></i>
</a>
@endif
@if(array_key_exists('manage',$buttons) && (empty($buttons['manage']['permission']) || auth()->user()->can($buttons['manage']['permission'])))
<a class="dropdown-item" href="{{ route($buttons['manage']['route_url'],$buttons['manage']['route_param']) }}" title="Manage Versions">
	<i class="{{($buttons['manage']['icon'] ?? 'fa fa-gear')}}"></i>{{ lang_trans(($buttons['manage']['label'] ?? 'label.manage')) }}
</a>
@endif
@if(array_key_exists('manage2',$buttons) && (empty($buttons['manage2']['permission']) || auth()->user()->can($buttons['manage2']['permission'])))
<a class="dropdown-item" href="{{ route($buttons['manage2']['route_url'],$buttons['manage2']['route_param']) }}" title="Manage Faq">
	<i class="{{($buttons['manage2']['icon'] ?? 'fa fa-question-circle')}}"></i>{{ lang_trans(($buttons['manage']['label'] ?? 'label.manage')) }}
</a>
@endif
@if(array_key_exists('delete',$buttons) && (empty($buttons['delete']['permission']) || auth()->user()->can($buttons['delete']['permission'])))
{!! Form::open(['url' => route($buttons['delete']['route_url'],$buttons['delete']['route_param']),'method' => 'post','class'=>'delete-form',"onSubmit"=>"return confirm('Are you sure you want to delete?') "]) !!}
{{method_field('DELETE')}}
{!! Form::token() !!}
{!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'delete_button','title'=>'Delete'] ) !!}
{!! Form::close() !!}
@endif
@endif