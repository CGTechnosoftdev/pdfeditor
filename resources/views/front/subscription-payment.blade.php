@extends('layouts.user-account')
@section("content")
<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="user-panel">
            <div class="image">
                <img src="{{asset('public/front/images/user.jpg')}}" class="rounded-circle" alt="User Image">
            </div>
            <div class="info">
                <p>bootstrap develop</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <a href="#" class="free-trial">Sign Up Free Trial</a>

        <ul class="list-unstyled components">
            <!-- <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul>
                </li> -->
            <li>
                <a href="#"><span><img src="{{asset('public/front/images/account-card-details.svg')}}"></span>Account Information</a>
            </li>
            <li class="active">
                <a href="#"><span><img src="{{asset('public/front/images/payment.svg')}}"></span>Subscription & Payment</a>
            </li>
            <li>
                <a href="#"><span><img src="{{asset('public/front/images/settings.svg')}}"></span>Settings</a>
            </li>
            <li>
                <a href="#"><span><img src="{{asset('public/front/images/integrations.svg')}}"></span>Integrations</a>
            </li>
            <li>
                <a href="#"><span><img src="{{asset('public/front/images/user-circle.svg')}}"></span>Personal Information</a>
            </li>
            <li>
                <a href="#"><span><img src="{{asset('public/front/images/audit-trial.svg')}}"></span>Audit Trail</a>
            </li>
            <li>
                <a href="#"><span><img src="{{asset('public/front/images/custom-branding.svg')}}"></span>Custom Branding</a>
            </li>
            <li>
                <a href="#"><span><img src="{{asset('public/front/images/address-book.svg')}}"></span>Address Book</a>
            </li>
            <li>
                <a href="#"><span><img src="{{asset('public/front/images/api.svg')}}"></span>API</a>
            </li>
        </ul>

        <!-- <ul class="list-unstyled CTAs">
                <li>
                    <a href="#" class="download">Download source</a>
                </li>
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                </li>
            </ul> -->
    </nav>

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
                                    <h4>Your Plan</h4>
                                    <div class="plan-status account-plan">
                                        <h2></h2>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 mb-3">
                                <div class="plan-card">
                                    <h4>Your Account Status</h4>
                                    <div class="plan-status plan-paid">
                                        <h2></h2>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="plan-pricing">
                                    <h5>Your Plan Pricing</h5>
                                    <ul>
                                        <li><span class="title">Price per user per month</span> - <strong>$20.00</strong></li>
                                        <li><span class="title">Account minimum charge</span> - <strong>$20.00</strong></li>
                                    </ul>
                                    <button class="btn btn-cancel">Cancel Subscription</button>
                                </div>
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
                    // blockUI();
                },
                complete: function(response) {
                    //  unblockUI();
                }
            },
            search: {
                "regex": true
            },
            columns: JSON.parse(columnsList),
            order: JSON.parse(order),
            pageLength: "{{ Auth::user()->general_setting['paging_limit'] }}"
        });
        if (statusFilterView.length > 0) {
            $(statusFilterView).appendTo("#laravel_datatable_wrapper .dataTables_filter");
        }

        $(document).on('change', '#status_dropdown', function() {
            table.draw();
        });

        // $('#searchForm').on('submit', function(e) {
        // 	e.preventDefault();
        // 	table.draw();
        // });
    });
</script>
@endsection