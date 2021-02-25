@extends('layouts.front-user')
@section("content")

<div class="main-title">
    <h2>{{$title}}</h2>
</div>
<div class="card">
    <div class="subscript-and-payment">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Plan Subscription</a>
            </li>
            @if(!empty($card_detail))
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Payment Method</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Payment History</a>
            </li>
        </ul>


        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                @if(!empty($current_plan_data))
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="plan-card">
                            <h4>Current Plan</h4>
                            <div class="plan-status account-plan">
                                <h2>{{$current_plan_data['plan_amount']}}</h2>
                                <p>{{$current_plan_data['plan_name']}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="plan-card">
                            <h4>Current Account Status</h4>
                            <div class="plan-status {{$current_plan_data['plan_class']}}">
                                <h2>{{$current_plan_data['plan_status']}}</h2>
                                <p>Expires on {{$current_plan_data['plan_expiry']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if(!empty($renewal_data))
                        <div class="plan-pricing" id="upcomming_renewal_containerid">
                            <h5>Upcomming Renewal</h5>
                            <ul>
                                <li><span class="title">Plan Name</span> - <strong>{{$renewal_data['plan_name']}}</strong></li>
                                <li><span class="title">Price</span> - <strong>{{$renewal_data['plan_amount']}}</strong></li>
                                <li><span class="title">Renewal On</span> - <strong>{{$renewal_data['renewal_date']}}</strong></li>
                            </ul>
                            {!! Form::open(['url' => route('front.cancel-subscription'),'method' => 'post','class'=>'delete-form',"onSubmit"=>"return confirm('Are you sure you want to cancel subscription?') "]) !!}
                            {{method_field('DELETE')}}
                            {!! Form::token() !!}
                            {!! Form::button('Cancel Subscription', ['type' => 'submit', 'class' => 'btn btn-cancel','title'=>'Cancel Subscription'] ) !!}
                            {!! Form::close() !!}
                        </div>
                        @else
                        <div class="plan-pricing">Subscription Cancelled</div>
                        @endif
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('front.pricing')}}"><button class="btn btn-success">Subscribe now</button></a>
                    </div>
                </div>
                @endif
            </div>
            @if(!empty($card_detail))
            <div class="tab-pane" id="tabs-2" role="tabpanel">
                <div class="create-new-card">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="account-discription ">Billing Account Description</label>
                                <div class="form-control">{{$user->full_name}}</div>
                            </div>
                            <div class="form-group">
                                <label for="invoice-email">Invoice Email</label>
                                <div class="form-control">{{$user->email}}</div>
                            </div>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="user-card">
                                <div class="name-and-type">
                                    <span class="card-holder-name">{{$card_detail['name']}}</span>
                                    <span class="card-type-logo">{{$card_detail['brand']}}</span>
                                </div>
                                <div class="card-number">XXXX-XXXX-XXXX-{{$card_detail['last4']}}</div>
                                <div class="expiry-date">{{$card_detail['exp_month']}}/{{$card_detail['exp_year']}}</div>
                            </div>
                            <button class="btn edit-card" data-toggle="modal" data-target="#edit_card">Edit Card</button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="tab-pane" id="tabs-3" role="tabpanel">

                <!--Begin::Dashboard 3-->

                <!--Begin::Section-->
                <div class="row">
                    <div class="col-md-12">
                        <!--begin::Portlet-->
                        <div class="kt-portlet">
                            <!--begin::Form-->
                            <form class="kt-form">
                                <div class="kt-portlet">
                                    <div class="row">
                                        <div class="form-group validated col-lg-12">
                                            <div class="kt-portlet__body paginations">
                                                <div class="table-responsive">
                                                    <table class="table " id="laravel_datatable">
                                                        <thead>
                                                            <tr>
                                                                @foreach($data_table['data_column_config']['columns'] as $column)
                                                                <th>
                                                                    {{ (array_key_exists('label',$column) ? $column['label'] : '') }}
                                                                </th>
                                                                @endforeach

                                                            </tr>


                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Portlet-->

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<div class="modal fade more-options payment-info-modal" id="edit_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                {{ Form::open(['route' => ['front.update-card'],'method'=>'post','enctype'=>"multipart/form-data","id"=>'card-form']) }}
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Payment Info</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group  {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name On Card<span class="required-label">*</span></label>
                                {{ Form::text('name',old('name'),['placeholder'=>'Enter Name on Card','class'=>"form-control",'id'=>'name'])}}
                                @if ($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('card_number') ? ' has-error' : '' }}">
                                <label for="card_number">Card Number<span class="required-label">*</span></label>
                                {{ Form::text('card_number',old('card_number'),['placeholder'=>'Enter Card Number','class'=>"form-control",'id'=>'card_number','data-inputmask'=>'"mask": "9999-9999-9999-9999"','data-mask'])}}
                                @if ($errors->has('card_number'))
                                <span class="help-block"><strong>{{ $errors->first('card_number') }}</strong></span>
                                @endif
                                <!-- <input type="text" class="form-control" id="card_number" placeholder="Card Number"> -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('expiry_date') ? ' has-error' : '' }}">
                                <label for="card_number">Expiry Date<span class="required-label">*</span></label>
                                {{ Form::text('expiry_date',old('expiry_date'),['placeholder'=>'MM/YYYY','class'=>"form-control",'id'=>'expiry_date','data-inputmask'=>'"alias": "mm/yyyy"','data-mask'])}}
                                @if ($errors->has('expiry_date'))
                                <span class="help-block"><strong>{{ $errors->first('expiry_date') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('cvv') ? ' has-error' : '' }}">
                                <label for="card_number">CVV/CVC<span class="required-label d-content">*</span></label>
                                {{ Form::password('cvv',['placeholder'=>'XXX','class'=>"form-control",'id'=>'cvv'])}}
                                @if ($errors->has('cvv'))
                                <span class="help-block"><strong>{{ $errors->first('cvv') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('zip_code') ? ' has-error' : '' }}">
                                <label for="card_number">Zip Code<span class="required-label d-content">*</span></label>
                                {{ Form::text('zip_code',old('zip_code'),['placeholder'=>'Enter Zip Code','class'=>"form-control",'id'=>'zip_code'])}}
                                @if ($errors->has('zip_code'))
                                <span class="help-block"><strong>{{ $errors->first('zip_code') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endsection
@section("additionaljs")

<script src="{{ asset('public/admin/plugins/jQueryDatatable/jquery.dataTables.min.js') }}"></script>
<script>
    var statusFilterView = '{!! $data_table["status_filter_view"] ?? "" !!}';
    var sourceUrl = '{{ $data_table["data_source"] }}';
    var columnsList = '{!! json_encode($data_table["data_column_config"]["columns"]) !!}';
    var order = '{!! json_encode($data_table["data_column_config"]["order"]) !!}';
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('#laravel_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: sourceUrl,
                type: 'GET',
                data: function(d) {
                    d.statusFilter = $("#status_dropdown").val()
                },
                beforeSend: function() {
                    //    blockUI();
                },
                complete: function(response) {
                    console.log(response);
                    //  unblockUI();
                }
            },
            search: {
                "regex": true
            },
            dom: 'Brtip',
            columns: JSON.parse(columnsList),
            order: JSON.parse(order),
            pageLength: "{{ !empty(Auth::user()->general_setting['paging_limit'])?Auth::user()->general_setting['paging_limit']:10 }}"
        });
        if (statusFilterView.length > 0) {
            $(statusFilterView).appendTo("#laravel_datatable_wrapper .dataTables_filter");
        }

        $(document).on('change', '#status_dropdown', function() {
            table.draw();
        });
    });
</script>
@endsection

@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\EditCardFormRequest','#card-form') !!}
<script src="{{ asset('public/admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('public/admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('public/admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script type="text/javascript">
    $('[data-mask]').inputmask();
</script>
@append