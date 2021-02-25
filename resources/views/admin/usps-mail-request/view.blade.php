@extends('layouts.admin')
@section('title',($title ?? ''))
@section('heading',($heading ?? ''))
@section('breadcrumb',($breadcrumb ?? ''))
@section('content')
<section class="content">
    <!-- Info boxes -->
    <div class="box">
        <div class="box-body">
            <div class="user-management usps-management">
                <div class="user-info">
                    <div class="row">
                        <!-- /.row -->



                        <div class="form-group ">
                            <label for="name" class="control-label text-left col-sm-3 required">Delivery Method</label>
                            <div class="col-sm-9">
                                {{ $usps_delivery_methods[$usps_request->delivery_method]["name"] }}
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="name" class="control-label text-left col-sm-3 required">Color</label>
                            <div class="col-sm-9">
                                {{ $yes_no_arr[$usps_request->color_mode_status] }}
                            </div>
                        </div>


                        <div class="form-group ">
                            <div class="col-sm-12">
                                <h4>From Address</h4>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="name" class="control-label text-left col-sm-3 required">From</label>
                            <div class="col-sm-9">
                                {{ $usps_request->from_name }}
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="first_name" class="control-label text-left col-sm-3 required">Address Line1</label>
                            <div class="col-sm-9">
                                {{ $usps_request->from_address_line_first }}
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="first_name" class="control-label text-left col-sm-3 required">Address Line2</label>
                            <div class="col-sm-9">
                                {{ $usps_request->from_address_line_second }}
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="first_name" class="control-label text-left col-sm-3 required">City</label>
                            <div class="col-sm-9">
                                {!! $usps_request->from_city !!}
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="first_name" class="control-label text-left col-sm-3 required">State</label>
                            <div class="col-sm-9">
                                {!! $usps_request->from_state !!}
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="first_name" class="control-label text-left col-sm-3 required">Zip</label>
                            <div class="col-sm-9">
                                {!! $usps_request->from_zip !!}
                            </div>
                        </div>


                        <div class="form-group ">
                            <div class="col-sm-12">
                                <h4>To Address</h4>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="name" class="control-label text-left col-sm-3 required">From</label>
                            <div class="col-sm-9">
                                {{ $usps_request->to_name }}
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="first_name" class="control-label text-left col-sm-3 required">Address Line1</label>
                            <div class="col-sm-9">
                                {{ $usps_request->to_address_line_first }}
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="first_name" class="control-label text-left col-sm-3 required">Address Line2</label>
                            <div class="col-sm-9">
                                {{ $usps_request->to_address_line_second }}
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="first_name" class="control-label text-left col-sm-3 required">City</label>
                            <div class="col-sm-9">
                                {!! $usps_request->tocity !!}
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="first_name" class="control-label text-left col-sm-3 required">State</label>
                            <div class="col-sm-9">
                                {!! $usps_request->to_state !!}
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="first_name" class="control-label text-left col-sm-3 required">Zip</label>
                            <div class="col-sm-9">
                                {!! $usps_request->to_zip !!}
                            </div>
                        </div>







                    </div>
                </div>
            </div>
            <div class="recent-notes usps-notes">
                <div class="notes-heading">
                    <h4>Recent Status</h4>
                    <div class="notes-content">
                        @if(!empty($usps_entered_status))
                        <ul>
                            @foreach($usps_entered_status as $usps_status)
                            <li>
                                <div class="date-time">{{ changeDateTimeFormat($usps_status->created_at) }}</div>

                                <p>{{ $usps_request_status[$usps_status->mail_status] }}</p>
                                <p>{{ $usps_status->description }}</p>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <h5>No Status added</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- /.content -->
<div id="usps-update-status-modal" class="modal fade new-modal" role="dialog">
    <div class="modal-dialog" role="document" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">USPS Status Add</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-lg-12 col-md-12">

                        {{ Form::open(['route' => ['usps-mail-request-add-status',$usps_request->id],'method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}

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
                                {!! Html::link(route('usps-mail-request.list'),'Cancel',['class'=>'btn btn-default']) !!}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('additionaljs')
<script>
    $(document).ready(function() {
        $("#add_new_status_button_id").click(function() {
            $("#usps-update-status-modal").modal("show");

        });
    });
</script>

@endsection