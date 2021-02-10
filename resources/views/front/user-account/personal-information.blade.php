@extends('layouts.front-user')
@section("title",$title)
@section("content")
<div class="main-heading">
    <h4>{{$title}}</h4>
</div>
<div class="card p-4">
    <div class="aditional-account-info personal-info border-top-0">
        {{ Form::model($user_model,['route' => ['front.personal-information-save',$user_id],'method'=>'post','id'=>'profile-info-update-form','enctype'=>"multipart/form-data","autocomplete" => 'off']) }}
        <div class="aditional-account-content">
            <h5>User Profile <span> <img src="{{asset('public/front/images/info-i.svg')}}"></span></h5>
        </div>
        <div class="profile-logo-upload-preview pb-3">
            <div class="profile-logo-upload">
                <h6>Upload Picture</h6>
                <a>
                    <!--<input type="file" id="dvd_image"> -->
                    {{ Form::file('profile_picture', ['id' => 'dvd_image','accept'=>".png, .jpg, .jpeg"]) }} Change Picture
                </a>
            </div>

            <div class="profile-logo-preview">
                <div class="preview {{(!empty($profile_picture)?'':'hide')}}">
                    <img src="{{$profile_picture}}" class="image_to_upload" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    {{Form::text('first_name',old('first_name'),['placeholder' => 'First Name','id' => 'first_name','class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="first-name">Last Name</label>
                    {{Form::text('last_name',old('last_name'),['placeholder' => 'Last Name','id' => 'last_name','class' => 'form-control'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="aditional-account-content">
                    <h5>Phone and Fax Number <span> <img src="{{asset('public/front/images/info-i.svg')}}"></span></h5>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="first-name">Phone Number</label>
                    {{Form::text('contact_number',old('contact_number'),['placeholder' => 'Phone Number','class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="first-name">Fax Number</label>
                    {{Form::text('fax_number',old('fax_number'),['placeholder' => 'Fax Number','class' => 'form-control'])}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="aditional-account-content">
                    <h5>Company Information <span> <img src="{{asset('public/front/images/info-i.svg')}}"></span></h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="first-name">Company Name</label>
                    {{Form::text('company_name',old('company_name'),['placeholder' => 'Company Name','class' => 'form-control'])}}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="first-name">Job Title</label>
                    {{Form::text('company_job_title',old('company_job_title'),['placeholder' => 'Job Title','class' => 'form-control'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="aditional-account-content">
                    <h5>Address <span> <img src="{{asset('public/front/images/info-i.svg')}}"></span></h5>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="first-name">Address Line1</label>
                    {{Form::text('address_line_1',old('address_line_1'),['placeholder' => 'Address Line1','class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="first-name">Address Line2</label>
                    {{Form::text('address_line_2',old('address_line_2'),['placeholder' => 'Address Line2','class' => 'form-control'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="first-name">Country</label>
                    {{Form::select('countries_id',$countary_list,old('countries_id'),['placeholder' => 'Country','class' =>'form-control'])}}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="first-name">State</label>
                    {{Form::text('state',old('state'),['placeholder' => 'State','class' => 'form-control'])}}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="first-name">City</label>
                    {{Form::text('city',old('city'),['placeholder' => 'City','class' => 'form-control'])}}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="first-name">Zip Code</label>
                    {{Form::text('zip_code',old('zip_code'),['placeholder' => 'Zip Code','class' => 'form-control'])}}
                </div>
            </div>



        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group border-top mt-3 pt-4">

                    {!! Form::submit('Save',['class'=>'btn btn-success addnew-btn','id'=>'share_btn']) !!}
                </div>
            </div>
        </div>

        {{ Form::close() }}
    </div>
</div>



@endsection
@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\PersonalInformationFormRequest','#profile-info-update-form') !!}
<script>
    (function() {
        // Display the image to be uploaded.
        $('#dvd_image').on('change', function(e) {
            return readURL(this);
        });

        this.readURL = function(input) {
            var reader;

            // Read the contents of the image file to be uploaded and display it.

            if (input.files && input.files[0]) {
                reader = new FileReader();
                reader.onload = function(e) {
                    var $preview;
                    $('.image_to_upload').attr('src', e.target.result);
                    $preview = $('.preview');
                    if ($preview.hasClass('hide')) {
                        return $preview.toggleClass('hide');
                    }
                };
                return reader.readAsDataURL(input.files[0]);
            }
        };

    }).call(this);
</script>
@append