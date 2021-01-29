@extends('layouts.front-user')
@section('title',($title ?? ''))
@section("content")
<!-- Content Header (Page header) -->
<section class="content-header share-allert">
    <div class="title">
        <h2>Send Via USPS</h2>
    </div>
    <div class="share-allert-text">
        <p>Please fill in the information below to print and send your document via USPS. Your document will be printed in a secure, HIPAA compliant facility and sent via USPS. If you choose USPS Certified Mail, we will send you a tracking number
            and delivery notification.</p>
    </div>
</section>

<!-- Main content -->
<section class="content">
    {{ Form::open(['route' => ['front.send-via-usps',$document->encrypted_id],'method'=>'post','id'=>'send-via-usps-form','enctype'=>"multipart/form-data"]) }}
    <div class="advance-settings-part">
        <h3>
            <a class="" data-toggle="collapse" href="#you-are-sharing" aria-expanded="true" aria-controls="you-are-sharing">
                <img class="icon" src="{{ asset('public/front/images/file-document-outline.svg') }}"> Document to Send via USPS</a>
        </h3>
        <div class="collapse show" id="you-are-sharing">
            <div class="advance-settings-content">
                <div class="row">
                    <div class="col-lg-10 col-md-8">
                        <div class="single-document single-doc-signed">
                            <div class="doc-dots">
                                <button><i class="fas fa-bars"></i></button>
                            </div>
                            <div class="doc-img"><img src="{{ asset('public/front/images/doc-img-1.png') }}" class="user-image" alt="PDFWriter Admin Image"></div>
                            <div class="doc-content">
                                <h5>{{ $document->name }}</h5>
                                <div class="last-activity">Last update: {{ changeDateTimeFormat($document->updated_at) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3>
            <a class="" data-toggle="collapse" href="#recipients" aria-expanded="true" aria-controls="recipients">
                <img class="icon" src="{{ asset('public/front/images/pin.svg') }}"> Fill in the Address and Return Address Label </a>
        </h3>
        <div class="collapse show" id="recipients">
            <div class="advance-settings-content">
                <div class="return-address-section">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>From</h5>
                                    <div class="form-group">
                                        {{ Form::text('from_name',old('from_name'),['placeholder'=>'Name','class'=>"form-control",'id'=>'from_name']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::text('from_address_line_first',old('from_address_line_first'),['placeholder'=>'Address Line 1','class'=>"form-control",'id'=>'from_address_line_first']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::text('from_address_line_second',old('from_address_line_second'),['placeholder'=>'Address Line 2','class'=>"form-control",'id'=>'from_address_line_second']) }}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::text('from_city',old('from_city'),['placeholder'=>'City','class'=>"form-control",'id'=>'from_city']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::text('from_state',old('from_state'),['placeholder'=>'State','class'=>"form-control",'id'=>'from_state']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::text('from_zip',old('from_zip'),['placeholder'=>'Zip','class'=>"form-control",'id'=>'from_zip']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h5>To</h5>
                                    <div class="form-group">
                                        {{ Form::text('to_name',old('to_name'),['placeholder'=>'Name','class'=>"form-control",'id'=>'to_name']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::text('to_address_line_first',old('to_address_line_first'),['placeholder'=>'Address Line 1','class'=>"form-control",'id'=>'to_address_line_first']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::text('to_address_line_second',old('to_address_line_second'),['placeholder'=>'Address Line 2','class'=>"form-control",'id'=>'to_address_line_second']) }}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::text('to_city',old('to_city'),['placeholder'=>'City','class'=>"form-control",'id'=>'to_city']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::text('to_state',old('to_state'),['placeholder'=>'State','class'=>"form-control",'id'=>'to_state']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::text('to_zip',old('to_zip'),['placeholder'=>'Zip','class'=>"form-control",'id'=>'to_zip']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="usps-img">
                                <img src="{{ asset('public/front/images/usps-img.svg') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3>
            <a class="" data-toggle="collapse" href="#reminders-for-recipients" aria-expanded="true" aria-controls="reminders-for-recipients">
                <img class="icon" src="{{ asset('public/front/images/pin.svg') }}"> Choose Delivery Method
            </a>
        </h3>
        <div class="collapse show" id="reminders-for-recipients">
            <div class="advance-settings-content">
                <div class="delivery-method">
                    <div class="personalize-invitation-part">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Document Settings</h3>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="personalize-invitation-title">
                                    <h6>Use Color Mode</h6>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <div class="personalize-invitation-content d-flex align-items-center">
                                    <div class="tg-list-item">
                                        {{ Form::checkbox('color_mode_status','1',null,['id'=>'color_mode_status','class'=>'tgl tgl-light']) }}
                                        <label class="tgl-btn" for="color_mode_status"></label>
                                    </div>
                                    <span class="reminder-text">This is a paid feature. Please find the final price below.</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Choose Delivery Method</h3>
                            </div>
                            <div class="col-md-12">
                                <ul class="template-types">
                                    @foreach($delivery_methods as $method_id => $method)
                                    <li class="{{ $method_id == $default_delivery_method ? 'active' : '' }}">
                                        <label for="method_{{$method_id}}">
                                            <input name="delivery_method" value="{{$method_id}}" type="radio" id="method_{{$method_id}}" name="radio-group" {{ $method_id == $default_delivery_method ? "checked=''" : '' }}>
                                            {{ $method['name'] }} <span class="price">$ {{ $method['amount']}}</span>
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="advance-settings-btns advance-usps-btns">
            <div class="send-btn">
                {!! Form::submit('Send',['class'=>'share-btn']) !!}
                <span>By clicking Send, you agree to PDF Writer's <a href="#">Terms of Service</a> and <a href="#">Privacy Policy.</a></span>
            </div>
            <!-- <div class="preview-btns">
                <a href="#" class="my-doc-btn">Instructions</a>
                <a href="#" class="btn btn-outline-success float-right">Preview</a>
            </div> -->

        </div>

    </div>
    {{ Form::close() }}

</section>
<!-- /.content -->
@append

@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\UspsFormRequest','#send-via-usps-form') !!}
@append