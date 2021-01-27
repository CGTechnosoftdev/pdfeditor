@extends('layouts.front-user')
@section('title',($title ?? ''))
@section("content")
<!-- Content Header (Page header) -->


<section class="content-header">
    <div class="title">
        <h2>Address Book</h2>
    </div>
    <div class="heading-btns">
        <div class="form-group folder-dropdown">
            <!-- <button class="btn btn-warning">Document</button>
                    <button class="btn btn-link">Templates</button>
                    <button class="btn btn-link">Notifications</button> -->
            <div class="position-relative">
                <button class="btn btn-lightgray mr-2" id="delete_address_selectedId"><i class="fas fa-trash"></i> Delete</button>
                <button class="btn btn-success addnew-btn" data-toggle="modal" id="add_new_address_btn" data-target="#add-new-contact"><i class="fas fa-plus"></i> Add New Contact</button>
            </div>



            <div class="input-group input-group-joined input-group-solid ml-3">

                {{Form::text('search_text',"",['id'=>'search_text','class' => 'form-control mr-sm-0','placeholder' => 'Search'])}}
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

        $("#importGmailContactsid").click(function(e) {
            e.preventDefault();
            if (confirm("Do you want to import contacts from Google Account?")) {
                window.location.href = $(this).attr("data-url");
            }
        });

        $("#add_new_address_btn").click(function() {
            $("#edit_email_address_btn_id").addClass("hide");
            $("#edit_email_address_btn_id").removeClass("show");
            $("#add_email_address_btn_id").addClass("show");

            $("#addresslist_id").val("");
            $("#name").val("");
            $("#email").val("");
            $("#phone").val("");
            $("#fax").val("");
            $(".add_Address .modal-title").html("Add New Contact");
            $(".add_Address").modal('show');
        });
        $("body").on("click", "#add_email_address_btn_id", function(e) {
            e.preventDefault();
            var form = $("#email_address_add_form_id");
            $("#edit_email_address_btn_id").addClass("hide");

            $("#add_email_address_btn_id").addClass("show");
            $.ajax({
                url: "{{route('front.address-book-item-add')}}",
                type: "post",
                data: form.serialize(),
                success: function(response) {
                    console.log(response);
                    $("#userDocMsgConId").removeClass("hide");
                    $("#address_mg_box_id").removeClass("alert-danger");
                    $("#address_mg_box_id").addClass("alert-success");
                    $("#address_mg_box_id").addClass("show");
                    $("#address_mg_box_id").html(response.message);
                    getAddressList();
                    setTimeout(function() {
                        $("#address_mg_box_id").removeClass("show");
                        $("#address_mg_box_id").addClass("hide");
                        $("#add_Address").modal("hide");
                    }, 3000);
                },
                error: function(data) {
                    var jsonData = $.parseJSON(data.responseText);
                    $("#address_mg_box_id").removeClass("hide");
                    $("#address_mg_box_id").removeClass("alert-success");
                    $("#address_mg_box_id").addClass("alert-danger");
                    $("#address_mg_box_id").addClass("show");
                    $("#address_mg_box_id").html(jsonData.message);

                    setTimeout(function() {
                        $("#address_mg_box_id").removeClass("show");
                        $("#address_mg_box_id").addClass("hide");
                    }, 3000);
                }


            });

        });
        $("body").on("click", "a[id ^= 'editAddressItem_']", function() {
            var id = $(this).attr("data-id");

            //addresslist_id
            $("#addresslist_id").val(id);
            $("#edit_email_address_btn_id").addClass("show");
            $("#add_email_address_btn_id").addClass("hide");
            $("#add_email_address_btn_id").removeClass("show");
            $(".add_Address .modal-title").html("Edit Contact");
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

        $("body").on("click", "#edit_email_address_btn_id", function(e) {
            e.preventDefault();
            var form = $("#email_address_add_form_id");
            $.ajax({
                url: "{{url('address-book-item-edit')}}/" + $("#addresslist_id").val(),
                type: "post",
                data: form.serialize(),
                success: function(response) {
                    console.log(response);
                    $("#userDocMsgConId").removeClass("hide");
                    $("#address_mg_box_id").removeClass("alert-danger");
                    $("#address_mg_box_id").addClass("alert-success");
                    $("#address_mg_box_id").addClass("show");
                    $("#address_mg_box_id").html(response.message);
                    getAddressList();
                    setTimeout(function() {
                        $("#address_mg_box_id").removeClass("show");
                        $("#address_mg_box_id").addClass("hide");
                        $("#add_Address").modal("hide");
                    }, 3000);
                },
                error: function(data) {
                    var jsonData = $.parseJSON(data.responseText);
                    $("#address_mg_box_id").removeClass("hide");
                    $("#address_mg_box_id").removeClass("alert-success");
                    $("#address_mg_box_id").addClass("alert-danger");
                    $("#address_mg_box_id").addClass("show");
                    $("#address_mg_box_id").html(jsonData.message);

                    setTimeout(function() {
                        $("#address_mg_box_id").removeClass("show");
                        $("#address_mg_box_id").addClass("hide");
                    }, 3000);
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