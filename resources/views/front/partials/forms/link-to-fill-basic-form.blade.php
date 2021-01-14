 <!-- Modal -->
 <div class="modal fade more-options share-now" id="linktofill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">LinkToFill</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body" id="link-to-fill-form">
                 <h6>Distribute your documents to be filled by anyone</h6>
                 <div class="shareable-file">
                     <img src="{{ asset('public/front/images/file-pdf.svg') }}" id="document-preview">
                     <span id="document-name"></span>
                 </div>
                 <div class="published-link-div disable-div">
                     <div class="publish-to-distribute">
                         <div class="form-group">
                             <label for="link_to_fill">Publish to distribute</label>
                             <input type="text" class="form-control" name="publish_link" id="link-to-fill" placeholder="Not published yet">
                         </div>
                         <button class="btn btn-outline-success" data-clipboard-demo="" data-clipboard-target="#link-to-fill"><i class="far fa-copy"></i> Copy Link</button>
                     </div>
                     <div class="share-with-social">
                         <div class="more-options"><span>OR</span></div>
                         <div class="social-btns">
                             <a class="facebook" id="facebook-share" href="" target="_blank">
                                 <i class="fab fa-facebook-f"></i> Share on Facebook
                             </a>
                             <a class="twitter" id="twitter-share" href="" target="_blank">
                                 <i class="fab fa-twitter"></i> Share on Twitter
                             </a>
                         </div>
                         <p class="non-published">Your document is <a href="">not published</a> yet</p>
                         <p class="published invisible">Your document is <a href="">published</a> now</p>
                     </div>
                 </div>
                 <div class="share-link-btns">
                     <div class="d-flex justify-content-between non-published">
                         <button class="btn btn-success" id="publish-link" data-document="">Publish</button>
                         <button class="btn btn-outline-success" id="link-to-fill-advance-setting" data-document="">Advance Settings</button>
                     </div>
                     <div class="d-flex justify-content-between published invisible">
                         <button class="btn btn-success" data-dismiss="modal">Done</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>