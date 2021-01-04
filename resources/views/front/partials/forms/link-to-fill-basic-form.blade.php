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