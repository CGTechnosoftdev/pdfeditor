@extends('layouts.front-home')
@section('title',($title ?? ''))
@section('heading',($heading ?? ''))
@section('content')
<section class="verify-email-part">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if($verification_status == 'error')
                <div class="card">
                    <div class="card-header text-center">
                        <h1><i class="fa fa-frown-o text-danger"></i> Sorry</h1>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger alert-block">
                            <strong>{!! $verification_message !!}</strong>
                        </div>
                    </div>
                </div>
                @else
                <div class="card">
                    <div class="card-header text-center">
                        <h1><i class="fa fa-smile text-success"></i> Welcome</h1>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-block">
                            <strong>{!! $verification_message !!}</strong>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <!-- <div class="alert alert-success alert-block text-center" id="success_msg_id_container">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{$title}}</div>

                    <div class="card-body">
                        @include('admin.partials.flash-messages')
                        {{$page_content}}
                    </div>
                </div>
            </div>

        </div> -->
    </div>
</section>
@endsection