@extends('layouts.front-user')
@section('title',($title ?? ''))
@section("content")
<section class="content-header">
    <div class="title">
        <h2><span>In/Out Box</span> > {{$title}}</h2>
        <span id="items-count">0 Items</span>
    </div>
    <div class="heading-btns">
        @include('front.partials.forms.add-new-dropdown')

        <div class="input-group input-group-joined input-group-solid ml-3">
            <input class="form-control mr-sm-0" id="search_text" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg></button>
            </div>
        </div>
    </div>
</section>
<div class="short-by-section">
    <div class="short-checkbox">
        <div class="custom-control custom-checkbox red mr-sm-2">
            <input type="checkbox" class="custom-control-input" id="select-all">
            <label class="custom-control-label" for="select-all">Select All</label>
        </div>
    </div>
    <div class="short-btns">
        <ul>
            <li>
                <a href="#" id="delete-selected"><img src="{{ asset('public/front/images/trash-alt.svg') }}"> Delete</a>
            </li>
        </ul>
    </div>
</div>
<!-- Main content -->
<section class="content" id="list-section">
</section>
<!-- /.content -->
@endsection
@section('additionaljs')
<script>
    $(document).ready(function() {
        function getDocumentList() {
            blockUI();
            var search_text = $('#search_text').val();
            $.ajax({
                url: "{{route('front.out-usps-mail-list-data')}}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": csrf_token,
                    search_text: search_text,
                },
                success: function(response) {
                    $('#list-section').html(response.html);
                    $('#items-count').html(response.count + " Items");
                },
                complete: function() {
                    unblockUI();
                },
            });
        }
        getDocumentList();

        $('#search_text').keyup(delayTyping(function(e) {
            getDocumentList();
        }, 500));

        $(document).on('click', '#select-all', function(e) {
            selectAllCheckbox('#select-all', '.document-checkbox');
        })

        $(document).on('click', '#delete-item', function(e) {
            var request = $(this).closest(".single-document").attr('data-id');
            if (request) {
                deleteRequest(request);
            } else {
                toastr.error('Error occoured, Please try again');
            }
        })

        $(document).on('click', '#delete-selected', function(e) {
            e.preventDefault();
            if ($('.document-checkbox:checked').length > 0) {
                var selected_requests = [];
                $('.document-checkbox:checked').each(function() {
                    selected_requests.push($(this).val());
                });
                deleteRequest(selected_requests);
            } else {
                toastr.error('No item selected');
            }
        })

        function deleteRequest(requests) {
            blockUI();
            $.ajax({
                url: "{{route('front.out-usps-mail-delete')}}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": csrf_token,
                    requests: requests,
                },
                success: function(response) {
                    location.reload();
                },
                error: function(data) {
                    var response = data.responseJSON;
                    toastr.error(response.message);
                },
                complete: function() {
                    unblockUI();
                }
            });
        }

    });
</script>
@append