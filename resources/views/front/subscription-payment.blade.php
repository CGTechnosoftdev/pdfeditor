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
                                        <h2>{{$your_plan_amount}}</h2>
                                        <p>{{$plan_type}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 mb-3">
                                <div class="plan-card">
                                    <h4>Your Account Status</h4>
                                    <div class="plan-status plan-paid">
                                        <h2>{{$subscription_status}}</h2>
                                        <p>{{$subscribed_on}}</p>
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
                        <div class="payment-history-table">
                            <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-layout-fixed">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date Billed</th>
                                            <th scope="col">Date Paid</th>
                                            <th class="billing-peroid" scope="col">Billing Peroid</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user_subscription_list as $sub_index => $subscription_object)
                                        <tr>
                                            <td>{{ !empty($subscription_object->start)?date('M d,Y',strtotime($subscription_object->start)):"-"}}</td>
                                            <td>{{!empty($subscription_object->end)?date('M d,Y',strtotime($subscription_object->end)):"-"}}</td>
                                            <td>{{!empty($subscription_object->start)?date('M d,Y',strtotime($subscription_object->start)):""}} - {{!empty($subscription_object->end)?date('M d,Y',strtotime($subscription_object->end)):""}}</td>
                                            <td>{{ !empty($subscription_object->subscription_plan_amount)?$DEFAULT_CURRNCY.$subscription_object->subscription_plan_amount:"-"}}</td>
                                            <td>
                                                @switch($subscription_object->subscription_status)
                                                @case($SUBSCRIPTION_STATUS_YES)
                                                Paid
                                                @break
                                                @case($SUBSCRIPTION_STATUS_TRAIL)
                                                Trial
                                                @break
                                                @default
                                                No-Payment
                                                @endswitch
                                            </td>
                                            <td><a href="#"><i class="fas fa-eye"></i></a> <a href="#"><i class="fas fa-eye"></i></a></td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
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
<script src="{{asset('public/front/dataTable/jquery.dataTables.min.js')}}"></script>

<script>
    $(document).ready(function() {
        // alert("heelo");
        $('#dtBasicExample').DataTable({
            "searching": false,
            "bInfo": false,
            "sPaginationType": "full_numbers",
        });


    });
</script>
@endsection