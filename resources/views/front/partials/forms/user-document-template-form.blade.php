<div class="modal fade more-options share-now" id="user_template_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Testing Only!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['url' => '#','method'=>'post','class'=>'login-form','id' => 'user_document_template_form_id','enctype'=>"multipart/form-data"]) }}
                <input type="hidden" name="_token" value="{{ csrf_token()}}">
                {{ Form::hidden('type',2) }}
                {{ Form::file('name',null,array('placeholder'=>'File','class'=>"form-control name"))}}
                {{ Form::button('Click Me!',array('id' => 'document-template-submit-id')) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<!--Test Model-->
<!-- Modal -->