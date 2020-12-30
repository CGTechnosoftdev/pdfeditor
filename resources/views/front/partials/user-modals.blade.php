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
                                 <span>LinkToFit</span>
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


 <!-- Modal -->
 <div class="modal fade more-options share-now" id="linktofit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">LinkToFill</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <h6>Distribute your documents to be filled by anyone</h6>
                 <div class="shareable-file">
                     <img src="{{ asset('public/front/images/file-pdf.svg') }}"> Get a Document Signed
                 </div>
                 <div class="share-by">
                     <div class="publish-to-distribute">
                         <div class="form-group">
                             <label for="public_distribute">Publish to distribute</label>
                             <input type="text" class="form-control" id="public_distribute" placeholder="Not published yet">
                         </div>
                         <button class="btn btn-outline-success"><i class="far fa-copy"></i> Copy Link</button>
                     </div>
                     <div class="share-with-social">
                         <div class="more-options"><span>OR</span></div>
                         <div class="social-btns">
                             <a class="facebook" href=""><i class="fab fa-facebook-f"></i> Share on Facebook</a>
                             <a class="twitter" href=""><i class="fab fa-twitter"></i> Share on Twitter</a>
                         </div>
                         <p>Your document is <a href="">not published</a> yet</p>
                     </div>
                     <div class="share-link-btns">
                         <div class="d-flex justify-content-between">
                             <button class="btn btn-success">Publish</button>
                             <button class="btn btn-outline-success">Advance Settings</button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal -->
 <div class="modal fade more-options share-now" id="share" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Share</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <h6>The documents to be shared:</h6>
                 <div class="shareable-file">
                     <img src="{{ asset('public/front/images/file-pdf.svg') }}"> Get a Document Signed
                 </div>
                 <div class="share-by">
                     <ul class="nav nav-tabs">
                         <li><a class="active" data-toggle="tab" href="#email-link">Share by Email</a></li>
                         <li><a data-toggle="tab" href="#public-link">Share by Public Link</a></li>
                     </ul>

                     <div class="tab-content">
                         <div id="email-link" class="tab-pane fade in active show">
                             <form>
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="email">Email</label>
                                             <input type="email" class="form-control" id="email" placeholder="Enter email">
                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="name">Name</label>
                                             <input type="text" class="form-control" id="name" placeholder="Enter Name">
                                         </div>
                                     </div>
                                 </div>
                             </form>
                         </div>
                         <div id="public-link" class="tab-pane fade">
                             <form>
                                 <div class="row">
                                     <div class="col-md-12">
                                         <div class="form-group">
                                             <label for="public_link">Public Link</label>
                                             <input type="text" class="form-control" id="public_link" value="https://example.com" placeholder="https://example.com">
                                         </div>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                     <div class="share-link-btns">
                         <div class="d-flex justify-content-between">
                             <button class="btn btn-success">Share</button>
                             <button class="btn btn-outline-success">Advance Settings</button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>


 @include('front.partials.forms.user-document-template-form')

 @section("additionaljs")

 <script type="text/javascript">
     $("document").ready(function() {
         $("#userDocTempConId").addClass("hide");
         $("#document-template-submit-id").click(function() {
             $("#user_document_template_form_id").submit();
         })

         $("#user_document_template_form_id").submit(function(e) {


             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });

             e.preventDefault();
             var formData = new FormData(this);
             $.ajax({
                 type: 'POST',
                 url: "{{ route('front.user-document.template-form-save')}}",
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
                     $("#userDocTempConId").removeClass("hide");
                     $("#userDocTempConId").removeClass("alert-danger");
                     $("#userDocTempConId").addClass("alert-success");
                     $("#userDocTempConId").addClass("show");
                     $("#userDocTempConId").html(data.message);

                     setTimeout(function() {
                         $("#userDocTempConId").removeClass("show");
                         $("#userDocTempConId").addClass("hide");
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


         });

     });
 </script>

 @endsection