@extends('layouts.front-user')
@section("title",$title)
@section("content")


<div class="content-container">
    <div class="main-heading">
        <h1>General Settings</h1>
    </div>
    <div class="contact-tabs">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="contact-info">
                    <div class="icon"><img src="../public/front/images/email-outline.svg"></div>
                    <div class="info">
                        <span>Email Address</span>
                        <p>{{$user->email}}</p>
                    </div>
                    <div class="edit">

                        <a id="general_seettings_email_frm_trigger_id" href="#"><img src="../public/front/images/edit-outline.svg"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="contact-info">
                    <div class="icon"><img src="../public/front/images/phone-outline.svg"></div>
                    <div class="info">
                        <span>Phone Number </span>
                        <p>{{$user->contact_number}}</p>
                    </div>
                    <div class="edit">
                        <a id="general_seettings_phone_frm_trigger_id" href="#"><img src="../public/front/images/edit-outline.svg"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="contact-info">
                    <div class="icon"><img src="../public/front/images/lock_outline.svg"></div>
                    <div class="info">
                        <p>Change Password</p>
                    </div>
                    <div class="edit">
                        <a id="general_seettings_password_frm_trigger_id" href="#"><img src="../public/front/images/arrow-right.svg"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="general-settings-tabs">
        <h4 class="active">
            <div class="d-flex align-items-center">
                <div class="tab-icon"><img src="../public/front/images/time-clock.svg"></div>
                <div class="tab-content">
                    <span>Time &amp; Date Settings</span>
                    <p>Select your Timezone</p>
                </div>
                <div class="tab-info">
                    <img src="../public/front/images/info-i.svg">
                </div>
            </div>
        </h4>
        <div class="setting-tab-content">
            <div class="heading">
                <h6>Current Time:</h6>
                <h5>12/01/20 12:00 AM Eastern Time (US &amp; Canada)</h5>
            </div>
            {{ Form::open(['url' => "#",'method'=>'post','class'=>'login-form','id' => 'general_settings_date_time_form_id','enctype'=>"multipart/form-data","autocomplete" => 'off']) }}

            <div class="row">
                <div class="col-md-7 col-sm-8">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-md-3 col-form-label">Time zone</label>
                        <div class="col-sm-8 col-md-9">
                            {{Form::select("timezone",$timezone_list,($general_settings->timezone??0),["id" => 'timezoneid'])}}

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-md-3 col-form-label">Time Format</label>
                        <div class="col-sm-8 col-md-9">
                            <div class="timeformate">
                                <ul>
                                    @foreach($time_format_arr as $time_index => $timeValue)
                                    <li class="active"><span>{{$timeValue}}</span></li>
                                    {{ Form::radio('time_format', $time_index , (($general_settings->time_format==$time_index)?true:false)) }}
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-md-3 col-form-label">Date Format</label>
                        <div class="col-sm-9 col-md-9">
                            {{Form::select('date_format',$date_time_arr,($general_settings->date_format??0),["id" => 'date_formatid'])}}
                        </div>
                    </div>
                    <button class="btn btn-success" id="general_settings_time_date_btn_id">Update</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
        <h4>
            <div class="d-flex align-items-center">
                <div class="tab-icon"><img src="../public/front/images/security.svg"></div>
                <div class="tab-content">
                    <span>Authdentication &amp; Access Security</span>
                    <p>Account Access and Security</p>
                </div>
                <div class="tab-info">
                    <img src="../public/front/images/info-i.svg">
                </div>
            </div>
        </h4>


        <div class="setting-tab-content">
            {{ Form::open(['url' => "#",'method'=>'post','class'=>'login-form','id' => 'general_settings_grant_access_form_id','enctype'=>"multipart/form-data","autocomplete" => 'off']) }}
            {{Form::select('grant_access',$grant_access_arr,1)}}
            <button class="btn btn-success" id="general_settings_grant_access_btn_id">Update</button>
            {{ Form::close() }}

        </div>


        <h4>
            <div class="d-flex align-items-center">
                <div class="tab-icon"><img src="../public/front/images/security.svg"></div>
                <div class="tab-content">
                    <span>Encripted Folder</span>
                    <p></p>
                </div>
                <div class="tab-info">
                    <img src="../public/front/images/info-i.svg">
                </div>
            </div>
        </h4>


        <div class="setting-tab-content">


            <button class="btn btn-success" id="general_settings_encript_folder_btn_id">Update Encript Folder</button>

        </div>


        <h4>
            <div class="d-flex align-items-center">
                <div class="tab-icon"><img src="../public/front/images/security.svg"></div>
                <div class="tab-content">
                    <span>HIPAA Compliance</span>
                    <p></p>
                </div>
                <div class="tab-info">
                    <img src="../public/front/images/info-i.svg">
                </div>
            </div>
        </h4>


        <div class="setting-tab-content">
            {{Form::hidden('hippa_compliance',((!empty($general_settings->hipaa_compliance)&& $general_settings->hipaa_compliance != 'NULL')??0),["id" => "hippa_complianceid" ])}}
            <button class="btn btn-success" id="general_settings_hipaa_convi_btn_id">Update Hipaa</button>
        </div>



        <h4>
            <div class="d-flex align-items-center">
                <div class="tab-icon"><img src="../public/front/images/bell.svg"></div>
                <div class="tab-content">
                    <span>Notification Preferences</span>
                    <p>Manage Email Notifications</p>
                </div>
                <div class="tab-info">
                    <img src="../public/front/images/info-i.svg">
                </div>
            </div>
        </h4>
        <div class="setting-tab-content">
            Notification form
            {{Form::hidden('notification_preference',((!empty($general_settings->notification_preference)&& $general_settings->notification_preference != 'NULL')??0),["id" => "notification_preference" ])}}
            <button class="btn btn-success" id="general_settings_notification_btn_id">Update Notification</button>
        </div>
        <!--<h4>
            <div class="d-flex align-items-center">
                <div class="tab-icon"><img src="../public/front/images/card.svg"></div>
                <div class="tab-content">
                    <span>Payment System</span>
                    <p>Collect Payment</p>
                </div>
                <div class="tab-info">
                    <img src="../public/front/images/info-i.svg">
                </div>
            </div>
        </h4>
        <div class="setting-tab-content">
            <ul>
                <li>Nam de isto magna dissensio est.</li>
                <li>Quis istud possit, inquit, negare?</li>
                <li>Quod mihi quidem visus est, cum sciret, velle tamen confitentem audire Torquatum.</li>
                <li>Sic enim censent, oportunitatis esse beate vivere.</li>
                <li>Nam de isto magna dissensio est.</li>
                <li>Quis istud possit, inquit, negare?</li>
                <li>Quod mihi quidem visus est, cum sciret, velle tamen confitentem audire Torquatum.</li>
                <li>Sic enim censent, oportunitatis esse beate vivere.</li>
                <li>I need to fix this... "section" should wrap around the "ul"</li>
            </ul>
        </div>
        <h4>
            <div class="d-flex align-items-center">
                <div class="tab-icon"><img src="../public/front/images/e-sign.svg"></div>
                <div class="tab-content">
                    <span>E-Sign Method</span>
                    <p>Select E-Sign Method</p>
                </div>
                <div class="tab-info">
                    <img src="../public/front/images/info-i.svg">
                </div>
            </div>
        </h4>
        <div class="setting-tab-content">
            <ul>
                <li>Nam de isto magna dissensio est.</li>
                <li>Quis istud possit, inquit, negare?</li>
                <li>Quod mihi quidem visus est, cum sciret, velle tamen confitentem audire Torquatum.</li>
                <li>Sic enim censent, oportunitatis esse beate vivere.</li>
                <li>Nam de isto magna dissensio est.</li>
                <li>Quis istud possit, inquit, negare?</li>
                <li>Quod mihi quidem visus est, cum sciret, velle tamen confitentem audire Torquatum.</li>
                <li>Sic enim censent, oportunitatis esse beate vivere.</li>
                <li>I need to fix this... "section" should wrap around the "ul"</li>
            </ul>
        </div> 
        <h4>
            <div class="d-flex align-items-center">
                <div class="tab-icon"><img src="../public/front/images/editing-settings.svg"></div>
                <div class="tab-content">
                    <span>Document Editing Settings</span>
                    <p>Choose Edit Type</p>
                </div>
                <div class="tab-info">
                    <img src="../public/front/images/info-i.svg">
                </div>
            </div>
        </h4>
        <div class="setting-tab-content">
            <ul>
                <li>Nam de isto magna dissensio est.</li>
                <li>Quis istud possit, inquit, negare?</li>
                <li>Quod mihi quidem visus est, cum sciret, velle tamen confitentem audire Torquatum.</li>
                <li>Sic enim censent, oportunitatis esse beate vivere.</li>
                <li>Nam de isto magna dissensio est.</li>
                <li>Quis istud possit, inquit, negare?</li>
                <li>Quod mihi quidem visus est, cum sciret, velle tamen confitentem audire Torquatum.</li>
                <li>Sic enim censent, oportunitatis esse beate vivere.</li>
                <li>I need to fix this... "section" should wrap around the "ul"</li>
            </ul>
        </div>-->

    </section>

