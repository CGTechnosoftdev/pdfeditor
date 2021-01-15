@extends('layouts.front-user')
@section('title',($title ?? ''))
@section("content")
<section class="content-header">
    <div class="title">
        <h2><span>Documents</span> > {{$title}}</h2>
        <span id="items-count">0 Items</span>
    </div>
    <div class="heading-btns">
        <button class="btn btn-success create-smart-folder"><i class="fas fa-plus"></i> Create New Folder</button>
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
                <a href="#" class="delete-selected"><img src="{{ asset('public/front/images/trash-alt.svg') }}"> Delete</a>
            </li>
        </ul>

    </div>
</div>
<!-- Main content -->
<section class="content" id="list-section">
</section>
<!-- /.content -->
<div class="modal fade more-options" id="smart-folder-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['method'=>'post','class'=>'form-horizontal','id'=>'smart-folder-form']) }}
            <input name="_method" id="_method" type="hidden" value="PUT">
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Folder Name</label>
                    {{ Form::text('name',old('name'),['placeholder'=>'Enter Folder Name','class'=>"form-control",'id'=>'name']) }}
                </div>
                <div class="form-group select-tags-here">
                    <label for="name">Enter tags to filter the documents</label>
                    {!! Form::select('tags[]',($user_tags), old('tags'), ['class'=>'form-control select2','id'=>'tags','multiple'=>true]) !!}
                </div>

                <div class="share-link-btns">
                    <div class="d-flex justify-content-between">
                        {!! Form::submit('Save',['class'=>'btn btn-success']) !!}
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\SmartFolderFormRequest','#smart-folder-form')->ignore('') !!}
<script>
    $(document).ready(function() {
        $("#tags").select2({
            placeholder: "Enter a tag",
            allowClear: true,
            tags: true,
            tokenSeparators: [',']
        });

        function getFolderList() {
            blockUI();
            var search_text = $('#search_text').val();
            $.ajax({
                url: "{{route('front.smart-folder-list-data')}}",
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
        getFolderList();
        $('#search_text').keyup(delayTyping(function(e) {
            getFolderList();
        }, 500));

        $(document).on('click', '#select-all', function(e) {
            selectAllCheckbox('#select-all', '.document-checkbox');
        })

        $(document).on("click", ".delete-selected", function(e) {
            e.preventDefault();
            if ($('.document-checkbox:checked').length > 0) {
                var selected_folders = [];
                $('.document-checkbox:checked').each(function() {
                    selected_folders.push($(this).val());
                });
                deleteFolders(selected_folders);
            } else {
                toastr.error('No document selected');
            }
        });

        $(document).on('click', ".create-smart-folder", function(e) {
            $('#smart-folder-modal').find('.modal-title').html("Add Smart Folder");
            $('#smart-folder-form').attr('action', "{{route('front.add-smart-folder')}}");
            $('#smart-folder-form').find('#_method').val("POST");
            $('#smart-folder-modal').modal('show');
        });
        $(document).on('click', ".update-smart-folder", function(e) {
            e.preventDefault();
            var folder_id = $(this).closest('.single-document').attr("data-folder");
            var detail_url = '{{ route("front.smart-folder-detail", ":folder") }}';
            var form_url = '{{ route("front.update-smart-folder", ":folder") }}';
            detail_url = detail_url.replace(':folder', folder_id);
            form_url = form_url.replace(':folder', folder_id);
            blockUI();
            $.ajax({
                url: detail_url,
                type: "get",
                dataType: 'json',
                success: function(response) {
                    $('#smart-folder-modal').find('#name').val(response.data.name);
                    $('#tags').val(response.data.tags);
                    $('#tags').trigger('change');
                    $('#smart-folder-form').attr('action', form_url);
                    $('#smart-folder-form').find('#_method').val("PUT");
                    $('#smart-folder-modal').find('.modal-title').html("Edit Smart Folder");
                    $('#smart-folder-modal').modal('show');
                    console.log(response);
                },
                error: function(data) {
                    var response = data.responseJSON;
                    toastr.error(response.message);
                },
                complete: function() {
                    unblockUI();
                }
            });

        });

        $(document).on("click", ".delete-smart-folder", function(e) {
            e.preventDefault();
            var folder_id = $(this).closest('.single-document').attr("data-folder");
            deleteFolders(folder_id);
        });

        function deleteFolders(folders) {
            blockUI();
            $.ajax({
                url: "{{route('front.delete-smart-folder')}}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": csrf_token,
                    folders: folders,
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