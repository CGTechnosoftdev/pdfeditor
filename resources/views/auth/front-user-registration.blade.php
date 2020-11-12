@extends('layouts.admin-login')

@section('content')



<section class="content">
	<!-- Info boxes -->
	<div class="box">
		<div class="box-body">
            
			<div class="row">
			<div class="alert alert-success alert-block invisible" id="success_msg_id_container"> 			
 			<strong id="success_msg_id"></strong>
 			<button type="button" class="close" data-dismiss="alert">×</button>
 		</div>
		
				{{ Form::open(['route' => 'front.user.registration.save','method'=>'post','class'=>'form-horizontal','id' => 'user_registration_id','enctype'=>"multipart/form-data"]) }}
				
				{{ Form::hidden("_token", csrf_token())}}
		
				<div class="col-xs-12 col-lg-12 col-md-12">			

				
			
			
					<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
						<label for="email" class="control-label text-left col-sm-4 required">Email<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{{ Form::text('email',null,array('placeholder'=>'Enter Email','class'=>"form-control"))}}
							<span class="text-danger" id="email-error"></span>
						</div>
					</div>
				
					<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password" class="control-label text-left col-sm-4 required">
							Password
							<i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{ config('constant.PASSWORD_REGEX_INSTRUCTION') }}"></i>
						</label>
						<div class="col-sm-8" >
							{{ Form::password('password', ['class' => 'form-control','placeholder' => 'Enter Password ','id'=>'password' ]) }}   
							<span class="text-danger" id="password-error"></span>
						</div>
					</div>
					
                                        
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							
						</div>
					</div>
				</div>
				<!-- /.row -->
			
                
     

                {{ Form::close() }}
                
                
            </div>
            


		</div>
	</div>
</section>
<!-- /.content -->

@endsection
@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\FrontUserRegistrationFormRequest') !!}
@endsection