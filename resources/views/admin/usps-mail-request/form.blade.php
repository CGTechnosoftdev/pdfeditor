@extends('layouts.admin')
@section('title',($title ?? ''))
@section('heading',($heading ?? ''))
@section('breadcrumb',($breadcrumb ?? ''))
@section('content')
<section class="content">
    <!-- Info boxes -->
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 col-lg-6 col-md-9">
                    @if(!empty($usps_mail_status))
                    {{ Form::model($usps_mail_status,['route' => ['usps-mail-request-edit-status-save',$usps_request->id,$usps_mail_status->id],'method'=>'put','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
                    @else
                    {{ Form::open(['route' => ['usps-mail-request-add-status',$usps_request->id],'method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
                    @endif
                    {{Form::hidden('usps_requests_id',$usps_request->id)}}

                    {!! Form::token() !!}

                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label text-left col-sm-4 required">Mail Status<span class="required-label">*</span></label>
                        <div class="col-sm-8">
                            {{ Form::select('mail_status',$usps_request_status,old('mail_status'),['class'=>"form-control",'id'=>'mail_status']) }}
                            @if ($errors->has('mail_status'))
                            <span class="help-block"><strong>{{ $errors->first('mail_status') }}</strong></span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="control-label text-left col-sm-4 required">Description</label>
                        <div class="col-sm-8">
                            {{ Form::textarea('description',old('description'),['placeholder'=>'Enter Description','class'=>"form-control"])}}
                            @if ($errors->has('description'))
                            <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            {!! Form::submit((isset($usps_request_status)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
                            {!! Html::link(route('business-category.index'),'Cancel',['class'=>'btn btn-default']) !!}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                <div class="col-xs-12 col-lg-6 col-md-3">
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
@section('additionaljs')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
{!! JsValidator::formRequest('App\Http\Requests\UspsMailStatusRequestFormRequest') !!}
@endsection