</div>
<br />

@include('front.partials.forms.general-settings-password-update')
@include('front.partials.forms.general-settings-phone-update')
@include('front.partials.forms.general-settings-email-update')
@include('front.partials.forms.general-settings-encript-folder-update')
@endsection
@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\GeneralSettingsEmailUpdateFormRequest','#general_settings_email_form_id') !!}
{!! JsValidator::formRequest('App\Http\Requests\GeneralSettingsPasswordUpdateFormRequest','#general_settings_password_form_id') !!}
{!! JsValidator::formRequest('App\Http\Requests\GeneralSettingsFolderEncriptPasswordUpdateFormRequest','#general_settings_encript_folder_form_id') !!}
{!! JsValidator::formRequest('App\Http\Requests\GeneralSettingsPhoneUpdateFormRequest','#general_settings_phone_form_id') !!}
<script>
    $(document).ready(function() {
        $("#general_seettings_email_frm_trigger_id").click(function() {

            $.ajax({
                url: "{{route('front.general-settings-email-reset-request',[$user->id])}}",
                type: "post",
                data: "_token={{csrf_token()}}",
                success: function(response) {
                    console.log("respone");
                    console.log(response);
                    toastr.success(response.message);
                },
                error: function(data) {
                    var response = data.responseJSON;
                    toastr.error(response.message);
                }

            });
            // $(".gs_email_update_modal").modal("show");
        });
        var is_email_update = "{{$is_email_update}}";
        if (is_email_update == true) {
            $(".gs_email_update_modal").modal("show");
        }
        // alert(is_email_update);

        var is_contact_number_update = "{{$is_contact_number_update}}";
        if (is_contact_number_update == true) {
            $(".gs_phone_update_modal").modal("show");
        }

        $("#general_seettings_password_frm_trigger_id").click(function() {
            $(".gs_password_update_modal").modal("show");
        });
        $("#general_seettings_phone_frm_trigger_id").click(function() {
            alert("reset pone ");
            $.ajax({
                url: "{{route('front.general-settings-phone-reset-request',[$user->id])}}",
                type: "post",
                data: "_token={{csrf_token()}}",
                success: function(response) {
                    console.log("respone");
                    console.log(response);
                    toastr.success(response.message);
                },
                error: function(data) {
                    var response = data.responseJSON;
                    toastr.error(response.message);
                }

            });

            //  $(".gs_phone_update_modal").modal("show");
        });

        $("#general_settings_encript_folder_btn_id").click(function() {
            $(".folder_encript_update_modal").modal("show");
        });


        $('#general_seeting_email_btn_id').click(function(e) {
            e.preventDefault();
            $("#general_settings_email_form_id").submit();
        });
        $("#general_settings_time_date_btn_id").click(function(e) {
            e.preventDefault();
            //  var formData = new FormData($("#general_settings_date_time_form_id")[0]);
            var formData = $('#general_settings_date_time_form_id');
            $.ajax({
                url: "{{route('front.general-settings-date_time-update')}}",
                type: "post",
                data: formData.serialize(),
                success: function(response) {
                    toastr.success(response.message);
                },
                error: function(data) {
                    var response = data.responseJSON;
                    toastr.error(response.message);
                }
            });

        });
        $("#general_settings_grant_access_btn_id").click(function(e) {
            e.preventDefault();
            var formData = $("#general_settings_grant_access_form_id");

            $.ajax({
                url: "{{route('front.general-settings-grant_access-update')}}",
                type: "post",
                data: formData.serialize(),
                success: function(response) {
                    toastr.success(response.message);
                },
                error: function(data) {
                    var response = data.responseJSON;
                    toastr.error(response.message);
                }
            });

        });

        $('#general_settings_hipaa_convi_btn_id').click(function(e) {
            e.preventDefault();

            var hippa_complianceid = $("#hippa_complianceid").val();
            if (hippa_complianceid == "")
                hippa_complianceid = 0;
            var on_off_arr = <?php echo  json_encode($on_off_arr) ?>;



            console.log(on_off_arr);

            var on_off_key_array = {};
            $.map(on_off_arr, function(val, i) {
                on_off_key_array[val] = i;
            });
            console.log(on_off_key_array);

            var update_value = "";
            if (on_off_arr[hippa_complianceid] == "On") {
                update_value = on_off_key_array["Off"];
            } else if (on_off_arr[hippa_complianceid] == "Off") {
                update_value = on_off_key_array["On"];
            }

            $("#hippa_complianceid").val(update_value)
            $.ajax({
                url: "{{route('front.general-settings_hipaa_compliance-update')}}",
                type: "post",
                data: "_token={{csrf_token()}}&hipaa_compliance=" + update_value,
                success: function(response) {
                    toastr.success(response.message);
                },
                error: function(data) {
                    var response = data.responseJSON;
                    toastr.error(response.message);
                }
            });

        });

        $('#general_settings_notification_btn_id').click(function(e) {
            e.preventDefault();
            var notification_preference = $("#notification_preference").val();
            if (notification_preference == "")
                notification_preference = 0;
            var on_off_arr = <?php echo  json_encode($on_off_arr) ?>;
            // var on_off_arr = "{!! json_encode($on_off_arr) !!}";

            //alert(on_off_arr[is_notification_promotionid]);
            var on_off_key_array = {};
            $.map(on_off_arr, function(val, i) {
                on_off_key_array[val] = i;
            });
            var update_value = "";
            if (on_off_arr[notification_preference] == "On") {
                update_value = on_off_key_array["Off"];
            } else if (on_off_arr[notification_preference] == "Off") {
                update_value = on_off_key_array["On"];
            }

            $("#notification_preference").val(update_value)
            $.ajax({
                url: "{{route('front.general-settings_notification_preference-update')}}",
                type: "post",
                data: "_token={{csrf_token()}}&notification_preference=" + update_value,
                success: function(response) {
                    toastr.success(response.message);
                },
                error: function(data) {
                    var response = data.responseJSON;
                    toastr.error(response.message);
                }
            });

        });

    });
</script>
@append