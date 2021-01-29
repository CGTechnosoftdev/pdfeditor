@extends('layouts.front-user')
@section("title",$title)
@section("content")

<div class="main-heading">
    <h4>{{$title}}</h4>
</div>
<div class="card p-4">
    <div class="account-info">
        <ul>
            <li>
                <strong>Accound ID</strong>
                <span>{{ $account_id }}</span>
            </li>
            <li>
                <strong>Registration Date</strong>
                <span>{{ $registration_date }}</span>
            </li>
            <li>
                <strong>Last Login</strong>
                <span>{{ $last_login }}</span>
            </li>
        </ul>
    </div>
    @if(empty($user->parent_id))
    <div class="aditional-account-info d-flex">
        <div class="aditional-account-content">
            <h5>Additional Accounts Management <span> <img src="{{ asset('public/front/images/info-i.svg') }}"></span></h5>
            <p>Allow colleagues to enjoy PDF Writer's features with you by adding separate accounts for them.</p>
        </div>
        <div class="aditional-account-btns">
            <a class="additional-btn" href="{{route('front.additional-account-list')}}"><img src="{{ asset('public/front/images/manage-aditional-account.svg') }}"> Manage Additional Accounts</a>
        </div>
    </div>
    @endif
    <!-- <div class="aditional-account-info">
        <div class="aditional-account-content">
            <h5>Internal Email <span> <img src="{{ asset('public/front/images/info-i.svg') }}"></span></h5>
            <p>All the documents sent to your PDF Writer's email address will automatically appear in your PDF Writer account In/Out Box.</p>
            <div class="publish-to-distribute">
                <div class="form-group mb-0">
                    <input type="email" class="form-control" id="public_distribute" value="u1+358184956@pdfwriter.com" placeholder="Email Address">
                </div>
                <button class="btn btn-outline-success mt-0"><i class="far fa-copy"></i> Copy Email</button>
            </div>
        </div>
    </div> -->

    <div class="aditional-account-info d-flex">
        <div class="aditional-account-content">
            <h5>Inbound Fax Number <span> <img src="{{ asset('public/front/images/info-i.svg') }}"></span></h5>
            <p>Receive faxes online directly into your PDF Writer account.</p>
        </div>
        <div class="aditional-account-btns">
            <a class="additional-btn" href=""><img src="{{ asset('public/front/images/fax-number.svg') }}"> Get Fax Number</a>
        </div>
    </div>

    <div class="aditional-account-info">
        <div class="aditional-account-content">
            <h5>Inbound Fax Number <span> <img src="{{ asset('public/front/images/info-i.svg') }}"></span></h5>
        </div>
        <div class="document-statistics">
            <ul>
                <li>
                    <img src="{{ asset('public/front/images/all-docs.svg') }}">
                    <h6>All Documents</h6>
                    <span>7</span>
                </li>
                <li>
                    <img src="{{ asset('public/front/images/fax.svg') }}">
                    <h6>Faxed</h6>
                    <span>5</span>
                </li>
                <li>
                    <img src="{{ asset('public/front/images/encrypted.svg') }}">
                    <h6>Encrypted</h6>
                    <span>4</span>
                </li>
                <li>
                    <img src="{{ asset('public/front/images/share-document-icon.svg') }}">
                    <h6>Share</h6>
                    <span>2</span>
                </li>
                <li>
                    <img src="{{ asset('public/front/images/link-icon.svg') }}">
                    <h6>LinktoFill</h6>
                    <span>7</span>
                </li>
                <li>
                    <img src="{{ asset('public/front/images/share-document-icon.svg') }}">
                    <h6>Send for Review</h6>
                    <span>2</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection