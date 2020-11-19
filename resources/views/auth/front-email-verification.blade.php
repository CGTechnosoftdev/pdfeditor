@extends('layouts.front-home')

@section('content')
<section class="verify-email-part">
        <div class="container">
            <div class="alert alert-success alert-block text-center" id="success_msg_id_container">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$title}}</div>

                <div class="card-body">
                @include('admin.partials.flash-messages')
                    {{$page_content}}
                </div>
            </div>
        </div>

    </div>
</div>
</section>
@endsection
