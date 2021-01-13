<div class="footer-more-menus">
    <ul>
        <li>
            <a href="">
                <div class="more-img">
                    <img src="{{ asset('public/front/images/open.svg') }}">
                </div>
                <span>Open</span>
            </a>
        </li>
        <li>
            <a href="">
                <div class="more-img">
                    <img src="{{ asset('public/front/images/save-as.svg') }}">
                </div>
                <span>Save As</span>
            </a>
        </li>
        <li>
            <a href="">
                <div class="more-img">
                    <img src="{{ asset('public/front/images/convert.svg') }}">
                </div>
                <span>Convert</span>
            </a>
        </li>
        <li>
            <a href="">
                <div class="more-img">
                    <img src="{{ asset('public/front/images/print.svg') }}">
                </div>
                <span>Print</span>
            </a>
        </li>
        <li>
            <a href="">
                <div class="more-img">
                    <img src="{{ asset('public/front/images/convert-to-template.svg') }}">
                </div>
                <span>Convert to Template</span>
            </a>
        </li>
        <li>
            <a href="#" id="sharemenu_itemid">
                <div class="more-img">
                    <img src="{{ asset('public/front/images/share.svg') }}">
                </div>
                <span>Share</span>
            </a>
        </li>
        <li>
            <a href="" class="link-to-fill-button">
                <div class="more-img">
                    <img src="{{ asset('public/front/images/linktofill.svg') }}">
                </div>
                <span>LinkToFill</span>
            </a>
        </li>
    </ul>
    <a href="" class="more-btn" data-toggle="modal" data-target="#exampleModal">
        <div class="more-img">
            <img src="{{ asset('public/front/images/more.svg') }}">
        </div>
        <span>More</span>
    </a>
</div>
<!-- Modal -->
<div class="modal fade more-options" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>More Options</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="shareable-links">
                    <ul>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/email-icon.svg') }}"></div>
                                <span>Email</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/fax.svg') }}"></div>
                                <span>Fax</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/notarize-icon.svg') }}"></div>
                                <span>Notarize</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/send-to-irs-icon.svg') }}"></div>
                                <span>Send to IRS</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/send-via-usps.svg') }}"></div>
                                <span>Sebd via USPS</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/sms-icon.svg') }}"></div>
                                <span>SMS</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/download.svg') }}"></div>
                                <span>Download</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <h5>Workflow</h5>
                <div class="shareable-links">
                    <ul>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/share-document-icon.svg') }}"></div>
                                <span>Share Documents</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/link-icon.svg') }}"></div>
                                <span>LinkToFill</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/sell-my-form.svg') }}"></div>
                                <span>Sell My Form</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/send-for-review-icon.svg') }}"></div>
                                <span>Send for Review</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/share-for-support.svg') }}"></div>
                                <span>Share for Support</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- <h5>Manage Documents</h5>
                <div class="shareable-links">
                    <ul>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/review-pdf.svg') }}"></div>
                                <span>Rewrite PDF</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/rearrange.svg') }}"></div>
                                <span>Rearrange</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/split.svg') }}"></div>
                                <span>Split</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/clear.svg') }}"></div>
                                <span>Clear</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/tag.svg') }}"></div>
                                <span>Tag</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/fill-in-bulk.svg') }}"></div>
                                <span>Fill In Bulk</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/extrack-in-bulk.svg') }}"></div>
                                <span>Extract in Bulk</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/document-info.svg') }}"></div>
                                <span>Document Info</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/protect.svg') }}"></div>
                                <span>Protect</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="link-img"><img src="{{ asset('public/front/images/comment.svg') }}"></div>
                                <span>Comment</span>
                            </a>
                        </li>
                    </ul>
                </div> -->
            </div>
        </div>
    </div>
