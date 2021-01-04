<!-- Modal -->
<div class="modal fade more-options create-folder" id="add-new-folder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['route' => 'front.add-new-folder','method'=>'post','id'=>'add-new-folder-form']) }}
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Folder Name</label>
                    {{ Form::text('name',old('name'),['placeholder'=>'Enter Name','class'=>"form-control",'id'=>'name']) }}
                    <!-- <input type="text" class="form-control" id="name" placeholder="Enter Name"> -->
                </div>


                <div class="share-link-btns">
                    <div class="d-flex justify-content-between">
                        {!! Form::submit('Create',['class'=>'btn btn-success']) !!}
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\UserAddFolderFormRequest','#add-new-folder-form') !!}
@append