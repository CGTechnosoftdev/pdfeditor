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
        var selected_document = ''
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
                // async: false,
                data: {
                    "_token": csrf_token,
                    document: document,
                },
                success: function(result) {
                    console.log(result);
                },
                complete: function() {
                    $.unblockUI();
                }
            });
        }
        $(document).on('click', '.link-to-fill-button', function(e) {
            e.preventDefault();
            getDocumentInfo(selected_document);
            $('#linktofill').modal('show');
        });
    });
</script>
@append