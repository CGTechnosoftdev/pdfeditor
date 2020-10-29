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
        
                @if(isset($business_category))
                    {{ Form::model($business_category,['route' => ['business-category.update',$business_category->id],'method'=>'put','enctype'=>"multipart/form-data","id" => "business_categoryfrm_id"]) }}
                    {{ Form::hidden('id',null,array('placeholder'=>'Enter name','class'=>"form-control"))}}
					@else
					{{ Form::open(['route' => 'business-category.store','method'=>'post','enctype'=>"multipart/form-data","id" => "business_categoryfrm_id"]) }}
					@endif
					{!! Form::token() !!}
                    <div class="row">
						<!-- role name -->
						<div class="col-md-2">
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								{!! Form::label('name', 'Name',['class'=>'control-label']) !!}
								<span class="required-label">*</span>
							</div>		
                         </div>
						<div class="col-md-5">
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							
								{{ Form::text('name',null,array('placeholder'=>'Enter name','class'=>"form-control","onKeyup" => "textchange('#name','#slug')"))}}
								@if ($errors->has('name'))
								<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
								@endif
							</div>
						</div>
                    </div>
			
                    <div class="row">
						<!-- role name -->
						<div class="col-md-2">
						     <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
								{!! Form::label('slug', 'Slug',['class'=>'control-label']) !!}
								<span class="required-label">*</span>
							</div>		
                         </div>
						<div class="col-md-5">
							<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
							
								{{ Form::text('slug',null,array('placeholder'=>'Enter Slug','class'=>"form-control"))}}
								@if ($errors->has('slug'))
								 <span class="help-block"><strong>{{ $errors->first('slug') }}</strong></span>
								@endif
							</div>
						</div>
					</div>
				
                    
                    <div class="row">
						<!-- role name -->
						<div class="col-md-2">
							<div class="form-group{{ $errors->has('heading') ? ' has-error' : '' }}">
									{!! Form::label('heading', 'Heading',['class'=>'control-label']) !!}
									<span class="required-label">*</span>
							</div>		
                         </div>
						<div class="col-md-5">
							<div class="form-group{{ $errors->has('heading') ? ' has-error' : '' }}">
						
								{{ Form::text('heading',null,array('placeholder'=>'Enter Heading','class'=>"form-control"))}}
								@if ($errors->has('heading'))
								<span class="help-block"><strong>{{ $errors->first('heading') }}</strong></span>
								@endif
							</div>
						</div>
                    </div>
                    
                    <div class="row">
						<!-- role name -->
						<div class="col-md-2">
						<div class="form-group{{ $errors->has('short_description') ? ' has-error' : '' }}">
								{!! Form::label('short_description', 'Short Description',['class'=>'control-label']) !!}
								<span class="required-label">*</span>
							</div>		
                         </div>
						<div class="col-md-5">
							<div class="form-group{{ $errors->has('short_description') ? ' has-error' : '' }}">
							
								{{ Form::text('short_description',null,array('placeholder'=>'Short Description','class'=>"form-control"))}}
								@if ($errors->has('short_description'))
								<span class="help-block"><strong>{{ $errors->first('short_description') }}</strong></span>
								@endif
							</div>
						</div>
                    </div>
                    
                    <div class="row">
						<!-- role name -->
						<div class="col-md-2">
						<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
								{!! Form::label('description', 'Description',['class'=>'control-label']) !!}
							
							</div>		
                         </div>
						<div class="col-md-8">

						<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
								{{ Form::textarea('description',null,array('placeholder'=>'Enter Description','class'=>"form-control ckeditor"))}}
								@if ($errors->has('description'))
								<span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
								@endif
							</div>
						</div>
                    </div>
                    
                    <div class="row">
						<!-- role name -->
						<div class="col-md-6">
                            {!! Form::submit('Save',['class'=>'btn btn-info']) !!}
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
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">



    $(document).ready(function () {
       // $('.ckeditor').ckeditor();
	
	
    });
</script>
{!! JsValidator::formRequest('App\Http\Requests\BusinessCategoryFormRequest') !!}
@endsection