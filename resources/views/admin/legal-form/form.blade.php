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
                    @if(isset($legal_form))
                    {{ Form::model($legal_form,['route' => ['legal-form.update',$legal_form->id],'method'=>'put','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
                    @else
                    {{ Form::open(['route' => 'legal-form.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
                    @endif
                    {!! Form::token() !!}

                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label text-left col-sm-4 required">Name<span class="required-label">*</span></label>
                        <div class="col-sm-8">
                            {{ Form::text('name',old('name'),['placeholder'=>'Enter Name','class'=>"form-control",'id'=>'name',"onKeyup" => "createSlug('#name','#slug')"]) }}
                            @if ($errors->has('name'))
                            <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('form') ? ' has-error' : '' }}">
                        <label for="name" class="control-label text-left control-label col-sm-4 required">
                            Form
                        </label>
                        <div class="col-sm-8">
                            {{ Form::file('form',old('form'),array('class'=>"form-control"))}}
                            @if($errors->has('form'))
                            <span class="help-block"><strong>{{ $errors->first('form') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    @if(!empty($legal_form->form))
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <a href="{{$legal_form->form_url}}" target="_new" title="Form">
                                <i class="fa fa-file-pdf-o"></i>
                            </a>
                        </div>
                    </div>
                    @endif
                    <div class="form-group {{ $errors->has('keywords') ? ' has-error' : '' }}">
                        <label for="keywords" class="control-label text-left col-sm-4 required">Keywords</label>
                        <div class="col-sm-8">
                            {!! Form::select('keywords[]',($legal_form->keywords_arr ?? []), ($legal_form->keywords_arr ?? old('keywords_arr')), ['class'=>'form-control select2-token','multiple'=>true]) !!}
                            @if ($errors->has('keywords'))
                            <span class="help-block"><strong>{{ $errors->first('keywords') }}</strong></span>
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
                            {!! Form::submit((isset($legal_form)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
                            {!! Html::link(route('legal-form.index'),'Cancel',['class'=>'btn btn-default']) !!}
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
{!! JsValidator::formRequest('App\Http\Requests\LegalFormFormRequest') !!}
@endsection