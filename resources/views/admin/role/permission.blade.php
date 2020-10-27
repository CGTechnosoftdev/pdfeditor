@extends('admin.layouts.layout')
@section('title',$title)
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->

	<section class="content-header">
		<h1>{{$heading}}</h1>
		
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Info boxes -->
		<div class="row">
			<div class="col-xs-12 col-md-12">
				<div class="box">
					<div class="box-header">
						<!-- <h3 class="box-title">Hover Data Table</h3> -->
					</div>
					<!-- /.box-header -->
					<div class="box-body">

						@if(!empty($rolePermissions))
						{{ Form::model($rolePermissions,['route' => 'permission-post','method'=>'post','enctype'=>"multipart/form-data"]) }}
						@else
						{{ Form::open(['route' => 'permission-post','method'=>'post','enctype'=>"multipart/form-data"]) }}
						@endif
						{!! Form::token() !!}
						<input type="hidden" value="{{$role->id}}" name="role_id"/>
						@foreach($permissionArray as $permissions)
						<div class="row">
							<!-- role name -->
							<div class="col-md-12">
								<div class="form-group{{ $errors->has('permission') ? ' has-error' : '' }}">
								
								<b>	{{$permissions['module']}} Manager : </b><br>
									<span class="required-label"style="padding-left:20px;"></span>
									
										@foreach($permissions['permission'] as $value)
											<label style="padding-left:10px; font-weight: 500;">{{ Form::checkbox('permission[]', $value['id'], in_array($value['id'], $rolePermissions) ? true : false, array('class' => 'name')) }}
											{{ ucwords(str_replace("-", " ",$value['name']))  }}</label>
										
										@endforeach
								
								</div>
							</div>
						</div>
						@endforeach	
						<div class="box-footer ">
							<a href="{{ route('roles.index') }}" class="btn btn-default">Cancel</a>
							{!! Form::submit((!empty($rolePermissions)) ? 'Update' : 'Save',['class'=>'btn btn-info pull-right']) !!}

						</div>  <!-- /.box-footer -->

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
</div>
<!-- /.content-wrapper -->

@endsection

@section('script')
{!! JsValidator::formRequest('App\Http\Requests\PermissionsFormRequest') !!}
@endsection