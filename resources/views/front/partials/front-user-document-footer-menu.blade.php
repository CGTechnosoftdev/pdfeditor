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
            <a href="">
                <div class="more-img">
                    <img src="{{ asset('public/front/images/signnow.svg') }}">
                </div>
                <span>SignNow</span>
            </a>
        </li>
        <li>
            <a href="#" id="sharemenu_itemid">
                <div class="more-img">
                    <img src="{{ asset('public/front/images/signnow.svg') }}">
                </div>
                <span>Share</span>
            </a>
        </li>
        <li>
            <a href="" class="link-to-fill-button">
                <div class="more-img">
                    <img src="{{ asset('public/front/images/signnow.svg') }}">
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
            <div class="modal-body">
                <h5>Send To</h5>
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
            </div>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@include('front.partials.user-modals')
@section('additionaljs')
<script>
    $(document).ready(function() {
        var selected_document = '';
        var selected_document_info = '';
        var model_element = "#linktofill";
        $(document).on('click', '.content .single-document', function(e) {
            e.preventDefault();
            selected_document = $(this).attr('data-id');
            console.log($(this).attr('data-id'));
            $(this).addClass('active').siblings().removeClass('active');
            $('.footer-more-menus').addClass('active').siblings().removeClass('active');
        });

        function getDocumentInfo(document) {
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
                    selected_document_info = result.data;
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
        $(document).on('click', '.link-to-fill-button', function(e) {
            e.preventDefault();
            $(model_element).find('.non-published').removeClass('invisible');
            $(model_element).find('.published').addClass('invisible');
            $(model_element).find('.published-link-div').addClass('disable-div');
            getDocumentInfo(selected_document);
            if (selected_document_info) {
                $(model_element).find('#document-preview').attr('src', selected_document_info.thumbnail_url);
                $(model_element).find('#document-name').html(selected_document_info.formatted_name);
                $(model_element).find('#publish-link').attr('data-document', selected_document_info.encrypted_id);
                $(model_element).find('#advance-setting-link').attr('data-document', selected_document_info.encrypted_id);
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