@extends('layouts.admin')

@section('content')

@section('heading')
Update Profile
@endsection







    

<div class="box box-success">
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

        <form action="{{route('profileupdatesave', $user->id)}}" method="POST" enctype="multipart/form-data">
@csrf        
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label>First Name: *</label>               
                <input type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : ''}}" name="first_name" placeholder="Name" value="{{$user->first_name}}" />
                @if ($errors->has('first_name'))
                <span class="is-invalid invalid-feedback"role="alert">
                    <strong>{{ $errors->first('first_name') }}.</strong>
                </span>
               @endif

            </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">
            <div class="form-group">

<label>Last Name: *</label>


<input type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : ''}}" name="last_name" placeholder="Last Name" value="{{$user->last_name}}" />
@if ($errors->has('last_name'))
                <span class="is-invalid invalid-feedback"role="alert">
                    <strong>{{ $errors->first('last_name') }}.</strong>
                </span>
               @endif

</div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">

<label>Email: *</label>


<input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : ''}}" name="email" placeholder="email" value="{{$user->email}}" />
  @if ($errors->has('email'))
                <span class="is-invalid invalid-feedback"role="alert">
                    <strong>{{ $errors->first('email') }}.</strong>
                </span>
               @endif

</div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                   <label>Gender:</label>
                   <div class="form-control">
                   @foreach($gender_arr as $genderVal => $gendarCaption )
                    <input type="radio" name="gender" class="iradio_minimal-blue" value="{{$genderVal}}" {{($user->gender==$genderVal)?"checked":""}} /> {{$gendarCaption}} &nbsp;&nbsp;
                   @endforeach                                        
                    </div>                    
                   </div>
                </div>

               </div>
           

            <div class="row">
                <div class="col-md-6">
                <div class="row">
             
                  <div class="col-md-6">
                  <div class="form-group">
                            <label>Country:</label>
                            <select name="country_id" class="form-control">
                @foreach ($countryArray as $con_index => $conValue)              
              @if($con_index==$country_id)
               <option value="{{$con_index}}"  selected >{{$conValue}}</option>
              @else               
               <option value="{{$con_index}}"   >{{$conValue}}</option>
              @endif 
@endforeach
</select>
                 </div>

                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                            <label>Contact Number:</label>
                            <input class="form-control"  name="contact_number" value="{{$user->contact_number}}" />
                        </div>

                  </div>
             
              </div>
       
                     
                </div> 
                <div class="col-md-6">
                <div class="form-group">
                          <label>Image</label>
                          <div class="row">
                             <div class="col-md-6"><input type="file" name="profile_picture" class="form-control" /></div>
                             <div class="col-md-6">
                             @if(!empty($user->profile_picture))
                        <img src='{{URL::to('/')."/$directory/".$user->profile_picture}}' width="50px" /><br> <br> <a href='{{route("deleteprofileimage")}}' onclick="return confirm('Are you sure you want to delete?')"  >Delete Image</a>
                        @else
                        <img src='{{URL::to('/')."/".$placeholder}}' width="50px" /><br> 
                        
                    @endif 
                             </div>
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

@endsection
