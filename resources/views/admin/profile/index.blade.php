@extends('layouts.admin')
@section('title',($title ?? ''))
@section('heading',($heading ?? ''))
@section('sub_heading',($sub_heading ?? ''))
@section('breadcrumb',$breadcrumb)
@section('content')  

<div class="box ">
	<div class="box-header with-border">
		<!--  <h3 class="box-title">Update Profile</h3>-->
		<style>
			.example-modal .modal {
				position: relative;
				top: auto;
				bottom: auto;
				right: auto;
				left: auto;
				display: block;
				z-index: 1;
			}

			.example-modal .modal {
				background: transparent !important;
			}
		</style>


		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
			Change Password
		</button>


		<div class="modal fade" id="modal-default">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Change Password</h4>
						</div>
						<form action="{{route('profilepasswordchange')}}" method="POST" enctype="multipart/form-data">
							@csrf  
							<div class="modal-body">
								<div id="messageboxid"></div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Current Password:</label>
											<input class="form-control" type="password"  name="password2" id="currentpasswordid" value="" />
											<div id="currentpasswordid_con"></div>
										</div>
									</div> 
								</div> 



								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>New Password:</label>
											<input class="form-control"   type="password" name="new-password" id="passwordid" value="" />
											<div id="passwordid_con"></div>
										</div>
									</div> 
								</div> 

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Confirm Password:</label>
											<input class="form-control"  type="password" name="new-password-confirmation" id="confirmpasswordid" value="" />
											<div id="confirmpasswordid_con"></div>
										</div>
									</div> 
								</div> 

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary" id="savepasswordchange">Save changes</button>
							</div>
						</form> 

					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
		</div>

		@if(isset($user))
		{!! Form::model($user,['route' => ['update-profile'],'method' => 'put','enctype'=>"multipart/form-data"]) !!}
		@endif
		{!! Form::token() !!}
		<!-- /.box-header -->
		<div class="box-body">
			<div class="row">
				<div class="form-group col-lg-6 {{ $errors->has('first_name') ? ' has-error' : '' }}">
					{!! Form::label('first_name', 'First Name',['class'=>'form-control-label']) !!}
					<span class="required-label">*</span>
					{!! Form::text('first_name',old('first_name'),['class'=>'form-control  '.($errors->has("first_name") ? "is-invalid" : ""),'id'=>'first_name']) !!}
					<div class="{{ ($errors->has('first_name') ? 'invalid-feedback' : '') }}">
						{{ $errors->first('first_name') }}
					</div>
				</div>
				<div class="form-group col-lg-6 {{ $errors->has('last_name') ? ' has-error' : '' }}">
					{!! Form::label('last_name', 'Last Name',['class'=>'form-control-label']) !!}
					<span class="required-label">*</span>
					{!! Form::text('last_name',old('last_name'),['class'=>'form-control  '.($errors->has("last_name") ? "is-invalid" : ""),'id'=>'last_name']) !!}
					<div class="{{ ($errors->has('last_name') ? 'invalid-feedback' : '') }}">
						{{ $errors->first('last_name') }}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-6 {{ $errors->has('email') ? ' has-error' : '' }}">
					{!! Form::label('email', "Email",['class'=>'form-control-label']) !!}
					<span class="required-label">*</span>
					{!! Form::text('email',old('email'),['class'=>'form-control  '.($errors->has("email") ? "is-invalid" : ""),'id'=>'email','readonly']) !!}
					<div class="{{ ($errors->has('email') ? 'invalid-feedback' : '') }}">
						{{ $errors->first('email') }}
					</div>
				</div>
				<div class="form-group col-lg-6 {{ ($errors->has('country_id') || $errors->has('contact_number')) ? ' has-error' : '' }}">
					{!! Form::label('contact_number', "Contact Number",['class'=>'form-control-label']) !!}
					<span class="required-label">*</span>
					<div class="row">
						<div class="col-md-6">
							{!! Form::select('country_id',[''=>'Select Country Code'] + $country_arr, old('country_id'), ['class'=>'form-control required','data-unit'=>'from']) !!}
							<div class="{{ ($errors->has('country_id') ? 'invalid-feedback' : '') }}">
								{{ $errors->first('country_id') }}
							</div>
						</div> 
						<div class="col-md-6">
							{!! Form::text('contact_number',old('contact_number'),['class'=>'form-control  '.($errors->has("contact_number") ? "is-invalid" : ""),'id'=>'contact_number']) !!}
							<div class="{{ ($errors->has('contact_number') ? 'invalid-feedback' : '') }}">
								{{ $errors->first('contact_number') }}
							</div>
						</div> 

					</div>				
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-6  {{ $errors->has('gender') ? ' has-error' : '' }}">
					{!! Form::label('gender', "Gender", ['class'=>'form-control-label']) !!}
					{!! Form::select('gender',[''=>'Select'] + $gender_arr, old('gender'), ['class'=>'form-control required','data-unit'=>'from']) !!}
					<div class="{{ ($errors->has('gender') ? 'invalid-feedback' : '') }}">
						{{ $errors->first('gender') }}
					</div>
				</div>
				<div class=" form-group col-md-6">
					<label>Image</label>
					<div class="row">
						<div class="col-md-6"><input type="file" name="profile_picture" class="form-control" /></div>
						<div class="col-md-6">
							@if(!empty($user->profile_picture))
							<img src='{{$user->profile_picture}}' width="50px" />
							<br><br> 
							<a href='{{route("delete-profile-picture")}}' onclick="return confirm('Are you sure you want to delete?')">Delete Image</a>
							@endif 
						</div>
					</div>
				</div>
			</div>
			<div class="row">

				<div class="col-xs-12 col-sm-12 col-md-12 ">
					<button type="submit" class="btn btn-primary">Submit</button>

				</div>


			</div>
		</div>
		<!-- /.box-body -->

	</div>
