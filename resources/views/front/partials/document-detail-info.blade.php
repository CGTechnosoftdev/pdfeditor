<!-- Modal -->
<div class="modal fade more-options info-document " id="add-new-folder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="col col-md-3">
                            <label>Name</label>
                        </div>
                        <div class="col col-md-9"><span id="document_name"></span></div>
                    </div>
                    <div class="row">
                        <div class="col col-md-3"><label>Create Date</label></div>
                        <div class="col col-md-9"><span id="created_date"></span></div>
                    </div>
                    <div class="row">
                        <div class="col col-md-3"><label>Modified Date</label></div>
                        <div class="col col-md-9"><span id="modified_date"></span></div>
                    </div>
                    <div class="row">
                        <div class="col col-md-3"><label>Created By</label></div>
                        <div class="col col-md-9"><span id="created_by"></span></div>
                    </div>
                    <div class="row ">
                        <div class="col col-md-3"><label>Size</label></div>
                        <div class="col col-md-9"><span id="file_size"></span></div>
                    </div>
                </div>






            </div>

        </div>
    </div>
</div>

@section('additionaljs')

@append