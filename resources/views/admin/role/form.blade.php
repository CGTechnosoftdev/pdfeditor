@extends('layouts.admin')
@section('title',($title ?? ''))
@section('heading',($heading ?? ''))
@section('breadcrumb',($breadcrumb ?? ''))
@section('content')
<section class="content">
	<!-- Info boxes -->
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<div class="box">
				<!-- /.box-header -->
				<div class="box-body">
					@if(isset($role))
					{{ Form::model($role,['route' => ['roles.update',$role->id],'method'=>'put','enctype'=>"multipart/form-data"]) }}
					@else
					{{ Form::open(['route' => 'roles.store','method'=>'post','enctype'=>"multipart/form-data"]) }}
					@endif
					{!! Form::token() !!}
					<div class="row">
						<!-- role name -->
						<div class="col-md-6">
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								{!! Form::label('name', 'Name',['class'=>'control-label']) !!}
								<span class="required-label">*</span>
								{{ Form::text('name',null,array('placeholder'=>'Enter name','class'=>"form-control"))}}
								@if ($errors->has('name'))
								<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
								@endif
							</div>
						</div>
					</div>
					<div class="row">						
						@foreach($permissions as $module => $sub_permission)
						<div class="col-md-12 text-bold">
							{{$module}}
						</div>
						<div class="col-md-12">
							@foreach($sub_permission as $data)
							<label style="padding-left:10px; font-weight: 500;">
								{{ Form::checkbox('permission[]', $data['id'],in_array($data['id'],$role_permissions) ? true : false) }}
								{{ $data['name']  }}
							</label>
							@endforeach
						</div>
						@endforeach
						
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 ">
							{!! Form::submit((isset($role)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
							{!! Html::link(route('roles.index'),'Cancel',['class'=>'btn btn-default']) !!}
						</div>
					</div>
					{{ Form::close() }}

				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>

	</div>
	<!-- /.row -->

</section>
<!-- /.content -->

@endsection
@section('additionaljs')
<!-- {!! JsValidator::formRequest('App\Http\Requests\RolesFormRequest') !!} -->
@endsection