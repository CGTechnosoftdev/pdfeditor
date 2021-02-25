@extends('layouts.front-user')
@section("title",$title)
@section("content")

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="title">
        <h2>{{$title}}</h2>
    </div>
    <div class="heading-btns">
        <div class="form-group folder-dropdown">
            <div class="position-relative">
                <button class="btn btn-lightgray mr-2" id="delete-selected"><i class="fas fa-trash"></i> Delete</button>
                <button class="btn btn-success addnew-btn"><i class="fas fa-plus"></i> Add New Account</button>
            </div>

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
<!-- Main content -->
<section class="content">
    <div class="table-card">
        <div class="table-responsive">
            <table class="table multi-active-tr">
                <thead>
                    <tr>
                        <th class="select-all" scope="col">
                            <div class="custom-control custom-checkbox red mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="select-all">
                                <label class="custom-control-label" for="select-all">&nbsp;</label>
                            </div>
                        </th>
                        <th class="name" scope="col">Name</th>
                        <th class="email" scope="col">Email</th>
                        <th class="phone" scope="col">Phone</th>
                        <th class="fax" scope="col">Status</th>
                        <th class="action" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="list-section">

                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade my-default-modal" id="add-new-account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="user-form" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input name="first_name" type="text" class="form-control" id="first_name" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Last Name</label>
                                <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" type="email" class="form-control" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="number">Contact Number</label>
                                <input name="contact_number" type="text" class="form-control" id="contact_number" placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success submit-btn"></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\AdditionalUserFormRequest','#user-form') !!}
<script>
    $(document).ready(function() {
        var form_modal = $('#add-new-account');
        var form_element = $('#user-form');

        function getDocumentList() {
            blockUI();
            var search_text = $('#search_text').val();
            $.ajax({
                url: "{{route('front.additional-account-list-data')}}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": csrf_token,
                    search_text: search_text,
                },
                success: function(response) {
                    $('#list-section').html(response.html);
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

        $(document).on('click', '.addnew-btn', function(e) {
            e.preventDefault();
            var url = "{{route('front.additional-account-add')}}";
            form_modal.find('.modal-title').html('Add New Account');
            form_modal.find('.submit-btn').html('Add');
            form_modal.find('input:text').val('');
            form_element.attr('action', url)
            form_modal.modal('show');
        });

        $(document).on('click', '.edit-item', function(e) {
            e.preventDefault();
            var item = $(this).closest(".single-item").attr('data-id');
            var url = '{{ route("front.additional-account-detail", ":item") }}';
            url = url.replace(':item', item);
            if (item) {
                blockUI();
                $.ajax({
                    url: url,
                    type: "get",
                    dataType: 'json',
                    data: {
                        "_token": csrf_token,
                        item: item,
                    },
                    success: function(response) {
                        var data = response.data;
                        form_modal.find('input:text').val('');
                        var edit_url = '{{ route("front.additional-account-update", ":item") }}';
                        edit_url = edit_url.replace(':item', data.id);
                        $.each(data, function(key, value) {
                            if ($('#' + key).length > 0) {
                                $('#' + key).val(value);
                            }
                        });
                        form_modal.find('.modal-title').html('Edit Account');
                        form_modal.find('.submit-btn').html('Update');
                        form_element.attr('action', edit_url)
                        form_modal.modal('show');
                    },
                    error: function(data) {
                        var response = data.responseJSON;
                        toastr.error(response.message);
                    },
                    complete: function() {
                        unblockUI();
                    }
                });
            } else {
                toastr.error('Error occoured, Please try again');
            }
        })

        $(document).on('click', '#select-all', function(e) {
            selectAllCheckbox('#select-all', '.document-checkbox');
        })

        $(document).on('click', '.delete-item', function(e) {
            e.preventDefault();
            var item = $(this).closest(".single-item").attr('data-id');
            if (item) {
                deleteRecord(item);
            } else {
                toastr.error('Error occoured, Please try again');
            }
        })


        $(document).on('click', '.change-status', function(e) {
            e.preventDefault();
            var item = $(this).closest(".single-item").attr('data-id');
            if (item) {
                blockUI();
                $.ajax({
                    url: "{{route('front.additional-account-change-status')}}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": csrf_token,
                        item: item,
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
            } else {
                toastr.error('Error occoured, Please try again');
            }
        })

        $(document).on('click', '#delete-selected', function(e) {
            e.preventDefault();
            if ($('.document-checkbox:checked').length > 0) {
                var selected_items = [];
                $('.document-checkbox:checked').each(function() {
                    selected_items.push($(this).val());
                });
                deleteRecord(selected_items);
            } else {
                toastr.error('No record selected');
            }
        })

        function deleteRecord(items) {
            if (confirm("Are you sure want to delete selected user's")) {
                blockUI();
                $.ajax({
                    url: "{{route('front.additional-account-delete')}}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": csrf_token,
                        items: items,
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
        }

    });
</script>
@append