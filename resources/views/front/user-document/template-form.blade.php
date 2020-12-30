{{ Form::open(['url' => '#','method'=>'post','class'=>'login-form','id' => 'user_document_template_form_id','enctype'=>"multipart/form-data"]) }}
<input type="hidden" name="_token" value="{{ csrf_token()}}">
{{ Form::hidden('type',2) }}
{{ Form::file('name',null,array('placeholder'=>'File','class'=>"form-control name"))}}
{{ Form::button('Click Me!',array('id' => 'document-template-submit-id')) }}

{{ Form::close() }}
<!--Test Model-->
<!-- Modal -->