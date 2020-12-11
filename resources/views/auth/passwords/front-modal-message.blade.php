@extends('layouts.front-home')
@section('content')
@include('front.partials.front-middle-section')
@include('front.blocks.solve-pdf-problems')
<!-- Modal -->
<div class="account-popup modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" role="document">
        <div class="modal-content">
            <div class="modal-body">

 
      
                    <div class="row">
                        <div class="col-md-5">
                        <div class="login-popup login-form ">
                                        <div class="alert alert-success alert-block invisible" id="success_msg_id_container">
                                            <strong id="success_msg_id"></strong>
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                        </div>
                                        <div class="d-table ">
                                            <div class="d-table-cell align-middle">
                                                <div class="heading">

                                                <div class="row">
                                                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block"> 			
                        <strong>{!! $message !!}</strong>
                        <button type="button" class="close" data-dismiss="alert">×</button>
                    </div>
                    @endif


                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <strong>{!! $message !!}</strong>
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                    </div>
                    @endif
                                                </div>
                                                
                                                    
                                                </div>
                                        

                                            </div>
                                        </div>
                                        </div>
                        </div>
                        <div class="col-md-7 pl-md-4">
                            <div class="account-img">
                                <img src="{{ asset('public/front/images/login-bg.png')}}">
                            </div>
                        </div>
                    </div>
              



      

            </div>
        </div>
    </div>
</div>

@endsection
@section('additionaljs')
<script type="text/javascript">
    $('#exampleModal').modal();

   
</script>
@endsection