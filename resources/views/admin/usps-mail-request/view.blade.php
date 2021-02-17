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
                <!-- /.row -->

                <div class="col-xs-12 col-lg-10 col-md-9">

                    <div class="form-group col-md-12">
                        <label for="name" class="control-label text-left col-sm-3 required">Delivery Method</label>
                        <div class="col-sm-9">
                            {{ $usps_delivery_methods[$usps_request->delivery_method]["name"] }}
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="name" class="control-label text-left col-sm-3 required">Color</label>
                        <div class="col-sm-9">
                            {{ $yes_no_arr[$usps_request->color_mode_status] }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <h4>From Address</h4>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name" class="control-label text-left col-sm-3 required">From</label>
                            <div class="col-sm-9">
                                {{ $usps_request->from_name }}
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="first_name" class="control-label text-left col-sm-3 required">Address Line1</label>
                            <div class="col-sm-9">
                                {{ $usps_request->from_address_line_first }}
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="first_name" class="control-label text-left col-sm-3 required">Address Line2</label>
                            <div class="col-sm-9">
                                {{ $usps_request->from_address_line_second }}
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="first_name" class="control-label text-left col-sm-3 required">City</label>
                            <div class="col-sm-9">
                                {!! $usps_request->from_city !!}
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="first_name" class="control-label text-left col-sm-3 required">State</label>
                            <div class="col-sm-9">
                                {!! $usps_request->from_state !!}
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="first_name" class="control-label text-left col-sm-3 required">Zip</label>
                            <div class="col-sm-9">
                                {!! $usps_request->from_zip !!}
                            </div>
                        </div>


                        <div class="form-group col-md-12">
                            <h4>To Address</h4>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name" class="control-label text-left col-sm-3 required">From</label>
                            <div class="col-sm-9">
                                {{ $usps_request->to_name }}
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="first_name" class="control-label text-left col-sm-3 required">Address Line1</label>
                            <div class="col-sm-9">
                                {{ $usps_request->to_address_line_first }}
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="first_name" class="control-label text-left col-sm-3 required">Address Line2</label>
                            <div class="col-sm-9">
                                {{ $usps_request->to_address_line_second }}
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="first_name" class="control-label text-left col-sm-3 required">City</label>
                            <div class="col-sm-9">
                                {!! $usps_request->tocity !!}
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="first_name" class="control-label text-left col-sm-3 required">State</label>
                            <div class="col-sm-9">
                                {!! $usps_request->to_state !!}
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="first_name" class="control-label text-left col-sm-3 required">Zip</label>
                            <div class="col-sm-9">
                                {!! $usps_request->to_zip !!}
                            </div>
                        </div>





                    </div>
                </div>
            </div>
        </div>
</section>
<!-- /.content -->
@endsection