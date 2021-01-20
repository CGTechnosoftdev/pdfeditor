@extends('layouts.front-user')
@section('title',($title ?? ''))
@section("content")
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="title">
        <h2><?= $title ?></h2>

    </div>
    <div class="heading-btns">
        <button class="btn btn-success addnew-btn" id="add_new_address_btn"><i class="fas fa-plus"></i> Add New</button>


        <div class="input-group input-group-joined input-group-solid ml-3">
            <!--<input class="form-control mr-sm-0" type="search" placeholder="Search" aria-label="Search">-->
            {{form::text('search_text',"",['id'=>'search_text','class' => 'form-control mr-sm-0','placeholder' => 'Search'])}}
            <div class="input-group-append">
                <button class="input-group-text" id="trash_search_triggerid"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg></button>
            </div>
        </div>

    </div>
</section>

<div class="short-by-section">
    <div class="short-checkbox">
        <div class="custom-control custom-checkbox red mr-sm-2" id="selectAllId2">
            <input type="checkbox" class="custom-control-input" id="select-all">
            <label class="custom-control-label font-0" for="select-all">Select All</label>
        </div>
    </div>

    <div class="short-btns">
        <ul>
            <li>
                <a href="#" id="restore_selectedId"><img src="{{asset('public/front/images/copy.svg')}}"> Restore Selected</a>
            </li>
            <li>
                <a href="#" id="delete_address_selectedId"><img src="{{asset('public/front/images/rename.svg')}}"> Deleted Selected</a>
            </li>
        </ul>
        <div class="more-opt">
            <button id="empty_trashlistId"><img src="{{asset('public/front/images/empty-trash.svg')}}"> Empty Trash</button>
        </div>

    </div>
</div>
<!-- Main content -->
<section class="content">
    <section class="content" id="list-section">

    </section>

</section>

@include('front.partials.forms.add-email-address-form')
@endsection
@section('additionaljs')
<script>
    $(document).ready(function() {

        function getAddressList() {
            blockUI();

            var search_text = $('#search_text').val();

            $.ajax({
                url: "{{route('front.address-list-data')}}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": csrf_token,
                    search_text: search_text,
                },
                success: function(response) {
                    $('#list-section').html(response.html);
                    // $('#items-count').html(response.count + " Items");
                },
                complete: function() {
                    unblockUI();
                },
            });
        }
        getAddressList();

        $('#search_text').keyup(delayTyping(function(e) {
            getAddressList();
        }, 500));

        $("body").on("click", "#delete_address_selectedId", function() {

            var form = $("#addressbook-formid");
            form.attr({
                "action": "{{route('front.address-book-delete-operation')}}"
            });
            form.submit();
        });

        $("#add_new_address_btn").click(function() {
            $("#edit_email_address_btn_id").addClass("hide");
            $("#add_email_address_btn_id").addClass("show");
            $("#addresslist_id").val("");
            $(".add_Address").modal('show');
        });
        $("body").on("click", "#add_email_address_btn_id", function() {

            var form = $("#email_address_add_form_id");
            $.ajax({
                url: "{{route('front.address-book-item-add')}}",
                type: "post",
                data: form.serialize(),
                success: function(response) {
                    console.log(response);
                }


            });

        });
        $("body").on("click", "a[id ^= 'editAddressItem_']", function() {
            var id = $(this).attr("data-id");
            alert("id is " + id);
            //addresslist_id
            $("#addresslist_id").val(id);
            $("#edit_email_address_btn_id").addClass("show");
            $("#add_email_address_btn_id").addClass("hide");
            $(".add_Address").modal('show');
            $.ajax({
                url: "{{url('get-address-book-item-edit')}}/" + id,
                type: "get",
                success: function(response) {
                    $("#name").val(response.message.name);
                    $("#email").val(response.message.email);
                    $("#phone").val(response.message.phone);
                    $("#fax").val(response.message.fax);
                }
            });

        });

        $("body").on("click", "#edit_email_address_btn_id", function() {

            var form = $("#email_address_add_form_id");
            $.ajax({
                url: "{{url('address-book-item-edit')}}/" + $("#addresslist_id").val(),
                type: "post",
                data: form.serialize(),
                success: function(response) {
                    console.log(response);
                }
            });

        });

        //editAddressItem_

        //user_document_encripted
        //trash-single-restore-save
        $(document).on("click", "a[id ^= 'deleteAddressItem_']", function() {
            var address_item_id = $(this).attr("data-id");

            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    url: "{{route('front.address-book-item-delete')}}",
                    data: "_token={{csrf_token()}}&address_item_id=" + address_item_id,
                    type: "post",
                    success: function(response) {

                        toastr.success(response.message);
                        location.reload();
                    },
                    error: function(data) {
                        var response = data.responseJSON;
                        toastr.error(response.message);
                        location.reload();
                    },
                });

            }


        });



        var selectAllItems = "#select-all";
        var checkboxItem = ":checkbox";

        $(selectAllItems).click(function() {

            if (this.checked) {
                $(checkboxItem).each(function() {
                    this.checked = true;
                });
            } else {
                $(checkboxItem).each(function() {
                    this.checked = false;
                });
            }

        });


    });
</script>

@append