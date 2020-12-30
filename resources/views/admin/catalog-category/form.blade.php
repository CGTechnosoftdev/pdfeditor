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
					@if(isset($catalog_category))
					{{ Form::model($catalog_category,['route' => ['catalog-category.update',$catalog_category->id],'method'=>'put','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@else
					{{ Form::open(['route' => 'catalog-category.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@endif
					{!! Form::token() !!}
					<div class="row">
						<div class="col-xs-12 col-lg-6 col-md-9">
							<div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
								<label for="type" class="control-label text-left col-sm-4">Catalog Type<span class="required-label">*</span></label>
								<div class="col-sm-8">
									{!! Form::select('type',[''=>"Select"] + $catalog_type_arr, old('type'), ['class'=>'form-control','id'=>'catalog-type']) !!}
									@if ($errors->has('type'))
									<span class="help-block"><strong>{{ $errors->first('type') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('parent_id') ? ' has-error' : '' }}">
								<label for="parent_id" class="control-label text-left col-sm-4">Parent Category</label>
								<div class="col-sm-8">
									{!! Form::select('parent_id',['0'=>"Select"] + $parent_category_arr, old('parent_id'), ['class'=>'form-control','id'=>'parent_categories']) !!}
									@if ($errors->has('parent_id'))
									<span class="help-block"><strong>{{ $errors->first('parent_id') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name" class="control-label text-left col-sm-4">Name
									<span class="required-label">*</span>
								</label>
								<div class="col-sm-8">
									{{ Form::text('name',old('name'),['placeholder'=>'Enter Name','class'=>"form-control",'id'=>'name',"onKeyup" => "createSlug('#name','#slug')"]) }}
									@if ($errors->has('name'))
									<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
								<label for="slug" class="control-label text-left col-sm-4 required">Slug<span class="required-label">*</span></label>
								<div class="col-sm-8">
									{{ Form::text('slug',old('slug'),['placeholder'=>'Enter Slug','class'=>"form-control",'id'=>'slug'])}}
									@if ($errors->has('slug'))
									<span class="help-block"><strong>{{ $errors->first('slug') }}</strong></span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
								<label for="description" class="control-label text-left col-sm-4">Description</label>
								<div class="col-sm-8">
									{{ Form::textarea('description',old('description'),['placeholder'=>'Description','class'=>"form-control",'id'=>'description']) }}
									@if ($errors->has('description'))
									<span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									{!! Form::submit((isset($catalog_category)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
									{!! Html::link(route('catalog-category.index'),'Cancel',['class'=>'btn btn-default']) !!}
								</div>
							</div>
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
{!! JsValidator::formRequest('App\Http\Requests\CatalogFormCategoryFormRequest') !!}
<script>
	$('#catalog-type').change(function() {
		blockUI();
		var type = $(this).val();
		$("#parent_categories option").remove();
		$('#parent_categories').append($('<option>', {
			value: '0',
			text: 'Select'
		}));
		$.ajax({
			url: '{{ route("load-catalog-parent-categories") }}',
			data: {
				"_token": "{{ csrf_token() }}",
				"type": type
			},
			type: 'post',
			dataType: 'json',
			success: function(result) {
				$.each(result, function(k, v) {
					$('#parent_categories').append($('<option>', {
						value: k,
						text: v
					}));
				});
			},
			complete: function() {
				unblockUI();
			}
		});
	});
</script>
@endsection