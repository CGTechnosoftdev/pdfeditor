@extends('layouts.front-user')
@section('title',($title ?? ''))
@section("content")
<section class="content-header">
    <div class="title">
        <h2><span>Documents</span> > {{$title}}</h2>
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
@include('front.user-document.list-header-operations')
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
            var sort_by = $('#sort_by').val();
            var search_text = $('#search_text').val();
            $.ajax({
                url: "{{route('front.smart-folder-documents-list',$user_smart_folder->id)}}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": csrf_token,
                    sort_by: sort_by,
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
        $(document).on('change', '#folder_name', function(e) {
            e.preventDefault();
            getDocumentList();
        });
        $(document).on('change', '#sort_by', function(e) {
            e.preventDefault();
            getDocumentList();
        });

        $('#search_text').keyup(delayTyping(function(e) {
            getDocumentList();
        }, 500));

        $(document).on('click', '#select-all', function(e) {
            selectAllCheckbox('#select-all', '.document-checkbox');
        })

        $(document).on('click', '#move-to-trash-selected', function(e) {
            e.preventDefault();
            if ($('.document-checkbox:checked').length > 0) {
                var selected_documents = [];
                $('.document-checkbox:checked').each(function() {
                    selected_documents.push($(this).val());
                });
                window.moveToTrash(selected_documents);
            } else {
                toastr.error('No document selected');
            }
        })

    });
</script>
@append