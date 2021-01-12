@extends('layouts.front-user')
@section('title',($title ?? ''))
@section("content")
<section class="content-header">
    <div class="title">
        <h2><span>Documents</span> > {{$title}}</h2>
        <span id="items-count">0 Items</span>
    </div>
    <div class="heading-btns">
        <div class="form-group folder-dropdown">
            <label for="folder_name">Folder</label>
            <select id="folder_name" class="form-control my-dropdown">
                <option value="">Unsorted</option>
                @foreach($folders_list as $id => $name)
                <option value="{{$id}}">{{$name}}</option>
                @endforeach
            </select>
        </div>
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
            <label class="custom-control-label font-0" for="select-all">.</label>
        </div>
    </div>
    <div class="short-by">
        <label for="sort_by">Sort By :</label>
        <select id="sort_by" class="form-control my-dropdown">
            <option value="updated_at">Modified-Newest</option>
            <option value="created_at">Newest-Modified</option>
        </select>
    </div>
    <div class="short-btns">
        <ul>
            <li>
                <a href="#"><img src="{{ asset('public/front/images/copy.svg') }}"> Duplicate</a>
            </li>
            <li>
                <a href="#"><img src="{{ asset('public/front/images/rename.svg') }}"> Rename</a>
            </li>
            <li>
                <a href="#" id="move-to-trash-selected"><img src="{{ asset('public/front/images/trash-alt.svg') }}"> Move To Trash</a>
            </li>
            <li>
                <a href="#"><img src="{{ asset('public/front/images/move.svg') }}"> Move</a>
            </li>
            <li>
                <a href="#"><img src="{{ asset('public/front/images/clear-alt.svg') }}"> Clear</a>
            </li>
        </ul>
        <div class="more-opt">
            <div class="btn-group">
                <button id="btnGroupDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i> More
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item" href="#"><i class="far fa-edit"></i> Open</a>
                    <a class="dropdown-item" href="#"><i class="far fa-copy"></i> Duplicate</a>
                    <a class="dropdown-item" href="#"><i class="far fa-folder"></i> Move</a>
                </div>
            </div>
        </div>

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
            var folder_name = $('#folder_name').val();
            var sort_by = $('#sort_by').val();
            var search_text = $('#search_text').val();
            $.ajax({
                url: "{{route('front.document-list-data')}}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": csrf_token,
                    folder_name: folder_name,
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