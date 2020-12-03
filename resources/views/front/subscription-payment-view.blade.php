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


                <div class="col-xs-12 col-lg-10 col-md-9">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name" class="control-label text-left col-sm-3 required">Date Billed</label>
                            <div class="col-sm-9">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name" class="control-label text-left col-sm-3 required">Date Paid</label>
                            <div class="col-sm-9">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name" class="control-label text-left col-sm-3 required">Billing Period</label>
                            <div class="col-sm-9">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name" class="control-label text-left col-sm-3 required">Status</label>
                            <div class="col-sm-9">

                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>

    </div>
</div>
@endsection