</form>

@endsection
@section('additionaljs')
<script type="text/javascript">
	$("document").ready(function(){
 //  $("#currentpasswordid").val("");
 $("#modal-default").on("click","#savepasswordchange",function(){
     // $("#currentpasswordid").val("");
    //  $("#confirmpasswordid").val("");
     // $("#passwordid").val("");
     $("#messageboxid").val("");

     $.ajax({
     	type: "post",
     	dataType: 'json',
     	url: "{{route('profilepasswordchange')}}",
     	data: "_token={{csrf_token()}}&password="+$("#currentpasswordid").val()+"&new-password="+$("#passwordid").val()+"&new-password-confirmation="+$("#confirmpasswordid").val(), 
     	error:function(request, status, error){
     		console.log(request.responseText);
     		var retdata=jQuery.parseJSON( request.responseText )

     		if(typeof retdata.error != 'undefined')
     		{
     			$("#currentpasswordid").removeClass("is-invalid");
     			$("#passwordid").removeClass("is-invalid");
     			$("#confirmpasswordid").removeClass("is-invalid");
     			$("#currentpasswordid_con").html("");
     			$("#passwordid_con").html('');
     			$("#confirmpasswordid_con").html('');

     			$.each(retdata.error,function(index,value){
     				var messageArray=value.split("#");

     				if(parseInt(messageArray[1])==1)
     				{

     					$("#currentpasswordid_con").html('<span class="is-invalid invalid-feedback"role="alert"><strong>'+messageArray[0]+'</strong></span>');
     					$("#currentpasswordid").addClass(" is-invalid");
     				}
     				if(parseInt(messageArray[1])==2)
     				{
     					$("#passwordid_con").html('<span class="is-invalid invalid-feedback"role="alert"><strong>'+messageArray[0]+'</strong></span>');
     					$("#passwordid").addClass(" is-invalid");

     				}
     				if(parseInt(messageArray[1])==3)
     				{
     					$("#confirmpasswordid_con").html('<span class="is-invalid invalid-feedback"role="alert"><strong>'+messageArray[0]+'</strong></span>');
     					$("#confirmpasswordid").addClass(" is-invalid");
     				}
     			})
               // $("#messageboxid").html(retdata.error);
           }

           if(typeof retdata.message != 'undefined')
           {
           	$("#messageboxid").html(retdata.message);
           }
       }
   }).done(function( msg ) {
         // var retdata=jQuery.parseJSON( msg );
         console.log(msg);
         $("#currentpasswordid").removeClass("is-invalid");
         $("#passwordid").removeClass("is-invalid");
         $("#confirmpasswordid").removeClass("is-invalid");
         $("#currentpasswordid_con").html("");
         $("#passwordid_con").html('');
         $("#confirmpasswordid_con").html('');
         if(typeof msg.message != 'undefined')
         {
         	$("#messageboxid").html(msg.message);
         }
     });


});
});
</script>
@endsection

