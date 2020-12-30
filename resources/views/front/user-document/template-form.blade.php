{{ Form::open(['route' => 'front.login','method'=>'post','class'=>'login-form','id' => 'user_newlogin_form_id','enctype'=>"multipart/form-data"]) }}
{{ Form::hidden('type',2) }}
{{ Form::file('name',null,array('placeholder'=>'File','class'=>"form-control name"))}}
{{ Form::submit('Click Me!') }}

{{ Form::close() }}
<!--Test Model-->
<!-- Modal -->
<div class="modal fade more-options share-now" id="test_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Testing Only!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Test Model body here!
            </div>
        </div>
    </div>
</div>