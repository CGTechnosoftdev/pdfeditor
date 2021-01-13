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
@if(!empty($disable_encription))
@include('front.user-document.list-header-operations')
<!-- Main content -->
<section class="content" id="list-section">
</section>
@else
<section class="content encrypted-folder-center pt-4">
    <!-- <div class="recent-documents">
                    <h4>Recent Documents</h4>
                </div> -->

    <div class="encrypted-folder">
        <div class="encrypted-folder-img">
            <img src="../public/front/images/encrypted-folder.svg">
        </div>
        <div class="encrypted-folder-content">
            <h4>Encrypted Folder</h4>
            <p>Keep documents in the Encrypted Folder for additional security. Documents here won't appear in My Documents and require an additional password.</p>

            <span>Enter your password for your Encrypted Folder.</span>
            {{ Form::open(['route' => 'front.encrypted-document-list','method'=>'post','id'=>'encryption_password_form','class'=>'form-horizontal']) }}
            <div class="input-group input-group-joined">
                {{ Form::password('encryption_password',array('placeholder'=>'Enter Encryption Password','class'=>"form-control",'id'=>'encryption_password'))}}
                <div class="input-group-append">
                    {!! Form::submit('Submit',['class'=>'btn btn-success']) !!}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</section>
@endif
<!-- /.content -->
@endsection
@section('additionaljs')
@if(!empty($disable_encription))
<script>
    $(document).ready(function() {
        function getDocumentList() {
            blockUI();
            var sort_by = $('#sort_by').val();
            var search_text = $('#search_text').val();
            $.ajax({
                url: "{{route('front.encrypted-document-list-data')}}",
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
@else
<script>
    $(document).ready(function() {
        $("#encryption_password_form").submit(function(e) {
            e.preventDefault();
            var password = $('#encryption_password').val();
            if (password.length > 0) {
                $(this).off('submit').submit();
            } else {
                toastr.error("Password cannot be empty");
                return false;
            }
        });
    });
</script>
@endif
@append