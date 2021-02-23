<!-- Modal -->
<div class="modal fade more-options info-document" id="add-new-folder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Document Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="modal_middle_container">
                    <div class="row">
                        <div class="col col-md-3">Name</div>
                        <div class="col col-md-9" id="document_name"></div>
                    </div>
                    <div class="row">
                        <div class="col col-md-3">Create Date</div>
                        <div class="col col-md-9" id="created_date"></div>
                    </div>
                    <div class="row">
                        <div class="col col-md-3">Modified Date</div>
                        <div class="col col-md-9" id="modified_date"></div>
                    </div>
                    <div class="row">
                        <div class="col col-md-3">Created By</div>
                        <div class="col col-md-9" id="created_by"></div>
                    </div>
                    <div class="row ">
                        <div class="col col-md-3">Size</div>
                        <div class="col col-md-9" id="file_size"></div>
                    </div>
                </div>






            </div>

        </div>
    </div>
</div>

@section('additionaljs')

@append