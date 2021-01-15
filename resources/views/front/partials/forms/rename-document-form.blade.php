<!-- Modal -->
<div class="modal fade more-options rename-document" id="add-new-folder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rename Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['route' => 'front.rename-document-save','method'=>'post','id'=>'rename-document-form']) }}
            {{Form::hidden('document_id',null,array('id' => 'rename_doc_id'))}}
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Document Name</label>
                    {{ Form::text('name',old('name'),['placeholder'=>'Name','id' => 'document_rename_txt_id','class'=>"form-control"]) }}
                    <!-- <input type="text" class="form-control" id="name" placeholder="Enter Name"> -->
                </div>


                <div class="share-link-btns">
                    <div class="d-flex justify-content-between">
                        {!! Form::submit('Update',['class'=>'btn btn-success']) !!}
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\DocumentRenameFormRequest','#rename-document-form') !!}
@append