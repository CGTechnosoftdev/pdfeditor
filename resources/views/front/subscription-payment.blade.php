@extends('layouts.user-account')
@section("content")
<div class="wrapper">
    @include('front.partials.user-account-sidebar')

    <!-- Page Content  -->
    <div id="content">

        <div class="main-title">
            <h2>{{$title}}</h2>
        </div>
        <div class="card">
            <div class="subscript-and-payment">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Plan Subscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Payment Method</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Payment History</a>
                    </li>
                </ul>


                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 mb-3">
                                <div class="plan-card">
                                    <h4>Current Plan</h4>
                                    <div class="plan-status account-plan">
                                        <h2>{{$subscription_amount}}</h2>
                                        <p>{{$subscription_period}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 mb-3">
                                <div class="plan-card">
                                    <h4>Current Account Status</h4>
                                    <div class="plan-status {{$account_expired}}">
                                        <h2>{{$current_status}}</h2>
                                        <p>{{$expireDate}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @if(empty($cancel_subscription_message))
                                <div class="plan-pricing" id="upcomming_renewal_containerid">
                                    <h5>Upcomming Renewal</h5>
                                    <ul>
                                        <li><span class="title">Plan Name</span> - <strong>{{$plan_name}}</strong></li>
                                        <li><span class="title">Price</span> - <strong>{{$renewel_price}}</strong></li>
                                        <li><span class="title">Renewal On</span> - <strong>{{$upcomming_renewel}}</strong></li>
                                    </ul>
                                    <button class="btn btn-cancel" id="cancel_subscription_btnid">Cancel Subscription</button>
                                </div>
                                @else
                                <div class="plan-pricing">{{$cancel_subscription_message}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabs-2" role="tabpanel">
                        <div class="create-new-card">
                            <div class="row">
                                <div class="col-md-4">
                                    <form>
                                        <div class="form-group">
                                            <label for="account-discription ">Billing Account Description</label>
                                            <input type="text" class="form-control" id="account-discription" placeholder="Billing Account Description">
                                        </div>
                                        <div class="form-group">
                                            <label for="invoice-email">Invoice Email</label>
                                            <input type="email" class="form-control" id="invoice-email" placeholder="Invoice Email">
                                        </div>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </form>
                                </div>
                                <div class="col-md-7 offset-md-1">
                                    <div class="user-card">
                                        <div class="name-and-type">
                                            <span class="card-holder-name">Card Holder Name</span>
                                            <span class="card-type-logo">Visa</span>
                                        </div>
                                        <div class="card-number">XXXX-XXXX-XXXX-2589</div>
                                        <div class="expiry-date">03/22</div>
                                    </div>
                                    <button class="btn edit-card">Edit Card</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                    <div class="kt-portlet__body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-striped" id="laravel_datatable">
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

        $(document).on("click", "#cancel_subscription_btnid", function() {
            if (!confirm('Are you sure you want to cancel?'))
                return false;

            $.ajax({
                url: "{{route('front.subscription-payment-cancel',[$user_id])}}",
                type: "post",
                data: "user_subscribe_id={{$user_current_subscribe_id}}&_token={{ csrf_token()}}",
                success: function(response) {
                    alert(response);
                    // console.log(response);
                    $("#upcomming_renewal_containerid").html("Subscription Cancel successfully!");

                }
            });
        });

        // $('#searchForm').on('submit', function(e) {
        // 	e.preventDefault();
        // 	table.draw();
        // });
    });
</script>
@endsection