</div>
@include('front.partials.user-modals')
@section('additionaljs')
<script>
    $(document).ready(function() {
        window.selected_document = '';
        window.selected_document_info = '';
        var model_element = "#linktofill";
        // $(document).on('click', '.content .single-document', function(e) {
        $(document).on('click', '.document-container', function(e) {
            window.selected_document = $(this).attr('data-id');
            var idArray = $(this).attr('id').split("document_list_item_");
            $("#recent_document_select_item").val(idArray[1]);
            $(this).addClass('active').siblings().removeClass('active');
            $('.footer-more-menus').addClass('active').siblings().removeClass('active');
        });
        $(document).on('show.bs.dropdown', '.document-action-menu', function() {
            $(this).closest(".document-container").click();
        });

        $(document).on('click', '.move-to-trash', function() {
            window.moveToTrash(window.selected_document);
        });

        $("#sharemenu_itemid").click(function() {
            // alert("ajax call is ");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var user_document_id = $("#recent_document_select_item").val();
            //  alert("get item info " + user_document_id);
            $("#user_doc_id").val(user_document_id);
            $("#user_doc_id2").val(user_document_id);

            if (user_document_id != 0) {
                // getDocumentInfo(user_document_id);
                // console.log(window.selected_document_info);

                $.ajax({
                    type: 'GET',
                    url: "{{ url('/user-document-share-get')}}/" + user_document_id,
                    success: function(data) {
                        console.log(data);

                        $("#shareDocumentLinkId").html(data.response_data.formatted_name);
                        $("#shareDocumentLinkId").attr("href", data.file_url);
                        $("#public_linkid").val(data.public_link);

                        $("#cust_share").modal("show");

                    }
                });
                // alert("id is " + user_document_id);
                // getDocumentInfo(user_document_id);
                // console.log(window.selected_document_info);


            }



        });


        $("a[id ^= 'share_by_link_']").click(function() {

            var idArray = $(this).attr("id").split("share_by_link_");

            if (idArray[1] == 1) {
                $("#linkid").val("");
            } else if (idArray[1] == 2) {
                $("#linkid").val($("#public_linkid").val());
            }
            $("#form_typeid").val(idArray[1])
        });



        $("#share_button_id").click(function(e) {
            var share_type = $("#form_typeid").val();
            if (share_type == 1) {

                e.preventDefault();
                var formData = new FormData($("#user_document_send_email_form_id")[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('front.user-document.user-document-email-share-save')}}",
                    data: formData,
                    cache: false,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        // this.reset();
                        console.log(JSON.stringify(data));
                        //  var jsonData = $.parseJSON(data.responseText);
                        // alert('File has been uploaded successfully');
                        $("#userDocMsgConId").removeClass("hide");
                        $("#userDocMsgConId").removeClass("alert-danger");
                        $("#userDocMsgConId").addClass("alert-success");
                        $("#userDocMsgConId").addClass("show");
                        $("#userDocMsgConId").html(data.message);

                        setTimeout(function() {
                            $("#userDocMsgConId").removeClass("show");
                            $("#userDocMsgConId").addClass("hide");
                        }, 3000);

                    },
                    error: function(data) {
                        var jsonData = $.parseJSON(data.responseText);
                        $("#userDocMsgConId").removeClass("hide");
                        $("#userDocMsgConId").removeClass("alert-success");
                        $("#userDocMsgConId").addClass("alert-danger");
                        $("#userDocMsgConId").addClass("show");
                        $("#userDocMsgConId").html(jsonData.message);

                        setTimeout(function() {
                            $("#userDocMsgConId").removeClass("show");
                            $("#userDocMsgConId").addClass("hide");
                        }, 3000);
                    }
                });

            } else if (share_type == 2) {


                e.preventDefault();
                var formData = new FormData($("#user_document_share_link_form_id")[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('front.user-document.user-document-link-share-save')}}",
                    data: formData,
                    cache: false,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        // this.reset();
                        console.log(JSON.stringify(data));
                        //  var jsonData = $.parseJSON(data.responseText);
                        // alert('File has been uploaded successfully');
                        $("#userDocMsgConId").removeClass("hide");
                        $("#userDocMsgConId").removeClass("alert-danger");
                        $("#userDocMsgConId").addClass("alert-success");
                        $("#userDocMsgConId").addClass("show");
                        $("#userDocMsgConId").html(data.message);

                        setTimeout(function() {
                            $("#userDocMsgConId").removeClass("show");
                            $("#userDocMsgConId").addClass("hide");
                        }, 3000);

                    },
                    error: function(data) {
                        var jsonData = $.parseJSON(data.responseText);
                        $("#userDocTempConId").removeClass("hide");
                        $("#userDocTempConId").removeClass("alert-success");
                        $("#userDocTempConId").addClass("alert-danger");
                        $("#userDocTempConId").addClass("show");
                        $("#userDocTempConId").html(jsonData.message);

                        setTimeout(function() {
                            $("#userDocTempConId").removeClass("show");
                            $("#userDocTempConId").addClass("hide");
                        }, 3000);
                    }
                });

            }

        });


        $("#advance_settings_id").click(function() {
            var user_document_id = $("#recent_document_select_item").val();
            // alert("{{url('user-document-advance-settings')}}/" + user_document_id);
            window.location.href = "{{url('user-document-advance-settings')}}/" + user_document_id;
        });



        window.getDocumentInfo = function(document) {
            blockUI();
            $.ajax({
                url: "{{route('front.document-info')}}",
                type: "post",
                dataType: 'json',
                async: false,
                data: {
                    "_token": csrf_token,
                    document: document,
                },
                success: function(result) {
                    window.selected_document_info = result.data;
                },
                complete: function() {
                    unblockUI();
                },
                error: function(data) {
                    var response = data.responseJSON;
                    toastr.error(response.message);
                    $(model_element).modal('hide');
                }
            });
        }

        window.moveToTrash = function(document) {
            blockUI();
            $.ajax({
                url: "{{route('front.move-to-trash-save')}}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": csrf_token,
                    document: document,
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
        $(document).on('click', '.link-to-fill-button', function(e) {
            e.preventDefault();
            $(model_element).find('.non-published').removeClass('invisible');
            $(model_element).find('.published').addClass('invisible');
            $(model_element).find('.published-link-div').addClass('disable-div');
            window.getDocumentInfo(window.selected_document);
            if (window.selected_document_info) {
                $(model_element).find('#document-preview').attr('src', window.selected_document_info.thumbnail_url);
                $(model_element).find('#document-name').html(window.selected_document_info.formatted_name);
                $(model_element).find('#publish-link').attr('data-document', window.selected_document_info.encrypted_id);
                $(model_element).find('#advance-setting-link').attr('data-document', window.selected_document_info.encrypted_id);
                $(model_element).modal('show');
            }
        });

        $(document).on('click', '#publish-link', function(e) {
            e.preventDefault();
            blockUI();
            var document = $(this).attr('data-document');
            $.ajax({
                url: "{{route('front.publish-link-to-fill')}}",
                type: "post",
                dataType: 'json',
                async: false,
                data: {
                    "_token": csrf_token,
                    document: document,
                },
                success: function(response) {
                    var response_data = response.data;
                    $(model_element).find('#link-to-fill').val(response_data.publish_link);
                    $(model_element).find('#facebook-share').attr('href', response_data.facebook_share_link);
                    $(model_element).find('#twitter-share').attr('href', response_data.twitter_share_link);
                    $(model_element).find('.non-published').addClass('invisible');
                    $(model_element).find('.published').removeClass('invisible');
                    $(model_element).find('.published-link-div').removeClass('disable-div');
                },
                error: function(data) {
                    var response = data.responseJSON;
                    $(model_element).modal('hide');
                    toastr.error(response.message);
                },
                complete: function() {
                    unblockUI();
                },
            });
        });

        $(document).on('click', '#advance-setting-link', function(e) {
            e.preventDefault();
            blockUI();
            var document = $(this).attr('data-document');
            var url = '{{ route("front.advance-link-to-fill", ":document") }}';
            url = url.replace(':document', document);
            window.location.replace(url);

        });
    });
</script>
@append