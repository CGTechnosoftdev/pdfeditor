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
                    @if(isset($document_template))
                    {{ Form::model($document_template,['route' => ['document-template.update',$document_template->id],'method'=>'put','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
                    @else
                    {{ Form::open(['route' => 'document-template.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
                    @endif
                    {!! Form::token() !!}


                    <div class="form-group {{ $errors->has('document_type_id') ? ' has-error' : '' }}">
                        <label for="document_type_id" class="control-label text-left col-sm-4 required">
                            Document Type<span class="required-label">*</span>
                        </label>
                        <div class="col-sm-8">
                            {!! Form::select('document_type_id',$document_type_list, old('document_type_id'), ['class'=>'form-control required','data-unit'=>'from']) !!}
                            @if ($errors->has('document_type_id'))
                            <span class="help-block"><strong>{{ $errors->first('document_type_id') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label text-left col-sm-4 required">Name<span class="required-label">*</span></label>
                        <div class="col-sm-8">
                            {{ Form::text('name',old('name'),['placeholder'=>'Enter Name','class'=>"form-control",'id'=>'name',"onKeyup" => "createSlug('#name','#slug')"]) }}
                            @if ($errors->has('name'))
                            <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('template_file') ? ' has-error' : '' }}">
                        <label for="name" class="control-label text-left control-label col-sm-4 required">
                            Template File
                        </label>
                        <div class="col-sm-8">
                            {{ Form::file('template_file',old('template_file'),array('class'=>"form-control"))}}
                            @if($errors->has('template_file'))
                            <span class="help-block"><strong>{{ $errors->first('template_file') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    @if(!empty($document_template->template_file))
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <a href="{{$document_template->template_file_url}}" target="_new" title="Template File">
                                <i class="fa fa-file-pdf-o"></i>
                            </a>
                        </div>
                    </div>
                    @endif


                    <div class="form-group {{ $errors->has('keywords') ? ' has-error' : '' }}">
                        <label for="keywords" class="control-label text-left col-sm-4 required">Keywords</label>
                        <div class="col-sm-8">
                            {{ Form::text('keywords',old('keywords'),['placeholder'=>'Enter keywords','class'=>"form-control"])}}
                            @if ($errors->has('keywords'))
                            <span class="help-block"><strong>{{ $errors->first('keywords') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('is_popular') ? ' has-error' : '' }}">
                        <label for="is_popular" class="control-label text-left col-sm-4 required">Is Popular?</label>
                        <div class="col-sm-8">
                            {{ Form::checkbox('is_popular',1,old('is_popular'),['class'=>'styled-checkbox','id'=>'is_popular']) }}
                            <label for="is_popular"></label>
                            @if ($errors->has('is_popular'))
                            <span class="help-block"><strong>{{ $errors->first('is_popular') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            {!! Form::submit((isset($document_template)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
                            {!! Html::link(route('document-template.index'),'Cancel',['class'=>'btn btn-default']) !!}
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
{!! JsValidator::formRequest('App\Http\Requests\DocumentTemplateFormRequest') !!}
@endsection